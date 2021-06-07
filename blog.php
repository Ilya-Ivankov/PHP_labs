<?php
        header("Content-Type: text/html; charset=utf-8");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="heder">
<div class="qwe">
    <h2 class="blog">МОЙ БЛОГ</h2>
    <h1 class="blog">ПУТЕШЕСТВИНИКА</h1>
</div>
<div class="menu">
    <ul>
        <li><a class="active" href="blog.php">Главная</a></li>
        <li><a href="#about">Войти</a></li>
        <li id="foto"><a href="newnote.php">Новая записть</a></li>
        <li id="foto"><a href="#contact">Отправить сообщения</a></li>
        <li id="foto"><a href="email.php">Майл</a></li>
        <li id="fl"><a href="photo.php" >Фото</a></li>
        <li id="adm"><a href="files.php" >Файлы</a></li>
        <li id="inf"><a href="inform.php" >Информация</a></li>
        <li><a class="active2" href="#about">Выйти</a></li>
      </ul> 
</div>
</header>

<main>
<div class="photo"></div>
<div class="book">
 <blockquote class="blockquote-4">
    <p>«Путешествовать и жить гораздо интереснее, если следуешь внезапно возникающим импульсам.»</p>
    <cite>Билл Брайсон “Путешествия по Европе”</cite>
</blockquote>   
</div>
	<form id="search" name="search" action="" method="get" style="text-align: center">
		Введите слово поиска:<input name="usersearch" type="text" size="22" maxlength="50" required>
		<input type="submit" name="submit" id="submit" value="Найти" /><br>
		<?php
require_once ("connections/MySiteDB.php");
$select = mysqli_select_db($link, $db) or die("Не могу подключиться к базе.");
$user_search = $_GET['usersearch'];
if (!empty($user_search))
 {
$query_usersearch = "SELECT * FROM notes WHERE title LIKE '%$user_search%' OR article LIKE '%$user_search%'";
$result_usersearch = mysqli_query($link, $query_usersearch) or die("Не могу соединиться с MySQL.");
 while ($array_usersearch = mysqli_fetch_array($result_usersearch))
{
echo "id записи: ".$array_usersearch['id']."<br>";
echo "Название записи: ".$array_usersearch['title']."<br>";
echo "Текст записи: ".$array_usersearch['article']."<br>";
 }
 }
		?>
	</form>
	<form id="search2" name="search2" action="" method="get" style="text-align: center">
		Введите предложение поиска:<input type="text" size="15" maxlength="50" name="usersearch2" required>
		<input type="submit" name="submit" id="submit" value="Найти" />
		<?php 
$user_search = $_GET['usersearch2'];
$clean_search = str_replace(',', ' ', $user_search);
if($clean_search){
$where_list = array();
$query_usersearch = "SELECT * FROM notes";
$search_words = explode(' ', $clean_search);
$final_search_words = array();
if (count($search_words) > 0)
 {
foreach($search_words as $word)
{
if (!empty($word))
{
$final_search_words[] = $word;
}
} 
 }
foreach($final_search_words as $word)
 {
$where_list[] = " article LIKE '%$word%'"; 
 }
$where_clause = implode (' OR ', $where_list);
if (!empty($where_clause))
 {
$query_usersearch .=" WHERE $where_clause";
 }
$res_query = mysqli_query($link, $query_usersearch);
while ($res_array = mysqli_fetch_array($res_query))
{
echo "<br>"."Id записи: ".$res_array['id'], "<br>";
echo "Содержание записи: ".$res_array['article'], "<br>", "<hr>", "<br>";
} 
}

		?>
	</form>
<div class="blk">
    <h3>Рад приветсвовать Вас!</h3>
    <p>Здесь я буду рассказывать о своих путишествиях...<br></p><p>И выкладывать разный контент...<br></p><p>&nbsp;Оставайся с нами, будет интересно!</p>
		<?php
	$hostname = "localhost";
	$user = "admin";
	$password = "admin";
	$db = "MySiteDB";
	//$a = require_once ("connections/MySiteDB.php");
	$link = mysqli_connect($hostname,$user,$password) or die("Не могу соединиться с MySQL.");
	$select = mysqli_select_db($link, $db) or die("Не могу подключиться к базе.");
	$query = "SELECT * FROM `notes` ORDER BY id DESC";
	$data = mysqli_query($link,$query) or die("MySQL запрос не сработал");
	while($note = mysqli_fetch_array($data)){
		echo $note ['id'], "<br>";?> 
	<a href="comments.php?note=<?php echo $note['id']; ?>">
	<?php echo $note ['title'], "<br>";?></a> 
		<?php 
 		echo $note ['created'], "<br>";
		echo $note ['title'], "<br>";
		echo $note ['article'], "<br>"; 
	}
	?>
    <div class="gora">
    </div>
</div>
</main>
<footer class="footer">
    <a href="inform.php"><div class="stat">СТАТИСТИКА</div></a>
	</footer>
</body>
</html>
