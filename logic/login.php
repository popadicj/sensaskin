<?php
session_start();
header("Content-Type: application/json");
require_once "../config/connection.php";

if(isset($_POST['send'])){
    $email = $_POST['email'];
    $pass = $_POST['password'];
    
    if(empty($email) || empty($pass)){
        http_response_code(422);
        echo json_encode(["Please fill in all fields."]);
        exit;
    }
    try {
        $query = "SELECT * FROM users WHERE email = :email AND is_active = 1";
        $stmt = $conn->prepare($query);
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch();

        if($user){
            if(password_verify($pass, $user->password)){
                
                $_SESSION['user'] = $user; 
                
                http_response_code(200);
                echo json_encode(["message" => "Login successful"]);
            } else {
                http_response_code(401); 
                echo json_encode(["Wrong password."]);
            }
        } else {
            http_response_code(404); 
            echo json_encode(["User not found or inactive."]);
        }

    } catch(PDOException $e) {
        http_response_code(500);
    }
}