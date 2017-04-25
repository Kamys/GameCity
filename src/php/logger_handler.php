<?php

/**
 * Created by PhpStorm.
 */
class logger_handler
{
    public static function logger_init()
    {
        include('../../../lib/log4php/Logger.php');
        Logger::configure('../../../src/main/res/config.xml');
    }
}