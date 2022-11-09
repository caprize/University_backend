<?php

header("Content-Transfer-Encoding: binary");
header('Content-type: pdf');
header('Expires: 0');


header("Content-disposition: attachment; filename= file.pdf");
//header('Content-name: '.$object->file['filename']);
header('Content-Type:application-x/force-download');
session_start();




$id = $_GET['id'];

$manager = new MongoDB\Driver\Manager("mongodb://root:root@mongo:27017");


$query = new MongoDB\Driver\Query( [] );
$cursor = $manager->executeQuery("db.collection", $query);
foreach ($cursor as $document) {
    // print_r($document);
    echo $document ->_id;
    echo " ";
    // $document = json_decode(json_encode($document),true);
    // echo ($document ->_id) . PHP_EOL . "1";
    if (!strcmp($document ->_id,$id)){
        print_r($document);
        echo "here";
        // echo $document ->title;
        echo $document->title;
    }
}
?>
