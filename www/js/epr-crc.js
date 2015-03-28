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