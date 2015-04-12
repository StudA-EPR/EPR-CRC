    <?php include 'header.php'; ?>
    <body>
		<div class="container">
    <?php include 'navigation.php'; ?>
		<div id="content-container">
		<!-- begin content area -->
		<div class="page-header">
            <h1>Kamera auslösen</h1>
        </div>
		
		<div class="row">
			<div class="col-md-6 container" id="previewDIV">
				<a target="preview.jpg" class="snapshot-link"><img src="preview.jpg" alt="Preview" id="preview" class="img-rounded img-responsive"></a> <br>
			</div>
			<div class="col-md-6">
				<button class="btn btn-lg btn-primary" id="auto-ausloesen" href="#" role="button"><i class="fa fa-camera"></i> Foto aufnehmen</button>
				<div id="gphoto-exception-wrapper">
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