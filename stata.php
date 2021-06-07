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
	require_once ("connections/MySiteDB.php");
	$select_db = mysqli_select_db ($link, $db);
	$query = "";
	?>
</body>
</html>