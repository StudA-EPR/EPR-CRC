    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/epr-crc.js"></script>
	<?php 
			if(isset($_GET["page"]))
			{
				if(($_GET["page"])=="gallery") {
					echo "<script src=\"js/gallery.js\"></script>";
				}
			}
	?>
	