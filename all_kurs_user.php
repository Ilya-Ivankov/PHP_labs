<?php
session_start();//Начало сессии
require("connect.php");
if(!isset($_SESSION['$emailS']) and !$_SESSION['nameS'] and !$_SESSION['statusS']){
	header('location: login_sot.php');
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Документ без названия</title>
</head>
<?php
	echo $_SESSION["idS"];
	$kurs = $pdo->query('SELECT * FROM `kurs` WHERE `id_users` = $_SESSION["idS"]');
?>
<body>
	<h1>Мои курсы:</h1>
	
</body>
</html>