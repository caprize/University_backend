<html lang="ru">
<head>
<title>Hello world page</title>
    <link rel="stylesheet" href="style.css" type="text/css"/>
</head>
<body>
<h1>Доступность книги</h1>
<?php
$ar = htmlspecialchars($_GET["title"]);
$mysqli = new mysqli("db", "user", "password", "appDB");
$result = $mysqli->query("SELECT * FROM books");
$t = 0 ;
foreach ($result as $row){
    if ($ar == $row['title']){
        $t = $t+1; 
        $tk =  $row['taken'];
        if ($tk == 1){
            echo "OOPS this book is already taken";
            break;
        }
        else {
            echo "Come to us! You can take this book";
            break;
        }
    }
    
}
if ($t == 0){
    echo "Not found :(";
}
?>
</body>
</html>