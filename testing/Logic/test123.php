<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Unbenanntes Dokument</title>
</head>

<body>
<?php
	require_once("libaries/libuser.php");
/*	$query = "SELECT *
			  FROM `Benutzer`
			  WHERE `Email` = 'anti@lol.de'";
	$res = mysql_fetch_array(SELECT_DATA($query));
	var_dump($res);
	echo "<br><br>";
	var_dump(clean_resultarray($res,true));
	echo "<br>";
	var_dump(clean_resultarray($res,false));*/
	echo "time(): " . time() .  "<br>\n";
	echo "date(): " . date("Y-z.H:i:s:u") .  "<br>\n";
	
	echo "SessionId #1: " . rand(0, 9999999999) . "-" . time() .  "<br>\n";
	echo "SessionId #2: " . rand(0, 9999999999) . "-" . time() .  "<br>\n";
    echo "SessionId #3: " . rand(0, 9999999999) . "-" . time() .  "<br>\n";
	echo "SessionId #4: " . rand(0, 9999999999) . "-" . time() .  "<br>\n";
	echo "SessionId #5: " . rand(0, 9999999999) . time();
	$newDate= new DateTime("now");
	$newDate = $newDate->add(new DateInterval('P1D'));
	echo INSERT_DATA("Sessions", array("BenutzerId" => 1, "SessionId" => 60289547541327436858, "Lebensdauer" => date_format($newDate, 'Y-m-d'))) . "<br>";
	var_dump(get_languages());
//	sendActivationcode(5); echo "<br/>Activation mail send!";
	//$data = array("Email" => "l@l.com", "Passwort" => "sdf", "Vorname" => "sahra", "Nachanme" => "Golf", "Funktion" => "1", "Muttersprache" => "de");
	//var_dump(stringy($data));
	//echo makeList(stringy($data));

/*	$table_name = "Session";
	$newDate= new DateTime("now");
	$newDate = $newDate->add(new DateInterval('P1D'));
	$arrSet = array( "Lebensdauer" => date_format($newDate, 'Y-m-d'));
	$arrWhere = array("BenutzerId" => 1, "SessionId" => 12, "Lebensdauer" => "2012-01-24");
	$query = "UPDATE `$table_name`
			  SET " . to_select($arrSet) . " 
			  WHERE " . to_select($arrWhere) . " LIMIT 1";
	echo $query;*/
?>
</body>
</html>