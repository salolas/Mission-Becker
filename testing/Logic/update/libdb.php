<?php
require_once("/path.php");
require_once($COMFORTPATH . "dbconnection.php");
require_once($COMFORTPATH . "array-utils.php");

function get_languages(){
	$out = array();
	$query = "SELECT *
			  FROM Sprachen";
	$res = SELECT_DATA($query);
	while($row = mysql_fetch_assoc($res))
		$out[$row["Sprachkuerzel"]] = $row["Sprachname"];
	return $out;
}
function SELECT_DATA($values, $table_name, $arr_where, $arr_join = array()){
	$query = "SELECT " . $select . "
			  FROM " . $table_name . "
			  WHERE " . to_select($arr_where) . 
			  (empty($arr_join) ? "" : " AND " . intersperse(to_compare($arr_join), " AND "));
	return mysql_query($query);
}
//Formatierung $arrData: [key]=Spaltenname [value]=Wert.
//						 Bsp.: array("Vorname" => "Hans-Dieter", "Nachname" => "Brot");
function INSERT_DATA($table_name, $arr_data){
	$arr = escape_array($arr_data);
	$values = makeList(stringy($arr));
	$keys = makeList(array_keys($arr));
	$query = "INSERT INTO ".$table_name." ".$keys."
			  VALUES ".$values;
  	return mysql_query($query);
}
function UPDATE_DATA($table_name, $arr_set, $arr_where){
	$query = "UPDATE `$table_name`
			  SET " . intersperse(to_compare(escape_array($arr_set)), ", ") . " 
			  WHERE " . to_select($arr_where) . " LIMIT 1";
	return mysql_query($query);
}
?>
