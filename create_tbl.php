<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Документ без названия</title>
</head>
<body>
<?php
	$hostname = "localhost";
	$user = "admin";
	$password = "admin";
	$db = "MySiteDB";
	$link = mysqli_connect($hostname,$user,$password);
	$select = mysqli_select_db($link, $db);
	if ($select){
 		echo " База успешно выбрана", "<br>";
	}
 	else {
		echo "База не выбрана";
 	} 
	$query = "CREATE TABLE notes
 	(id INT NOT NULL AUTO_INCREMENT,
 	PRIMARY KEY (id),
 	created DATE,
 	title VARCHAR (20),
 	article VARCHAR (255))"; 
	$create_tbl = mysqli_query ($link, $query); 
	if ($create_tbl){
 		echo "Таблица успешно создана", "<br>";
 	} 
	else {
		echo "Таблица не создана";
 } 
?>
</body>
</html>