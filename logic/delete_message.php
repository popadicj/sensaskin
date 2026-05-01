<?php
session_start();
require_once "../config/connection.php";

if(isset($_POST['id_message'])) {
    $id = $_POST['id_message'];
    $stmt = $conn->prepare("DELETE FROM messages WHERE id = ?");
    if($stmt->execute([$id])) {
        http_response_code(200);
    }
}