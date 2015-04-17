<?php

/**
 * Class IOUtils
 *
 * This class contains generic helper methods for filesystem related tasks.
 */
class IOUtils {
    /**
     * Get the newest image file of a given directory.
     * The image files must have a timestamp in their filenames.
     *
     * @param $dir the directory
     * @return null the image filename or null in case no one exists
     */
    public static function getNewestPhotoFile($dir) {
        $files = glob($dir . '/*.jpg');

        $filesSize = count($files);
        if ($filesSize > 0) {
            return $files[$filesSize - 1];
        }

        return null;
    }
}