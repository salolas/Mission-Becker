<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml/dtd/xhtml1-transitional.dtd">

<?php
  $conn = mysql_connect("localhost", "missionbecker", 'weak;bla$komisch!') or die(mysql_error());
  $db   = mysql_select_db("missionbecker", $conn) or die(mysql_error());

  $interessen = Array();
  $query = "SELECT DISTINCT Name FROM Interessen";
  $result = mysql_query($query, $conn);
  for($i = 0; $line = mysql_fetch_array($result); $i++) {
    $interessen[$i] = $line["Name"];
  }

  $query = 'INSERT INTO Schueler (Name) VALUES ("' . mysql_escape_string($_GET["name"]) . '")';
  mysql_query($query, $conn) or die(mysql_error());
  $schuelerid = mysql_insert_id();

  foreach($_GET["besonderheiten"] as $besonderheit){
    $query = 'SELECT Id FROM Besonderheiten WHERE Name = "' . mysql_escape_string($besonderheit) . '"';
    $result = mysql_query($query, $conn);
    $line = mysql_fetch_array($result);
    $besonderheitenid = $line["Id"];
    $query = 'INSERT INTO SchuelerBesonderheiten (SchuelerId, BesonderheitenId) VALUES (' . $schuelerid . ', "' . $besonderheitenid . '")';
    mysql_query($query, $conn) or die(mysql_error());
  }

  foreach($interessen as $interesse){
    $query = 'SELECT Id FROM Interessen WHERE Name = "' . $interesse . '"';
    $result = mysql_query($query, $conn);
    $line = mysql_fetch_array($result);
    $interessenid = $line["Id"];
    $query = 'INSERT INTO SchuelerInteressen (SchuelerId, InteressenId, Bewertung)
              VALUES ("' . $schuelerid . '", "' . $interessenid . '", ' . mysql_escape_string($_GET[$interesse]) . ')';
    mysql_query($query, $conn) or die(mysql_error());
  }

?>


<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Eingabe</title>
  </head>
  <body>
    Eingabe erfolgreich!
  </body>
</html>
