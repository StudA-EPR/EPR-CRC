<div class="row "><table class="table table-bordered table-hover" id="cameraInfoTable"><thead><tr><th>Hersteller</th><th>Modell</th><th>Akkustand</th></tr></thead><tbody><tr></tr></tbody></table>
</div>
<hr>
<form class="form-horizontal" action="extendedaction.php" method="post">
			<fieldset>



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
                    <input type="checkbox" id="checkIntervall" value="" name="">
                    verwenden
                 </label>
              </div>
			</div>
				<hr>
            <!-- Verschlusszeit-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="appendedtext">Verschlusszeit</label>
			  <div class="col-md-4">			
                  <select class="form-control" id="selectVerschlusszeit" name="verschlusszeit">

                   </select>               
				<p class="help-block">Verschlusszeit für die Aufnahme wählen</p>
			  </div>
			</div>
            
            <!-- Blende-->
            <div class="form-group">
			  <label class="col-md-4 control-label" for="appendedtext">Blende</label>
			  <div class="col-md-4">			
                  <select class="form-control" id="selectBlende" name="blende">

                   </select>
				<p class="help-block">Blendeneinstellung für die Aufnahme wählen</p>
			  </div>
			</div>

				<!-- ISO-->
				<div class="form-group">
					<label class="col-md-4 control-label" for="appendedtext">ISO</label>
					<div class="col-md-4">
						<select class="form-control" id="selectISO" name="iso">

						</select>
						<p class="help-block" id="isoinfo">ISO für die Aufnahme wählen</p>
					</div>
				</div>

			<!-- Button -->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="startCapture">Einstellungen in Kamera setzen</label>
			  <div class="col-md-4">
				<button id="setSettings" name="setSettings" class="btn btn-primary"><i class="fa fa-camera"></i> speichern</button>
			  </div>
			</div>

			</fieldset>
		</form>
		<div id="gphoto-exception-wrapper-extended">
		</div>




 