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
        <li id="foto"><a href="#news">Новая записть</a></li>
        <li id="foto"><a href="#contact">Отправить сообщения</a></li>
        <li id="foto"><a href="#about">Фото</a></li>
        <li id="fl"><a href="#about" >Файлы</a></li>
        <li id="adm"><a href="#about" >Администратору</a></li>
        <li id="inf"><a href="#about" >Информация</a></li>
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
<div class="stata">
<h1>СТАТИСТИКА</h1>
<table>
    <tr>
      <th>Показатель</th>
      <th>Результат</th>

      </tr>
     <tr>
      <td>Сделано записей</td>
      <td>	<?php
		require_once ("connections/MySiteDB.php");
		$select_db = mysqli_select_db ($link, $db);
		$query_allnotes = "SELECT COUNT(id) AS allnotes FROM notes";
		$allnotes = mysqli_query ($link, $query_allnotes) or die (mysqli_error());
		$row_allnotes = mysqli_fetch_assoc ($allnotes);
		$allnotes_num = $row_allnotes['allnotes'];
		echo  $allnotes_num;
		mysqli_free_result ($allnotes);
	?></td>
     </tr>
    <tr>
      <td>Оставлено коментариев</td>
      <td><?php
		  $query_allcomments = "SELECT COUNT(id) AS allcomments FROM comments";
		  $allcomments = mysqli_query ($link, $query_allcomments) or die (mysqli_error());
		  $row_allcomments = mysqli_fetch_assoc ($allcomments);
		  $allcomments_num = $row_allcomments['allcomments'];
		  echo  $allcomments_num;
		  mysqli_free_result ($allcomments);
		  ?></td>
    </tr>
    <tr>
      <td>Записи за месяц</td>
      <td>
		<?php
		  $date_array = getdate(); 
		  $begin_date = date ("Y-m-d", mktime(0,0,0, $date_array['mon'],1,$date_array['year'])); 
		  $end_date = date ("Y-m-d", mktime(0,0,0, $date_array['mon'] + 1,0,$date_array['year'])); 
		  $query_lmnotes = "SELECT COUNT(id) AS lmnotes FROM notes WHERE created>='$begin_date' AND created<='$end_date'";
		  $lmnotes = mysqli_query ($link, $query_lmnotes)or die (mysqli_error());
		  $row_lmnotes = mysqli_fetch_assoc ($lmnotes);
		  $lmnotes_num = $row_lmnotes['lmnotes'];
		  echo $lmnotes_num;
		  mysqli_free_result ($lmnotes); 
		  ?>
		</td>
    </tr>
    <tr>
      <td>Коментарии за месяц</td>
      <td><?php
		  $query_lmcomments = "SELECT COUNT(id) AS lmcomments FROM comments WHERE created>='$begin_date' AND created<='$end_date'";
		  $lmcomments = mysqli_query ($link, $query_lmcomments)or die (mysqli_error());
		  $row_lmcomments = mysqli_fetch_assoc ($lmcomments);
		  $lmcomments_num = $row_lmcomments['lmcomments'];
		  echo $lmcomments_num;
		  mysqli_free_result ($lmcomments); 
		  ?>
		</td>
    </tr>
    <tr>
        <td>Последняя записть</td>
        <td><?php
			$query_last_note = "SELECT id, title FROM notes ORDER BY created DESC LIMIT 0,1";
			$lastnote = mysqli_query ($link, $query_last_note) or die (mysqli_error());
			$row_lastnote = mysqli_fetch_assoc ($lastnote);
			echo "<a href='comments.php?note=".$row_lastnote['id']."'>".$row_lastnote['title']."</a>";
			mysqli_free_result ($lastnote); 
			?>
		</td>
      </tr>
      <td>Самая обслуживаемая запись</td>
      <td>
	<?php
		$query_mcnote = "SELECT notes.id, notes.title FROM comments, notes WHERE comments.art_id=notes.id GROUP BY notes.id ORDER BY COUNT(comments.id) DESC LIMIT 0,1";
		$mcnote = mysqli_query($link,$query_mcnote);
		$row_mcnote = mysqli_fetch_assoc($mcnote);
		echo "<a href='comments.php?note=".$row_mcnote['id']."'>".$row_mcnote['title']."</a>";
		mysqli_free_result ($mcnote);
	?>
	</td>
    </table>
</div>
</main>
<footer class="footer">
    <a href="blog.php"><div class="stat">ГЛАВНАЯ</div></a>
</footer>
</body>
</html>
