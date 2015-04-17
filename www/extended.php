<div class="row "><table class="table table-bordered table-hover" id="cameraInfoTable"><thead><tr><th>Hersteller</th><th>Modell</th><th>Akkustand</th></tr></thead><tbody><tr></tr></tbody></table>
</div>
<hr>
<form class="form-horizontal" action="extendedaction.php" method="post">
			<fieldset>
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
				<button id="setSettings" name="setSettings" class="btn btn-primary"><i class="fa fa-floppy-o"></i><i class="fa fa-arrow-right"></i><i class="fa fa-camera"></i> speichern</button>
			  </div>
			</div>

			</fieldset>
		</form>
		<div id="gphoto-exception-wrapper-extended">
		</div>




 