<html lang="ru">
<head>
<title>Hello world page</title>
    <link rel="stylesheet" href="style.css" type="text/css"/>
</head>
<body>
<h1>Таблица книг</h1>
<table>
    <tr><th>Id</th><th>Title</th><th>Author</th><th>Taken</th></tr>
<?php
$mysqli = new mysqli("db", "user", "password", "appDB");
$result = $mysqli->query("SELECT * FROM books");
foreach ($result as $row){
    echo "<tr><td>{$row['ID']}</td><td>{$row['title']}</td><td>{$row['author']}</td><td>{$row['taken']}</td></tr>";
}
echo "hi";
?>
</table>
</body>
</html>
