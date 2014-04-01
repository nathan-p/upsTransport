<?php

class Toolkit {
    
    public static function arriveDans($horaire) {
        $now = date('Y-m-d H:i:s');
        $datetime1 = new DateTime($now);
        $datetime2 = new DateTime($horaire);
        $interval = $datetime1->diff($datetime2);
        return $interval->format('%i');
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
       $secondeAttente = 0;
       
       if ($jour != "Sunday") {
            if ($matin) {
                $secondeAttente = 9*60;
            } else if ($heurePointe) {
                $secondeAttente = 80;
            } else if ($heureCreuse) {
                $secondeAttente = 5*60;    
            } else if ($enSoireSemaine && ($jour != "Friday" || $jour != "Saturday")) {
                $secondeAttente = 7*60;    
            } else if ($enSoireHorsSemaine && ($jour == "Friday" || $jour == "Saturday")) {
                $secondeAttente = 4*60;    
            } else {
                echo "erreur";
            }
       } else { // dimanche
           $secondeAttente = 7*60;
       }      
       echo $secondeAttente;
    } 
}

?>
