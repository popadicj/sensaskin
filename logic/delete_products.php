<?php
session_start();
require_once "../config/connection.php";

if(isset($_POST['id_product'])) {
    $id = $_POST['id_product'];

    $stmt = $conn->prepare("SELECT image FROM products WHERE id_product = ?");
    $stmt->execute([$id]);
    $img = $stmt->fetch();

    $delete = $conn->prepare("DELETE FROM products WHERE id_product = ?");
    $res = $delete->execute([$id]);

    if($res) {
        if(file_exists("../assets/img/" . $img->image)) {
            unlink("../assets/img/" . $img->image);
        }
        http_response_code(200);
    } else {
        http_response_code(500);
    }
}