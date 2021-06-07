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
	$query = "CREATE DATABASE MySiteDB";
	// Создание соединения
	$link = mysqli_connect($hostname,$user,$password);
	// Проверка соединения
	if ($link) {
 		echo "Соединение с сервером установлено", "<br>";
	} 
	else {
		echo "Нет соединения с сервером: ".mysqli_connect_error();
	} 
	// Созданние базы данных
	$result = mysqli_query($link, $query);
	if ($result){
		echo  "База данных успешно создана";
	}
	else{
		echo "База не создана: ". mysqli_error($link);
	}
?>
</body>
</html>