<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_Dreamweaver = "localhost";
$database_Dreamweaver = "MySiteDB";
$username_Dreamweaver = "admin";
$password_Dreamweaver = "admin";
$Dreamweaver = mysql_pconnect($hostname_Dreamweaver, $username_Dreamweaver, $password_Dreamweaver) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_query("SET NAMES cp1251;" , $Dreamweaver) or die(mysql_error());
mysql_query("SET CHARACTER SET cp1251;", $Dreamweaver) or die(mysql_error());
header("Content-Type: text/html; charset=utf-8");
?>