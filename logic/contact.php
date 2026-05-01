<?php
header("Content-Type: application/json");
require_once "../config/connection.php";

if(isset($_POST['send'])) {
    $name = $_POST['fullName'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    try {
        $query = "INSERT INTO messages (full_name, email, message) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $result = $stmt->execute([$name, $email, $message]);
        if($result) {
            echo json_encode(["message" => "Message sent successfully!"]);
        }
    } catch(PDOException $e) {
        http_response_code(500);
        echo json_encode(["message" => "Database error."]);
    }
}