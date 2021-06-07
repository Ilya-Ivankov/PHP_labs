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
//Сценарий отправки файла на сервер
//Проверяем, была ли выполнена отправка файла. Далее реализуем сценарий.
if (isset($_POST["MAX_FILE_SIZE"]))
 { 
$tmp_file_name = $_FILES["file_upload"]["tmp_name"];
$dest_file_name = $_SERVER['DOCUMENT_ROOT']."/photo/".$_FILES["file_upload"]["name"];
move_uploaded_file($tmp_file_name, $dest_file_name);
 }
	require_once ("connections/MySiteDB.php");
	$select = mysqli_select_db($link, $db) or die("Не могу подключиться к базе.");
	$image_dir_path = $_SERVER['DOCUMENT_ROOT'] . "/photo"; 
	$image_dir_id = opendir($image_dir_path); 
	$array_files = null; 
	$i = 0;
	while(($path_to_file = readdir($image_dir_id)) !== false){
		if(($path_to_file !=".") && ($path_to_file !="..")){
			$array_files[$i] = basename($path_to_file);
			$i++; 
		}
	}
		closedir($image_dir_id);
?>
<p>Эта страница для работы с изображеними</p><br><hr>
<form name = "file_upload" action="photo.php" enctype="multipart/form-data" method="post">
<input type="hidden" name="MAX_FILE_SIZE" value="65536"/>
<input type="file" name="file_upload" size="20"/>
<input type="submit" name="submit" value="Добавить" />
</form>
<?php
$array_files_count = count($array_files);
if ($array_files_count)
 {
sort($array_files);
for ($i=0; $i<$array_files_count; $i++)
{
//Выводим мена хранящихся в массиве файлов на страницу
?>
<p><a href="/photo/<?php echo $array_files[$i]; ?>" target="_blank">
<?php echo $array_files[$i]; ?></a></p>
<?php
}
}
?>
<hr>
<!-- Форма для удаления файла с сервера -->
<form name="file_delete" action="photo.php" method="post" enctype="application/x-www-form-urlencoded">
Файл <select name = "file_delete" size="1">
<?php for ($i=0; $i<$array_files_count; $i++) { ?>
<option><?php echo $array_files[$i]; ?></option>
<?php } ?></select>
<input type="submit" name="submit" value="Удалить" />
<?php
//Сценарий удаления файла
//Сначала проверяем, было ли запущено удаление файла
if (isset($_POST["file_delete"]))
 {
//Формируем полное имя файла
$file_name = $_SERVER['DOCUMENT_ROOT'] . "/photo/".$_POST["file_delete"];
//Функция unlink() удаляет файл
unlink($file_name);
 }
?> 
</form> 
<h1><a href="blog.php">НАЗАД</a></h1>
</body>
</html>