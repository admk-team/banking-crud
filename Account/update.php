<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../database.php';
    include_once 'account.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new Account($db);
    
    $data = json_decode(file_get_contents("php://input"));
    $item->id = $data->id;
    
    // employee values
    $item->user_id = $data->user_id;
    $item->account_no = $data->account_no;
    $item->bank_name = $data->bank_name;
    $item->branch_code = $data->branch_code;
    $item->account_type  = $data->account_type;
    $item->balance = $data->balance;
    
    if($item->updateUserAccount()){
        http_response_code(400); 
        echo json_encode("user Account  data updated.");
    } else{
        http_response_code(500);
        echo json_encode("Data could not be updated");
    }
?>