<?php

require_once 'classes/httpparameters.php';
require_once 'classes/option.php';
require_once 'classes/gphotoutils.php';

$params     = new HTTPParameters();
$descriptor = $params->get('descriptor', 'GET');
$value      = $params->get('value', 'GET');

try {
    $option = new Option($descriptor);
    $option->setCurrent($value);
    GPhoto::setConfig($option);
    $response = array('error' => false);
} catch (GPhotoException $e) {
    $response = GPhotoUtils::toArray($e);
}

header('Content-Type: application/json');
$json = json_encode($response);

if ($json === false) {
    // Error:
    echo '{}';
} else {
    echo $json;
}
