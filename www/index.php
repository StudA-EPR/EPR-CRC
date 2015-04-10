
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
		$("#preview").attr("src", "/photos/preview.jpg?timestamp="+d.getTime());
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
	//preload Images
function preload(arrayOfImages) {
	$('#myModalGal').modal('show'); 
	$('#myModalGal').on('shown.bs.modal', function(e){
		//console.log("show");
		
		var $pb = $('.progress-bar');
		var $wert = 0;
		var $anteil = 100/arrayOfImages.length;
		
		$(arrayOfImages).each(function () {
					
			$('<img />').attr('src',this).appendTo('body').hide();
			$wert = $wert + $anteil;
			$pb.attr('aria-valuenow', $wert);
			$pb.css('width', ($wert)+'%');
			$pb.text($wert + "%");
			//console.log("add "+ $wert);
		});
		$('#myModalGal').modal('hide'); 
		//console.log("hide");
	});
	
	
}
	
	$( document ).ready(function() {
		
		$('#myCarousel').carousel({			
			interval:false // remove interval for manual sliding
			});
			
		$.getJSON("imagelist.php", function(data){
		
			//initialize carousel
			var start=0;
			for (var i=start, limit=5; i < limit; i++) {
				console.log(data[i]);
				if (i==start) {		
					$('#sliderwrapper').append("<div class=\"item active\"><img src=\"" + data[i] + "\" ></div>");						
				} else {
				$('#sliderwrapper').append("<div class=\"item\"><img src=\"" + data[i] +"\"></div>");					
				}
			}
			var idx = $('#myCarousel .item.active').index();			
	
			// when the carousel slides, check index and load partially more content
			$('#myCarousel').on('slid.bs.carousel', function (e) {
				
				// get index of currently active item
				idx = $('#myCarousel .item.active').index();	
				console.log("current index: " + (idx+1));
				if ( (idx+1) % 5 ==0) {			// every 5th image
					//console.log("load next 5 images");
					//$('.item').html("wait...");
					preload([data[idx+1], data[idx+2],data[idx+3],data[idx+4],data[idx+5]]);
					console.log("Images preloaded: "+ data[idx+1], data[idx+2],data[idx+3],data[idx+4],data[idx+5]);
					for (var i=(idx+1); i<(idx+6); i++) {
						if(i<data.length) {
							console.log("einbetten: " + data[i]);
							$('.carousel-inner').append("<div class=\"item\"><img src=\"" + data[i] +"\"></div>");
							}
					}
					
				}

		  
			});
	});

});

	</script>
</body>
</html>