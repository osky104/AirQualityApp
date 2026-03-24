<?php
    $host = "localhost";
    $username = "root";
    $password = "";

    $dsn = "mysql:host=$host;port:3360;charset=utf8";

    $pdo = new PDO ($dsn, $username, $password);

    $pdo->exec("CREATE DATABASE IF NOT EXISTS WeatherRecordings");
    $pdo->exec("USE WeatherRecordings");

    $pdo->exec("CREATE TABLE IF NOT EXISTS City (
        Name VARCHAR(100) PRIMARY KEY,
        Province VARCHAR(100),
        Latitude DECIMAL(10, 8),
        Longitude DECIMAL(11, 8)
    )");

    $pdo->exec("CREATE TABLE IF NOT EXISTS RegistrationAir (
        date_time DATETIME,
        City_name VARCHAR(100),
        aqi INT,
        pm10 DECIMAL(6, 2),
        pm2_5 DECIMAL(6, 2),
        `no` DECIMAL(6, 2),
        no2 DECIMAL(6, 2),
        co DECIMAL(6, 2),
        nh3 DECIMAL(6, 2),
        o3 DECIMAL(6, 2),
        PRIMARY KEY (date_time, City_name),
        FOREIGN KEY (City_name) REFERENCES City(Name) ON DELETE CASCADE ON UPDATE CASCADE
    )");


    $pdo->exec("CREATE TABLE IF NOT EXISTS RegistrationWeather (
        date_time DATETIME,
        City_name VARCHAR(100),
        temperature DECIMAL(4, 2),          
        feels_like DECIMAL(4, 2),           
        humidity INT,                     
        precipitation DECIMAL(5, 2),      
        precip_probability INT,             
        wind_speed DECIMAL(5, 2),          
        weather_code INT,                   
        PRIMARY KEY (date_time, City_name),
        FOREIGN KEY (City_name) REFERENCES City(Name) ON DELETE CASCADE ON UPDATE CASCADE
    )");


    


?>