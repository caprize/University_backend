<?php


session_start();
require '/home/public_html/phpmyadmin/vendor/autoload.php';
// echo $_SESSION["lang"];
if (!strcmp($_SESSION["lang"],"ru")){
    include("phpinforu.php");
}
else{
    include("phpinfo.php");
}


?>
