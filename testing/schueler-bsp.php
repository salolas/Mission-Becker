<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php

  function besonderheiten_input($name){
    return '<input type="checkbox" name="besonderheiten[]" value="' . $name . '" /> ' . $name . '<br/>';
  }

  function interessen_input($name){
    return $name . ': <input type="text" name="' . $name . '" size="3" /> <br/>';
  }

  $conn = mysql_connect("localhost", "missionbecker", 'weak;bla$komisch!') or die(mysql_error());
  $db   = mysql_select_db("missionbecker", $conn) or die(mysql_error());

?>


<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Beispielschueler Eingabe - Mission Becker</title>
  </head>
  <body>
    <h1>Eingabe Beispielschueler</h1>

    <form action="schueler-eingabe.php" method="get">
      Name: <input type="text" name="name" size="10" /><br/>
      <h5>Besonderheiten</h5>
<?php
  $query = "SELECT DISTINCT Name FROM Besonderheiten";
  $result = mysql_query($query, $conn);
  while ($line = mysql_fetch_array($result)){
    echo besonderheiten_input($line["Name"]) . "\n";
  }
?>
      <h5>Interessen</h5>
      Nur Eingaben zwischen 0 und 1.<br/>
<?php
  $query = "SELECT DISTINCT Name FROM Interessen";
  $result = mysql_query($query, $conn);
  while ($line = mysql_fetch_array($result)){
    echo interessen_input($line["Name"]) . "\n";
  }
?>
      <input type="submit" value="Abschicken" />
    </form>
  </body>
</html>
