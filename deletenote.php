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
	$note_id = $_GET['note'];
	$select_db = mysqli_select_db ($link, $db);
	$query = "DELETE FROM `mysitedb`.`notes` WHERE `notes`.`id` = $note_id";
	$result = mysqli_query($link,$query);
	$query2 = "DELETE FROM `mysitedb`.`comments` WHERE `comments`.`art_id` = $note_id";
	$result2 = mysqli_query($link,$query2);
	?>
	<a href="comments.php?note=<?php echo $note_id?>">Назад</a>
</body>
</html>