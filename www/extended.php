    <?php include 'header.php'; ?>
    <body>
		<div class="container">
    <?php include 'navigation.php'; ?>
		<div id="content-container">
		<!-- begin content area -->
		
		
		
		<form class="form-horizontal">  
			<fieldset>

			<!-- Form Name -->
			<legend>Erweiterte Einstellungen</legend>

			<!-- Serienbilder Input-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="appendedtext">Serienaufnahme</label>
			  <div class="col-md-4">
				<div class="input-group spinner">
					<input id="serienbilderAnzahl" name="serienbilderAnzahlInput" class="form-control input-text" placeholder="Aufnahmen" type="text">
					<div class="input-group-btn-vertical">
						<button type="button" class="btn btn-default"><i class="fa fa-caret-up"></i></button>
						<button type="button"  class="btn btn-default"><i class="fa fa-caret-down"></i></button>
					</div>  
                   
				</div>                
				<p class="help-block">Anzahl der Serienbilder eingeben</p>
			  </div>
              <div class="col-md-4">
                <label>
                    <input type="checkbox" id="checkSerienbilder" value="">
                    verwenden
                 </label>
              </div>
			</div>
			<!-- Intervall Input-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="appendedtext">Intervall</label>
			  <div class="col-md-4">
				<div class="input-group spinner">
				  <input id="intervallSekunden" name="intervallSekundenInput" class="form-control input-text" placeholder="Sekunden" type="text">
				  <div class="input-group-btn-vertical">
						<button type="button" class="btn btn-default"><i class="fa fa-caret-up"></i></button>
						<button type="button" class="btn btn-default"><i class="fa fa-caret-down"></i></button>
					</div>
				</div>
				<p class="help-block">Zeit zwischen den Aufnahmen eingeben</p>
			  </div>
               <div class="col-md-4">
                <label>
                    <input type="checkbox" id="checkSerienbilder" value="">
                    verwenden
                 </label>
              </div>
			</div>
            <!-- Verschlusszeit-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="appendedtext">Verschlusszeit</label>
			  <div class="col-md-4">			
                  <select class="form-control">
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                   </select>               
				<p class="help-block">Verschlusszeit für die Aufnahme wählen</p>
			  </div>
               <div class="col-md-4">
                <label>
                    <input type="checkbox" id="checkSerienbilder" value="">
                    verwenden
                 </label>
              </div>
			</div>
            
            <!-- Blende-->
            <div class="form-group">
			  <label class="col-md-4 control-label" for="appendedtext">Blende</label>
			  <div class="col-md-4">			
                  <select class="form-control">
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                   </select>               
				<p class="help-block">Verschlusszeit für die Aufnahme wählen</p>
			  </div>
               <div class="col-md-4">
                <label>
                    <input type="checkbox" id="checkSerienbilder" value="">
                    verwenden
                 </label>
              </div>
			</div>
			<!-- Button -->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="startCapture">Mit diesen Einstellungen aufnehmen</label>
			  <div class="col-md-4">
				<button id="startCapture" name="startCapture" class="btn btn-primary"><i class="fa fa-camera"></i> Auslösen</button>
			  </div>
			</div>

			</fieldset>
		</form>
			
		
		<!-- end content area -->
				</div>
		<div id="statusDiv"></div>
    </div>
<?php 
require_once 'classes/gphoto.php';
date_default_timezone_set('UTC');

try {
    $configs = GPhoto::listConfig();
    
    var_dump($configs);
    
    foreach ( $configs as $config) {
        $configDetails = GPhoto::getConfig($config);

        foreach ($configDetails as &$line) {
            echo $line . '<br />';
        }
    }

} catch (GPhotoException $e) {
    echo $e->getMessage() . PHP_EOL;
}
?>
    
    
<?php include("footer.php") ?>

</body>
</html>