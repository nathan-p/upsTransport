<?php

include_once 'controller/Database.php';

$db = new Database();
$db->getConnection();

//chercher l'identifiant du like en fonction de la ligne
$data = explode(";", $_POST['data']);
$typeTransport = $data[0];
$erase = $_POST['eraseLike'];

if (isset($typeTransport)) {
    
    if($erase){
        //effacer un like dans la bd pour cette ligne
    }
    
    $numLigne = $data[1];

    //recuperer le nombre de like 
    $nbLike = 0;
    $reqNbLike = "SELECT nbLike FROM USERLIKE WHERE numLigne=".$numLigne." AND moyenTransport='".$typeTransport."';";
    
    $nbLike = $db->getOneData($reqNbLike);
    $nbLike = $nbLike[0];
   
    
    //ajouter ou modifier le tuple
    if($nbLike == 0){
        $req = "INSERT INTO userlike VALUES(0," . $numLigne . ",'" . $typeTransport . "',1);";
        $nbLike = 1;
        $db->getOneData($req);
    }
    else{
        $nbLike = $nbLike+1;
        $req = "UPDATE userlike SET nbLike=".$nbLike." WHERE numLigne=".$numLigne." AND moyenTransport='".$typeTransport."';";
        $db->getOneData($req);
    }
    echo $nbLike;
    exit();
}
?>
