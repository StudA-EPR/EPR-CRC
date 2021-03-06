<?php

//
// Config stuff:
//

require_once 'classes/httpparameters.php';
require_once 'classes/gphoto.php';
require_once 'classes/gphotoutils.php';

date_default_timezone_set('UTC');

$params = new HTTPParameters();

//
// Analyze GET parameters:
//

$preview = $params->get('preview', 'GET');

$filename    = null;
$errorMarkup = null;
$response    = null;

try {
    $filename = GPhoto::captureImage();
    $response = array('filename' => $filename, 'error' => false);
} catch (GPhotoException $e) {
    //$errorMarkup = GPhotoUtils::formatGPhotoException($e);
    $response = GPhotoUtils::toArray($e);
}

//
// Printing the HTTP response:
//

header('Content-Type: application/json');
$json = json_encode($response);

if ($json === false) {
    echo 'JSON Encoding Error!';
} else {
    echo $json;
}
