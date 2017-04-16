<?php

/**
 * Use for control game process.
 * Add new world.
 */
class game
{
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
        $this->city_names = $array_city_names;
        $this->city_names_manager = $city_names_manager;
        $this->city_names_used = array();
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
        if ($this->check_city($city_name)) {
            $this->delete_city_name($city_name);
            array_push($this->city_names_used, $city_name);
            return true;
        }
        return false;
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
     * Check it is possible say city name.
     * City name can say if city name contains in $this->city_names
     * and not contains in $this->city_names_used.
     *
     * @param $city_name string which need check.
     *
     * @return bool can say city name.
     */
    function check_city($city_name)
    {
        $in_city_names = in_array($city_name, $this->city_names);
        $in_city_names_used = in_array($city_name, $this->city_names_used);

        return ($in_city_names and !$in_city_names_used);
    }
}
