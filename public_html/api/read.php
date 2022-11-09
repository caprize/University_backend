<?php

// ini_set('session.save_handler', 'redis');
// ini_set('session.save_path', "tcp://127.0.0.1:80");

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
session_start();
// echo session_id(); // идентификатор сессии
// echo session_name();


include_once '/home/public_html/database/database.php';
include_once '/home/public_html/class/Order.php';


$database = new Database();
$db = $database->getConnection();
 
$items = new Orders($db);

$items->id = (isset($_GET['id']) && $_GET['id']) ? $_GET['id'] : '0';



$result = $items->read();

$lang = $_GET['lang'];
$login = $_GET['login'];
$backgr = $_GET['backgr'];

$_SESSION["lang"] = $lang;
$_SESSION["login"] = $login;
$_SESSION["backgr"] = $backgr;

echo $_SESSION["login"];

$redis = new Redis();
// подключаемся к серверу redis
$redis->connect(
  'redis',
  6379
);
$redis->set('session_id', session_id());
$redis->set('session_name', session_name());
$response = $redis->get('session_id');
echo $response;








if($result->num_rows > 0){    
    $itemRecords=array();
    $itemRecords["items"]=array(); 
	while ($item = $result->fetch_assoc()) { 	
        extract($item); 
        $itemDetails=array(
            "id" => $ID,
            "book_id" => $book_id,
            "date_end" => $date_end,
			"user_id" => $user_id	
        ); 
       array_push($itemRecords["items"], $itemDetails);
    }    
    http_response_code(200);     
    echo json_encode($itemRecords);
}else{     
    http_response_code(404);     
    echo json_encode(
        array("message" => "No item found.")
    );
} 

