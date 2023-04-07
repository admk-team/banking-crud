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
    $item->id = isset($_GET['id']) ? $_GET['id'] : die();
  
    $item->getSingleUserAccount();
    if($item->id != null){
        // create array
        $emp_arr = array(
                "id" =>  $item->id,
                "user_id" =>$item->$user_id,
                "account_no" =>$item-> $account_no,
                "bank_name" =>$item-> $bank_name,
                "branch_code" =>$item-> $branch_code,
                "account_type" =>$item-> $account_type,
                "balance" =>$item->$balance
        );
      
        http_response_code(200);
        echo json_encode($emp_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("User Account  not found.");
    }
?>