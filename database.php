<?php
    $host = "localhost";
    $username = "root";
    $password = "";

    $dsn = "mysql:host=$host;port:3360;charset=utf8";

    $pdo = new PDO ($dsn, $username, $password);

    $pdo->exec("CREATE DATABASE IF NOT EXISTS WeatherRecordings");
    $pdo->exec("USE WeatherRecordings");


?>