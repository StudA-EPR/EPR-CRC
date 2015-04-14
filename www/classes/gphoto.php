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
     * This uses the --list-config switch of gphoto.
     *
     * @return array the configuration
     */
    public static function listConfig() {
        $eval = self::$bin . ' --list-config';
        $configList = self::execute($eval);
        return $configList;
    }

    /**
     * Get information about the camera storage.
     * This uses the --storage-info switch of gphoto.
     *
     * @return array the storage info
     */
    public static function storageInfo() {
        $eval = self::$bin . ' --storage-info';
        $storageInfo = self::execute($eval);
        return $storageInfo;
    }

    /**
     * Get the abilities of the connected camera.
     * This uses the --abilities switch of gphoto.
     *
     * @return mixed
     */
    public static function listAbilities() {
        $eval = self::$bin . ' --abilities';
        $abilities = self::execute($eval);
        return $abilities;
    }

    /**
     * Get the configuration details for a specific configuration descriptor.
     * This uses the --get-config switch of gphoto.
     *
     * @param $configDescriptor the descriptor
     * @return mixed the configuration details
     */
    public static function getConfig($configDescriptor) {
        $eval = self::$bin . " --get-config $configDescriptor";
        $config = self::execute($eval);
        return $config;
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

        return $output;
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