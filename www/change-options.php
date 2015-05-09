<?php

require_once 'classes/httpparameters.php';
require_once 'classes/option.php';
require_once 'classes/gphotoutils.php';

$params   = new HTTPParameters();
$response = array('error' => false);
$changes  = 0;

try {
    $options = $params->getArrayByMethod('POST');

    // Iterate over the given identifier value pairs and try to save them.
    foreach ($options as $identifier => $value) {
        $option = new Option($identifier);
        $value = intval($value);
        // Only set the current value if there is an actual change.
        if ($option->getCurrentIndex() != $value) {
            $option->setCurrent($value);
            GPhoto::setConfig($option);
            $changes++;
        }
    }

    $response['changes'] = $changes;
} catch(GPhotoException $e) {
    $response = array('error' => true);
}

header('Content-Type: application/json');
$json = json_encode($response);

if ($json === false) {
    echo '{}';
} else {
    echo $json;
}