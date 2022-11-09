<?php
session_start();
echo "Ваш логин: ";
echo $_SESSION["login"];
if (!strcmp($_SESSION["backgr"],"dark" )){ 
echo '<body style="background-color:grey;color:white">';
}
else {
 echo '<body style="background-color:white">';
}
?>


<html lang="ru">
<head>
<title>Hello world page</title>
    <!-- <link rel="stylesheet" href="style.css" type="text/css"/> -->
</head>
    
<body>
    <p>Привет мир!!!!</p>
</body>
</html>

