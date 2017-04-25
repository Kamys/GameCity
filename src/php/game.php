<?php

/**
 * Use for control game process.
 * Add new world.
 */
class game
{

    public static $array_exception_characters = array('ь', 'ъ', 'ё');
    private $log;
    /**
     * This array with cities names which can use as a answer.
     * @var array.
     */
    private $city_names;
    /**
     * This array with cities names which already to used.
     * Their cant use as a answer.
     * @var array.
     */
    private $city_names_used;
    /**
     * Use for save status game.
     * Save $city_names and $city_names_used for continue game.
     * @var city_names_manager
     */
    private $city_names_manager;

    function __construct(array $array_city_names, city_names_manager $city_names_manager)
    {
        $this->log = Logger::getLogger(__CLASS__);
        $this->city_names = $array_city_names;
        $this->city_names_manager = $city_names_manager;
        $this->city_names_used = array();
    }

    /**
     * Use for say new city name.
     * Check can say city name if yes add him in
     *
     * @param $city_name string which need say.
     *
     * @return bool successful say name city.
     */
    public function say_city($city_name): bool
    {
        $this->log->info("say_city: $city_name");
        if ($this->check_city($city_name)) {
            $this->delete_city_name($city_name);
            array_push($this->city_names_used, $city_name);
            return true;
        }
        return false;
    }

    /**
     * Check it is possible say city name.
     *
     * @param $city_name string which need check.
     *
     * @return bool can say city name.
     */
    function check_city($city_name)
    {
        $city_name = mb_strtolower($city_name);
        $result = $this->check_city_in_array($city_name) && $this->check_city_name($city_name);
        $this->log->debug("check_city: return $result");
        return $result;
    }

    /**
     * City name can say if city name contains in $this->city_names
     * and not contains in $this->city_names_used.
     *
     * @param $city_name string which need check.
     *
     * @return bool can say city name.
     */
    function check_city_in_array($city_name)
    {
        $this->log->debug("check_city_in_array: city_name = $city_name");
        $in_city_names = in_array($city_name, $this->city_names);
        $in_city_names_used = in_array($city_name, $this->city_names_used);

        $this->log->debug(
            "check_city_in_array: in_city_names = $in_city_names, " .
            "in_city_names_used = $in_city_names_used");
        return ($in_city_names and !$in_city_names_used);
    }

    /**
     * Check first character is $city_name
     * needs equals end character last city_name.
     * Exception, some characters. (ь,ъ,ё)
     *
     * @param $city_name string
     *
     * @return bool
     */
    private function check_city_name($city_name): bool
    {
        $count = count($this->city_names_used);
        $this->log->debug("check_city_name: count = $count");
        if ($count == 0) {
            $this->log->debug("check_city_name: This firs city name. Return true");
            return true;
        }
        $past_city_name = $this->city_names_used[$count - 1];
        $last_character = $this->last_character($past_city_name);

        $result = $this->check_first_character($city_name, $last_character);
        $this->log->debug("check_city_name: return $result");
        return $result;
    }

    /**
     * @param $past_city_name string
     *
     * @return string
     */
    private function last_character($past_city_name): string
    {
        $this->log->debug("last_character: past_city_name = $past_city_name");
        $last_character = substr($past_city_name, -2);
        if (in_array($last_character, $this::$array_exception_characters)) {
            $last_character = substr($past_city_name, -3);
        }
        $this->log->debug("last_character: last_character = $last_character");
        return $last_character;
    }

    private function check_first_character($string, $first_character): bool
    {
        $this->log->debug("check_first_character: string = $string, first_character = $first_character");
        $sub_string = substr($string, 0, 2);
        $this->log->debug("check_first_character: sub_string = $sub_string");
        $result = $sub_string == $first_character;
        $this->log->debug("check_first_character: return $result");
        return $result;
    }

    /**
     * Use for delete city name from $this->city_names.
     *
     * @param $city_name string which need delete.
     *
     * @throws Exception if failed found city name in $this->city_names.
     */
    private function delete_city_name($city_name)
    {
        if (($key = array_search($city_name, $this->city_names)) !== false) {
            unset($this->city_names[$key]);
        } else {
            throw new Exception("Failed delete_city_name(). Name city not found.");
        }
    }

    /**
     * Save game data.
     * Use $this->city_names_manager for save data.
     */
    private function save_game_status()
    {
        $this->city_names_manager->save_city_names($this->city_names);
        $this->city_names_manager->save_city_names_use($this->city_names_used);
    }

    /**
     * Init game status.
     * Use $this->city_names_manager for get data.
     */
    private function init_game_status()
    {
        $this->city_names = $this->city_names_manager->get_city_names();
        $this->city_names_used = $this->city_names_manager->get_city_names_use();
    }
}
