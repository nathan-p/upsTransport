<?php

    require_once('../model/Database.php');
    require_once('../toolkit/Toolkit.php');
    
    $keyGenerated = Toolkit::getKey();
    
    $reqAddKey = "INSERT INTO apikey VALUES('".$keyGenerated."');";
    Database::getOneData($reqAddKey);
    
    echo $keyGenerated; 
?>
