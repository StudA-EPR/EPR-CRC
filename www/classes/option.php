<?php

require_once 'gphoto.php';

/**
 * Class OptionType
 *
 * PHP doesn't support enumerations, this sort of behaves like one.
 */
class OptionType {
    const TEXT   = 'TEXT';
    const RADIO  = 'RADIO';
    const TOGGLE = 'TOGGLE';
    const RANGE  = 'RANGE';
    const MENU   = 'MENU';
    const DATE   = 'DATE';

    const UNKNOWN = 'UNKNOWN';

    public static function get($string) {
        switch ($string) {
            case OptionType::TEXT:
                return OptionType::TEXT;
            case OptionType::RADIO:
                return OptionType::RADIO;
            case OptionType::TOGGLE:
                return OptionType::TOGGLE;
            case OptionType::RANGE:
                return OptionType::RANGE;
            case OptionType::MENU:
                return OptionType::MENU;
            case OptionType::DATE:
                return OptionType::DATE;
            default:
                return OptionType::UNKNOWN;
        }
    }
}

/**
 * Class Option
 *
 * Represents a single configuration option.
 */
class Option {
    protected $option;
    protected $label;
    protected $type;
    protected $current;
    protected $choices = array();

    /**
     * Constructor.
     *
     * @param string the config option descriptor
     * @throws GPhotoException getting the details for the given option failed
     */
    public function __construct($optionDescriptor) {
        $details = GPhoto::getConfig($optionDescriptor);    // the lines of the --get-config output.
        $this->option  = $optionDescriptor;
        $this->label   = preg_replace('/Label: /'  , '', $details[0]);
        $type          = preg_replace('/Type: /'   , '', $details[1]);
        $this->type    = OptionType::get($type);
        // The [ ]? part of the regex is important in case the value of current is empty.
        // Then, for whatever reason, the space character after 'Current:' is cut off,
        // even though it seems to be present at my desktop's terminal.
        $this->current = preg_replace('/Current:[ ]?/', '', $details[2]);

        if ($this->type === OptionType::RADIO) {
            $detailsSize = count($details);
            $pattern     = '/Choice: [0-9]+ /';

            for ($i = 3; $i < $detailsSize; $i++) {
                $currentLine = $details[$i];

                if (preg_match($pattern, $currentLine) === 1) {
                    $this->choices[$i - 3] = preg_replace($pattern, '', $currentLine);
                }
            }
        }

        $this->choices;
    }

    /**
     * Get a string representation of the option.
     *
     * @return string the string
     */
    public function toString() {
        $string =     'Option: '  . $this->option   . PHP_EOL
                    . 'Label: '   . $this->label    . PHP_EOL
                    . 'Type: '    . $this->type     . PHP_EOL
                    . 'Current: ' . $this->current  . PHP_EOL;

        if ($this->type === OptionType::RADIO) {
            $i = 0;

            foreach ($this->choices as &$choice) {
                $string .= "Choice: $i $choice" . PHP_EOL;
                $i++;
            }
        }

        return $string;
    }

    /**
     * Get the option details in a single array.
     *
     * @return array the array
     */
    public function toArray() {
        $array = array();
        $array['option']  = $this->option;
        $array['label']   = $this->label;
        $array['type']    = $this->type;
        $array['current'] = $this->current;

        // Create explicit key value pairs by using nested array to trick the json_encode function later.
        $choiceKeyValuePairs = array();
        foreach ($this->choices as $index => $value) {
            $choiceKeyValuePairs[] = array(0 => $index, 1 => $value);
        }
        $array['choices'] = $choiceKeyValuePairs;

        return $array;
    }

    /**
     * Reset the current value.
     * To make the camera use the new value, use GPhoto::setConfig(Option $option).
     * If the given value is not part of the choices, it is treated as invalid and will be ignored.
     *
     * @param $current the new current value, either as a descriptor or as its index number
     */
    public function setCurrent($current)
    {
        if (is_integer($current)) {
            if (array_key_exists($current, $this->choices)) {
                $this->current = $this->choices[$current];
            }
        } else {
            if (in_array($current, $this->choices)) {
                $this->current = $current;
            }
        }
    }

    // Getters:

    public function getOption()
    {
        return $this->option;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getCurrent()
    {
        return $this->current;
    }

    public function getChoices()
    {
        return $this->choices;
    }
}