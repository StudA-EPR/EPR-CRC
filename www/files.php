<?php

require 'classes/filemanager.php';

// TODO: Refactor a lot!

//
// Config stuff:
//

date_default_timezone_set('UTC');

$fileSizeUnit = 'k';    // kilo byte

//
// Analyze GET/POST parameters:
//

// TODO


//
// Print header.
//
// TODO: Outsource into template!
//

echo '<!DOCTYPE html>' . PHP_EOL;
echo '<html>' . PHP_EOL;
echo '<head>' . PHP_EOL;
echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">' . PHP_EOL;
echo '<link rel="stylesheet" href="css/bootstrap.min.css">' . PHP_EOL;
echo '<link rel="stylesheet" href="css/font-awesome.min.css">' . PHP_EOL;
echo '<title>Dateimanager</title>' . PHP_EOL;
echo '</head>' . PHP_EOL;
echo '<body>' . PHP_EOL;

//
// Build the UI:
//

try {
    $filemanager = new FileManager('/www');

    echo '<h1>' . $filemanager->getDir() . '/</h1>' . PHP_EOL;

    // Table stuff:
    echo '<table class="table table-striped">' . PHP_EOL;
    echo '<thead><tr><th>Dateiname</th><th>Dateigröße <span class="label label-default">' . strtoupper($fileSizeUnit . 'b') . '</span></th><th>Modifikationsdatum</th></tr></thead>' . PHP_EOL;
    echo '<tbody>' . PHP_EOL;

    // Children files:
    $files = $filemanager->getFileList();
    foreach ($files as &$file) {
        echo '<tr>' . PHP_EOL;

        echo '<td>';
        if ($filemanager->isDir($file)) {
            echo '<i class="fa fa-folder-open"></i> <a href="/files.php?location=' . $file . '">'. $file . '</a>/';
        } else {
            echo $file;
        }
        echo '</td>' . PHP_EOL;
        echo '<td>' . $filemanager->getSizeAsString($file, $fileSizeUnit) . '</td>' . PHP_EOL;
        echo '<td>' . $filemanager->getModDate($file, 'Y-m-d H:i:s') . '</td>' . PHP_EOL;

        echo '</tr>' . PHP_EOL;
    }

    echo '</tbody>' . PHP_EOL;

} catch (FileManagerException $e) {
    echo $e->getMessage() . PHP_EOL;
}


//
// Print footer.
//
// TODO: Outsource into template!
//

echo '<script src="js/jquery.min.js"></script>' . PHP_EOL;
echo '<script src="js/bootstrap.min.js"></script>' . PHP_EOL;
echo '</body>' . PHP_EOL;
echo '</html>' . PHP_EOL;