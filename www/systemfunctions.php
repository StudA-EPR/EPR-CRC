<?php

	if(isset($_GET["page"]))
	{
		$command = $_GET["command"];
		switch($command)
				{
				case "restart": shell_exec('sudo /sbin/shutdown -r now'); break;
				
				default: include("basis.php");
			   }
			   
	}
?>


<?php 
			if(isset($_GET["page"]))
{
				switch($_GET["page"])
				{
				case "basis": include("basis.php"); break;
				case "extended": include("extended.php"); break;
				case "gallery": include("gallery.php"); break;
				case "files": include("files.php"); break;
				default: include("basis.php");
			   }
			 }
			else
				include("basis.php");


			?>