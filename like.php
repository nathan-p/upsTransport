<?php

require_once($_SERVER['DOCUMENT_ROOT']."/upsTransport/model/Database.php");

$db = new Database();
$db->getConnection();

//chercher l'identifiant du like en fonction de la ligne
$data = explode(";", $_POST['data']);
$typeTransport = $data[0];
$erase = $_POST['eraseLike'];

if (isset($typeTransport)) {

    if ($erase) {
        //effacer un like dans la bd pour cette ligne
    }

    $numLigne = $data[1];
    $destinationLine = $data[2];

    switch ($typeTransport) {
        case "BUS":
            //recuperer le nombre de like 
            $nbLike = 0;
            $reqNbLike = "SELECT nbLike FROM BUS WHERE numBus=" . $numLigne . " AND directionBus='" . $destinationLine . "';";
            $nbLike = $db->getOneData($reqNbLike);
            $nbLike = $nbLike[0];

            //ajouter ou modifier le tuple
            $nbLike = $nbLike + 1;
            $req = "UPDATE BUS SET nbLike=" . $nbLike . " WHERE numBus=" 
                    . $numLigne . " AND directionBus='" . $destinationLine . "';";
           
            $db->getOneData($req);
            break;
        case "METRO":
            //recuperer le nombre de like 
            $nbLike = 0;
            $reqNbLike = "SELECT nbLike FROM METRO WHERE idMetro='" . $numLigne . "' AND directionMetro='" . $destinationLine . "';";
            //echo $reqNbLike;
            $nbLike = $db->getOneData($reqNbLike);
            $nbLike = $nbLike[0];

            //ajouter ou modifier le tuple
            $nbLike = $nbLike + 1;
            $req = "UPDATE METRO SET nbLike=" . $nbLike . " WHERE idMetro='" 
                    . $numLigne . "' AND directionMetro='" . $destinationLine . "';";
            //echo $req;
            $db->getOneData($req);
            break;
        case "VELO":
            //recuperer le nombre de like 
            $nbLike = 0;
            $reqNbLike = "SELECT nbLike FROM VELO WHERE idVelo=" . $numLigne . " AND contratVelo='" . $destinationLine . "';";
            $nbLike = $db->getOneData($reqNbLike);
            $nbLike = $nbLike[0];

            //ajouter ou modifier le tuple
            $nbLike = $nbLike + 1;
            $req = "UPDATE VELO SET nbLike=" . $nbLike . " WHERE idVelo=" 
                    . $numLigne . " AND contratVelo='" . $destinationLine . "';";
            
            $db->getOneData($req);
            break;
    }

    echo $nbLike;
    exit();
}
?>
