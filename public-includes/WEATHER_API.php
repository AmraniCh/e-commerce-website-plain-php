<?php

    $apiKey = "030675d4d32373a08109d979d5531ed7";
    $cityId = "6547294";
    $googleApiUrl = "http://api.openweathermap.org/data/2.5/weather?id=" . $cityId . "&lang=fr&units=metric&APPID=" . $apiKey;

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);

    curl_close($ch);
    $data = json_decode($response);

    // fr 
    $temp_max = $data->main->temp_max;
    $temp_min = $data->main->temp_min;
    $temp = $data->main->temp;
    $pression = $data->main->pressure;
    $vitesse_vent = $data->wind->speed;
    $direction = $data->wind->deg;
    $vitesse_vent = $vitesse_vent*3600/1000;
    $humidite = $data->main->humidity;
    $icon = $data->weather[0]->icon.".png";
    $ville = $data->name; 

    setlocale(LC_TIME, 'french.UTF-8', 'fr_FR.UTF-8');
    $date = strftime('%A %d %B %Y, %H:%M');
    $jour = ucfirst(strftime('%A'));
        
    echo json_encode(
        array( 
            'date' => $date,
            'jour' => $jour,
            'ville' => $ville,
            'temp' => number_format($temp, 1),
            'icon' => '<img
                src="http://openweathermap.org/img/w/'.$icon.'">',
            'vitesse_vent' => number_format($vitesse_vent, 1)." Km/h",
            'humidite' => 'Humidité '.$humidite.'%'
        )
    );
?>