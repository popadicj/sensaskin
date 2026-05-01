<?php
session_start();
if (isset($_GET['id']) && isset($_GET['action'])) {
    $id = $_GET['id'];
    $action = $_GET['action'];

    if (isset($_SESSION['cart'][$id])) {
        if ($action == 'plus') {
            $_SESSION['cart'][$id]['quantity'] += 1;
        } elseif ($action == 'minus') {
            $_SESSION['cart'][$id]['quantity'] -= 1;

            if ($_SESSION['cart'][$id]['quantity'] < 1) {
                unset($_SESSION['cart'][$id]);
            }
        }
    }
}
header("Location: ../cart.php");
exit();