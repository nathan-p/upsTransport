<?php

require_once($_SERVER['DOCUMENT_ROOT']."/upsTransport/model/Database.php");

$db = new Database();
$db->getConnection();

//chercher l'identifiant du unlike en fonction de la ligne
$data = explode(";", $_POST['data']);
$typeTransport = $data[0];

if (isset($typeTransport)) {
    $numLigne = $data[1];

    //recuperer le nombre de unlike 
    $nbUnlike = 0;
    $reqNbUnlike = "SELECT nbUnlike FROM USERUNLIKE WHERE numLigne=".$numLigne." AND moyenTransport='".$typeTransport."';";
    
    $nbUnlike = $db->getOneData($reqNbUnlike);
    $nbUnlike = $nbUnlike[0];
   
    
    //ajouter ou modifier le tuple
    if($nbUnlike == 0){
        $req = "INSERT INTO userunlike VALUES(0," . $numLigne . ",'" . $typeTransport . "',1);";
        $nbUnlike = 1;
        $db->getOneData($req);
    }
    else{
        $nbUnlike = $nbUnlike+1;
        $req = "UPDATE userunlike SET nbUnlike=".$nbUnlike." WHERE numLigne=".$numLigne." AND moyenTransport='".$typeTransport."';";
        $db->getOneData($req);
    }
    echo $nbUnlike;
    exit();
}


?>
