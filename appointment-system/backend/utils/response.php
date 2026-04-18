<?php
function response($success, $data, $message) {
    echo json_encode([
        "success" => $success,
        "data" => $data,
        "message" => $message
    ]);
}
?>