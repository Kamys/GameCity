<?php

use PHPUnit\Framework\TestCase;

class gameTest extends TestCase
{
    private $game;
    private $array_city_names = array("Белгород", "Давлеканово", "Обоянь");

    /**
     * gameTest constructor.
     */
    public function __construct()
    {
        $this->game = new game($this->array_city_names, new default_manager());
    }

    public function test_go()
    {
        $this->assertTrue(false);
    }


}

/**
 * Class default_manager need for test.
 */
class default_manager implements city_names_manager
{

    private $city_names;
    private $city_names_use;

    function save_city_names(array $city_names)
    {
        $this->city_names = $city_names;
    }

    function save_city_names_use(array $city_names_use)
    {
        $this->city_names_use = $city_names_use;
    }

    function get__city_names(): array
    {
        return $this->city_names;
    }

    function get__city_names_use(): array
    {
        return $this->city_names_use;
    }
}
