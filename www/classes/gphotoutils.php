<?php

require_once 'gphotoexception.php';
require_once 'htmlutils.php';

/**
 * Class GPhotoUtils
 *
 * Utility class for GPhoto related stuff.
 */
class GPhotoUtils {
    /**
     * Generates pretty HTML markup out of a GPhotoException.
     *
     * @param GPhotoException $exception the exception
     */
    public static function formatGPhotoException(GPhotoException $exception) {
        $message  = $exception->getMessage();
        $exitCode = $exception->getExitCode();
        $output   = HTMLUtils::convertNewlines($exception->getOutput());

        return " \
        <div class=\"alert alert-warning alert-dismissible\" role=\"alert\"> \
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button> \
            <strong>GPhotoException</strong> $message \
            <br /> \
            <strong>Exit code: </strong> $exitCode \
            <br /> \
            <strong>Stderr: </strong><br />$output \
        </div>";
    }
}