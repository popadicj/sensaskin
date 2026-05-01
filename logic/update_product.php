<?php
session_start();
require_once "../config/connection.php";

if(isset($_POST['id_product'])) {
    $id = $_POST['id_product'];
    $name = $_POST['pName'];
    $price = $_POST['pPrice'];
    $desc = $_POST['pDesc'];
    $cat = $_POST['pCat'];
    $skin = $_POST['pSkinType'];

    if($_FILES['pImage']['size'] > 0) {
        $imgName = time() . "_" . $_FILES['pImage']['name'];
        move_uploaded_file($_FILES['pImage']['tmp_name'], "../assets/img/" . $imgName);
        
        $query = "UPDATE products SET name=?, price=?, description=?, category_id=?, skin_type_id=?, image=? WHERE id_product=?";
        $params = [$name, $price, $desc, $cat, $skin, $imgName, $id];
    } else {
        $query = "UPDATE products SET name=?, price=?, description=?, category_id=?, skin_type_id=? WHERE id_product=?";
        $params = [$name, $price, $desc, $cat, $skin, $id];
    }

    $stmt = $conn->prepare($query);
    if($stmt->execute($params)) {
        header("Location: ../admin.php?page=products&msg=Updated");
    }
}