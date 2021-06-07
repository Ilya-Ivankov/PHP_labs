<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Документ без названия</title>
</head>

<body>
<?php
	$hostname = "localhost";
	$user = "root";
	$password = "";
	$link = mysqli_connect($hostname,$user,$password);
	if ($link) {
 		echo "Соединение с сервером установлено", "<br>";
	} 
	else {
		echo "Нет соединения с сервером";
	} 
	$query = "GRANT ALL PRIVILEGES ON *.* TO 'Admin'@'localhost' IDENTIFIED BY 'Admin' WITH GRANT OPTION";
	$user = mysqli_query($link,$query);
	if ($user){
		echo "Пользователь создан";
	}	
	else {
		echo "Ошибка: пользователь не создан";
	}
?>	
</body>
</html>