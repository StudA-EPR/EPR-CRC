<?php

require_once 'filemanagerexception.php';

/**
 * Class FileManager
 *
 * This class provides basic functionality for a Filemanager.
 */
class FileManager {
    protected $dir;

    /**
     * @param $dir the directory without an appending slash
     * @throws FileManagerException $dir is not a directory
     */
    public function __construct($dir) {
        $fileInfo = new SplFileInfo($dir);
        if (! $fileInfo->isDir()) {
            throw new FileManagerException($dir . ' is not a directory.');
        }

        $this->dir = $dir;
    }

    /**
     * Get the working directory of this filemanager.
     *
     * @return string working directory
     */
    public function getDir() {
        return $this->dir;
    }

    /**
     * Delete a file.
     *
     * @param $filename the filename of the file to delete
     */
    public function delete($filename) {
        $filePath = $this->buildFilenameWithPath($filename);

        if (false == unlink($filePath)) {
            throw new FileManagerException('Deleting ' . $filename . ' failed.');
        }
    }

    /**
     * Rename a file.
     *
     * @param $oldFilename the filename of the file to rename
     * @param $newFilename the new name of the file
     */
    public function rename($oldFilename, $newFilename) {
        $filePath = $this->buildFilenameWithPath($oldFilename);
        $newFilePath = $this->buildFilenameWithPath($newFilename);

        if (false == rename($filePath, $newFilePath)) {
            throw new FileManagerException('Renaming ' . $oldFilename . ' to ' . $newFilename . ' failed.');
        }
    }

    /**
     * Get the host relative path to the file. Use this method to construct an URL
     * for referencing files in HTML pages.
     *
     * @param $filename the filename of the file under the path
     */
    public function getHostRelativePath($filename) {
        return $this->buildFilenameWithPath($filename);
    }

    /**
     * Get the size of a file.
     *
     * @param $filename name of the file
     * @return int file size in bytes
     */
    public function getSize($filename) {
        $fileInfo = new SplFileInfo($filename);
        return $fileInfo->getSize();
    }

    /**
     * Get the size of a file in a human readable format.
     *
     * @param $filename name of the file
     * @param string $unit unit of the file size
     * @return string the file size in a human readable format
     * @throws FileManagerException unknown unit identifier
     */
    public function getSizeAsString($filename, $unit = 'm') {
        $size = $this->getSize($filename);

        switch ($unit) {
            case 'k':
                return ($size / 1000) . ' KB';
            case 'm':
                return ($size / 1000000) . ' MB';
            default:
                throw new FileManagerException("Unknown unit identifier " . $unit . ".");
        }
    }

    /**
     * Get the modification date of a file.
     *
     * @param $filename the name of the file
     * @param $format the format of the date (see PHPs date function)
     * @return bool|string the modification date
     */
    public function getModDate($filename, $format) {
        $fileInfo = new SplFileInfo($filename);
        $timestamp = $fileInfo->getMTime();
        return date($format, $timestamp);
    }

    /**
     * Checks whether the file is a directory.
     *
     * @param $filename the name of the file
     * @return bool true if it is a directory, otherwise false
     */
    public function isDir($filename) {
        $fileInfo = new SplFileInfo($filename);
        return $fileInfo->isDir();
    }

    /**
     * Get the files of the working directory.
     *
     * @return array the files
     * @throws FileManagerException getting the files failed
     */
    public function getFileList() {
        $files = scandir($this->dir);

        if ($files == false) {
            throw new FileManagerException("Couldn't get the files of " . $this->dir . ".");
        }

        return $files;
    }

    // Private/Protected methods:

    protected function buildFilenameWithPath($filename) {
        return $this->dir . '/' . $filename;
    }

}