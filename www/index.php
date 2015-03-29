
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
       "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>

<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
<title>Studienarbeit: EPR camera remote control</title>
</head>
<body>
 <body>	
    <div class="container">
      <?php include("navigation.php") ?>
		<div id="content-container">
			<?php 
			if(isset($_GET["page"]))
{
				switch($_GET["page"])
				{
				case "basis": include("basis.php"); break;
				case "extended": include("extended.php"); break;
				case "gallery": include("gallery.php"); break;
				default: include("basis.php");
			   }
			 }
			else
				include("basis.php");


			?>
		</div>
		<div id="statusDiv"></div>
    </div>

    <script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script>
	//reload preview image onClick
	$('#previewDIV a').click(function(){
		d = new Date();
		$("#preview").attr("src", "preview.jpg?timestamp="+d.getTime());
	});
	//call function -> in this case we need a script which returns the console output
	$('#auto-ausloesen').click(function(){
		$("#output").load('control.php?option=ausloesen');
		});
	$('#linkToStatusPage').click(function(){	
		//$('#statusDropDown').load('status.php #stausDDcontent');
		$('#statusDropDown').load('status.php?option=spaceinfo').html();
		//$('#statusDropDown').html($('#statusDDcontent').html());
	});	
	$(function(){
    $("#linkToStatusPage").hover(function(){
      $(this).find("#statusDiv").fadeIn();
    }
                    ,function(){
                        $(this).find("#statusDiv").fadeOut();
                    }
                   );        
	});
	
	</script>
</body>
</html>