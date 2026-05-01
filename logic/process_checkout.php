<?php
session_start();
require_once "../config/connection.php";

// 1. Sigurnosna provera: Mora biti ulogovan i korpa ne sme biti prazna
if(!isset($_SESSION['user']) || empty($_SESSION['cart'])) {
    header("Location: ../index.php");
    exit();
}

try {
    $conn->beginTransaction();

    $userId = $_SESSION['user']->id_user;
    $grandTotal = 0;

    foreach($_SESSION['cart'] as $item) {
        $grandTotal += $item['price'] * $item['quantity'];
    }
    $queryOrder = "INSERT INTO orders (user_id, total_price) VALUES (?, ?)";
    $stmtOrder = $conn->prepare($queryOrder);
    $stmtOrder->execute([$userId, $grandTotal]);
    
    $orderId = $conn->lastInsertId();

    $queryItems = "INSERT INTO order_items (order_id, product_id, quantity, price_at_purchase) VALUES (?, ?, ?, ?)";
    $stmtItems = $conn->prepare($queryItems);

    foreach($_SESSION['cart'] as $item) {
        $stmtItems->execute([
            $orderId, 
            $item['id'], 
            $item['quantity'], 
            $item['price']
        ]);
    }

    $conn->commit();
    unset($_SESSION['cart']);
    header("Location: ../cart.php?order=success");
    exit();

} catch (Exception $e) {
    $conn->rollBack(); 
    die("Greška pri obradi porudžbine: " . $e->getMessage());
}