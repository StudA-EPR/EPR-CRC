<?php

/**
 * Class GPhotoException
 */
class GPhotoException extends Exception {
    protected $exitCode;
    protected $output;

    /**
     * Constructor.
     *
     * @param string $message the message
     * @param null $exitCode the exit code of the gphoto call
     * @param null $output the text output of the gphoto call
     * @param int $code the exception code
     * @param Exception $previous the previous exception
     */
    public function __construct($message, $exitCode = null, $output = null, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);

        if ($exitCode !== null) {
            $this->exitCode = $exitCode;
        } else {
            $this->exitCode = 0;
        }

        if ($output !== null) {
            $this->output = $output;
        } else {
            $this->output = '';
        }
    }

    /**
     * Get the exit code of the gphoto call.
     *
     * @return int the exit code
     */
    public function getExitCode() {
        return $this->exitCode;
    }

    /**
     * The output of the gphoto call.
     *
     * @return string the output
     */
    public function getOutput() {
        return $this->output;
    }
}