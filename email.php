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
<form action="" method="POST" name="myform">
  <p>Тема: 
  <input type="text"  name="Topic" size="15" maxlength="50" required>  
  </p> 
  <p>Текст: <textarea name="Text" cols="30" rows="5" required></textarea>  
  </p>
  <input type="submit"> 
</form>
		<?php

	$Topic = $_POST['Topic'];
	$Text = $_POST['Text'];
	echo $Text;
	//$to = "C:\WebServers\tmp\!sendmail";
	$from = "Ilya@mail.ru";
	$headrs = "From: ivan.s.borisov@mail.ru" . "\r\n" .
                    "Reply-To: ivan.s.borisov@mail.ru" . "\r\n" .
                    'Content-type: text/plain; charset=windows-1251' . "\r\n" .
                    "X-Mayler: PHP/" . phpversion() ;
	mail($to = "6640001@mail.ru",$Topic,$Text,$headrs);
//Файл приходит, но нет инфы в нём=(
?>

	<a href="blog.php">Вернутся</a>
</body>
</html>

