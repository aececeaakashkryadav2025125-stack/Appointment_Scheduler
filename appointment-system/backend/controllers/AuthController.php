<?php
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../utils/response.php";

class AuthController {

    public function register() {
        $conn = $GLOBALS['conn'];

        $data = json_decode(file_get_contents("php://input"));

        $name = $data->name;
        $email = $data->email;
        $password = password_hash($data->password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

        if ($conn->query($sql)) {
            response(true, null, "User registered");
        } else {
            response(false, null, "Email already exists");
        }
    }

    public function login() {
        $conn = $GLOBALS['conn'];

        $data = json_decode(file_get_contents("php://input"));

        $email = $data->email;
        $password = $data->password;

        $result = $conn->query("SELECT * FROM users WHERE email='$email'");
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            response(true, $user, "Login success");
        } else {
            response(false, null, "Invalid credentials");
        }
    }
}
?>