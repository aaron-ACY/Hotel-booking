<?php

class Admin extends Controller
{
    use Database;

    public function index()
    {
        $total_booking = $this->query("SELECT count(id) as total FROM booking");
        $data['total_bookings'] = $total_booking[0]->total ?? 0;

        $query = "
        SELECT 
            b.id, 
            g.first_name, g.last_name, g.email_address, g.phone_number,
            r.room_number, 
            rc.class_name as room_type,
            ps.payment_status_name as status
        FROM booking b
        JOIN guest g ON b.guest_id = g.id
        LEFT JOIN booking_room br ON b.id = br.booking_id
        LEFT JOIN room r ON br.room_id = r.id
        LEFT JOIN room_class rc ON r.room_class_id = rc.id
        LEFT JOIN payment_status ps ON b.payment_status_id = ps.id
        ORDER BY b.id DESC LIMIT 10
    ";

        $data['rows'] = $this->query($query);
        $this->view('dashboard/dashboard', $data);
    }

    public function delete($id = null)
    {
        if ($id) {
            $this->query("DELETE FROM booking_room WHERE booking_id = :id", ['id' => $id]);
            $this->query("DELETE FROM booking_addon WHERE booking_id = :id", ['id' => $id]);
            $query = "DELETE FROM booking WHERE id = :id LIMIT 1";
            $this->query($query, ['id' => $id]);
        }

        header("Location: " . ROOT . "/admin");
        exit;
    }
}
