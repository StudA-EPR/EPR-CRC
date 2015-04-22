    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/epr-crc.js"></script>
	<?php 
			if(isset($active_tab))
			{
				if($active_tab=="gallery") {
					echo "<script src=\"js/gallery.js\"></script>";
				}
				if($active_tab=="index") {
                    echo "<script src=\"js/snapshot.js\"></script>";
                    echo "<script src=\"js/settings.js\"></script>";
				}
				
			}
	?>
	