<?php

/**
 * Description of game
 *
 * @author HNKNTOC
 */
class game
{
    /*
     * Use for save and get status name city in cookies.
     */

    private $manager_status;

    /**
     * This array with cities names.
     * @var array.
     */
    private $array_citys_name;
    private $file_path;

    function __construct()
    {
        $this->manager_status = new cookies_array_manager("CITY_STATUS");
        $this->manager_status->init();
        $this->file_path = $_SERVER['DOCUMENT_ROOT'] . "\app\\res\list_city";
    }

    function init()
    {
        $file = fopen($this->file_path, "r");
        $string_city_names = fread($file, filesize($this->file_path));
        $this->array_citys_name = explode(",", $string_city_names);

        for ($i = 0; $i < sizeof($this->array_citys_name); $i++) {
            $this->manager_status->add_at_index(1, $i);
        }
    }

    function say_word($word)
    {
        if ($this->check_word($word)) {
            $index = $this->get_index_for_name_city($word);
            if ($this->check_word_status($index)) {
                $this->manager_status->add_at_index(0, $index);
                $this->manager_status->save();
                return true;
            }
        }
        return false;
    }

    //TODO: delete check_word_status. hi in check_word.

    function check_word($word)
    {
        $in_array = in_array($word, $this->array_citys_name);
        if ($in_array) {
            $index = $this->get_index_for_name_city($word);
            $result = $this->check_word_status($index);
            return $result;
        } else {
            return false;
        }
    }

    private function get_index_for_name_city($search_name)
    {
        while ($city_name = current($this->array_citys_name)) {
            if ($city_name == $search_name) {
                return key($this->array_citys_name);
            }
            next($this->array_citys_name);
        }
        throw new Exception("get_index_for_name_city: Failed!!");
    }

    //TODO bug in get_status_for_name_city

    private function check_word_status($index_city_name)
    {
        $status = $this->get_status_for_name_city($index_city_name);
        logging("status", $status);
        if ($status == 1) {
            logging("check_word_status", "true");
            return true;
        } else {
            logging("check_word_status", "false");
            return false;
        }
    }

    function get_status_for_name_city($index_city_name)
    {
        $exists = $this->manager_status->check_exists($index_city_name);
        if ($exists) {
            $this->manager_status->init();
            $result = $this->manager_status->get_value($index_city_name);
            logging("result status", $result);
            return $result;
        } else {
            logging("get_status_for_name_city", "return 0");
            return 0;
        }
    }

}
