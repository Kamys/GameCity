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
Logger::configure('src/main/res/config.xml');
$logger = Logger::getLogger("main");
$logger->info("This is an informational message.");
$logger->warn("I'm not feeling so good...");
?>
</body>
</html>
