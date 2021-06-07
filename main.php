<?php require_once('Connections/Dreamweaver.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_notes = 10;
$pageNum_notes = 0;
if (isset($_GET['pageNum_notes'])) {
  $pageNum_notes = $_GET['pageNum_notes'];
}
$startRow_notes = $pageNum_notes * $maxRows_notes;

mysql_select_db($database_Dreamweaver, $Dreamweaver);
$query_notes = "SELECT * FROM notes ORDER BY created ASC";
$query_limit_notes = sprintf("%s LIMIT %d, %d", $query_notes, $startRow_notes, $maxRows_notes);
$notes = mysql_query($query_limit_notes, $Dreamweaver) or die(mysql_error());
$row_notes = mysql_fetch_assoc($notes);

if (isset($_GET['totalRows_notes'])) {
  $totalRows_notes = $_GET['totalRows_notes'];
} else {
  $all_notes = mysql_query($query_notes);
  $totalRows_notes = mysql_num_rows($all_notes);
}
$totalPages_notes = ceil($totalRows_notes/$maxRows_notes)-1;

$queryString_notes = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_notes") == false && 
        stristr($param, "totalRows_notes") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_notes = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_notes = sprintf("&totalRows_notes=%d%s", $totalRows_notes, $queryString_notes);

        header("Content-Type: text/html; charset=utf-8");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Документ без названия</title>
	<style>
		li {
    list-style-type: none; /* Убираем маркеры */
   		}
	</style>
</head>

<body>
	<h2>ПРИВЕТ!</h2>
	<h3>Это мини-вариант моего сайта о путешествиях</h3>
	<nav>
	<a href="<?php printf("%s?pageNum_notes=%d%s", $currentPage, 0, $queryString_notes); ?>">На главную</a>|
	<a href="<?php printf("%s?pageNum_notes=%d%s", $currentPage, min($totalPages_notes, $pageNum_notes + 1), $queryString_notes); ?>">Вперёд</a>|
	<a href="<?php printf("%s?pageNum_notes=%d%s", $currentPage, max(0, $pageNum_notes - 1), $queryString_notes); ?>">Назад</a>|
	<a href="<?php printf("%s?pageNum_notes=%d%s", $currentPage, $totalPages_notes, $queryString_notes); ?>">На последнюю</a>|
	</nav>
	<hr>
<ul>
		<li><a href="Dreamweaver/login.php">Вход</a></li>
		<li><a href="Dreamweaver/addnew.php">Добавить заметку</a></li>
		<li><a href="Dreamweaver/users.php">Администратору</a></li>
		<li><a href="Dreamweaver/logout.php">Выход</a></li>
		<li><a href="Dreamweaver/comm.php">Коментарии</a></li>
	</ul>
	<hr>
<?php do { ?>
  <p><?php echo $row_notes['id']; ?>  </p>
  <p><a href="Dreamweaver/comm.php?note=<?php echo $row_notes['id']?>"><?php echo $row_notes['title']; ?></a></p>
  <p><?php echo $row_notes['article']; ?></p>
  <p><?php echo $row_notes['created']; ?></p>
  <?php } while ($row_notes = mysql_fetch_assoc($notes)); ?>
<hr style="border: double">
<p>Заметки с <?php echo ($startRow_notes + 1) ?> по <?php echo min($startRow_notes + $maxRows_notes, $totalRows_notes) ?> из <?php echo $totalRows_notes ?> </p>
</body>
</html>
<?php
mysql_free_result($notes);
?>
