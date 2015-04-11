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

    /**
     * @return string HTML newline tag
     */
    public static function newline() {
        return '<br />';
    }

    /**
     * Adds escape sequences to double quotes using a backslash.
     *
     * @param $string the input
     * @return mixed the output
     */
    public static function escapeDoubleQuotes($string) {
        return preg_replace('"', '\\"', $string);
    }
}