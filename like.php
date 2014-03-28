<?php

include_once 'controller/Database.php';

$db = new Database();
$db->getConnection();

//chercher l'identifiant du like en fonction de la ligne
//avec le POST
$data = explode(";", $_POST['data']);
$typeTransport = $data[0];

if (isset($typeTransport)) {
    $numStation = $data[1];

    //regarder si c'est un like ou unlike
    //$typeLike = $_POST['typeLike'];
    //recuperer le nombre de like 
    $nbLike = 10;

    //modifier ou creer la le like pour cette ligne
    //$typeTransport ne marche pas
    $req = "INSERT INTO userlike VALUES(0," . $numStation . ",'" . $typeTransport . "'," . $nbLike . ");";
    $db->getOneData($req);
}
?>
