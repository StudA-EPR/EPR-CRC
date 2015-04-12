<?php

	if(isset($_GET["command"]))
	{
		$command = $_GET["command"];

		switch($command)
        {
            case "reboot":
                shell_exec('reboot');
                break;
            case "shutdown":
                shell_exec('halt');
                break;
            default:
                break;
        }
	}

?>
