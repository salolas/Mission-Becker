<?php
  $conn = mysql_connect("localhost", "missionbecker", 'weak;bla$komisch!') or die(mysql_error());
  $db   = mysql_select_db("missionbecker", $conn) or die(mysql_error());
?>