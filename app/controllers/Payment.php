<?php

class Payment extends Controller
{
    use Database;

    public function checkout($booking_id = null)
    {
        // 1. Cấu hình Múi giờ chuẩn Việt Nam (Bắt buộc)
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        
        if (!$booking_id) die("Lỗi: Không tìm thấy mã đơn hàng.");

        $booking = $this->query("SELECT * FROM booking WHERE id = :id LIMIT 1", ['id' => $booking_id]);
        if (!$booking) die("Lỗi: Đơn hàng không tồn tại.");
        
        // 2. CẤU HÌNH TRỰC TIẾP (Để loại trừ lỗi file config)
        $vnp_TmnCode = "GISS1M9C"; 
        $vnp_HashSecret = "VP4587OY9RO0JQ2ZNH3C15VQJ4Q7SJM8"; 
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_ReturnUrl = ROOT . "/payment/callback";
        
        // 3. Xử lý dữ liệu đơn hàng
        $vnp_TxnRef = $booking_id; 
        // Loại bỏ ký tự đặc biệt (như dấu #) để tránh lỗi mã hóa
        $vnp_OrderInfo = "Thanh toan don " . $booking_id; 
        $vnp_OrderType = "billpayment";
        $vnp_Amount = (int)($booking[0]->booking_amount * 100); 
        $vnp_Locale = 'vn';
        
        // [QUAN TRỌNG] Fix cứng IP Localhost (Tránh lỗi ::1 của IPv6)
        $vnp_IpAddr = "127.0.0.1";

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_ReturnUrl,
            "vnp_TxnRef" => $vnp_TxnRef
        );

        // 4. Sắp xếp và tạo URL (Quy trình chuẩn)
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        header('Location: ' . $vnp_Url);
        exit;
    }

    public function callback()
    {
        // CẤU HÌNH LẠI TẠI ĐÂY
        $vnp_HashSecret = "VP4587OY9RO0JQ2ZNH3C15VQJ4Q7SJM8";
        
        $inputData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }
        
        $vnp_SecureHash = $inputData['vnp_SecureHash'] ?? '';
        unset($inputData['vnp_SecureHash']);
        
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        
        if ($secureHash == $vnp_SecureHash) {
            if ($_GET['vnp_ResponseCode'] == '00') {
                // Xử lý thành công
                $booking_id = $_GET['vnp_TxnRef'];
                $this->query("UPDATE booking SET status = 'checked_out', payment_status_id = 2 WHERE id = :id", ['id' => $booking_id]);
                
                $rooms = $this->query("SELECT room_id FROM booking_room WHERE booking_id = :id", ['id' => $booking_id]);
                if ($rooms) {
                    foreach ($rooms as $r) {
                        $this->query("UPDATE room SET status_id = 4 WHERE id = :rid", ['rid' => $r->room_id]);
                    }
                }
                echo "<script>alert('Thanh toán thành công!'); window.location.href = '" . ROOT . "/room';</script>";
            } else {
                echo "<script>alert('Giao dịch thất bại! Mã lỗi: " . $_GET['vnp_ResponseCode'] . "'); window.location.href = '" . ROOT . "/room';</script>";
            }
        } else {
            echo "Chữ ký không hợp lệ (Signature Mismatch)!";
        }
    }
}
