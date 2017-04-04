<?php

/**
 * This manager help save and read element in the array from the cookies.
 * @author HNKNTOC
 */
class cookies_array_manager
{

    private $array = array();
    private $cookie_name;

    function __construct($cookie_name)
    {
        $this->cookie_name = $cookie_name;
    }

    function get_city_names()
    {
        return $this->array;
    }

    function init()
    {
        if ($this->check_cookies()) {
            $this->array = unserialize($_COOKIE[$this->cookie_name]);
        }
        logging("init array", $this->array);
    }

    private function check_cookies()
    {
        return array_key_exists($this->cookie_name, $_COOKIE);
    }

    function add($new_value)
    {
        array_push($this->array, $new_value);
    }

    function add_at_index($new_value, $index)
    {
        $this->array[$index] = $new_value;
    }

    function get_value($index)
    {
        return $this->array[$index];
    }

    function save()
    {
        setcookie($this->cookie_name, serialize($this->array));
    }

    function clear()
    {
        $_COOKIE = array();
    }

    function check_exists($index)
    {
        return array_key_exists($index, $this->array);
    }

}
