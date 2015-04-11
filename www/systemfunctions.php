<?php


	if(isset($_GET["command"]))
	{
		$command = $_GET["command"];
		switch($command)
				{
				case "reboot": shell_exec('poweroff -f now'); break;
				case "shutdown": shell_exec('reboot -f now'); break;
				
			   }
			   
	}
?>
