<?php

/**
 * Class HTMLUtils
 *
 * This class contains some helpful static methods to generate HTML markup
 * out of various input strings.
 */
class HTMLUtils {
    /**
     * Converts UNIX newlines to HTML linebreak tags.
     *
     * @param $string the input
     * @return mixed the output
     */
    public static function convertNewlines($string) {
        return preg_replace('/\n/', '<br />', $string);
    }
}