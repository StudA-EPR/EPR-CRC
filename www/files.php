<?php

require_once 'classes/filemanager.php';
require_once 'classes/httpparameters.php';

//
// Config stuff:
//

date_default_timezone_set('UTC');
$errors     = '';
$title      = 'Dateimanager';
$active_tab = 'filemanager';

$params     = new HttpParameters();


//
// Analyze GET/POST parameters:
//

$location      = $params->get('location', 'GET');
$fileSizeUnit  = $params->get('sizeunit', 'GET');

// Initialize with defaults if no params were transmitted.
if ($location === null)     $location = '/www';
if ($fileSizeUnit === null) $fileSizeUnit = 'k';


$filemanager = null;
try {
    $filemanager = new FileManager($location);
} catch (FileManagerException $e) {
    $errors += $e->getMessage() . PHP_EOL;
}


//
// Perform any actions like deleting or renaming files:
//

if ($params->has('action', 'GET')) {
    try {
        $action      = $params->get('action', 'GET');
        $actionFile  = $params->get('file', 'GET');

        switch ($action) {
            case 'rm':
                $filemanager->delete($actionFile);
                break;
            case 'mv':
                $actionFileNew = $params->get('newFile', 'GET');
                $filemanager->rename($actionFile, $actionFileNew);
                break;
            default:
                $errors += 'Unknown action ' . $actionName . '.' . PHP_EOL;
                break;
        }

    } catch (FileManagerException $e) {
        $errors += $e->getMessage() . PHP_EOL;
    }
}
?>

<?php include 'header.php'; ?>

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
    echo '<thead><tr><th class="filename-column">Dateiname</th><th>Dateigröße&nbsp;<span class="label label-default">' . strtoupper($fileSizeUnit . 'b') . '</span></th><th>Modifikationsdatum</th><th></th></tr></thead>' . PHP_EOL;
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
            echo '<td><div class="btn-group btn-group-xs mv-rm-btn-group">' . PHP_EOL;
            echo '<button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#rename-modal" data-filename="' . $file . '">Umbenennen</button>';
            echo '<a href="files.php?file=' . $file . '&action=rm" class="btn btn-danger btn-xs" onclick="javascript:deleteFileConfirm(\'' . $file . '\')"><i class="fa fa-trash"></i> Löschen</a>' . PHP_EOL;
            echo '</div></td>' . PHP_EOL;
        } else {
            echo '<td></td>' . PHP_EOL;
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

<?php include 'footer.php'; ?>