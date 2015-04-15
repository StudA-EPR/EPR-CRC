<?php

require_once 'classes/option.php';
require_once 'classes/httpparameters.php';

$params           = new HTTPParameters();
$optionDescriptor = $params->get('descriptor', 'GET');

try {
    $option            = new Option($optionDescriptor);
    $response          = $option->toArray();
    $response['error'] = false;
} catch (GPhotoException $e) {
    $response = array('error' => true, 'message' => $e->getMessage(), 'exitCode' => $e->getExitCode(), 'output' => $e->getOutput());
}

header('Content-Type: application/json');
$json = json_encode($response);

if ($json === false) {
    // Error
    echo '{}';
} else {
    echo $json;
}