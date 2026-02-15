<?php

class Booking extends Controller
{
    use Database;

    public function index()
    {
        $this->view('booking/booking');
    }

    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            // --- [FIX LỖI] LOGIC XỬ LÝ KHÁCH HÀNG THÔNG MINH ---

            $guest_id = null;
            $email = $_POST['email_address'];
            $phone = $_POST['phone_number'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];

            // 1. Kiểm tra xem khách hàng này đã tồn tại chưa (Dựa trên Email hoặc SĐT)
            // Tuyệt đối KHÔNG tìm theo user_id ở bước này để tránh lỗi Admin bị ghi đè thông tin
            $check_guest = $this->query("SELECT id FROM guest WHERE email_address = :email OR phone_number = :phone LIMIT 1", [
                'email' => $email,
                'phone' => $phone
            ]);

            if ($check_guest) {
                // A. KHÁCH CŨ -> Lấy ID và cập nhật thông tin mới nhất
                $guest_id = $check_guest[0]->id;

                $this->query("UPDATE guest SET 
                    first_name = :fn, 
                    last_name = :ln, 
                    phone_number = :pn, 
                    email_address = :em 
                    WHERE id = :id", [
                    'fn' => $first_name,
                    'ln' => $last_name,
                    'pn' => $phone,
                    'em' => $email,
                    'id' => $guest_id
                ]);
            } else {
                // B. KHÁCH MỚI -> Tạo hồ sơ mới (INSERT)
                
                // Xử lý User ID:
                // - Nếu là Admin đặt hộ: user_id = NULL (để tách biệt hồ sơ)
                // - Nếu là Khách tự đặt: user_id = ID của họ
                $user_id_val = null;
                if (isset($_SESSION['USER'])) {
                    if ($_SESSION['USER']->role == 'admin') {
                        $user_id_val = null; // Admin đặt hộ -> Không gán ID admin
                    } else {
                        $user_id_val = $_SESSION['USER']->id; // Khách tự đặt -> Gán ID khách
                    }
                }

                $query_guest = "INSERT INTO guest (first_name, last_name, email_address, phone_number, user_id) 
                                VALUES (:fn, :ln, :em, :pn, :uid)";
                
                $this->query($query_guest, [
                    'fn'  => $first_name,
                    'ln'  => $last_name,
                    'em'  => $email,
                    'pn'  => $phone,
                    'uid' => $user_id_val
                ]);

                // Lấy ID khách hàng vừa tạo
                $last_guest = $this->query("SELECT id FROM guest ORDER BY id DESC LIMIT 1");
                $guest_id = $last_guest[0]->id;
            }

            // ----------------------------------------------------

            // 2. LƯU THÔNG TIN ĐẶT PHÒNG
            $booking_data = [
                'guest_id'          => $guest_id,
                'payment_status_id' => 1, // Unpaid
                'checkin_date'      => $_POST['checkin_date'],
                'checkout_date'     => $_POST['checkout_date'],
                'num_adults'        => $_POST['num_adults'],
                'num_children'      => $_POST['num_children'],
                'booking_amount'    => $_POST['total_amount']
            ];

            $query_booking = "INSERT INTO booking (guest_id, payment_status_id, checkin_date, checkout_date, num_adults, num_children, booking_amount) 
                              VALUES (:guest_id, :payment_status_id, :checkin_date, :checkout_date, :num_adults, :num_children, :booking_amount)";
            $this->query($query_booking, $booking_data);

            // Lấy Booking ID vừa tạo
            $last_booking = $this->query("SELECT id FROM booking ORDER BY id DESC LIMIT 1");
            $booking_id = $last_booking[0]->id;

            // 3. Lưu chi tiết phòng và CẬP NHẬT TRẠNG THÁI
            if (isset($_POST['room_ids']) && is_array($_POST['room_ids'])) {
                foreach ($_POST['room_ids'] as $room_id) {
                    $this->query("INSERT INTO booking_room (booking_id, room_id) VALUES (:booking_id, :room_id)", [
                        'booking_id' => $booking_id,
                        'room_id'    => $room_id
                    ]);

                    // Cập nhật trạng thái phòng -> Đã đặt (2)
                    $this->query("UPDATE room SET status_id = 2 WHERE id = :id", ['id' => $room_id]);
                }
            }

            // 4. LƯU CHI TIẾT DỊCH VỤ 
            if (isset($_POST['addon_ids']) && is_array($_POST['addon_ids'])) {
                foreach ($_POST['addon_ids'] as $addon_id) {
                    $this->query("INSERT INTO booking_addon (booking_id, addon_id) VALUES (:booking_id, :addon_id)", [
                        'booking_id' => $booking_id,
                        'addon_id'   => $addon_id
                    ]);
                }
            }

            header('Content-Type: application/json');
            echo json_encode(['status' => 'success', 'message' => 'Đặt phòng thành công!']);
            exit;
        }
    }

    // --- XỬ LÝ CHECK-IN ---
    public function checkin($id = null)
    {
        if (!$id) return;

        $this->query("UPDATE booking SET status = 'checked_in' WHERE id = :id", ['id' => $id]);

        $rooms = $this->query("SELECT room_id FROM booking_room WHERE booking_id = :id", ['id' => $id]);
        if ($rooms) {
            foreach ($rooms as $r) {
                // Phòng chuyển sang trạng thái 2 (Đang ở)
                $this->query("UPDATE room SET status_id = 2 WHERE id = :rid", ['rid' => $r->room_id]);
            }
        }

        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }

    // --- XỬ LÝ CHECK-OUT ---
    public function checkout($id = null)
    {
        if (!$id) return;

        // Cập nhật booking -> checked_out và đã thanh toán
        $this->query("UPDATE booking SET status = 'checked_out', payment_status_id = 2 WHERE id = :id", ['id' => $id]);

        $rooms = $this->query("SELECT room_id FROM booking_room WHERE booking_id = :id", ['id' => $id]);
        if ($rooms) {
            foreach ($rooms as $r) {
                // Phòng chuyển sang trạng thái 4 (Dọn dẹp)
                $this->query("UPDATE room SET status_id = 4 WHERE id = :rid", ['rid' => $r->room_id]);
            }
        }

        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }
}
