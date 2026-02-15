<?php

class Admin extends Controller
{
    use Database;

    public function index()
    {

        if (!isset($_SESSION['USER']) || $_SESSION['USER']->role !== 'admin') {
            // Nếu chưa đăng nhập hoặc không phải admin -> Đá về trang login
            header("Location: " . ROOT . "/auth");
            exit;
        }

        // 1. Tính TỔNG ĐƠN ĐẶT (Total Bookings)
        $total_booking = $this->query("SELECT count(id) as total FROM booking");
        // Kiểm tra kết quả để tránh lỗi nếu database trống
        $data['total_bookings'] = ($total_booking && isset($total_booking[0])) ? $total_booking[0]->total : 0;


        // 2. Tính SỐ PHÒNG TRỐNG (Available Rooms)
        // Dựa vào ảnh database bạn gửi: ID 1 = Available
        $available_rooms = $this->query("SELECT count(id) as total FROM room WHERE status_id = 1");
        $data['available_rooms'] = ($available_rooms && isset($available_rooms[0])) ? $available_rooms[0]->total : 0;


        // 3. Tính DOANH THU THÁNG (Monthly Revenue)
        $current_month = date('m');
        $current_year = date('Y');

        $query_revenue = "SELECT COALESCE(SUM(booking_amount), 0) as total 
                          FROM booking 
                          WHERE MONTH(checkin_date) = :month 
                          AND YEAR(checkin_date) = :year
                          AND payment_status_id = 2"; // <--- THÊM DÒNG NÀY

        $revenue = $this->query($query_revenue, [
            'month' => $current_month,
            'year'  => $current_year
        ]);

        $data['revenue'] = ($revenue && isset($revenue[0])) ? $revenue[0]->total : 0;


        // 4. LẤY DANH SÁCH ĐƠN HÀNG (Cho bảng bên dưới)
        $query = "
        SELECT 
            b.id, 
            b.status, -- [THÊM CỘT NÀY]
            g.first_name, g.last_name, g.email_address, g.phone_number,
            r.room_number, 
            rc.class_name as room_type,
            ps.payment_status_name as payment_status -- Đổi alias cho rõ nghĩa
        FROM booking b
        JOIN guest g ON b.guest_id = g.id
        LEFT JOIN booking_room br ON b.id = br.booking_id
        LEFT JOIN room r ON br.room_id = r.id
        LEFT JOIN room_class rc ON r.room_class_id = rc.id
        LEFT JOIN payment_status ps ON b.payment_status_id = ps.id
        ORDER BY b.id DESC LIMIT 10
        ";

        $rows = $this->query($query);
        $data['rows'] = $rows ? $rows : []; // Gán mảng rỗng nếu không có dữ liệu

        // Gửi toàn bộ $data sang View
        $this->view('dashboard/dashboard', $data);
    }

    // Giữ nguyên hàm delete để nút xóa hoạt động
    public function delete($id = null)
    {
        if (!isset($_SESSION['USER']) || $_SESSION['USER']->role !== 'admin') {
            die("Bạn không có quyền thực hiện hành động này!");
        }

        if ($id) {
            // [MỚI 1] Lấy danh sách các phòng thuộc đơn hàng này trước khi xóa
            $rooms = $this->query("SELECT room_id FROM booking_room WHERE booking_id = :id", ['id' => $id]);

            // [MỚI 2] Duyệt qua từng phòng và cập nhật trạng thái về "Trống" (Available - ID 1)
            if ($rooms) {
                foreach ($rooms as $room) {
                    // Giả định status_id = 1 là Available (khớp với logic Dashboard bạn đã làm)
                    $this->query("UPDATE room SET status_id = 1 WHERE id = :rid", ['rid' => $room->room_id]);
                }
            }

            // [CŨ] Sau khi trả phòng xong thì mới xóa dữ liệu trong các bảng liên quan
            $this->query("DELETE FROM booking_room WHERE booking_id = :id", ['id' => $id]);
            $this->query("DELETE FROM booking_addon WHERE booking_id = :id", ['id' => $id]);
            $this->query("DELETE FROM booking WHERE id = :id LIMIT 1", ['id' => $id]);
        }

        // Chuyển hướng về trang hiện tại (Sửa lại đường dẫn nếu ở file Customers.php)
        // Nếu ở Admin.php:
        header("Location: " . ROOT . "/admin");
        // Nếu ở Customers.php:
        // header("Location: " . ROOT . "/customers"); 
        exit;
    }

    public function profile()
    {
        // 1. Kiểm tra quyền Admin
        if (!isset($_SESSION['USER']) || $_SESSION['USER']->role !== 'admin') {
            header("Location: " . ROOT . "/auth");
            exit;
        }

        $id = $_SESSION['USER']->id;
        $message = "";

        // 2. Xử lý cập nhật thông tin (Khi bấm nút Lưu)
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);

            if (!empty($username)) {
                // Cập nhật tên
                $this->query("UPDATE users SET username = :username WHERE id = :id", [
                    'username' => $username,
                    'id'       => $id
                ]);

                // Cập nhật mật khẩu (Nếu có nhập)
                if (!empty($password)) {
                    $hash = password_hash($password, PASSWORD_DEFAULT);
                    $this->query("UPDATE users SET password = :password WHERE id = :id", [
                        'password' => $hash,
                        'id'       => $id
                    ]);
                }

                // Cập nhật lại Session để hiển thị tên mới ngay lập tức
                $_SESSION['USER']->username = $username;

                $message = "Cập nhật thông tin thành công!";
            } else {
                $message = "Tên đăng nhập không được để trống!";
            }
        }

        // 3. Lấy thông tin mới nhất từ DB
        $user = $this->query("SELECT * FROM users WHERE id = :id LIMIT 1", ['id' => $id]);

        $data['user'] = $user[0];
        $data['message'] = $message;
        $data['page_title'] = "Thông tin tài khoản";

        $this->view('dashboard/profile', $data); // Gọi view profile
    }
}
