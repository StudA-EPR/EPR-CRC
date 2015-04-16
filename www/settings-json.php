<?php

require_once 'classes/settings.php';
require_once 'classes/gphotoutils.php';

try {
    $settings = new Settings();
    $settingsArray = $settings->toArray();
    $response = array('error' => false, 'settings:' => $settingsArray);
} catch (GPhotoException $e) {
    $response = GPhotoUtils::toArray($e);
} // finally clause not available in PHP<=5.4 (OpenWrt version: 5.4)


//
// Print the response:
//

header('Content-Type: application/json');
$json = json_encode($response);

if ($json === false) {
    // Error
    echo '{}';
} else {
    echo $json;
}