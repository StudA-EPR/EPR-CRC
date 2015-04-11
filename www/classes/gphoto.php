<?php

require_once 'gphotoexception.php';

/**
 * Class GPhoto
 *
 * An object oriented wrapper API for gphoto.
 */
class GPhoto {
    public    static $photosDir        = 'photos/';
    protected static $bin              = 'gphoto2';
    protected static $timestampFormat  = 'Y-m-d_H:i:s';

    /**
     * Capture an image and download it onto the host system.
     *
     * @return string the filename of the captured image
     */
    public static function captureImage() {
        $filename = self::constructFilename();
        $eval = self::$bin . " --capture-image-and-download --filename \"$filename\"";
        self::execute($eval);
        return $filename;
    }

    // TODO: just like self::captureImage but with a copy resized using imagemagick
    public static function captureImageAndPreview() {
        throw new Exception("Not implemented yet: captureImageAndPreview()");
    }

    // TODO: Implement me!
    public static function captureImagesInInterval($size, $delay) {
        throw new Exception("Not implemented yet: captureImagesInInterval(size, delay)");
    }

    /**
     * Get the configuration of gphoto.
     *
     * @return string the configuration
     */
    public static function listConfig() {
        $eval = self::$bin . ' --list-config';
        $output = self::execute($eval);
        return $output;
    }

    /**
     * Get information about the camera storage.
     *
     * @return string the storage info
     */
    public static function storageInfo() {
        $eval = self::$bin . ' --storage-info';
        $output = self::execute($eval);
        return $output;
    }


    // protected/private methods

    /**
     * Executes an external program.
     *
     * @param $eval the string to evaluate for execution
     * @return mixed the output of the executed program
     * @throws GPhotoException the program exited with a non-zero status
     */
    protected static function execute($eval) {
        exec($eval, $output, $exitCode);

        if ($exitCode !== 0) {
            throw new GPhotoException("The execution of `$eval` failed.", $exitCode, self::arrayToString($output));
        }

        return self::arrayToString($output);
    }

    /**
     * Helper method that appends all elements of an array to a string.
     *
     * @param array $array the array
     * @return string the string
     */
    protected static function arrayToString(array $array) {
        $string = '';

        foreach ($array as &$line) {
            $string .= $line . PHP_EOL;
        }

        return $string;
    }

    /**
     * Construct a filename that contains a timestamp.
     *
     * @return string the filename
     */
    protected static function constructFilename() {
        return self::$photosDir . 'image_' . date(self::$timestampFormat) . '.jpg';
    }
}