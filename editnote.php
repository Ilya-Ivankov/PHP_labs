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
	<h2>Редактирование данных</h2>
<?php
    require_once ("connections/MySiteDB.php");
	$note_id = $_GET['note'];
	$select_db = mysqli_select_db ($link, $db);
	$query = "SELECT  title, article FROM notes WHERE id = $note_id";
	$result = mysqli_query($link,$query);
	while($edit_note = mysqli_fetch_array($result)){; 
?>
	<form name="editnote" id="editnote" action="#" method="POST">
Тема:<input type="text" name="title" id="title" size="20" maxlength="20" value="<?php echo $edit_note['title']?>" required/><br><br>
Текст:<textarea name="article" cols="55" rows="10" id="article" value="" required><?php echo $edit_note['article']?>  </textarea><br>
<input type="hidden" name = "note" id = "note" value ="<?php echo $note_id; }?>"/><br>
<input type="submit" name="submit" id="submit" value="Отправить" />
<?php
$title = $_POST['title'];
$article = $_POST['article'];
$query2 = "UPDATE `mysitedb`.`notes` SET `title` = '$title',`article` = '$article' WHERE `notes`.`id` =$note_id;";		
$result2 = mysqli_query($link,$query2);		
?>
		<a href="comments.php?note=<?php echo $note_id?>">НАЗАД</a>
	</form>
</body>
</html>