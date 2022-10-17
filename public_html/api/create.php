<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '/home/public_html/database/database.php';
include_once '/home/public_html/class/Order.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$database = new Database();
$db = $database->getConnection();
 
$items = new Orders($db);
 
ini_set("allow_url_fopen", true);



$data = json_decode(file_get_contents('php://input'));
echo $data->book_id;
echo $data->date_end;
echo $data->user_id;
if(!empty($data->date_end)){  
    echo "here";  

    $items->book_id = $data->book_id;
    $items->date_end = $data->date_end;
    $items->user_id = $data->user_id;
    
    if ($items->create()){       
        http_response_code(201);         
        echo json_encode(array("message" => "Item was created."));
    }
    else{         
        
        http_response_code(503);        
        echo json_encode(array("message" => "Unable to create item."));
    }
}else{
    echo "here1";    
    http_response_code(400);    
    echo json_encode(array("message" => "Unable to create item. Data is incomplete."));
}

