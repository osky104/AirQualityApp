<?php

require 'database.php';

//TAKE CITY OF TN FROM A CSV
$check = $pdo->query("SELECT COUNT(*) FROM City")->fetchColumn();

if ($check == 0) {
    $filename = "comuniTrentino.csv";
    $file = fopen($filename, "r");

    while ($linea = fgets($file)) {
        $name = trim(explode("," , $linea)[0]);
        $lat = trim(explode("," , $linea)[1]);
        $lon = trim(explode("," , $linea)[2]);

        $stmt  = $pdo -> prepare("INSERT INTO City VALUES (:name, 'TN', :lat, :lon)");
        $stmt -> bindParam(":name", $name, PDO::PARAM_STR);
        $stmt -> bindParam(":lat", $lat);
        $stmt -> bindParam(":lon", $lon);

        $stmt -> execute();
    }

    fclose($file);
}

$cities = $pdo -> query("SELECT Name, Latitude, Longitude FROM City")->fetchALL(PDO::FETCH_ASSOC);
$sqlInsert = "INSERT INTO RegistrationAir (aqi, pm10, pm2_5, `no`, no2, co, nh3, o3, date_time, City_name) VALUES (:aqi, :pm10, :pm2_5, :no, :no2, :co, :nh3, :o3, :dt, :city)";
$stmt = $pdo->prepare($sqlInsert);

//TAKE DATA FROM OPEN-METEO
//METEO DATA
foreach($cities as $city) {

    $lat = $city['Latitude'];
    $lon = $city['Longitude'];
    $name = $city['Name'];

    //AIR QUALITY DATA
    $urlAir = "https://air-quality-api.open-meteo.com/v1/air-quality?latitude=$lat&longitude=$lon&hourly=pm10,pm2_5,carbon_monoxide,carbon_dioxide,nitrogen_dioxide,sulphur_dioxide,ozone,european_aqi,nitrogen_monoxide,ammonia&past_days=31&forecast_days=1";
   
    $response = file_get_contents($urlAir);
    $data = json_decode($response, true);
    
    $aqi = $data['hourly']['european_aqi'];
    $time = $data['hourly']['time'];
    $pm10 = $data['hourly']['pm10'];
    $pm2_5 = $data['hourly']['pm2_5'];
    $co = $data['hourly']['carbon_dioxide'];
    $no = $data['hourly']['nitrogen_monoxide'];
    $no2 = $data['hourly']['nitrogen_dioxide'];
    $o3 = $data['hourly']['ozone'];
    $nh3 = $data['hourly']['ammonia'];

    foreach ($time as $i => $time_val) {
        $aqi_val    = $aqi[$i];
        $pm10_val   = $pm10[$i];
        $pm2_5_val  = $pm2_5[$i];
        $co_val     = $co[$i];
        $no_val     = $no[$i];
        $no2_val    = $no2[$i];
        $o3_val     = $o3[$i];
        $nh3_val    = $nh3[$i];

        $stmt->bindValue(":aqi", $aqi_val, PDO::PARAM_INT);
        $stmt->bindValue(":pm10", $pm10_val, PDO::PARAM_STR);
        $stmt->bindValue(":pm2_5", $pm2_5_val, PDO::PARAM_STR);
        $stmt->bindValue(":no", $no_val, PDO::PARAM_STR);
        $stmt->bindValue(":no2", $no2_val, PDO::PARAM_STR);
        $stmt->bindValue(":co", $co_val, PDO::PARAM_STR);
        $stmt->bindValue(":nh3", $nh3_val, PDO::PARAM_STR);
        $stmt->bindValue(":o3", $o3_val, PDO::PARAM_STR);
        $stmt->bindValue(":dt", $time_val, PDO::PARAM_STR);
        $stmt->bindValue(":city", $name, PDO::PARAM_STR);

        $stmt -> execute();
    }



}













//put the data in database
?>