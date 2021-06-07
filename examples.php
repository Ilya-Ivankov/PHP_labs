<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Документ без названия</title>
</head>
<body>
	<? 
	$br = "<br>";
	$a = 10;
	$b = 20;
	echo "Значение a = ",$a,$br,"Значение b =",$b,$br;
	$c = $a+$b;
	echo "Сумма a+b= ",$c,$br;
	$c = $c*3;
	echo "Сумма увеличинная в 3 раза = ",$c,$br;
	$c = $a-$b;
	echo "Разность a и b = ",$c,$br;
	$p = "Программа";
	$b = "работает";
	$result = $p." ".$b;
	echo $result,$br;
	$result .=" "."хорошо";
	echo $result,$br;
	$q = 5;
	$w = 7;
	echo $q," ",$w,$br;
	function qw(&$q,&$w){
		$q = $q + $w;
		$w = $w - $q;
		$w = -$w;
		$q = $q - $w;
		echo $q," ",$w,$br;
	}
	qw ($q,$w);
	?>	
</body>
</html>