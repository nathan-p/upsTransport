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
            $nbUn_LikeAjout = 0;
            $reqNbLike = "SELECT ".$typeLikeUnlike." FROM BUS WHERE numBus='" . $numLigne .
                    "' AND directionBus='" . htmlentities($destinationLine) . "';";
            $nbUn_LikeAjout = $db->getOneData($reqNbLike);
            $nbUn_LikeAjout = $nbUn_LikeAjout[0];

            $retourNbUn_LikeAjout = $nbUn_LikeAjout+ 1;
            
            $req = "UPDATE BUS SET ".$typeLikeUnlike."=" . $retourNbUn_LikeAjout . " WHERE numBus='" 
                    . $numLigne . "' AND directionBus='" . htmlentities($destinationLine) . "';";
            $db->getOneData($req);
            
            if ($erase == "true") {
                   //recupere le nombre de like
                   $reqNbLikeUnlike = "SELECT ".$typeInverse." FROM BUS WHERE numBus='". $numLigne
                                        . "' AND directionBus='".$destinationLine."';"; 
                   
                   $nbUn_LikeRetrait = $db->getOneData($reqNbLikeUnlike);
                   $nbUn_LikeRetrait = $nbUn_LikeRetrait[0];
                   
                   //enlever un like/unlike
                   $retourNbUn_LikeRetrait = $nbUn_LikeRetrait-1;
                   $req = "UPDATE BUS SET ".$typeInverse."=" . $retourNbUn_LikeRetrait . " WHERE numBus='" 
                    . $numLigne . "' AND directionBus='" . htmlentities($destinationLine) . "';";
                    $db->getOneData($req);
            }
            break;
        case "METRO":
            //recuperer le nombre de like 
            $nbUn_LikeAjout = 0;
            $reqNbLike = "SELECT ".$typeLikeUnlike." FROM METRO WHERE idMetro='" . $numLigne 
                    ."' AND directionMetro='" . $destinationLine . "';";
            $nbUn_LikeAjout = $db->getOneData($reqNbLike);
            $nbUn_LikeAjout = $nbUn_LikeAjout[0];

            $retourNbUn_LikeAjout = $nbUn_LikeAjout + 1;
            $req = "UPDATE METRO SET ".$typeLikeUnlike."=" . $retourNbUn_LikeAjout . " WHERE idMetro='" 
                    . $numLigne . "' AND directionMetro='" . $destinationLine . "';";
            $db->getOneData($req);
            if ($erase == "true") {
                   //recupere le nombre de like
                   $reqNbLikeUnlike = "SELECT ".$typeInverse." FROM METRO WHERE idMetro='". $numLigne
                                        . "' AND directionMetro='".$destinationLine."';"; 
                   $nbUn_LikeRetrait = $db->getOneData($reqNbLikeUnlike);
                   $nbUn_LikeRetrait = $nbUn_LikeRetrait[0];
                   
                   //enlever un like/unlike
                   $retourNbUn_LikeRetrait = $nbUn_LikeRetrait-1;
                   $req = "UPDATE METRO SET ".$typeInverse."=" . $retourNbUn_LikeRetrait . " WHERE idMetro='" 
                    . $numLigne . "' AND directionMetro='" . $destinationLine . "';";
                    $db->getOneData($req);
            }
            break;
        case "VELO":
            //recuperer le nombre de like 
            $nbUn_LikeAjout = 0;
            $reqNbLike = "SELECT ".$typeLikeUnlike." FROM VELO WHERE idVelo=" . $numLigne .
                    " AND contratVelo='" . $destinationLine . "';";
            $nbUn_LikeAjout = $db->getOneData($reqNbLike);
            $nbUn_LikeAjout = $nbUn_LikeAjout[0];

            $retourNbUn_LikeAjout = $nbUn_LikeAjout + 1;
            $req = "UPDATE VELO SET $typeLikeUnlike =" . $retourNbUn_LikeAjout . " WHERE idVelo=" 
                    . $numLigne . " AND contratVelo='" . $destinationLine . "';";
            
            $db->getOneData($req);
            if ($erase == "true") {
                   //recupere le nombre de like
                   $reqNbLikeUnlike = "SELECT $typeInverse FROM VELO WHERE idVelo=". $numLigne
                                        . " AND contratVelo='".$destinationLine."';"; 
                   $nbUn_LikeRetrait = $db->getOneData($reqNbLikeUnlike);
                   $nbUn_LikeRetrait = $nbUn_LikeRetrait[0];
                   
                   //enlever un like/unlike
                   $retourNbUn_LikeRetrait = $nbUn_LikeRetrait-1;
                   $req = "UPDATE VELO SET $typeInverse =" . $retourNbUn_LikeRetrait . " WHERE idVelo=" 
                    . $numLigne . " AND contratVelo='" . $destinationLine . "';";
                    $db->getOneData($req);
            }
            break;
    }
    if($erase == "true"){
        $nbLikeUnlike = json_encode(array('nbLikeAjout'=>$retourNbUn_LikeAjout,'nbLikeRetrait'=>$retourNbUn_LikeRetrait));
        echo $nbLikeUnlike;
    } else {
        $nbLikeAjout = json_encode(array('nbLikeAjout'=>$retourNbUn_LikeAjout));
        echo $nbLikeAjout;
    }
    //echo "b";
    
    exit();
}
?>
