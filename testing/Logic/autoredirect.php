<?php
	include("libaries/libuser.php");
	if(isset($_POST["do"]) && isset($_POST["n"]) && isset($_POST["v"]) && isset($_POST["redirect"])){
		$do = $_POST["do"];
		$name = $_POST["n"];
		$val = $_POST["v"];
		$redirect = $_POST["redirect"];
	}
	else if(isset($_GET["do"]) && isset($_GET["n"]) && isset($_GET["v"]) && isset($_GET["redirect"])){
		$do = $_GET["do"];
		$name = $_GET["n"];
		$val = $_GET["v"];
		$redirect = $_GET["redirect"];
	}
	else
		exit;
	$title = "Auto Redirect";
	$time = 0;
	$error = "";
	if($do == "login"){
		if(!login($name, $val)){
			$error = "<b>Login failed!</b><br/>\nUsername and Password missmatch!";
			$time = 5;
		}
	}
	else if($do == "activate"){
		$time = 5;
		$title = "Email verification";
		if(activate_user($name, $val))
			$title = "Verification sucessfull!";
		else
			$error = "Verification failed!";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="refresh" content="<?php echo $time; ?>; URL=<?php echo $redirect; ?>">
<title><?php echo $title; ?></title>
</head>

<body>
	<h1 style="text-align:center;font:Verdana, Geneva, sans-serif;color:#999"><?php echo $title; ?></h1>
  	<p style="text-align:center;font:Verdana, Geneva, sans-serif;color:#666">If you're not redirected automatically, <a href="<?php echo $redirect; ?>">click here</a></p>
    <p style="text-align:center;font:Verdana, Geneva, sans-serif;color:#F00;font-size:20px"><?php echo $error; ?></p>
</body>
</html>