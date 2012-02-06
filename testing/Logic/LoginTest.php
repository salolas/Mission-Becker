<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Unbenanntes Dokument</title>
</head>
<?php
	require_once("libaries/libuser.php");
	if(is_logged_in()){
		echo "<b>Login abgeschlossen...</b><br>\n" . intersperse(to_compare(get_user_by_cookie("*")), "<br/>\n") . "<br>";
	}
	
?>
<form action="autoredirect.php" method="post">
	<br>
    <input type="hidden" name="do" value="login" />
	<input type="text" name="n"/><br>
    <input type="password" name="v" /><br>
    <input type="hidden" name="redirect" value="<?php echo "http://missionbecker.bplaced.de" . $_SERVER['PHP_SELF']; ?>" />
    <input type="submit" value="Anmelden"/>
</form>
<body>
</body>
</html>