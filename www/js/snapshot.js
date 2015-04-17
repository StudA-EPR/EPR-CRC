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
				var alertBox = generateGPhotoExceptionBox(data.message, data.exitCode, data.output);
				$('#gphoto-exception-wrapper').html(alertBox);
			}
			
			$btn.html('<i class="fa fa-camera"></i> Foto aufnehmen');
			$btn.prop('disabled', false);
			$('.snapshot-spinner').remove();
			$('.snapshot-link img').css('opacity', '1.0');
		});
	});
});