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
	$hostname = "localhost";
	$user = "admin";
	$password = "admin";
	$db = "MySiteDB";
	$link = mysqli_connect($hostname,$user,$password) or die("Не могу соединиться с MySQL.");
	$select = mysqli_select_db($link, $db) or die("Не могу подключиться к базе.");
	$note_id = $_GET['note'];
	$query = "SELECT created, title, article FROM notes WHERE id = $note_id"; 
	$data = mysqli_query($link,$query) or die("MySQL запрос не сработал");
	while($note = mysqli_fetch_array($data)){
?>
	<h3>Запись №: <?php echo $note_id;?></h3>
	<p>Дата:<?php echo $note ['created'];?></p>
	<p>Название:<?php echo $note ['title'];?></p>
	<p>Статья:<?php echo $note ['article'];}?></p>
	<a href="editnote.php?note=<?php echo $note_id;?>">Изменить заметку</a>
	<a href="deletenote.php?note=<?php echo $note_id;?>">Удалить запись</a>
	<h3>КОМЕНТАРИИ:</3h><br>
	<?php
	$query2 = "SELECT count(*) FROM comments WHERE art_id = $note_id";
	$data2 = mysqli_query($link,$query2) or die("MySQL запрос не сработал");	
	//$b = mysqli_num_rows($data2);
	$query_comments = "SELECT * FROM comments WHERE art_id = $note_id"; 
	$data3 = mysqli_query($link,$query_comments) or die("MySQL запрос не сработал");
	$b = mysqli_num_rows($data3);
	if($b>0){
	for($i = 0; $i < $b; ++$i){
		while($note2 = mysqli_fetch_array($data3)){
	    echo "Коментарий: ";
		echo $note2 ['comment']." "."Имя: ".$note2 ['author'];
		echo "<a href='DeleteComment.php?id_com=".$note2['id']."&note=".$note_id."'>"."Удалить"."</a>","<br>";
		}
		}
	}
	else{
		echo "Коментариев нет!";
	}
	?>
	<br>
	<a href="AddComments.php?note=<?php echo $note_id;?>">Добавить комментарий</a>
</body>
</html>

