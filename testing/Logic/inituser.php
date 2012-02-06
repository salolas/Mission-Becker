<?php
require_once('/path.php');
require_once($libpath . "Basic IO.php");
$IS_LOGGED_IN = is_logged_in();
if($IS_LOGGED_IN){
	$BENUTZERDATEN = get_user_by_cookie("*");
	$language = $BENUTZERDATEN["Sprachkuerzel"];
}
else if(isset($_GET["lang"]))
	$language = $_GET["lang"];
else
	$language = "en";
require_once("uebersetzung.php");
?>