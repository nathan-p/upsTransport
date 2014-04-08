<?php
include_once 'Toolkit.php';

$latDestination = $_POST['lat'];
$lngDestination = $_POST['lgn'];


$var = 'https://api.jcdecaux.com/vls/v1/stations?contract=Toulouse&apiKey=1ef4a16b7ad8c600c6e505f8a5d1167fe873de42';
$velo = file_get_contents($var);
$parsed_json_all_velo = json_decode($velo);

$i = 0;
foreach ($parsed_json_all_velo as $value) {
    //regarder la distance 
    $latStation = $value->{'position'}->{'lat'};
    $lgnStation = $value->{'position'}->{'lng'};
    if( $i == 0){
        $meilleureStation = $value;
        $distanceMin = Toolkit::getDistance($latStation,$lgnStation,$latDestination,$lngDestination);
    }

    $distance = Toolkit::getDistance($latStation,$lgnStation,$latDestination,$lngDestination);
    
    if($distance < $distanceMin){
        $meilleureStation = $value;
        $distanceMin = $distance;
    }
    $i++;
}


if($distanceMin <= 3000) {
    echo "La station de vélo la plus proche de chez vous est à ".number_format ($distanceMin).
                " mètres. <br>Adresse : ".$meilleureStation->{'address'}." ".$meilleureStation->{'name'};
}
else {
    echo "Attention ! La station vélo la plus proche de chez vous est à ".number_format ($distanceMin)." mètres.";
}

?>
