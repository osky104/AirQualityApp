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

//TAKE DATA FROM OPEN WEATHER 
$apiKey = "870dfb630a2c71f5bda65766d9f48bca"; 

$cities = $pdo -> query("SELECT Name, Latitude, Longitude FROM City")->fetchALL(PDO::FETCH_ASSOC);
$sqlInsert = "INSERT INTO Registration (aqi, pm10, pm2_5, `no`, no2, co, nh3, o3, City_name) VALUES (:aqi, :pm10, :pm2_5, :no, :no2, :co, :nh3, :o3, :city)";
$stmt = $pdo->prepare($sqlInsert);

foreach ($cities as $city) {
    $lat = $city['Latitude'];
    $lon = $city['Longitude'];
    $name = $city['Name'];

    //call the API
    $url = "http://api.openweathermap.org/data/2.5/air_pollution?lat=$lat&lon=$lon&appid=$apiKey";
    $response = file_get_contents($url);
    $data = json_decode($response, true);

    //take data
    $aqi = $data['list'][0]['main']['aqi'];
    $co = $data['list'][0]['components']['co'];
    $no = $data['list'][0]['components']['no'];
    $no2 = $data['list'][0]['components']['no2'];
    $o3 = $data['list'][0]['components']['o3'];
    $so2 = $data['list'][0]['components']['so2'];
    $pm10 = $data['list'][0]['components']['pm10'];
    $pm2_5 = $data['list'][0]['components']['pm2_5'];
    $nh3 = $data['list'][0]['components']['nh3'];
    $currentDate = $data['list'][0]['dt'];

    //time is in Unix Timestamp and we need to convert it 
    $currentDate = date('d/m/Y H:i', $currentDate); 

    $stmt -> bindParam(":aqi", $aqi, PDO::PARAM_INT);
    $stmt -> bindParam(":pm10", $pm10, PDO::PARAM_STR);
    $stmt -> bindParam(":pm2_5", $pm2_5, PDO::PARAM_STR);
    $stmt -> bindParam(":no", $no, PDO::PARAM_STR);
    $stmt -> bindParam(":no2", $no2, PDO::PARAM_STR);
    $stmt -> bindParam(":co", $co, PDO::PARAM_STR);
    $stmt -> bindParam(":nh3", $nh3, PDO::PARAM_STR);
    $stmt -> bindParam(":o3", $o3, PDO::PARAM_STR);
    $stmt -> bindParam(":city", $name, PDO::PARAM_STR);

    $stmt -> execute();
    usleep(200000);


}









//put the data in database
?>