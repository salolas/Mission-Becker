<?php
require_once("/path.php");
require_once($COMFORTPATH . "dbconnection.php");
require_once($libpath . "libdb.php");
require_once($libpath . "libsecurity.php");

function is_logged_in(){
	$sid = get_sid();
	if($sid)
		return is_valid_sid($sid);
	return false;
}
function get_sid(){
	$cookie = $_COOKIE["SID"];
	if(isset($cookie)){
		return $cookie;
	}
	return false;
}
function is_valid_sid($sid){
	$query = "SELECT SessionId, BenutzerId, Lebensdauer
					 FROM Sessions 
					 WHERE " . to_select(array("SessionId" => $sid));
	$res = mysql_fetch_assoc(SELECT_DATA($query));
	if(!$res){
		echo "Fehlercode für: sid nicht gesetzt. -> Eintrag nicht gefunden!";
		return false;
	}
	if($res["Lebensdauer"] < time()){
		echo "Fehlercode für: sid nicht gesetzt. -> Zeit abgelaufen!";
		return false;
	}
	UPDATE_DATA("Sessions",	array( "Lebensdauer" => get_lifetime()), $res);
	return true;
}

function login($email, $pass){
	$query = "SELECT BenutzerId
			  FROM Benutzer
			  WHERE " . to_select(array("Email" => $email, "Passwort" => $pass));
	$res = mysql_fetch_array(SELECT_DATA($query));
	if($res == null){
		echo "Fehlercode für: Benutzer oder passwort falsch!";
		return false;
	}
		
	$query = "SELECT SessionId
			  FROM Sessions";
	$sids = mysql_fetch_array(SELECT_DATA($query));
	$newSessionId = rand(0, 9999999999) . time(); //erstelle SessionID die noch nich vorhanden ist!!
	$lifetime = get_lifetime();
	
	$query = "SELECT SessionId, BenutzerId, Lebensdauer
			  FROM Sessions
			  WHERE " . to_select(array("BenutzerId" => $res["BenutzerId"]));
	$res2 = mysql_fetch_assoc(SELECT_DATA($query));
	if(!$res2)
		INSERT_DATA("Sessions", array("BenutzerId" => $res["BenutzerId"], "SessionId" => $newSessionId, "Lebensdauer" => $lifetime)) or die(mysql_error());
	else
		UPDATE_DATA("Sessions", array("SessionId" => $newSessionId, "Lebensdauer" => $lifetime), $res2) or die(mysql_error());
	setcookie("SID", $newSessionId, $lifetime);
	return true;
}
function activate_user($BenutzerId, $aktivierungscode){
	$arr = get_user_by_id($BenutzerId, "BenutzerId, Aktivierungscode");
	if($arr["Aktivierungscode"] === $aktivierungscode){
		UPDATE_DATA("Benutzer", array("Aktivierungscode" => 1), $arr) or die(mysql_error());
  		return true;
	}
	else if($arr["Aktivierungscode"] == "1")
		return true;
	return false;
}
function send_activationcode($BenutzerId){
	$arr = get_user_by_id($BenutzerId, "BenutzerId, Email, Vorname, Nachname, Aktivierungscode");
	$aktivierungslink = "http://missionbecker.bplaced.de/testing/Logic/autoredirect.php?do=activate&n=".$arr["BenutzerId"]."&v=" . $arr["Aktivierungscode"] . "&redirect=http://missionbecker.bplaced.de";
	$betreff = "Verify Emailaddress";
	$text = "Hello " . $arr["Vorname"] . " " . $arr["Nachname"] . ",
please follow this link $aktivierungslink to verify your e-mail address.";
	mail($arr["Vorname"] . "<" . $arr["Email"] . ">", $betreff, $text) or die(error_get_last());
}
function get_user_by_cookie($values){
	$cookie = get_sid();
	if($cookie){
		$query = "SELECT Distinct $values
				  FROM Sessions s, Benutzer b
				  WHERE " . to_select(array("s.SessionId" => $cookie)) . " AND s.BenutzerId = b.BenutzerId";
		$res = mysql_fetch_assoc(SELECT_DATA($query));
		return $res;
	}
	return false;
}
function get_user_by_id($BenutzerId, $values){
	$query = "SELECT Distinct $values
			  FROM Benutzer
			  WHERE " . to_select(array("BenutzerId" => $BenutzerId));
	$res = mysql_fetch_assoc(SELECT_DATA($query));
	return $res;
}

function user_exists($email){
	$query = "SELECT *
			  FROM `Benutzer` 
			  WHERE " . to_select(array("Email" => $email));
	if(mysql_fetch_array(SELECT_DATA($query)))
		return true;
	return false;
}
function add_user($email, $pass, $vorname, $nachname, $funktion, $sprache){
	if(UserExists($email))
		echo "Benutzer existiert bereits";
		return false; // Fehlerkuerzel für: Benutzer existiert bereits!
	$code = rand(0, 99) . time();
	$data = array("Email" => $email, "Passwort" => $pass, "Vorname" => $vorname, "Nachanme" => $nachname, "Funktion" => $funktion, "Benutzersprache" => $sprache, "Aktivierungscode" => $code);
	INSERT_DATA("Benutzer", $data);
	return true;
}

function get_user_languages_by_userid($BenutzerId, $values){
	$res = SELECT_DATAX($values, "Sprachen", array("BenutzerId" => $BenutzerId));
	$out = array();
	while($arr = mysql_fetch_assoc($res)){
		$out[$arr["Sprachkuerzel"]] = $arr;
	}
	return out;
}

function get_user_austauschprogramme_by_userid($BenutzerId, $values){
	$res = SELECT_DATAX($values, "BenutzerAustauschprogramm", array("BenutzerId" => $BenutzerId));
	$out = array();
	while($arr = mysql_fetch_assoc($res)){
		$out[$arr["AustauschId"]] = $arr;
	}
	return out;
}
?>