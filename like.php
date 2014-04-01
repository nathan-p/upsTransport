<?php

include_once 'model/Database.php';

$db = new Database();
$db->getConnection();

//chercher l'identifiant du like en fonction de la ligne
$data = explode(";", $_POST['data']);
$typeTransport = $data[0];
$erase = $_POST['eraseLike'];
$type = $_POST['type'];

if (isset($typeTransport)) {

    if($type == "like"){
        $typeLikeUnlike = "nbLike";
        $typeInverse = "nbUnlike";
    }
    else{
        $typeLikeUnlike = "nbUnlike";
        $typeInverse = "nbLike";
    }
    $numLigne = $data[1];
    $destinationLine = $data[2];

    switch ($typeTransport) {
        case "BUS":
            //recuperer le nombre de like 
            $nbLike = 0;
            $reqNbLike = "SELECT ".$typeLikeUnlike." FROM BUS WHERE numBus='" . $numLigne .
                    "' AND directionBus='" . htmlentities($destinationLine) . "';";
            $nbLike = $db->getOneData($reqNbLike);
            $nbLike = $nbLike[0];

            $retourNbLike = $nbLike+ 1;
            
            $req = "UPDATE BUS SET ".$typeLikeUnlike."=" . $retourNbLike . " WHERE numBus='" 
                    . $numLigne . "' AND directionBus='" . htmlentities($destinationLine) . "';";
            $db->getOneData($req);
            
            if ($erase) {
                   //recupere le nombre de like
                   $reqNbLikeUnlike = "SELECT ".$typeInverse." FROM BUS WHERE numBus='". $numLigne
                                        . "' AND directionBus='".$destinationLine."';"; 
                   
                   $nbLikeUnlike = $db->getOneData($reqNbLikeUnlike);
                   $nbLikeUnlike = $nbLikeUnlike[0];
                   
                   //enlever un like/unlike
                   $nbLikeUnlike = $nbLikeUnlike-1;
                   $req = "UPDATE BUS SET ".$typeInverse."=" . $nbLikeUnlike . " WHERE numBus='" 
                    . $numLigne . "' AND directionBus='" . htmlentities($destinationLine) . "';";
                    $db->getOneData($req);
            }
            break;
        case "METRO":
            //recuperer le nombre de like 
            $nbLike = 0;
            $reqNbLike = "SELECT ".$typeLikeUnlike." FROM METRO WHERE idMetro='" . $numLigne 
                    ."' AND directionMetro='" . $destinationLine . "';";
            $nbLike = $db->getOneData($reqNbLike);
            $nbLike = $nbLike[0];

            $retourNbLike = $nbLike + 1;
            $req = "UPDATE METRO SET ".$typeLikeUnlike."=" . $retourNbLike . " WHERE idMetro='" 
                    . $numLigne . "' AND directionMetro='" . $destinationLine . "';";
            $db->getOneData($req);
            if ($erase) {
                   //recupere le nombre de like
                   $reqNbLikeUnlike = "SELECT ".$typeInverse." FROM METRO WHERE idMetro='". $numLigne
                                        . "' AND directionMetro='".$destinationLine."';"; 
                   $nbLikeUnlike = $db->getOneData($reqNbLikeUnlike);
                   $nbLikeUnlike = $nbLikeUnlike[0];
                   
                   //enlever un like/unlike
                   $nbLikeUnlike = $nbLikeUnlike-1;
                   $req = "UPDATE METRO SET ".$typeInverse."=" . $nbLikeUnlike . " WHERE idMetro='" 
                    . $numLigne . "' AND directionMetro='" . $destinationLine . "';";
                    $db->getOneData($req);
            }
            break;
        case "VELO":
            //recuperer le nombre de like 
            $nbLike = 0;
            $reqNbLike = "SELECT ".$typeLikeUnlike." FROM VELO WHERE idVelo=" . $numLigne .
                    " AND contratVelo='" . $destinationLine . "';";
            $nbLike = $db->getOneData($reqNbLike);
            $nbLike = $nbLike[0];

            $retourNbLike = $nbLike + 1;
            $req = "UPDATE VELO SET $typeLikeUnlike =" . $retourNbLike . " WHERE idVelo=" 
                    . $numLigne . " AND contratVelo='" . $destinationLine . "';";
            
            $db->getOneData($req);
            if ($erase) {
                   //recupere le nombre de like
                   $reqNbLikeUnlike = "SELECT $typeInverse FROM VELO WHERE idVelo=". $numLigne
                                        . " AND contratVelo='".$destinationLine."';"; 
                   $nbLikeUnlike = $db->getOneData($reqNbLikeUnlike);
                   $nbLikeUnlike = $nbLikeUnlike[0];
                   
                   //enlever un like/unlike
                   $nbLikeUnlike = $nbLikeUnlike-1;
                   $req = "UPDATE VELO SET $typeInverse =" . $nbLikeUnlike . " WHERE idVelo=" 
                    . $numLigne . " AND contratVelo='" . $destinationLine . "';";
                    $db->getOneData($req);
            }
            break;
    }

    echo $retourNbLike;
    exit();
}
?>
