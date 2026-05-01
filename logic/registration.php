<?php
header("Content-Type: application/json");
require_once "../config/connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['send'])) {
    
    $fName = $_POST['firstName'];
    $lName = $_POST['lastName'];
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $reName = "/^[A-ZŠĐČĆŽ][a-zšđčćž]{2,15}$/";
    $reEmail = "/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/";
    $rePass = "/^(?=.*[A-Z])(?=.*[a-z])(?=.*[\W_])(?=.*\d).{8,}$/";

    $errors = [];

    if(!preg_match($reName, $fName)) $errors[] = "Name must start with capital letter.";
    if(!preg_match($reName, $lName)) $errors[] = "Surname must start with capital letter.";
    if(!preg_match($reEmail, $email)) $errors[] = "Please enter a valid email address(e.g., example@gmail.com)";
    if(!preg_match($rePass, $pass)) $errors[] = "Min 8 characters, uppercase, lowercase, number and special character.";

    if(count($errors) > 0) {
        http_response_code(422);
        echo json_encode($errors);
        exit;
    }
    $hashedPass = password_hash($pass, PASSWORD_DEFAULT);
    $roleId = 2;   // Podrazumevano: Kupac
    $isActive = 1;

    $query = "INSERT INTO users (first_name, last_name, email, password, role_id, is_active) 
              VALUES (:fName, :lName, :email, :pass, :roleId, :isActive)";
    
    try {
        $prepare = $conn->prepare($query);
        $prepare->bindParam(':fName', $fName);
        $prepare->bindParam(':lName', $lName);
        $prepare->bindParam(':email', $email);
        $prepare->bindParam(':pass', $hashedPass);
        $prepare->bindParam(':roleId', $roleId);
        $prepare->bindParam(':isActive', $isActive);
        $result = $prepare->execute();

        if($result) {
            http_response_code(201);
            echo json_encode(["message" => "Registration successful"]);
        }
    } catch (PDOException $e) {
        if($e->getCode() == 23000) { 
            http_response_code(409);
            echo json_encode(["message" => "This email is already registered."]);
        } else {
            http_response_code(500);
            echo json_encode(["message" => "Database error: " . $e->getMessage()]);
        }
    }
} else {
    http_response_code(404);
}