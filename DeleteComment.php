<?php
      header("Content-Type: text/html; charset=utf-8");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Документ без названия</title>
</head>
<body>
	<?php
	require_once ("connections/MySiteDB.php");
	$id_com = $_GET['id_com'];
	$note_id = $_GET['note'];
	$select_db = mysqli_select_db ($link, $db);	
	$query = "DELETE FROM `mysitedb`.`comments` WHERE `comments`.`id` = $id_com";
	$result = mysqli_query($link,$query);
	?>
	<a href="comments.php?note=<?php echo $note_id ?>">Назад</a>
</body>
</html>