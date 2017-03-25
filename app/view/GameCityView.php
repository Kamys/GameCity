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
        logging('COOKIE', $_COOKIE);
        logging('POST', $_POST);
        if (check_post()) {
            clear();
            $city_names = [];
            if (array_key_exists('CITY_NAMES', $_COOKIE)) {
                $city_names = unserialize($_COOKIE["CITY_NAMES"]);
            }
            add_city_name_in_cookis($city_names);
            logging("Result = ", $city_names);
            setcookie("CITY_NAMES", serialize($city_names));

            foreach ($city_names as $value) {
                say_city($value);
            }
        }

        function add_city_name_in_cookis(&$city_names) {
            $city_name_of_post = get_city_name_of_post();
            if (check_string($city_name_of_post)) {
                logging("Add in cookies", $city_name_of_post);
                array_push($city_names, $city_name_of_post);
            } else {
                logging("Not add in cookies", $city_name_of_post);
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

        function get_city_name_of_post() {
            return $_POST['cityName'];
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
