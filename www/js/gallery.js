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
            if (data.length > 0 ) {
                
			//initialize carousel
			var start = 0;
            var limit = 5;
            if (data.length <5) {
                limit = data.length;                
            }
			for (var i=start, limit; i < limit; i++) {
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
                    //check wheter there are more images
                    if (data[idx+1]) {
                        console.log("next element " + data[idx+1]+" exists");
                        // check following elemnets and append to load-array
                        var loadarray = new Array();
                        var loadcount=0;
                         for (i=(idx+1); i<(idx+6); i++) {
                            if (data[i]) {loadarray[loadcount]=data[i]}
                            loadcount++;                            
                         }
					preload(loadarray);
					console.log("Images preloaded: "+ loadarray);
                    //for (var i = 0; i < arrayLength; i++) {
                        loadarray.forEach(function(entry) {
                                                    console.log("einbetten: " +entry);
                                                    $('.carousel-inner').append("<div class=\"item\"><img src=\"" + entry +"\"></div>");
                        });
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