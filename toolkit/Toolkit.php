<?php

class Toolkit {
    
    public static function arriveDans($horaire) {
        $now = date('Y-m-d H:i:s');
        $datetime1 = new DateTime($now);
        $datetime2 = new DateTime($horaire);
        $interval = $datetime1->diff($datetime2);
        return $interval->format('%i');
    }
    
    public static function heureReelle($minute) {
        date_default_timezone_set('Etc/GMT-2');
        $h1=date("Y-m-d H:i:s"); 
        $h2 = strtotime('+'.$minute.' minute');
        return date('H:i', $h2);
    }
    
    public static function getHoraire(){ 
       date_default_timezone_set('Etc/GMT-2');
       $jour = date("l"); // monday ...
       $numJour = date("j"); // de 1 à 31
       $semaine = date("W");
       $mois = date("n"); // de 1 à 12
       $heure = date("G"); // de 0 à 23
       $minute = date("i"); // de 00 à 59
       
       $heurePointe = (($heure >= 7 && $heure <= 8) 
                    || ($heure == 11 && $minute >= 30) || $heure == 12 || ($heure == 13 && $minute < 30) 
                    || ($heure == 17 && $minute >= 30) || $heure == 18 || ($heure == 19 && $minute < 30));
       $heureCreuse = (($heure >= 9 && $heure <= 10) || ($heure == 11 && $minute < 30) 
                    || ($heure == 13 && $minute >= 30) || ($heure >= 14 && $heure <= 16) || ($heure == 17 && $minute < 30)); 
       $matin = (($heure == 5 && minute >= 15) || $heure == 6);
           
       $enSoireSemaine = ($heure == 19 && $minute >= 30) || ($heure >= 20 && $heure <= 23);
       $enSoireHorsSemaine = ($heure == 19 && $minute >= 30) || ($heure >= 20 && $heure <= 22);
       
       $minuteAttente = 0;
       $secondeAttente = 00;
       
       if ($jour != "Sunday") {
            if ($matin) {
                $minuteAttente = 9;
            } else if ($heurePointe) {
                $minuteAttente = 1;
                $secondeAttente = 20;
            } else if ($heureCreuse) {
                $minuteAttente = 5;    
            } else if ($enSoireSemaine && ($jour != "Friday" || $jour != "Saturday")) {
                $minuteAttente = 7;    
            } else if ($enSoireHorsSemaine && ($jour == "Friday" || $jour == "Saturday")) {
                $minuteAttente = 4;    
            } else {
                return "Pas de métro à cette heure ci.";
            }
       } else { // dimanche
           $minuteAttente = 7;
       }      
       return $minuteAttente.$secondeAttente;
    } 
    
    public static function getKey() {
        $chars = '0123456789abcdefghijklmnopqrstuvwxyz'; // Certains caract�res ont �t� enlev�s car ils pr�tent � confusion
        $rand_str = '';
        for ($i = 0; $i < 33; $i++) {
          $rand_str .= $chars{ mt_rand( 0, strlen($chars)-1 ) };
        }
        return $rand_str;
    }
    
    public static function comparerLines($linesDestination) {
        $numLigne = array();
        $destinationLigne = array();
        $retour = array();
        $l = 0;
        for ($k = 0; $k < count($linesDestination); $k++)  {
            $res = explode("!",$linesDestination[$k]);
            $numLigne[$l] = $res[0];
            $destinationLigne[$l] = $res[1];
            $l++;
        }
        
        $bus = Bus::getAllBus();
        $j=0;
        foreach($bus as $row){
            for ($i = 0; $i < count($numLigne); $i++) { 
                if ($row['numBus'] == $numLigne[$i] && $row['directionBus'] == htmlentities($destinationLigne[$i])) {
                    $retour[$j] = $numLigne[$i].'!'.$destinationLigne[$i];
                    $j++;
                }
            }
        }
        
        return $retour;
    }
}

?>
