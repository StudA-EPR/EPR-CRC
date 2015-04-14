<?php

require_once 'option.php';
require_once 'gphoto.php';

/**
 * Class Settings
 *
 * Represents all configuration options of the camera.
 */
class Settings {
    protected $options = array();

    /**
     * Constructor.
     * Automatically initializes with all available configuration options.
     *
     * @throws GPhotoException getting the config off of the camera failed
     */
    public function __construct() {
        $optionDescriptors = GPHOTO::listConfig();

        foreach ($optionDescriptors as &$optionDescriptor) {
            $this->options[$optionDescriptor] = new Option($optionDescriptor);
        }
    }

    /**
     * Get an option by its descriptor.
     *
     * @param $descriptor the descriptor
     * @return mixed the option
     */
    public function getOptionByDescriptor($descriptor) {
        return $this->options[$descriptor];
    }

    /**
     * Get an option by its label.
     *
     * @param $label the label
     * @return null the option
     */
    public function getOptionByLabel($label) {
        foreach ($this->options as &$option) {
            if ($option->getLabel() === $label) {
                return $option;
            }
        }

        return null;
    }

    /**
     * Checks whether an option with a given descriptor exists.
     *
     * @param $descriptor the descriptor
     * @return bool true if the option exists, otherwise false
     */
    public function has($descriptor) {
        return isset($this->options[$descriptor]);
    }

    /**
     * Checks whether an option with a given label exists.
     *
     * @param $label the label
     * @return bool true if the option exists, otherwise false
     */
    public function hasByLabel($label) {
        foreach ($this->options as &$option) {
            if ($option->getLabel() === $label) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get all options.
     *
     * @return array the options
     */
    public function getOptions() {
        return $this->options;
    }

    /**
     * Get the number of options available.
     *
     * @return int the number of options
     */
    public function size() {
        return count($this->options);
    }

    /**
     * Get the settings with all options as a single array.
     *
     * @return array the array
     */
    public function toArray() {
        $array = array();

        foreach ($this->options as &$option) {
            $array[] = $option->toArray();
        }

        return $array;
    }
}