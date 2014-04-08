<?php
include_once 'Toolkit.php';
include_once 'Tisseo.php';
include_once '../model/moyenTransport/Bus.php';

$latDestination = $_POST['lat'];
$lngDestination = $_POST['lgn'];

$code = Tisseo::tabCodeOperateurItineraire($latDestination,$lngDestination);
$lignes = Bus::comparerLines(Tisseo::linesArretsItineraire($code));


for ($i = 0; $i < cout($lignes); $i++) {
    $resLignes = explode("!",$lignes[$i]);
    echo "Le bus ".$resLignes[0]." en direction de ".$resLignes[1]."<br/>";
}

?>
