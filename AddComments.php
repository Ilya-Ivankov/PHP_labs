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
	<form name="addComments" id="addComments" method="POST" action="#">
	Ваше имя: <input type="text" name="autor" id="autor" size="20" maxlength="20" required >
	<br>Комментарий:<br>
	<textarea name="comment" cols="55" rows="10" id="comment" required></textarea>
	<input type="hidden" name = "created" id = "created" value ="<?php echo date("Y-m-d");?>" /><br>	
	<input type="hidden" name = "art_id" id = "art_id" value ="<?php echo $note_id;?>"/><br>	
	<input type="submit" name="submit" id="submit" value="Отправить" />
	</form>
	<?php
	require_once ("connections/MySiteDB.php");
	$note_id = $_GET['note'];
	$select_db = mysqli_select_db ($link, $db);
	$autor = $_POST['autor'];
	$comment = $_POST['comment'];
	$created = $_POST['created'];	
	$art_id = $_POST['art_id'];	
	if (($autor)&&($comment)){
	$query = "INSERT INTO `mysitedb`.`comments` (`id`, `created`, `author`, `comment`, `art_id`) VALUES (NULL, '$created', '$autor', '$comment', '$note_id');";
	$result = mysqli_query ($link, $query);
	}
	?>
	<a href="comments.php?note=<?php echo $note_id ?>">Назад</a>
	</body>
</html>