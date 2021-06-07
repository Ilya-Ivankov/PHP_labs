<?php require_once('../Connections/Dreamweaver.php'); ?>
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

$colname_notes = "-1";
if (isset($_GET['note'])) {
  $colname_notes = $_GET['note'];
}
mysql_select_db($database_Dreamweaver, $Dreamweaver);
$query_notes = sprintf("SELECT created, title, article FROM notes WHERE id = %s", GetSQLValueString($colname_notes, "int"));
$notes = mysql_query($query_notes, $Dreamweaver) or die(mysql_error());
$row_notes = mysql_fetch_assoc($notes);
$totalRows_notes = mysql_num_rows($notes);

$colname_comments = "-1";
if (isset($_GET['note'])) {
  $colname_comments = $_GET['note'];
}
mysql_select_db($database_Dreamweaver, $Dreamweaver);
$query_comments = sprintf("SELECT created, author, `comment` FROM comments WHERE art_id = %s ORDER BY created ASC", GetSQLValueString($colname_comments, "int"));
$comments = mysql_query($query_comments, $Dreamweaver) or die(mysql_error());
$row_comments = mysql_fetch_assoc($comments);
$totalRows_comments = mysql_num_rows($comments);
 //require_once('Connections/Dreamweaver.php'); ?>
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
 
<h1><a href="../main.php">На главную</a></h1>
<p><?php echo $row_notes['title']; ?></p>
<p><?php echo $row_notes['article']; ?></p>
<p><?php echo $row_notes['created']; ?></p>
<hr>
<p>Комментарии: </p>
<?php do { ?>
  <p><?php echo $row_comments['author']; ?></p>
  <p><?php echo $row_comments['comment']; ?></p>
  <p><?php echo $row_comments['created']; ?></p>
  <?php } while ($row_notes = mysql_fetch_assoc($notes)); ?>

</body>
</html>
<?php
mysql_free_result($notes);

mysql_free_result($comments);
?>
