<?php

/**
 * Class FileManagerException
 *
 * An Exception type for any Exceptions related to the FileManager.
 */
class FileManagerException extends Exception {
    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}