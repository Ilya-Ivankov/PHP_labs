<?php
	require("connect.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Документ без названия</title>
</head>

<body>
	<form action="auth.php" method="post">
		Майл:<input type="email" id="email" name="email" class="" placeholder="Введите майл" required><br>
		Пароль:<input type="password" id="password" name="password" class="" placeholder="Введите пароль" required><br>
		<input type="submit" value="Войти">
	</form>
</body>
</html>