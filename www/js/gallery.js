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
            
            //first of all -> check whether there are images in the image-array
            if (!(data.length > 0) ) {
                
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
        }
        else {
            $( "#myCarousel" ).replaceWith( "\
            <div class=\"alert alert-info \" role=\"alert\">\
                <h3>Keine Bilder gefunden</h3> \
                Bisher sind noch keine Bilder im photo-Verzeichnis vorhanden. <br> \
                Über die Menüpunkte <a href=\"/index.php\" >Basis</a> und <a href=\"/extended.php\" >Erweitert</a> können Fotos aufgenommen werden.\
            </div>" );
        }
	});

});