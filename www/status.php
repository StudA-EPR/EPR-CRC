<?php
# Make sure variables been invoked properly.
  if ($_SERVER['REQUEST_METHOD'] != GET) {
  echo "<hr>Script Error:";
  echo "<br>Usage error, cannot complete request, REQUEST_METHOD!=GET.";
  echo "<br>Check your FORM declaration and be sure to use METHOD=\"GET\".<hr>";
 
  }


  if(array_key_exists("option", $_GET)) {
	$option = htmlspecialchars($_GET['option']);
	
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
	if($option == "spaceinfo"){
		//$ausgabe = shell_exec("df -Ph $PWD | tail -1 | awk '{ print $3} 2>&1");
		
		echo "<i class=\"fa fa-hdd-o\" ></i>free: " ;
		//echo shell_exec("df -Ph $PWD | tail -1 | awk \'{ print $3}\'") ;
		echo shell_exec(escapeshellcmd($command));
		echo HumanSize(disk_free_space("/"));
		echo " <br> ";
		echo "<i class=\"fa fa-hdd-o\"></i>total: ";
		echo HumanSize(disk_total_space("/"));
		echo "<li class=\"divider\"></li>";
		echo "<i class=\"fa fa-clock-o \" ></i>Up: " ;
		//echo shell_exec("uptime");
		echo showUptime();
	}
	if($option == "statusumfassend") {
		//Todo: use htmlentities();
		echo "<div id=\"statusumfassend\">";
		echo "	<table>";

		echo "	<tr><td></td><td>";
		echo "	<div id=\"umgebungsvariablen\">";
		//echo shell_exec("export"); 
		echo "	</div></td></tr>";
			
		echo "	<tr><td>Uptime</td><td>";
		echo "	<div id=\"uptime\">";
		echo shell_exec("uptime");
		echo "	</div></td></tr>";
			
		echo "	<tr><td>uname</td><td>";
		echo "	<div id=\"uname\">";
		echo shell_exec("uname -a");
		echo "	</div></td></tr>";
			
		echo "	<tr><td>Version</td><td>";
		echo "	<div id=\"version\">";
		echo shell_exec("cat /proc/version");
		echo "	</div></td></tr>";
		echo "	</table>";
		echo "</div>";
	}
	
}

	function parseEchoLines($echoString) {
		
		//keep the function...just in case.. ;-)
		//$pattern = '#^.*$#';
		//$replacement = '<br>';
		//return preg_replace($pattern, $replacement, $echoString);
		return nl2br($echoString);

	}

function HumanSize($Bytes){
  $Type=array("", "Kilo", "Mega", "Giga", "Terra", "Peta", "Exo", "Zetta", "Yotta");
  $Index=0;
  while($Bytes>=1024)
  {
    $Bytes/=1024;
    $Index++;
  }
  return("".number_format($Bytes,2,",",".")." ".$Type[$Index]."bytes");
}
function showUptime(){
      
		$display=exec("uptime" );
		$myArray = explode(',', $display);
		return $myArray[0]; 
}
?>

<?php //echo urldecode($_SERVER['QUERY_STRING']) ?>

		<?php
		echo parseEchoLines($ausgabe);
		
/*
<div id="statusumfassend">
	<table>

		<tr><td></td><td>
		<div id="umgebungsvariablen">
		<?php //echo shell_exec("export"); ?>
		</div></td></tr>
		
		<tr><td>Uptime</td><td>
		<div id="uptime">
		<?php echo shell_exec("uptime"); ?>
		</div></td></tr>
		
		<tr><td>uname</td><td>
		<div id="uname">
		<?php echo shell_exec("uname -a"); ?>
		</div></td></tr>
		
		<tr><td>Version</td><td>
		<div id="version">
		<?php echo shell_exec("cat /proc/version"); ?>
		</div></td></tr>
	</table>
</div>

<div id="statusDDcontent">
<li class="dropdown-header">Uptime:</li>
<li><?php echo shell_exec("uptime"); ?></li>
<li class="divider"></li>
<li class="dropdown-header">uname:</li>
<li><?php echo shell_exec("uname -a"); ?></li>
<li class="dropdown-header">Version</li>
<li><?php echo shell_exec("cat /proc/version"); ?></li>
<li><a href="#"><i  class="fa fa-wrench" style="padding-right:5px;"></i> Konfiguration</a></li>
</div>
*/
?>