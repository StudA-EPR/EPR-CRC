<?php 
	$active_tab = basename($_SERVER['REQUEST_URI'], ".php");	
	switch($active_tab)
				{
				case "index": $title= "Startseite - Basis" ; break;
				case "extended": $title= "Erweitert" ; break;
				case "gallery": $title= "Bildergalerie" ; break;
				case "files": $title= "Filemanager" ; break;
				default: $title= "Studienarbeit EPRCRC" ;
				
			   }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/epr-crc.css">
        <title><?php echo $title; ?></title>
    </head>
