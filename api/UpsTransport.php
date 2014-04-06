<?php

    require_once("../model/Database.php");
    
    require_once("../api/ApiKey.php");
    
    require_once("../model/moyenTransport/Bus.php");
    require_once("../model/moyenTransport/Velo.php");
    require_once("../model/moyenTransport/Metro.php");
    
    require_once("../toolkit/Toolkit.php");
    require_once("../toolkit/Tisseo.php");
    require_once("../toolkit/Google.php");
    
    if(isset($_GET['key'])){
        
        $key = $_GET['key'];
        $keyValid = false;

        if(ApiKey::isValidKey($key) == 1){
            $keyValid = true;
        }
    
        if($keyValid){
            if(isset($_GET['bus'])) {
                $zonesArrets = Tisseo::linesArrets(Tisseo::tabCodeOperateur(Tisseo::idZoneArretPaulSabatier()));;
                echo json_encode($zonesArrets);
                
            } else if(isset($_GET['metro'])) {
                $ligne ="B";
                $direction1 ="Ramonville";
                $direction2 ="Borderouge";
                 
                $passageTimeSec ="";
                $passageTimeMin = substr(Toolkit::getHoraire(), 0, 1).'min';
                if (substr(Toolkit::getHoraire(), 1, 2) != 0) {
                        $passageTimeSec = substr(Toolkit::getHoraire(), 1, 3).'s ';
                }
                $passageTime = $passageTimeMin.$passageTimeSec;
                $metro1 = array("line"=>$ligne,"destination"=>$direction1,"passageTime"=>$passageTime);
                $metro2 = array("line"=>$ligne,"destination"=>$direction1,"passageTime"=>$passageTime);
                $metro = array($metro1,$metro2);
                echo json_encode($metro);
                
            } else if(isset($_GET['velo'])) {
                $velo = new Velo(227, "Toulouse");
                $velo = array("numStation"=>227,"adress"=>Velo::getAdresse($velo),
                    "nbBorneTotal"=>Velo::getNbBorneTotal($velo),"nbBorneDispo"=>Velo::getNbBorneDispo($velo),
                    "nbVeloDispo"=>Velo::getNbVeloDispo($velo),"statut"=>Velo::estOuvert($velo));
                echo json_encode($velo);               
            }
        } else {
            echo "Votre clef est invalide ! V&eacute;rifiez que vous l'ayez rentr&eacute;e correctement.";
        }
    }else {
        echo "Une clef est requise ! Vous pouvez la demander sur le site UPSTransport";
    }

?>