<?php
function makeList($arr){
	return "(" . intersperse($arr, ", ") . ")";
}

function to_select($arr) {
	return intersperse(to_compare(escape_array($arr)), " AND ");
}

function intersperse($arr, $between){
	$first = array_shift($arr);
  return array_reduce($arr, function ($rest, $str) use ($between) {
                              return $rest . $between . $str;
                            }, $first);
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
	 return array_map(function ($str) { return '"'.$str.'"'; }, $arr);
}
?>
