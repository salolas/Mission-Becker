<?php

require_once("dbconn.php");

$result = mysql_query('SELECT `Textschluessel` as key, `Uebersetzungstext` as text
                       FROM `Uebersetzung`
                       WHERE `Sprachkuerzel`="' . $language . '"',
                       $conn);

$translation = array();
while ($line = mysql_fetch_assoc($result)) {
  $translation[$line['key']] = $line['text'];
}

?>
