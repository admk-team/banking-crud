<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once '../database.php';
    include_once 'user.php';
    $database = new Database();
    $db = $database->getConnection();
    $item = new User($db);
    $data = json_decode(file_get_contents("php://input"));
    $item->name = $data->name;
    $item->email = $data->email;
    $item->phone = $data->phone;
    if($item->createUser()){
        http_response_code(201); // Set HTTP response code to 201 (Created)
        echo 'User created successfully.';
    } else{
        http_response_code(500); 
        echo 'User could not be created.';
    }
?>