<?php

require_once 'classes/option.php';
require_once 'classes/httpparameters.php';
require_once 'classes/gphotoutils.php';

$params           = new HTTPParameters();
$optionDescriptor = $params->get('descriptor', 'GET');

try {
    $option            = new Option($optionDescriptor);
    $response          = $option->toArray();
    $response['error'] = false;
} catch (GPhotoException $e) {
    $response = GPhotoUtils::toArray($e);
}

header('Content-Type: application/json');
$json = json_encode($response);

if ($json === false) {
    // Error
    echo '{}';
} else {
    echo $json;
}