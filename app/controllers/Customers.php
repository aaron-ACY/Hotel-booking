<?php

class Customers extends Controller
{
    use Database;

    public function index()
    {
        $query = "SELECT 
                g.id as guest_id, 
                g.first_name, 
                g.last_name, 
                g.email_address, 
                g.phone_number, 
                b.id as booking_id, 
                b.status,
                b.checkin_date, 
                b.checkout_date,
                r.room_number,
                rc.class_name as room_type  -- Đổi tên cột để khớp với View
              FROM booking b
              JOIN guest g ON b.guest_id = g.id
              LEFT JOIN booking_room br ON b.id = br.booking_id
              LEFT JOIN room r ON br.room_id = r.id
              LEFT JOIN room_class rc ON r.room_class_id = rc.id -- Join đúng bảng room_class
              ORDER BY b.id DESC";

        $rows = $this->query($query);

        $this->view('booking/customers', [
            'rows' => $rows
        ]);
    }

    public function delete($id = null)
    {
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
        header("Location: " . ROOT . "/customers");
        // Nếu ở Customers.php:
        // header("Location: " . ROOT . "/customers"); 
        exit;
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $id = $_POST['id'];
            $full_name = trim($_POST['full_name']);
            $email = $_POST['email'];
            $phone = $_POST['phone'];

            // Logic tách Họ và Tên
            $parts = explode(" ", $full_name);
            if (count($parts) > 1) {
                $last_name = array_pop($parts);
                $first_name = implode(" ", $parts);
            } else {
                $first_name = "";
                $last_name = $full_name;
            }

            $query_guest = "UPDATE guest SET 
                        first_name = :first_name, 
                        last_name = :last_name, 
                        email_address = :email, 
                        phone_number = :phone 
                        WHERE id = :id LIMIT 1";

            $data_guest = [
                'id' => $id,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'phone' => $phone
            ];

            $this->query($query_guest, $data_guest);

            header("Location: " . ROOT . "/customers");
            exit;
        }
    }
}
