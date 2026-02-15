<?php

class Room extends Controller
{
    use Database;

    public function index()
    {
        // 1. Lấy danh sách phòng kèm thông tin chi tiết
        $query = "
            SELECT 
                r.id, r.room_number, r.status_id, r.floor_id, r.room_class_id,
                rc.class_name, rc.base_price,
                rs.status_name,
                f.floor_number,
                
                -- [MỚI] Lấy ID đơn đặt phòng hiện tại (để gắn vào link nút bấm)
                (SELECT b.id 
                 FROM booking b 
                 JOIN booking_room br ON b.id = br.booking_id 
                 WHERE br.room_id = r.id AND b.payment_status_id != 2 
                 ORDER BY b.id DESC LIMIT 1) as booking_id,

                -- [MỚI] Lấy trạng thái đơn đặt (để biết hiện nút Check-in hay Check-out)
                (SELECT b.status 
                 FROM booking b 
                 JOIN booking_room br ON b.id = br.booking_id 
                 WHERE br.room_id = r.id AND b.payment_status_id != 2 
                 ORDER BY b.id DESC LIMIT 1) as booking_status,

                -- Thông tin khách (nếu có)
                (SELECT CONCAT(g.first_name, ' ', g.last_name) 
                 FROM booking b 
                 JOIN booking_room br ON b.id = br.booking_id 
                 JOIN guest g ON b.guest_id = g.id 
                 WHERE br.room_id = r.id AND b.payment_status_id != 2 
                 ORDER BY b.id DESC LIMIT 1) as current_guest,
                 
                -- Ngày check-in (nếu có)
                (SELECT b.checkin_date
                 FROM booking b 
                 JOIN booking_room br ON b.id = br.booking_id 
                 WHERE br.room_id = r.id AND b.payment_status_id != 2 
                 ORDER BY b.id DESC LIMIT 1) as checkin_date,

                -- Ngày check-out (nếu có)
                (SELECT b.checkout_date 
                 FROM booking b 
                 JOIN booking_room br ON b.id = br.booking_id 
                 WHERE br.room_id = r.id AND b.payment_status_id != 2 
                 ORDER BY b.id DESC LIMIT 1) as checkout_date

            FROM room r
            JOIN room_class rc ON r.room_class_id = rc.id
            JOIN room_status rs ON r.status_id = rs.id
            JOIN floor f ON r.floor_id = f.id
            ORDER BY f.floor_number ASC, r.room_number ASC
        ";

        $rooms = $this->query($query);

        // 2. Nhóm phòng theo Tầng & Thống kê
        $floors_data = [];
        $stats = ['total' => 0, 'available' => 0, 'occupied' => 0, 'cleaning' => 0, 'maintenance' => 0];

        if ($rooms) {
            foreach ($rooms as $room) {
                $floors_data[$room->floor_number][] = $room;

                $stats['total']++;
                if ($room->status_id == 1) $stats['available']++;
                elseif ($room->status_id == 2) $stats['occupied']++;
                elseif ($room->status_id == 3) $stats['maintenance']++;
                elseif ($room->status_id == 4) $stats['cleaning']++;
            }
        }

        $data['floors'] = $floors_data;
        $data['stats'] = $stats;
        $data['page_title'] = 'Quản lý phòng';

        $this->view('room', $data);
    }

    // API Cập nhật trạng thái phòng (Dọn dẹp/Bảo trì -> Trống)
    public function update_status()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['room_id'], $_POST['status_id'])) {
            $room_id = $_POST['room_id'];
            $status_id = $_POST['status_id'];

            $this->query("UPDATE room SET status_id = :status_id WHERE id = :id", [
                'status_id' => $status_id,
                'id' => $room_id
            ]);

            header("Location: " . ROOT . "/room");
            exit;
        }
    }
}
