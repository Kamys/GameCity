<?php

/**
 * This main facade for module is GameInCity.
 * Use this for work with module is GameInCity.
 */
class GameInCity
{
    private $log;

    /**
     * GameInCity constructor.
     */
    public function __construct()
    {
        $this->log = Logger::getLogger(__CLASS__);
    }


    /**
     * Use for handling user messages.
     * @param $data array content data about action.
     * @param $token string need for use action with group from vk.
     * @param $user_sex string content user sex.
     * @param $link resource use for work with database.
     */
    public function message($data, $token, $user_sex, $link)
    {
        $this->log->info("message(): data =");
        $this->log->info($data);
        $this->log->info("message(): token = $token ,user_sex = $user_sex ,lin = $link");
    }
}