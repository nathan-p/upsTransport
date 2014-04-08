<?php
require_once('../model/Database.php');
require_once('Toolkit.php');
require_once('Tisseo.php');
require_once('../model/moyenTransport/Bus.php');

$latDestination = $_POST['lat'];
$lngDestination = $_POST['lgn'];

$code = Tisseo::tabCodeOperateurItineraire($latDestination,$lngDestination);
$lignes = Bus::comparerLines(Tisseo::linesArretsItineraire($code));

if (count($lignes) == 0) {
    echo "Pas de bus correspondant à votre destination.<br/>";
} else {
    for ($i = 0; $i < count($lignes); $i++) {
        $resLignes = explode("!",$lignes[$i]);
        echo "- Le bus ".$resLignes[0]." en direction de ".$resLignes[1]."<br/>";
    }
}
?>
