
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
       "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>

<link rel="stylesheet" href="css/bootstrap.min.css">

<!-- 
If you want to, you can use 
<link rel="stylesheet" href="css/yeti-bootstrap.min.css">  
or
<link rel="stylesheet" href="css/lavish-bootstrap.css"> 
as theme file
-->
<link rel="stylesheet" href="css/font-awesome.min.css">



<title>Studienarbeit: EPR camera remote control</title>
</head>
<body>
 <body>	
    <div class="container">

      
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
            <li class="active"><a href="#">Basis</a></li>
            <li><a href="#about">Erweitert</a></li>
            <li><a href="#contact">Galerie</a></li>
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


    <div id="content-container">
      <div class="jumbotron">
        <h1>Kamerafernsteuerung</h1>
        <p>Hier erscheint ein preview Bild inklusive der Steuerungsoptionen.</p>
        <p>Für weitere "Spezialfunktionen" (Intervall-Aufnahmen u. &auml;. wird eine zweite Seite erstellt die versierten Anwendern weitere Optionen bietet. </p>
	  </div>  
		
		<div class="row">
			<div class="col-md-6 container" id="previewDIV">
				<a targe="preview.jpg" ><img src="preview.jpg" alt="Preview" id="preview" class="img-rounded img-responsive"></a> <br>
			</div>
			<div class="col-md-6">
				<a class="btn btn-lg btn-primary" id="auto-ausloesen" href="#" role="button"><i class="fa fa-camera"></i> Foto aufnehmen</a>
				<div>Output:
					<pre id="output">lorem ipsum</pre>
					
				</div>
				
			</div>
			
		</div>
      <br />
	</div>
	
    </div> <!-- /container -->
      <div id="statusDiv"></div>


    <script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script>
	//reload preview image onClick
	$('#previewDIV a').click(function(){
		d = new Date();
		$("#preview").attr("src", "preview.jpg?timestamp="+d.getTime());
	});
	//call function -> in this case we need a script which returns the console output
	$('#auto-ausloesen').click(function(){
		$("#output").load('control.php?option=ausloesen');
		});
	$('#linkToStatusPage').click(function(){	
		//$('#statusDropDown').load('status.php #stausDDcontent');
		$('#statusDropDown').load('status.php?option=spaceinfo').html();
		//$('#statusDropDown').html($('#statusDDcontent').html());
	});	
	$(function(){
    $("#linkToStatusPage").hover(function(){
      $(this).find("#statusDiv").fadeIn();
    }
                    ,function(){
                        $(this).find("#statusDiv").fadeOut();
                    }
                   );        
	});
	</script>
</body>
</html>