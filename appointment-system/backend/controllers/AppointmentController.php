<?php
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../utils/response.php";

class AppointmentController {

    public function book() {
        $conn = $GLOBALS['conn'];

        $data = json_decode(file_get_contents("php://input"));

        $user_id = $data->user_id;
        $date = $data->appointment_date;
        $time = $data->appointment_time;

        $check = $conn->query("SELECT * FROM appointments 
            WHERE appointment_date='$date' AND appointment_time='$time'");

        if ($check->num_rows > 0) {
            response(false, null, "Slot already booked");
            return;
        }

        $sql = "INSERT INTO appointments (user_id, appointment_date, appointment_time)
                VALUES ('$user_id', '$date', '$time')";

        if ($conn->query($sql)) {
            response(true, null, "Appointment booked");
        } else {
            response(false, null, "Booking failed");
        }
    }

    public function getAll() {
        $conn = $GLOBALS['conn'];

        $result = $conn->query("SELECT * FROM appointments");

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        response(true, $data, "Fetched");
    }

    public function delete($id) {
        $conn = $GLOBALS['conn'];

        $conn->query("DELETE FROM appointments WHERE id=$id");
        response(true, null, "Deleted");
    }
}
?>