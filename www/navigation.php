<?php 
	$active_tab = basename($_SERVER['REQUEST_URI'], ".php");	
?>
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
            <li <?php if ($active_tab === 'index') {echo ' class="active"';} ?>> <a href="/index.php">Basis</a></li>
            <li <?php if ($active_tab === 'extended') {echo ' class="active"';} ?>><a href="/extended.php">Erweitert</a></li>
            <li <?php if ($active_tab === 'gallery') {echo ' class="active"'; } ?> ><a href="/gallery.php">Galerie</a></li>
            <li <?php if ($active_tab === 'filemanager') {echo ' class="active"';} ?>><a href="/files.php">Dateimanager</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Einstellungen <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li class="dropdown-header">Camera Remote Control</li>
                <li><a href="#"  id="linkToStatusPage"><i class="fa fa-info" style="padding-right:13px;"></i> Status</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">OpenWRT</li>
                <li><a href="/cgi-bin/luci"><i  class="fa fa-wrench" style="padding-right:5px;"></i> Konfiguration</a></li>
                <li><a href="/cgi-bin/luci" id="linkToStatusPage1"><i class="fa fa-info" style="padding-right:13px;"></i> Status</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li ><a href="./"><i class="fa fa-folder-open fa-lg"></i></a></li> <!-- Link zur moeglichen Statusseite über verfuegbaren Seicherplatz-->
			
			<li class="dropdown">
              <a href="#"onclick="showStatus()" class="dropdown-toggle" data-toggle="dropdown" id="linkToStatusPage"><i id="linkToStatusPage" class="fa fa-info-circle fa-lg"></i></a>
              <ul class="dropdown-menu" role="menu" id="statusDropDown">
                
                
              </ul>
            </li>
			<li><a href="#" onclick="callSystemFunction('shutdown')"><i class="fa fa-power-off fa-lg"></i></a></li> 
			<li><a href="#" onclick="callSystemFunction('reboot')"><i class="fa fa-power-off fa-lg"></i></a></li> 
          </ul>

        </div>
      </div>
    </nav>