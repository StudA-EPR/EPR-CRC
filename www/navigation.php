<nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">EPR-CRC</a>
          </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li <?php if($_GET["page"] == "basis") { echo 'class="nav active"'; } ?> >  <a href="index.php?page=basis">Basis</a></li>
            <li <?php if($_GET["page"] == "extended") { echo 'class="nav active"'; } ?> ><a href="index.php?page=extended">Erweitert</a></li>
            <li <?php if($_GET["page"] == "gallery") { echo 'class="nav active"'; } ?> ><a href="index.php?page=gallery">Galerie</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Einstellungen <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li class="dropdown-header">Camera Remote Control</li>
                <li><a href="#"><i class="fa fa-floppy-o" style="padding-right:5px;"></i> Dateiverwaltung</a></li>
                <li><a href="#"><i class="fa fa-info" style="padding-right:13px;"></i> Status</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">OpenWRT</li>
                <li><a href="#"><i  class="fa fa-wrench" style="padding-right:5px;"></i> Konfiguration</a></li>
                <li><a href="#" id="linkToStatusPage1"><i class="fa fa-info" style="padding-right:13px;"></i> Status</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li ><a href="./"><i class="fa fa-folder-open fa-lg"></i></a></li> <!-- Link zur moeglichen Statusseite über verfuegbaren Seicherplatz-->
			
			<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="linkToStatusPage"><i id="linkToStatusPage" class="fa fa-info-circle fa-lg"></i></a>
              <ul class="dropdown-menu" role="menu" id="statusDropDown">
                
                
              </ul>
            </li>
          </ul>
		  <!--
            <li><a href="#" id="linkToStatusPage"><i id="linkToStatusPage" class="fa fa-info-circle fa-lg"></i></a></li> <!-- Link zur Informations-/Statusseite -->
			<!-- <li><a href="../navbar-fixed-top/"><i class="fa fa-power-off fa-lg"></i></span></a></li> -->
			
          </ul>
        </div>
      </div>
    </nav>