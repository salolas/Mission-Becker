<?php
require_once("/path.php");
require_once($COMFORTPATH . "dbconnection.php");
function get_languages(){
	$out = array();
	$query = "SELECT *
			  FROM Sprachen";
	$res = SELECT_DATA($query);
	while($row = mysql_fetch_assoc($res))
		$out[$row["Sprachkuerzel"]] = $row["Sprachname"];
	return $out;
}
function SELECT_DATA($query){
	$result = mysql_query($query);
	return $result;
}
//Formatierung $arrData: [key]=Spaltenname [value]=Wert.
//						 Bsp.: array("Vorname" => "Hans-Dieter", "Nachname" => "Brot");
function INSERT_DATA($table_name, $arrData){
	$arr = escape_array($arrData);
	$values = makeList(stringy($arr));
	$keys = makeList(array_keys($arr));
	$query = "INSERT INTO ".$table_name." ".$keys."
			  VALUES ".$values;
  	return mysql_query($query);
}
function UPDATE_DATA($table_name, $arrSet, $arrWhere){
	$query = "UPDATE `$table_name`
			  SET " . intersperse(to_compare(escape_array($arrSet)), ", ") . " 
			  WHERE " . to_select($arrWhere) . " LIMIT 1";
	return mysql_query($query);
}

function makeList($arr){
	return "(" . intersperse($arr, ", ") . ")";
}

function to_select($arr) {
	return intersperse(to_compare(escape_array($arr)), " AND ");
}

function intersperse($arr, $between){
	$first = array_shift($arr);
	return array_reduce($arr, function ($rest, $str) use ($between) { return $rest . $between . $str; }, $first);
}

function escape_array($arr){
	return array_map("mysql_real_escape_string", $arr);
}

function to_compare($arr){
	$newarr = array();
	foreach ($arr as $key => $value) {
		$newarr[] = "$key=\"$value\"";
	}
	return $newarr;
}

function stringy ($arr) {
	 return array_map(function ($str){ return '"'.$str.'"'; }, $arr);
}
function get_lifetime(){
	return time() + 2*3600;
}
?>