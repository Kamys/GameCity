<?php

/**
 * Description of cookies_manager
 *
 * @author HNKNTOC
 */
class cookies_manager {

    private $city_names = array();

    function get_city_names() {
        return $this->city_names;
    }

    function init() {
        if ($this->check_cookies()) {
            $this->city_names = unserialize($_COOKIE["CITY_NAMES"]);
        }
    }

    function addCity($newCity) {
        array_push($this->city_names, $newCity);
    }

    function save() {
        setcookie("CITY_NAMES", serialize($this->city_names));
    }

    function clear() {
        $_COOKIE = array();
    }

    private function check_cookies() {
        return array_key_exists('CITY_NAMES', $_COOKIE);
    }

}
