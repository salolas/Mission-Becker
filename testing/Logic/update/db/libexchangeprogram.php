<?php
require_once("/path.php");
require_once($COMFORTPATH . "dbconnection.php");
require_once($libpath . "libdb.php");

function get_austauschprogramm_by_id($AustauschId, $values){
	return mysql_fetch_assoc(SELECT_DATAX($values, "Austauschprogramm", array("AustauschId" => $AustauschId)));
}
function get_schule1_by_austauschid($AustauschId, $values){
	return mysql_fetch_assoc(SELECT_DATAX($values, "Austauschprogramm a, Schule s", array("AustauschId" => $AustauschId, "a.SchulId1" => "s.SchulId")));
}
function get_schule2_by_austauschid($AustauschId, $values){
	return mysql_fetch_assoc(SELECT_DATAX($values, "Austauschprogramm a, Schule s", array("AustauschId" => $AustauschId, "a.SchulId2" => "s.SchulId")));
}
function get_users_by_austauschid($AustauschId, $values){
	$res = SELECT_DATAX($values, "BenutzerAustauschprogramm a, Benutzer b", array("a.AustauschId" => $AustauschId, "a.BenutzerId" => "b.BenutzerId"));
	$out = array();
	while($arr = mysql_fetch_assoc($res)){
		$out[$arr["BenutzerId"]] = $arr;
	}
	return out;
}
?>