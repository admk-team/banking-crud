<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../database.php';
    include_once 'transcation.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new Transcation($db);
    
    $data = json_decode(file_get_contents("php://input"));
    $item->id = $data->id;
    
    // employee values
    $item->transcation_id = $data->transcation_id;
    $item->user_id = $data->user_id;
    
    if($item->updateUserTranscation()){
        http_response_code(200);
        echo json_encode("user Transcation updated.");
    } else{
        http_response_code(500);
        echo json_encode("transcation could not be updated");
    }
?>