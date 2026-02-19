<?php
    $host = "localhost";
    $username = "root";
    $password = "";

    $dsn = "mysql:host=$host;port:3360;charset=utf8";

    $pdo = new PDO ($dsn, $username, $password);

    $pdo->exec("CREATE DATABASE IF NOT EXISTS WeatherRecordings");
    $pdo->exec("USE WeatherRecordings");

    $pdo->exec("CREATE TABLE IF NOT EXISTS `PollutionLogs` (
        `id` int NOT NULL AUTO_INCREMENT,
        `citta` varchar(50) NOT NULL,
        `aqi` int(11) NOT NULL, 
        `pm10` float NOT NULL,
        `pm25` float NOT NULL,
        `rilevationDate` datetime NOT NULL,
        PRIMARY KEY (`id`)
    )")
    


?>