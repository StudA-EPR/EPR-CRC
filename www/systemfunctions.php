<?php

	if(isset($_GET["page"]))
	{
		$command = $_GET["command"];
		switch($command)
				{
				case "restart": shell_exec('sudo /sbin/shutdown -r now'); break;
				case "shutdown": shell_exec('sudo /sbin/shutdown -f now'); break;
				
			   }
			   
	}
?>
