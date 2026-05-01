<?php
session_start();
require_once "../config/connection.php";
if(isset($_POST['id_user'])) {
    $id = $_POST['id_user'];

    if($id == $_SESSION['user']->id_user) {
        http_response_code(403);
        echo json_encode(["msg" => "You can't erase yourself!"]);
        exit();
    }
    $delete = $conn->prepare("DELETE FROM users WHERE id_user = ?");
    $res = $delete->execute([$id]);

    if($res) {
        http_response_code(200);
    } else {
        http_response_code(500);
    }
}