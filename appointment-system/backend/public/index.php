<?php
header("Content-Type: application/json");

require_once "controllers/AuthController.php";
require_once "controllers/AppointmentController.php";

$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// 🔥 REMOVE /index.php from path
$path = str_replace("/appointment-system/backend/index.php", "", $path);

$auth = new AuthController();
$app = new AppointmentController();

if ($path == "/register" && $method == "POST") {
    $auth->register();
}
elseif ($path == "/login" && $method == "POST") {
    $auth->login();
}
elseif ($path == "/appointments" && $method == "POST") {
    $app->book();
}
elseif ($path == "/appointments" && $method == "GET") {
    $app->getAll();
}
elseif (preg_match("/\/appointments\/(\d+)/", $path, $matches)) {
    $app->delete($matches[1]);
}
else {
    echo json_encode(["message" => "Route not found"]);
}
?>