<?php

require 'classes/filemanager.php';

// TODO: Refactor a lot!

//
// Config stuff:
//

$filemanager = null;

date_default_timezone_set('UTC');

$fileSizeUnit = 'k';    // kilo byte
$location = '/www';

$errors = '';


//
// Analyze GET/POST parameters:
//

// Directory to show.
if (array_key_exists('location', $_GET)) {
    $location = $_GET['location'];
}

// Unit of the file size numbers.
if (array_key_exists('sizeunit', $_GET)) {
    $fileSizeUnit = $_GET['sizeunit'];
}

// Actions: Delete (rm) or Rename (mv).
if (array_key_exists('file', $_GET) && array_key_exists('action', $_GET)) {
    $actionFile = $_GET['file'];
    $actionName = $_GET['action'];

    // action = rename, needs an additional parameter, the new name.
    if ($actionName == 'mv') {
        if (array_key_exists('newFile', $_GET)) {
            $actionFileNew = $_GET['newFile'];
        }
    }
}


//
// Perform any actions like deleting or renaming files:
//

try {
    $filemanager = new FileManager($location);

    switch ($actionName) {
        case 'rm':
            $filemanager->delete($actionFile);
            break;
        case 'mv':
            $filemanager->rename($actionFile, $actionFileNew);
            break;
        default:
            $errors += 'Unknown action ' . $actionName . '.' . PHP_EOL;
            break;
    }

} catch(FileManagerException $e) {
    echo $e->getMessage() . PHP_EOL;
}

?>

<!DOCTYPE html>
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <title>Dateimanager</title>
    </head>
    <body>

        <div class="container">

<?php

//
// Build the UI:
//

// Error messages in box:
if (! empty($errors)) {
    echo '<div class="alert alert-danger alert-dismissible" role="alert">' . PHP_EOL;
    echo $errors . PHP_EOL;
    echo '</div>' . PHP_EOL;
}


try {
    echo '<h1>' . $filemanager->getDir() . '/</h1>' . PHP_EOL;

    // Table stuff:
    echo '<table class="table table-striped">' . PHP_EOL;
    echo '<thead><tr><th>Dateiname</th><th>Dateigröße <span class="label label-default">' . strtoupper($fileSizeUnit . 'b') . '</span></th><th>Modifikationsdatum</th><th></th><th></th></tr></thead>' . PHP_EOL;
    echo '<tbody>' . PHP_EOL;

    // Children files:
    $files = $filemanager->getFileList();
    foreach ($files as &$file) {
        echo '<tr>' . PHP_EOL;

        echo '<td>';
        if ($filemanager->isDir($file)) {
            echo '<i class="fa fa-folder-open"></i> <a href="/files.php?location=' . $filemanager->getHostRelativePath($file) . '">'. $file . '</a>/';
        } else if ($filemanager->isImg($file)) {
            echo '<i class="fa fa-file-image-o"></i> <a href="/' . FileManager::resolvePath($filemanager->getAbsolutePath($file)) . '">' . $file . '</a>';
        } else {
            echo $file;
        }
        echo '</td>' . PHP_EOL;
        echo '<td>' . $filemanager->getSizeAsString($file, $fileSizeUnit) . '</td>' . PHP_EOL;
        echo '<td>' . $filemanager->getModDate($file, 'Y-m-d H:i:s') . '</td>' . PHP_EOL;

        if (! $filemanager->isDir($file)) {
            echo '<td><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#rename-modal" data-filename="' . $file . '">Umbenennen</button></td>' . PHP_EOL;
            echo '<td><a href="files.php?file=' . $file . '&action=rm" class="btn btn-danger btn-xs" onclick="javascript:deleteFileConfirm(\'' . $file . '\')"><i class="fa fa-trash"></i> Löschen</a></td>' . PHP_EOL;
        } else {
            echo '<td></td><td></td>' . PHP_EOL;
        }

        echo '</tr>' . PHP_EOL;
    }

    echo '</tbody>' . PHP_EOL;

} catch (FileManagerException $e) {
    echo $e->getMessage() . PHP_EOL;
}

?>
        </div>

        <!-- The rename modal. -->
        <div class="modal fade" id="rename-modal" tabindex="-1" role="dialog" aria-labelledby="rename-modal-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="rename-modal-label">Umbenennen</h4>
                    </div>
                    <form method="GET" action="/files.php">
                    <div class="modal-body">
                            <input type="hidden" name="action" value="mv" />
                            <div class="form-group">
                                <label for="old-filename" class="control-label">Aktueller Dateiname:</label>
                                <input type="text" name="file" class="form-control" id="old-filename" readonly>
                            </div>
                            <div class="form-group">
                                <label for="new-filename" class="control-label">Neuer Dateiname:</label>
                                <input type="text" name="newFile" class="form-control" id="new-filename">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
                        <button type="submit" class="btn btn-primary">Datei umbenennen</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/epr-crc.js"></script>
    </body>
</html>