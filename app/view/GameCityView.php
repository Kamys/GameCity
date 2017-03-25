<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        spl_autoload_register();
        logging('COOKIE', $_COOKIE);
        logging('POST', $_POST);
        if (check_post()) {
            clear();
            $cookies_manager = new cookies_manager();
            $cookies_manager->init();
            $city_new = $_POST['cityName'];

            if (check_string($city_new)) {
                $cookies_manager->addCity($city_new);
            }

            $cookies_manager->save();

            $city_names = $cookies_manager->get_city_names();
            foreach ($city_names as $value) {
                say_city($value);
            }
        }

        function clear() {
            if (array_key_exists('clear', $_POST)) {
                $clear = $_POST['clear'];
                logging("clear", $clear);
                logging("clear()", "Clear!");
                $_COOKIE = array();
            } else {
                logging("clear()", "Not clear!");
            }
        }

        function check_string($string) {
            return strlen($string) > 0;
        }

        function check_post() {
            return $_SERVER["REQUEST_METHOD"] == "POST";
        }

        function say_city($city_name) {
            echo "<p>" . "$city_name" . "</p>";
        }

        function logging($messages, $args) {
            //echo $messages . ": ";
            //print_r($args);
            //echo "<br>";
        }
        ?>
        <form action="" method="post">
            Enter city name:  <input type="text" name="cityName" /> <br/>
            Clear cookies:  <input type="checkbox" name="clear"/> <br/>
            <input type="submit" value="Go!" />
        </form>
    </body>
</html>
