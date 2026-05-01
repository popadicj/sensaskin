<?php
session_start();
header("Content-Type: application/json");
require_once "../config/connection.php";

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user'])) {
    $uId = $_SESSION['user']->id_user;
    $oId = $_POST['option_id'];
    $sId = $_POST['survey_id'];

    $check = $conn->prepare("SELECT * FROM survey_results sr 
                             JOIN survey_options so ON sr.option_id = so.id_option 
                             WHERE sr.user_id = :u AND so.survey_id = :s");
    $check->execute(['u' => $uId, 's' => $sId]);

    if($check->rowCount() > 0) {
        http_response_code(409);
        echo json_encode(["message" => "Already voted"]);
        exit;
    }

    $insert = $conn->prepare("INSERT INTO survey_results (user_id, option_id) VALUES (?, ?)");
    if($insert->execute([$uId, $oId])) {
        http_response_code(201);
        echo json_encode(["message" => "Vote recorded!"]);
    }
}