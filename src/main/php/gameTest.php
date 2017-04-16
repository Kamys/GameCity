<?php

use PHPUnit\Framework\TestCase;

include "game.php";

class gameTest extends TestCase
{
    private $array_city_names = array("Белгород", "Давлеканово", "Обоянь");

    // private $game;


    protected function setUp()
    {
        //$this->game = new game($this->array_city_names, new default_manager());
    }

    public function test_say_city_should_not_be_repetitions()
    {
        $game = new game($this->array_city_names, new default_manager());
        $city_name = "Белгород";
        $say_city_first = $game->say_city($city_name);
        $say_city_two = $game->say_city($city_name);

        $this->assertTrue($say_city_first, "First call say_city() need return true.");
        $this->assertFalse($say_city_two, "Two call say_city() need return false.");
    }

    public function test_say_city_should_be_in_list()
    {
        $game = new game($this->array_city_names, new default_manager());
        $city_name = "Нью-Йорк";
        $say_city_first = $game->say_city($city_name);

        $this->assertFalse($say_city_first, "Should return false. Because \"$city_name\" not in the list. ");

    }

    //TODO: add test for status game.


}

include "city_names_manager.php";

/**
 * Class default_manager need for test.
 */
class default_manager implements city_names_manager
{

    private $city_names = [];
    private $city_names_use = [];

    function save_city_names(array $city_names)
    {
        $this->city_names = $city_names;
    }

    function save_city_names_use(array $city_names_use)
    {
        $this->city_names_use = $city_names_use;
    }

    function get_city_names(): array
    {
        return $this->city_names;
    }

    function get_city_names_use(): array
    {
        return $this->city_names_use;
    }
}
