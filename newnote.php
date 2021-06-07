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
		<p>Добавить новую заметку: </p>
<form id="newnote" name="newnote" method="post" action="">
Тема:<input type="text" name="title" id="title" size="20" maxlength="20"/ required><br><br>
Текст:<textarea name=" article" cols="55" rows="10" id=" article" required> </textarea><br>
<input type="hidden" name = "created" id = "created" value ="<?php echo date("Y-m-d");?>"/><br>
<input type="submit" name="submit" id="submit" value="Отправить" />
</form>
<a href="blog.php">Возврат на главную страницу сайта</a>
	<?php
$localhost = "localhost";
$db = "MySiteDB";
$user = "admin";
$password = "admin";
$link = mysqli_connect($localhost, $user, $password) or trigger_error(mysql_error(),E_USER_ERROR);
$select_db = mysqli_select_db ($link, $db);
$title = $_POST['title'];
$created = $_POST['created'];
$article = $_POST['article'];
if (($title)&&($created)&&($article))
 {
$query = "INSERT INTO `mysitedb`.`notes` (`id`, `created`, `title`, `article`) VALUES (NULL, '$created', '$title', '$article');";
$result = mysqli_query ($link, $query);
 } 
?> 
</body>
</html>