<?php

require_once 'classes/httpparameters.php';
require_once 'classes/option.php';

$params   = new HTTPParameters();
$redirect = '/extended.php';

if ($params->has('descriptor', 'GET')) {
    $descriptor = $params->get('descriptor', 'GET');
} else {
    // Redirect to settings page.
    header("Location: $redirect?status=error&msg=No%20Descriptor");
    die();
}


$value  = $params->get('value', 'GET');
$option = new Option($descriptor);
$option->setCurrent($value);

try {
    GPhoto::setConfig($option);
    $redirect .= '?status=success';
} catch (GPhotoException $e) {
    $redirect .= '?status=error&msg=exception';
}

// Redirect to settings page.
header("Location: $redirect");
die();
