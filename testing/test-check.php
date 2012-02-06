<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/dtd/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Test Checkbox</title>
  </head>
  <body>
    <h1>Test Checkbox</h1>
    
    <form action="test-check.php" method="get">
<?php
  for($i = 0; $i < 10; $i++){
?>
      <input type="checkbox" name="check[]" value="<?php echo $i; ?>" /><?php echo $i; ?><br/>
<?php
  }
?>
    <input type="submit" value="Abschicken" />
    </form>

<?php
  if(isset($_GET["check"])){
?>
    <h1>Ausgabe Checkbox</h1>

<?php
    print_r($_GET["check"]);
  }
?>

  </body>
</html>
