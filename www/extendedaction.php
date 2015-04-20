<?php
    foreach ($_POST as $key => $value)
    echo $key.'='.$value.'<br />';


    // Setting-Parameter:
    $blendeIndex = $_POST["blende"];
    $requestString = "/main/capturesettings/f-number"; //add blendeIndex or text-value
    echo "get request to set the settings is commented in source code";
    $response ="noch kein request ausgeführt<br>";
    //$response = http_get("/change-options.php?descriptor=%2Fmain%2Fcapturesettings%2Fflashmode&value=Automatic%20Flash");
    echo $response;

?>

