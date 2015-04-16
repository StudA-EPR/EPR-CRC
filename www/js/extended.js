$(document).ready(function() {
    //start ajax request

    //ladeKameraInfo();
    //ladeVerschlusszeit();
    //ladeBlende();
    //ladeISO();

   ladeKameraInfo();



});

var ladeKameraInfo = (function () {
    var batterylevel;
    var manufacturer;
    var model;

    $.ajax({
        url: "/option-json.php",
        data: {descriptor: "/main/status/manufacturer"},
        method: "GET",
        dataType: "json",
    })
        .done( function(data) {
        manufacturer = data.current;
            $('#cameraInfoTable > tbody > tr').empty();
            $('#cameraInfoTable > tbody > tr').append('<td>'+ manufacturer + '</td>');

            $.ajax({
                url: "/option-json.php",
                method: "GET",
                data: {descriptor: "/main/status/cameramodel"},
                dataType: "json",
            })
                .done( function(data) {
                    model = data.current;
                    $('#cameraInfoTable > tbody > tr').append('<td>'+ model + '</td>');
                    $.ajax({
                        url: "/option-json.php",
                        data: {descriptor: "/main/status/batterylevel"},
                        method: "GET",
                        dataType: "json",
                    })
                        .done( function(data) {
                            batterylevel = data.current;
                            batterylevelNumber = batterylevel.slice(0,-1);
                            //$('#cameraInfoTable > tbody > tr').append('<td>'+ batterylevel + '</td>');
                            $('#cameraInfoTable > tbody > tr').append('<td>' +
                            '<div class=\"progress\">' +
                            '<div class=\"progress-bar\" role=\"progressbar progress-bar-success\" aria-valuenow=\"'+ batterylevelNumber +'\"'+
                            'aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width:' + batterylevel +'\">'+
                            batterylevel +
                            '</div></div></td>');
                            ladeVerschlusszeit();
                        });

                });


    });
});

// function for shutterspeed settings
var ladeVerschlusszeit = (function () {
    $.ajax({
        url: "/option-json.php",
        data: {descriptor: "/main/capturesettings/shutterspeed2"},
        method: "GET",
        dataType: "json",
        beforeSend: function () {
            $selectboxVerschluss = $('#selectVerschlusszeit');
            $selectboxVerschluss.prop('disabled', "disabled");
            $selectboxVerschluss.html('<option>lade Einstellungen</option>');
            // $('.snapshot-link img').css('opacity', '0.25');
            //$('.snapshot-link').append('<i class="fa fa-spinner fa-spin snapshot-spinner"></i>');
        }
    })
        .done(function (data) {
            if (data.error === false) {
                //data downloaded
                //now data variable contains data in json format
                var choices = data.choices;
                var current = data.current;
                $selectboxVerschluss.removeAttr('disabled');
                $selectboxVerschluss.empty();

                $.each(choices, function (key, value) {
                    if (value == current) {
                        $('#selectVerschlusszeit')
                            .append($("<option></option>")
                                .attr("value", key)
                                .prop("selected", "selected")
                                .text(value + " s"));
                    }
                    else {
                        $('#selectVerschlusszeit')
                            .append($("<option></option>")
                                .attr("value", key)
                                .text(value + " s"));
                    }
                });
            } else {
                // Error handling (show the exception):
                $('#gphoto-exception-wrapper-extended').html(" \
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


            ladeBlende();
        });
});

// Function for apperture settings
var ladeBlende = (function () {
    $.ajax({
        url: "/option-json.php",
        data: {descriptor: "/main/capturesettings/f-number"},
        method: "GET",
        dataType: "json",
        beforeSend: function () {
            $selectboxBlende = $('#selectBlende');
            $selectboxBlende.prop('disabled', "disabled");
            $selectboxBlende.html('<option>lade Einstellungen </option>');
        }
    })
        .done(function (blendedata) {

            if (blendedata.error === false) {
                //data downloaded
                //now data variable contains data in json format
                var choices = blendedata.choices;
                var current = blendedata.current;
                $selectboxBlende.removeAttr('disabled');
                $selectboxBlende.empty();
                $.each(choices, function (key, value) {
                    if (value == current) {
                        $('#selectBlende')
                            .append($("<option></option>")
                                .attr("value", key)
                                .prop("selected", "selected")
                                .text(value));
                    }
                    else {
                        $('#selectBlende')
                            .append($("<option></option>")
                                .attr("value", key)
                                .text(value));
                    }
                });
            } else {
                // Error handling (show the exception):
                $('#gphoto-exception-wrapper-extended').html(" \
					<div class=\"alert alert-warning alert-dismissible\" role=\"alert\"> \
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button> \
            <strong>GPhotoException</strong> " + blendedata.message + " \
            <br /> \
            <strong>Exit code: </strong> " + blendedata.exitCode + " \
            <br /> \
            <strong>Stderr: </strong><br />" + blendedata.output + " \
        </div> \
				");
            }


            ladeISO();
        });
});

var checkAndLoadISO = (function () {
    $.ajax({
        url: "/option-json.php",
        data: {descriptor: "/main/imgsettings/isoauto"},
        method: "GET",
        dataType: "json",
    })
        .done(function (data) {
            if (data.error === false) {
                //data downloaded
                //now data variable contains data in json form
                var isoautoState = true;
                isoautoState = isoauto.current;
            } else {
                // Error handling (show the exception):
                $('#gphoto-exception-wrapper-extended').html(" \
					<div class=\"alert alert-warning alert-dismissible\" role=\"alert\"> \
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button> \
            <strong>GPhotoException</strong> " + blendedata.message + " \
            <br /> \
            <strong>Exit code: </strong> " + blendedata.exitCode + " \
            <br /> \
            <strong>Stderr: </strong><br />" + blendedata.output + " \
        </div> \
				");
            }


            ladeISO(isoautoState);
        });
});

// Fucntion for ISO Values
//FOR ISO, we first need to check whether autoiso is activated or not. This is done by the checkAndLoadISO function
var ladeISO = (function (autoState) {
    $.ajax({
        url: "/option-json.php",
        data: {descriptor: "/main/imgsettings/iso"},
        method: "GET",
        dataType: "json",
        beforeSend: function () {
            $selectboxISO = $('#selectISO');
            $selectboxISO.prop('disabled', "disabled");
            $selectboxISO.html('<option>lade Einstellungen </option>');
        }
    })
        .done(function (data) {

            if (data.error === false) {
                //data downloaded
                //now data variable contains data in json format
                var choices = data.choices;
                var current = data.current;
                if (autoState== "On") //check whether iso automatic is activated or not
                {
                    $('#isoinfo').text("Auswahl nicht mglich, da ISO-Automatik aktiviert");
                }
                else {
                    $selectboxISO.removeAttr('disabled');
                }
                $selectboxISO.empty();
                $.each(choices, function (key, value) {
                    if (value == current) {
                        $('#selectISO')
                            .append($("<option></option>")
                                .attr("value", key)
                                .prop("selected", "selected")
                                .text(value));
                    }
                    else {
                        $('#selectISO')
                            .append($("<option></option>")
                                .attr("value", key)
                                .text(value));
                    }
                });
            } else {
                // Error handling (show the exception):
                $('#gphoto-exception-wrapper-extended').html(" \
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
        });
});

