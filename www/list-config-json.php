<?php

require_once 'classes/gphoto.php';
require_once 'classes/gphotoutils.php';

try {
    $response = array();
    $response['identifiers'] = GPhoto::listConfig();
    $response['error']       = false;
} catch (GPhotoException $e) {
    $response = GPhotoUtils::toArray($e);
}

header('Content-Type: application/json');
$json = json_encode($response);

if ($json === false) {
    echo '{}';
} else {
    echo $json;
}