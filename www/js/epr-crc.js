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

	//reload preview image onClick
$('#previewDIV a').click(function(){
	d = new Date();
	$("#preview").attr("src", "/photos/preview.jpg?timestamp="+d.getTime());
});
//call function -> in this case we need a script which returns the console output
$('#auto-ausloesen').click(function(){
	$("#output").load('control.php?option=ausloesen');
	});

function showStatus(){	
	//$('#statusDropDown').load('status.php #stausDDcontent');
	$('#statusDropDown').load('status.php?option=spaceinfo').html();
	//$('#statusDropDown').html($('#statusDDcontent').html());
}	

function callSystemFunction(cmd) {
	$.get( "/systemfunctions.php", { command: cmd} );
    return false;
}

// style spinner buttons in input fields
(function ($) {
  $('.spinner .btn:first-of-type').on('click', function() {
    $('.spinner input').val( parseInt($('.spinner input').val(), 10) + 1);
  });
  $('.spinner .btn:last-of-type').on('click', function() {
    $('.spinner input').val( parseInt($('.spinner input').val(), 10) - 1);
  });
})(jQuery);