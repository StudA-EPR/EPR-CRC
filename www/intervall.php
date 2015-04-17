<form class="form-horizontal" action="extendedaction.php" method="post">
			<fieldset>
			<!-- Serienbilder Input-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="appendedtext">Serienaufnahme</label>
			  <div class="col-md-4">
				<div class="input-group spinner">
					<input id="serienbilderAnzahl" name="serienbilderAnzahlInput" class="form-control input-text" value="0" placeholder="Aufnahmen" type="text">
					<div class="input-group-btn-vertical">
						<button type="button" class="btn btn-default"><i class="fa fa-caret-up"></i></button>
						<button type="button"  class="btn btn-default"><i class="fa fa-caret-down"></i></button>
					</div>  
                   
				</div>                
				<p class="help-block">Anzahl der Serienbilder eingeben</p>
			  </div>
              <div class="col-md-4">
                <label>
                    <input type="checkbox" id="checkSerienbilder" value="" name="checkSerienbilder">
                    verwenden
                 </label>
              </div>
			</div>
			<!-- Intervall Input-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="appendedtext">Intervall</label>
			  <div class="col-md-4">
				<div class="input-group spinner">
                  <input id="intervallSekunden" name="intervallSekundenInput" class="form-control input-text" value="0" placeholder="Sekunden" type="text">                  
				  <div class="input-group-btn-vertical">
						<button type="button" class="btn btn-default"><i class="fa fa-caret-up"></i></button>
						<button type="button" class="btn btn-default"><i class="fa fa-caret-down"></i></button>
					</div> 
				</div>
				<p class="help-block">Zeit (in Sekunden) zwischen den Aufnahmen eingeben</p>
			  </div>
               <div class="col-md-4">
                <label>
                    <input type="checkbox" id="checkIntervall" value="" name="checkIntervall">
                    verwenden
                 </label>
              </div>
			</div>
            			<!-- Button -->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="startCapture">Aufnahme starten</label>
			  <div class="col-md-4">
				<button id="setSettings" name="setSettings" class="btn btn-primary"><i class="fa fa-camera"></i> aufnehmen</button>
			  </div>
			</div>
		</fieldset>
		</form>
		<div id="gphoto-exception-wrapper-extended">
		</div>




 