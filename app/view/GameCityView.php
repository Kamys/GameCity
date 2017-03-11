<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $city_names = [];
            if (array_key_exists("CITY_NAMES", $_COOKIE)) {
                $city_names = unserialize($_COOKIE["CITY_NAMES"]);
            }
            array_push($city_names, $_POST['cityName']);
            logging("Result = ", $city_names);
            setcookie("CITY_NAMES", serialize($city_names));
            
            foreach ($city_names as $value){
                sayCity($value);
            }
        }
        
        function sayCity($city_name){
            echo "<p>" . "$city_name" ."</p>";
        }

        function logging($messages, $args) {
            echo $messages . ":";
            print_r($args);
            echo "<br>";
        }
        ?>
        <form action="" method="post">
            Enter city name:  <input type="text" name="cityName" /> <br/>
            <input type="submit" value="Go!" />
        </form>
    </body>
</html>
