var identifiers = [];
var settingsLoaded = false;

/**
 * Displays a Bootstrap styled alert box with the GPhotoException details.
 *
 * @param message the exception message
 * @param exitCode the exit code of gphoto
 * @param output the stderr output of gphoto
 */
function displayException(message, exitCode, output) {
    $('#gphoto-exception-wrapper-extended').append(generateGPhotoExceptionBox(message, exitCode, output));
}

/**
 * Dispays a progress info message.
 *
 * @param string the message to display
 */
function displayProgress(string) {
    $('#progress-info').html(string);
}

/**
 * Displays an animation with a spinner at the cam settings tab.
 */
function displaySpinnerAtTab() {
    $('#tab-cam-settings').append(' <i id="cam-settings-tab-spinner" class="fa fa-spinner fa-spin"></i>');
}

/**
 * Displays the number of configuration options in the cam settings tab.
 *
 * @param number the number of configuration options
 */
function displayNumberOfOptionsInTab(number) {
    $('#cam-settings-tab-spinner').remove();
    $('#tab-cam-settings').append('<span class="badge">' + number + '</span>');
}

/**
 * Disables the submit button.
 */
function disableSubmitButton() {
    $('#submit-settings').prop('disabled', true);
}

/**
 * Enables the submit button.
 */
function enableSubmitButton() {
    $('#submit-settings').prop('disabled', false);
}

/**
 * Builds an input field for a checkbox.
 *
 * @param identifier the identifier
 * @param current the current value
 * @returns {string} the markup
 */
function buildCheckboxField(identifier, current) {
    if (current == 1) {
        return '<input type="checkbox" name="' + identifier + '" value="1" checked>';
    }

    return '<input type="checkbox" name="' + identifier + '" value="1">';
}

/**
 * Builds a select field for an option of type RADIO.
 *
 * @param identifier the identifier (is used for the name attribute)
 * @param choices the choices
 * @param current the choice currently active (will be selected by default)
 * @returns {string} the generated markup
 */
function buildSelectField(identifier, choices, current) {
    var markup = '<select class="form-control" id="' + identifier + '" name="' + identifier + '">';

    for (var i in choices) {
        var choice            = choices[i];
        var choiceIndexNumber = choice[0];
        var choiceText        = choice[1];

        if (choiceText === current) {
            markup += '<option value="' + choiceIndexNumber + '" selected>' + choiceText + '<option>';
        } else {
            markup += '<option value="' + choiceIndexNumber + '">' + choiceText + '<option>';
        }
    }

    markup += '</select>';

    return markup;
}

/**
 * Formats a value.
 *
 * @param current the current value
 * @returns {*} the formated value
 */
function formatCurrent(current) {
    if (current == '') {
        return '<i>Kein Wert</i>';
    }

    return current;
}

/**
 * Builds the form elements for an optionl
 *
 * @param identifier the identifier
 * @param label the label
 * @param type the type
 * @param current the choice currently active
 * @param choices the choices
 */
function buildUIElementsForOption(identifier, label, type, current, choices) {
    var inputField = '';
    switch (type) {
        case 'TEXT':
            inputField = formatCurrent(current);
            break;
        case 'RADIO':
            inputField = buildSelectField(identifier, choices, current);
            break;
        case 'TOGGLE':
            inputField = buildCheckboxField(identifier, current);
            break;
        case 'RANGE':
            inputField = formatCurrent(current);
            break;
        case 'MENU':
            inputField = formatCurrent(current);
            break;
        case 'DATE':
            inputField = formatCurrent(current);
            break;
        default:
            inputField = 'Unbekannter Optionstyp: ' + type;
            break;
    }

    var $container = $('#settings-box');
    $container.append(
        '<div class="form-group">' +
            '<label class="col-md-4 control-label" for="appendedtext">' + label + '</label>' +
            '<div class="col-md-4">' +
                inputField +
            '</div>' +
        '</div>'
    );
}

/**
 * Loads a single option.
 *
 * @param identifier the identifier
 */
function loadOption(identifier, index) {
    $.ajax({
        url: '/option-json.php',
        method: 'GET',
        dataType: 'json',
        data: {
            'descriptor': identifier
        },
        beforeSend: function() {
            displayProgress('Lade Konfigurationsoption ' + index + ' von ' + identifiers.length + '.');
        }
    }).done(function(data) {
        if (data.error == false) {
            console.log(identifier)
            buildUIElementsForOption(data.option, data.label, data.type, data.current, data.choices);
        } else {
            // Fehlernachricht anzeigen.
            displayException(data.message, data.exitCode, data.output);
        }

        // Load the next option:
        var newIndex = index + 1;
        if (newIndex < identifiers.length) {
            loadOption(identifiers[newIndex], newIndex);
        } else {
            displayProgress('');
            displayNumberOfOptionsInTab(identifiers.length);
            enableSubmitButton();
        }
    });
}

/**
 * Loads the list with identifiers for the options.
 */
function loadIdentifieres() {
    $.ajax({
        url: '/list-config-json.php',
        method: 'GET',
        dataType: 'json',
        beforeSend: function() {
            displayProgress('Lade verfügbare Konfigurationsoptionen ...');
            displaySpinnerAtTab();
        }
    }).done(function(data) {
        console.log('identifiers response received');
        if (data.error == false) {
            identifiers = data.identifiers;
        } else {
            // Fehlernachricht anzeigen.
            displayException(data.message, data.exitCode, data.output);
        }

        // Now start loading the first option.
        if (identifiers.length > 0) {
            loadOption(identifiers[0], 0);
        } else {
            displayProgress('Keine Konfigurationsoptionen verfügbar.');
            displayNumberOfOptionsInTab(0);
        }
    });
}

// Do all the stuff.
$(document).ready(function() {
    $('#tab-cam-settings').on('shown.bs.tab', function() {
        if (settingsLoaded == false) {
            disableSubmitButton();
            settingsLoaded = true;
            loadIdentifieres();
        }
    })
});