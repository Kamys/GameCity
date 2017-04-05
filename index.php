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
include('lib/log4php/Logger.php');
include('src/main/php/game_in_city.php');
Logger::configure('src/main/res/config.xml');
$logger = Logger::getLogger("main");
$logger->info("==========Start==========");


$gameInCity = new game_in_city();
$gameInCity->message(read_json(), "", "", null);

function read_json()
{
    $json_file_path = "src/test/res/example_data_action.json";
    $json_file = fopen($json_file_path, "r") or die("Unable to open file!");

    $json_string = fread($json_file, filesize($json_file_path));
    return $json_array = json_decode($json_string);
}
?>
</body>
</html>
