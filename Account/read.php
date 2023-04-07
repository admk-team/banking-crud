<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../database.php';
    include_once 'account.php';
    $database = new Database();
    $db = $database->getConnection();
    $items = new Account($db);
    $stmt = $items->getUserAccount();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $employeeArr = array();
        $employeeArr["body"] = array();
        $employeeArr["itemCount"] = $itemCount;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "user_id" => $user_id,
                "account_no" => $account_no,
                "bank_name" => $bank_name,
                "branch_code" => $branch_code,
                "account_type" => $account_type,
                "balance" =>$balance
            );
            array_push($employeeArr["body"], $e);
        }
        http_response_code(400); //
        echo json_encode($employeeArr);
    }
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>