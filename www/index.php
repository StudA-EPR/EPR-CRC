    <?php include 'header.php'; ?>
    <body>
		<div class="container">
    <?php include 'navigation.php'; ?>
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

<?php include("footer.php") ?>
	
</body>
</html>