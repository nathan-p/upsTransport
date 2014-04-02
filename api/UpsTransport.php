<?php
    include_once '../model/Database.php';
    include_once '../api/Tisseo.php';
    include_once '../api/Decaux.php';
    
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
                  echo "<h1>metro</h1>";
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