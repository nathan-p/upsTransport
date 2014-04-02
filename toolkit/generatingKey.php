<?php

    include_once '../model/Database.php';
    include_once 'Toolkit.php';
    
    $keyGenerated = Toolkit::getKey();
    
    $reqAddKey = "INSERT INTO apikey VALUES('".$keyGenerated."');";
    Database::getOneData($reqAddKey);
    
    echo $keyGenerated;
?>
