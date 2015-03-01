<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>dhbw camera remote control</title>
</head>
<body>
<h3>Startseite <u>E</u>in<u>P</u>latinen<u>R</u>echner - <u>C</u>amera <u>R</u>emote <u>C</u>ontrol</h3>

	<form method="GET" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
	<br><input type="submit" value="preview" name="option">
	<br><input type="submit" value="info" name="option">
	<input type="submit" value="ausloesen" name="option">
	<input type="submit" value="debug" name="option">
	<input type="submit" value="listfiles" name="option">
	<input type="reset" value="reset">
	<p><input type="submit" value="interval" name="option"> shot every <input name="seconds" type="number" min="1" max="9999" value="3"> seconds </p>
	</form>
	


<?php
# Make sure variables been invoked properly.
  if ($_SERVER['REQUEST_METHOD'] != GET) {
  echo "<hr>Script Error:";
  echo "<br>Usage error, cannot complete request, REQUEST_METHOD!=GET.";
  echo "<br>Check your FORM declaration and be sure to use METHOD=\"GET\".<hr>";
 
  }

# exit if there are no search arguments
  if(array_key_exists("option", $_GET)) {
	$option = htmlspecialchars($_GET['option']);
	$seconds = htmlspecialchars($_GET['seconds']);
} else {
	exit();
}
?>

<!-- Echo the arguments-->
Variable: Wert <br>
Option: <?php echo $option; ?>
<br>
Interval-Sekunden: <?php echo $seconds; ?>
<br>

Querystring:<br>
<?php echo urldecode($_SERVER['QUERY_STRING']) ?>

<?php 
	if ($option == "ausloesen") {
		$ausgabe= shell_exec("gphoto2 --capture-image-and-download");
	}
	
	if ($option == "debug") {
		$ausgabe= shell_exec("ls -l 2>&1"); // the "2>&1" is to have STDERR also returned to STDOUT
	}
	
	if ($option == "info") {
		$ausgabe= shell_exec("gphoto2 --auto-detect && gphoto2 --abilities 2>&1"); 
	}
	
	if ($option == "listfiles") {
		$ausgabe= shell_exec("gphoto2 --list-files 2>&1"); 
	}
	if ($option == "reset") {
		$ausgabe= shell_exec("reboot 2>&1"); 
	}
	if ($option == "interval") {
		$ausgabe= shell_exec("gphoto2 --capture-image-and-download --interval $seconds 2>&1"); 
	}
	if ($option == "preview") {
		$ausgabe= shell_exec("gphoto2 --capture-preview --force-overwrite --filename preview.jpg 2>&1"); 
	}
	
	function parseEchoLines($echoString) {
		
		//keep the function...just in case.. ;-)
		//$pattern = '#^.*$#';
		//$replacement = '<br>';
		//return preg_replace($pattern, $replacement, $echoString);
		return nl2br($echoString);

	}
?>

<hr>
<b>Ausgabe:</b><br>
<?php
echo parseEchoLines($ausgabe);
?>


<br>
<b>Array:</b><br>
<?php print_r($_GET); ?>

<br><img src="../preview.jpg">

<br>
<hr>

<table border="1">
<tr><td colspan="2"><b>Environment Variables</b></td></tr>
<tr><td colspan="2"><pre>
<?php echo shell_exec("export"); ?>
</pre></td>
</tr>

<tr><td><b>Uptime:</b></td><td><b>uname -a:</b></td></tr>
<tr>
<td><pre> 
<?php echo shell_exec("uptime"); ?>
</pre></td>
<td><pre>
<?php echo shell_exec("uname -a"); ?>
</pre></td>
<tr><td colspan="2"><b>cat /proc/version</b></td></tr>
<tr><td colspan="2"><pre>
<?php echo shell_exec("cat /proc/version"); ?>
</pre></td></tr>
</table>

</body>
</html>
