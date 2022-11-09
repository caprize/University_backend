<?php


session_start();



// echo ($data);
$data = file_get_contents("php://input");






$head = "application/pdf";
$pos = strpos($data,$head);
if ($pos == NULL){
    echo "File is not pdf";
}
else {
    $bulk = new MongoDB\Driver\BulkWrite;

    // $document1 = ['title' => 'one'];
    $id = rand(0,100000);
    echo "YOUR ID IS: ";
    echo $id;
    $document2 = ['_id'  => $id, 'file' => new MongoDB\BSON\Binary($data,0)];
    // $document3 = ['_id' => new MongoDB\BSON\ObjectId, 'title' => 'three'];

    // $_id1 = $bulk->insert($document1);
    $_id1 = $bulk->insert($document2);
    // $_id3 = $bulk->insert($document3);

    // var_dump($_id1, $_id2, $_id3);

    $manager = new MongoDB\Driver\Manager("mongodb://root:root@mongo:27017");

    $result = $manager->executeBulkWrite('db.collection', $bulk);

    }
?>
