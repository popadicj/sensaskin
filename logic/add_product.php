<?php
session_start();
require_once "../config/connection.php";

if(isset($_POST['btnAddProduct'])) {
    $name = $_POST['pName'];
    $price = $_POST['pPrice'];
    $oldPrice = !empty($_POST['pOldPrice']) ? $_POST['pOldPrice'] : null;
    $cat = $_POST['pCat'];
    $skinType = $_POST['pSkinType'];
    $desc = $_POST['pDesc'];
    $isPopular = isset($_POST['pPopular']) ? 1 : 0;
    $image = $_FILES['pImage'];

    $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
    $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
    $newImageName = time() . "_" . rand(100, 999) . "." . $ext;
    $uploadPath = "../assets/img/" . $newImageName;

    if(in_array($image['type'], $allowedTypes) && move_uploaded_file($image['tmp_name'], $uploadPath)) {
        
        $query = "INSERT INTO products (name, description, price, old_price, image, is_popular, category_id, skin_type_id) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $success = $stmt->execute([$name, $desc, $price, $oldPrice, $newImageName, $isPopular, $cat, $skinType]);
        if($success) {
            header("Location: ../admin.php?msg=Product+Added");
        } else {
            echo "Database error.";
        }
    } else {
        echo "Image upload failed or invalid format.";
    }
}