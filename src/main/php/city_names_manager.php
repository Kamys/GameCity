<?php

/**
 * Created by PhpStorm.
 */
interface city_names_manager
{
    function save_city_names(array $city_names);

    function save_city_names_use(array $city_names_use);

    function get__city_names(): array;

    function get__city_names_use(): array;
}