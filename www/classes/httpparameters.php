<?php

/**
 * Class HTTPParameters
 *
 * A small wrapper class for the $_GET/$_POST arrays that provides some collection like methods
 * for improved code readability.
 */
class HTTPParameters {
    protected $getParams;
    protected $postParams;

    /**
     * Initialize with the GET and POST environment variables.
     */
    public function __construct() {
        $this->getParams  = $_GET;
        $this->postParams = $_POST;
    }

    /**
     * Collection like has method that checks whether a parameter key value pair exists.
     *
     * @param $key the key of the key value pair to check
     * @param $method GET or POST
     * @return bool true if a value for the key exists, otherwise false
     */
    public function has($key, $method) {
        $params = $this->getArrayByMethod($method);

        if ($params == null) {
            return false;
        }

        return isset($params[$key]);
    }

    /**
     * Collection like get method that gets the value for a given key.
     *
     * @param $key the key
     * @param $method GET or POST
     * @return null the value. null if no value for the given key exists
     */
    public function get($key, $method) {
        if ($this->has($key, $method)) {
            return $this->getArrayByMethod($method)[$key];
        }

        return null;
    }

    /**
     * Collection like size method that gets the size of a key value store.
     *
     * @param $method GET or POST
     * @return int the size
     */
    public function size($method) {
        return count($this->getArrayByMethod($method));
    }

    protected function getArrayByMethod($method) {
        if ($method === 'GET' || $method === 'get') {
            return $this->getParams;
        } elseif ($method === 'POST' || $method === 'post') {
            return $this->postParams;
        }

        return null;
    }
}