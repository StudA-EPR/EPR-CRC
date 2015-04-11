// Asynchronous request to take a snapshot.
$(document).ready( function () {
	$('#auto-ausloesen').click( function () {
		$.ajax({
			url: "/snapshot.php",
			method: "GET",
			dataType: "json",
			beforeSend: function () {
				$btn = $('#auto-ausloesen');
				$btn.prop('disabled', true);
				$btn.html('<i class="fa fa-spinner fa-spin"></i> Auslösen und herunterladen ...');
				$('.snapshot-link img').css('opacity', '0.25');
				$('.snapshot-link').append('<i class="fa fa-spinner fa-spin snapshot-spinner"></i>');
			}
		})
		.done( function (data) {
			$btn = $('#auto-ausloesen');
			if (data.error === false) {
				// Unlock the snapshot button and insert the snapshot into the page:
				$('#preview').attr('src', data.filename);
				$('#gphoto-exception-wrapper').html('');
			} else {
				// Error handling (show the exception):
				$('#gphoto-exception-wrapper').html(" \
					<div class=\"alert alert-warning alert-dismissible\" role=\"alert\"> \
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button> \
            <strong>GPhotoException</strong> " + data.message + " \
            <br /> \
            <strong>Exit code: </strong> " + data.exitCode + " \
            <br /> \
            <strong>Stderr: </strong><br />" + data.output + " \
        </div> \
				");
			}
			
			$btn.html('<i class="fa fa-camera"></i> Foto aufnehmen');
			$btn.prop('disabled', false);
			$('.snapshot-spinner').remove();
			$('.snapshot-link img').css('opacity', '1.0');
		});
	});
});