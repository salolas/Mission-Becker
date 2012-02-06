<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>php Uploader</title>
<script src="jquery.js"></script>
<script>
$(document).ready(function(){
	$('#upload,#download').hide();
	$('#uploadinfo').click(function(){
		$('#upload').slideToggle('fast');
		$('#download').slideUp('fast');
	});
	$('#downloadinfo').click(function(){
		$('#download').slideToggle('fast');
		$('#upload').slideUp('fast');
	});
	$('#downloadinfo,#uploadinfo').hover(function(){
		$(this).css("cursor","pointer");
	},function(){
		$(this).css("cursor","default");
	});
   	$('#files').blur(function() {
		if($('#files').val() == "new file")
			$('#files').css('visibility', 'hidden');
		else
			$('#files').css('visibility', 'visible');
	});
});
</script>
</head>

<body>
<div id="main">
<h1>FTP-Up-/Downloader</h1>
	<?php
	if(isset($_POST['do'])){
		$do = $_POST['do'];
		if($do == "upload" && isset($_FILES['datei'])){
			move_uploaded_file($_FILES['datei']['tmp_name'], $_FILES['datei']['name']);
			echo "Die Datei wurde <b>Erfolgreich</b> nach
				  <a href=\"http://missionbecker.bplaced.de/".dirname($_SERVER['PHP_SELF'])."\">http://missionbecker.bplaced.de".dirname($_SERVER['PHP_SELF'])."</a>
				  (<a href=\"http://missionbecker.bplaced.de".dirname($_SERVER['PHP_SELF'])."/".$_FILES['datei']['name']."\">Zur Datei</a>) hochgeladen";
		}
	
/*	if(do == "upload" && (isset($_POST['files']) || isset($_POST['filename'])))
	{
		$handle = fopen ("besucherzaehler.txt", w);
		fwrite ($handle, $inhalt);
		fclose ($handle);
	
		echo "Der Wert $inhalt wurde gespeichert ";
		echo "in der Datei besucherzaehler.txt";
	}*/
	}
	?>
</div>
<div id="uploadinfo">
Upload
</div>
<div id="upload">
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
	<input type="file" name="datei"><br/>
	<input type="hidden" name="do" value="upload"/><br/>
	<input type="submit" value="Upload"/><br/>
	<input type="reset" value="penis?!"/>
</form>
</div>
<div id="downloadinfo">
Download
</div>
<div id="download">
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<select name="files" id="files">
	<?php
	// Mit den folgenden Zeilen lassen sich
	// alle Dateien in einem Verzeichnis auslesen
	$dir = ".";//dirname($_SERVER['PHP_SELF']);
	if ($dh = opendir($dir)) {
    	while (($file = readdir($dh)) !== false) {
			if($file != "." && $file != "..")
        		echo "<option value=\"".$file."\"" . filetype($dir . $file) . ">".$file."</option>";
        }
        closedir($dh);
    }
	?>
	</select>
    <br/>
	<?php


	echo "NOT IMPLEMENTED-EXCEPTION";
	
	?>
    <input type="hidden" name="do" value="download"/><br/>
	<input type="submit" value="Show Code"/><br/>
	<input type="reset" value="penis?!"/>
</form>
</div>
</body>
</html>

