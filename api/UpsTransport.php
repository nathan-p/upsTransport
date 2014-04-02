<?php
    include_once '../model/Database.php';
    include_once 'Tisseo.php';
    include_once 'Decaux.php';
    include_once '../toolkit/Toolkit.php';
    
    if(isset($_GET['key'])){
        
        $key = $_GET['key'];
        $keyValid = false;

        $reqKeyExisteEnBD = "SELECT count(*) FROM apiKey WHERE ref='".$key."';";
        $result = Database::getOneData($reqKeyExisteEnBD);

        if( $result[0] == 1){
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
                $adresse= Decaux::adresse();
                $nbBorneTotal= Decaux::nbBorneTotal();
                $nbBorneDispo = Decaux::nbBorneDispo();
                $nbVeloDispo= Decaux::nbVeloDispo();
                $ouvert= Decaux::ouvert();
                $velo = array("adress"=>$adresse,"nbBorneTotal"=>$nbBorneTotal,"nbBorneDispo"=>$nbBorneDispo,
                    "nbVeloDispo"=>$nbVeloDispo,"ouvert"=>$ouvert);
                echo json_encode($velo);
                
            }
        } else {
            echo "La clef est invalide ...";
        }
    }else {
        echo "Une clef est requise ....";
    }

?>