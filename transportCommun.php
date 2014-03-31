<?php

// clé tisséo
// a03561f2fd10641d96fb8188d209414d8

$zonesArrets = file_get_contents('http://pt.data.tisseo.fr/stopAreasList?format=json&key=a03561f2fd10641d96fb8188d209414d8');
$parsed_json_zonesArrets = json_decode($zonesArrets);
$tabZonesArrets = $parsed_json_zonesArrets->{'stopAreas'}->{'stopArea'};
$estTrouve = 0;
$idZoneArretPaulSabatier = "";
for ($i = 0; $i < count($tabZonesArrets) && !$estTrouve; $i++) {
    if (strstr($tabZonesArrets[$i]->{'name'}, "Université Paul Sabatier")) {
        $idZoneArretPaulSabatier = $tabZonesArrets[$i]->{'id'};
        $estTrouve = 1;
    }
}

$poteauxArrets = file_get_contents('http://pt.data.tisseo.fr/stopPointsList?stopAreaId=' . $idZoneArretPaulSabatier . '&format=json&network=Tiss%C3%A9o&key=a03561f2fd10641d96fb8188d209414d8');
$parsed_json_poteauxArrets = json_decode($poteauxArrets);
$tabPoteauxArrets = $parsed_json_poteauxArrets->{'physicalStops'}->{'physicalStop'};
$tabCodeOperateur = array();
$j = 0;
$res = "";
for ($i = 0; $i < count($tabPoteauxArrets); $i++) {
    $res = $tabPoteauxArrets[$i]->{'operatorCodes'};
    $tabCodeOperateur[$j] = $res[0]->{'operatorCode'}->{'value'};
    $j++;
}

$parsed_json_linesArrets = array();
$j = 0;
for ($i = 0; $i < count($tabCodeOperateur); $i++) {
    $linesArrets = file_get_contents('http://pt.data.tisseo.fr/departureBoard?operatorCode=' . $tabCodeOperateur[$i] . '&number=1&format=json&key=a03561f2fd10641d96fb8188d209414d8');
    $parsed_json_linesArrets[$j] = json_decode($linesArrets);
    //print_r($parsed_json_linesArrets[$j]);
    //print("<br/><br/>");
    $j++;
}

$tabLineArrets = array();
$horaireLigne = array();
$numLigne = array();
$destinationLine = array();
$tmp = "";
$j = 0;
for ($i = 0; $i < count($parsed_json_linesArrets); $i++) {
    $tabLineArrets = $parsed_json_linesArrets[$i]->{'departures'}->{'departure'};
    //print($i . "=>");
    if (isset($tabLineArrets[0]->{'dateTime'})) {
        $horaireLigne[$j] = $tabLineArrets[0]->{'dateTime'};
        //print(" Horaire :" . $horaireLigne[$j]);
        $numLigne[$j] = $tabLineArrets[0]->{'line'}->{'shortName'};
        //print(" Ligne : " . $numLigne[$j]);
        $tmp = $tabLineArrets[0]->{'destination'};
        $destinationLine[$j] = $tmp[0]->{'name'};
        //print(" Destination : " . $destinationLine[$j]);
        //print(arriveDans($horaireLigne[$j])+" minutes");
    }

    //print("<br/>");
    $j++;
}

function arriveDans($horaire) {
    $now = date('Y-m-d H:i:s');
    $datetime1 = new DateTime($now);
    $datetime2 = new DateTime($horaire);
    $interval = $datetime1->diff($datetime2);
    return $interval->format('%i');
}

//print_r($tabCodeOperateur);  
// clé google
// AIzaSyAaspHQw2EYKhz9zXwu-_6g1RozGe4K_co
// https://maps.googleapis.com/maps/api/directions/json?origin=Universit%C3%A9PaulSabatier&destination=Figeac&mode=bicycling&sensor=false&key=AIzaSyAaspHQw2EYKhz9zXwu-_6g1RozGe4K_co
//cle JCDECEAUX
//1ef4a16b7ad8c600c6e505f8a5d1167fe873de42

$velo = file_get_contents('https://api.jcdecaux.com/vls/v1/stations/227?contract=Toulouse&apiKey=1ef4a16b7ad8c600c6e505f8a5d1167fe873de42');
$parsed_json_velo = json_decode($velo);
$nbBorneTotal = $parsed_json_velo->{'bike_stands'};
$nbBorneDispo = $parsed_json_velo->{'available_bike_stands'};
$ouvert = $parsed_json_velo->{'status'};
$adresse = $parsed_json_velo->{'address'};
$nbVeloDispo = $parsed_json_velo->{'available_bikes'};

function afficherBus() {
    //a faire ici a la place de dans le html
}

function afficherLikeVelo($num, $dest, $db) {
    $reqNbLike = "SELECT nbLike FROM VELO WHERE idVelo=" . $num .
            " AND contratVelo='" . $dest . "';";
    $nbLike = $db->getOneData($reqNbLike);
    $nbLike = $nbLike[0];
    return $nbLike;
}

function afficherUnlikeVelo($num, $dest, $db) {
    $reqNbUnlike = "SELECT nbUnlike FROM VELO WHERE idVelo=" . $num .
            " AND contratVelo='" . $dest . "';";
    $nbUnlike = $db->getOneData($reqNbUnlike);
    $nbUnlike = $nbUnlike[0];
    return $nbUnlike;
}
function afficherLikeMetro($num, $dest, $db) {
    $reqNbLike = "SELECT nbLike FROM METRO WHERE idMetro='" . $num .
            "' AND directionMetro='" . $dest . "';";
    $nbLike = $db->getOneData($reqNbLike);
    $nbLike = $nbLike[0];
    return $nbLike;
}

function afficherUnlikeMetro($num, $dest, $db) {
    $reqNbUnlike = "SELECT nbUnlike FROM METRO WHERE idMetro='" . $num .
            "' AND directionMetro='" . $dest . "';";
    $nbUnlike = $db->getOneData($reqNbUnlike);
    $nbUnlike = $nbUnlike[0];
    return $nbUnlike;
}



?>
