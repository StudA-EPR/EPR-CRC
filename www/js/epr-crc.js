// Confirmation popup for the filemanager.
function deleteFileConfirm(filename) {
	return confirm('Wollen Sie ' + filename + ' wirklich unwiderruflich löschen?');
}

// Updates the rename modal window with the corresponding filename.
$('#rename-modal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget); // Button that triggered the modal
  var filename = button.data('filename'); // Extract info from data-* attributes
  var modal = $(this);
  modal.find('#old-filename').val(filename);
});

// show != shown. The modal has to be rendered completely to correctly focus the cursor onto the input field.
$('#rename-modal').on('shown.bs.modal', function (event) {
	$('#new-filename').focus();
});

//call function -> in this case we need a script which returns the console output
$('#auto-ausloesen').click(function(){
	$("#output").load('control.php?option=ausloesen');
	});

function showStatus(){	
	
    
	//$('#statusDropDown').load('status.php?option=spaceinfo').html();    
	$.getJSON( "/status.php?option=json", function( data ) {
	  var items = [];
	  $.each( data, function( key, val ) {
		items.push( "<tr><td>" + key + ": </td><td>" + val + "</td></tr>" );
	  });
	  // clear DropDown Box to prevent multiple appendings
		$( "#statusDropDown" ).empty();
		$( "<table/>", {
			"class": "table table-hover",
			html: items.join( "" )
		  }).appendTo( "#statusDropDown" );
	 
	});
}
 function buttonStatus_Click() {
   //$('#linkToStatusPage').click();
   $("#linkToStatusPageMenu").dropdown();
   
  }	

function callSystemFunction(cmd) {
	var cmdGermanText = '';
	switch (cmd) {
		case 'reboot':
			cmdGermanText = 'neu starten';
			break;
		case 'halt':
			cmdGermanText = 'herunterfahren';
			break;
		default:
			cmdGermanText = 'unbekannte Aktion';
			break;
	}
	
	var confirmation = confirm("Sind Sie sicher, dass Sie " + cmdGermanText + " wollen?");
	
	if (confirmation === true) {
		$.get( "/systemfunctions.php", { command: cmd} );
  }
}

// style spinner buttons in input fields            coming soon: prevention of values < 0
(function ($) {
  $('.spinner .btn:first-of-type').on('click', function() {
	  //var wert = parseInt($(this).parent().prev().val(), 10);
	  var wert= $(this).parent().prev().val();
	  if (wert==parseInt(wert,10) && wert>=0) {
		  $(this).parent().prev().val( parseInt($(this).parent().prev().val(), 10) + 1);
	  }
	  else {
		  alert("Bitte geben Sie eine gültige (positive) Zahl ein");
	  }

  });
  $('.spinner .btn:last-of-type').on('click', function() {
	  var wert= $(this).parent().prev().val();
	  if (wert==parseInt(wert,10) && wert>=0) {
		  $(this).parent().prev().val( parseInt($(this).parent().prev().val(), 10) + -1);
	  }
	  else {
		  alert("Bitte geben Sie eine gültige (positive) Zahl ein");
	  }

  });
})(jQuery);


$('#myTab a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
});

function generateGPhotoExceptionBox(message, exitCode, output) {
	return " \
					<div class=\"alert alert-warning alert-dismissible\" role=\"alert\"> \
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button> \
            <strong>GPhotoException</strong> " + message + " \
            <br /> \
            <strong>Exit code: </strong> " + exitCode + " \
            <br /> \
            <strong>Stderr: </strong><br />" + output + " \
        </div> \
				";
}