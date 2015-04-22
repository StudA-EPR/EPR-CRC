<?php
require_once 'classes/ioutils.php';
$newest_image = IOUtils::getNewestPhotoFile('/www/photos');
if ($newest_image === null) {
    $newest_image = 'preview.jpg';
} else {
    $newest_image = preg_replace('/\/www\//', '', $newest_image);
}
$active_tab = 'index';
$title      = 'Schnappschuss aufnehmen';
include 'header.php';
?>
    <body>
		<div class="container">
    <?php include 'navigation.php'; ?>
		<div id="content-container">
		<!-- begin content area -->
        
        <div role="tabpanel">

          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist" style="margin-bottom: 18px;">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Kamera auslösen</a></li>
            <li role="presentation"><a href="#serienIntervall" aria-controls="serienIntervall" role="tab" data-toggle="tab">Serien- und Intervallaufnahme</a></li>
            <li role="presentation"><a href="#kameraEinstellungen" id="tab-cam-settings" aria-controls="kameraEinstellungen" role="tab" data-toggle="tab">Kameraeinstellungen</a></li>
          </ul>

          <!-- Tab panes -->
          <div class="tab-content">
          
            <div role="tabpanel" class="tab-pane active" id="home">             
             <div class="row">
                <div class="col-md-6 container" id="previewDIV">
				<a target="<?php echo $newest_image; ?>" class="snapshot-link"><img src="<?php echo $newest_image; ?>" alt="Preview" id="preview" class="img-rounded img-responsive"></a> <br>
                </div>
               <div class="col-md-6">
				<button class="btn btn-lg btn-primary" id="auto-ausloesen" href="#" role="button" style="vertical-align: middle;"><i class="fa fa-camera"></i> Foto aufnehmen</button>
				<div id="gphoto-exception-wrapper">
				</div>
			  </div>
             </div>
            </div>
            
            <div role="tabpanel" class="tab-pane" id="serienIntervall">
                 <?php include 'intervall.php'; ?>
            </div>
            
            <div role="tabpanel" class="tab-pane" id="kameraEinstellungen">
                   <?php include 'extended.php'; ?>
            </div>
          </div>

        </div>
        
        
       
        
	
	
		
			
				<!-- end content area -->
				</div>
		<div id="statusDiv"></div>
    </div>

<?php include("footer.php") ?>

</body>
</html>