    <?php include 'header.php'; ?>
    <body>
		<div class="container">
    <?php include 'navigation.php'; ?>
		<div id="content-container">
		<!-- begin content area -->
			<div class="jumbotron">
        <h1>Kamerafernsteuerung</h1>
        <p>Hier erscheint ein preview Bild inklusive der Steuerungsoptionen.</p>
        <p>Für weitere "Spezialfunktionen" (Intervall-Aufnahmen u. &auml;. wird eine zweite Seite erstellt die versierten Anwendern weitere Optionen bietet. </p>
	  </div>  
		
		<div class="row">
			<div class="col-md-6 container" id="previewDIV">
				<a target="preview.jpg" ><img src="preview.jpg" alt="Preview" id="preview" class="img-rounded img-responsive"></a> <br>
			</div>
			<div class="col-md-6">
				<a class="btn btn-lg btn-primary" id="auto-ausloesen" href="#" role="button"><i class="fa fa-camera"></i> Foto aufnehmen</a>
				<div>Output:
					<pre id="output">lorem ipsum</pre>
					
				</div>
				
			</div>
			
		</div>
		
			
				<!-- end content area -->
				</div>
		<div id="statusDiv"></div>
    </div>

<?php include("footer.php") ?>
    <script src="js/snapshot.js"></script>
	
</body>
</html>