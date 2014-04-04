<?php

class Velo {
    
    private $station;
    private $destination;
    
    public function __construct($_station, $_destination) {
        $this->setStation($_station);
        $this->setDestination($_destination);
    }
    
    public function getStation(){
        return $this->station;
    }

    public function setStation($_station) {
        $this->station = $_station;
    }
    
    public function getDestination(){
        return $this->destination;
    }

    public function setDestination($_destination) {
        $this->destination = $_destination;
    }
     
    public static function getNbBorneTotal($object){ 
        $var = 'https://api.jcdecaux.com/vls/v1/stations/'.$object->getStation().'?contract=Toulouse&apiKey=1ef4a16b7ad8c600c6e505f8a5d1167fe873de42';
        $velo = file_get_contents($var);
        $parsed_json_velo = json_decode($velo);
        $nbBorneTotal = $parsed_json_velo->{'bike_stands'};
        
        return $nbBorneTotal;
    } 
    
    public static function getNbBorneDispo($object){ 
        $var = 'https://api.jcdecaux.com/vls/v1/stations/'.$object->getStation().'?contract=Toulouse&apiKey=1ef4a16b7ad8c600c6e505f8a5d1167fe873de42';
        $velo = file_get_contents($var);
        $parsed_json_velo = json_decode($velo);
        $nbBorneDispo = $parsed_json_velo->{'available_bike_stands'};
        
        return $nbBorneDispo;
    } 
    
    public static function estOuvert($object){ 
        $var = 'https://api.jcdecaux.com/vls/v1/stations/'.$object->getStation().'?contract=Toulouse&apiKey=1ef4a16b7ad8c600c6e505f8a5d1167fe873de42';
        $velo = file_get_contents($var);
        $parsed_json_velo = json_decode($velo);
        $ouvert = $parsed_json_velo->{'status'};
        
        return $ouvert;
    }
    
    public static function getAdresse($object){ 
        $var = 'https://api.jcdecaux.com/vls/v1/stations/'.$object->getStation().'?contract=Toulouse&apiKey=1ef4a16b7ad8c600c6e505f8a5d1167fe873de42';
        $velo = file_get_contents($var);
        $parsed_json_velo = json_decode($velo);
        $adresse = $parsed_json_velo->{'address'};
        
        return $adresse;
    }
    
    public static function getNbVeloDispo($object){ 
        $var = 'https://api.jcdecaux.com/vls/v1/stations/'.$object->getStation().'?contract=Toulouse&apiKey=1ef4a16b7ad8c600c6e505f8a5d1167fe873de42';
        $velo = file_get_contents($var);
        $parsed_json_velo = json_decode($velo);
        $nbVeloDispo = $parsed_json_velo->{'available_bikes'};
        
        return $nbVeloDispo;
    }
    
    public static function getNbLikeVelo($object) {
        $reqNbLike = "SELECT nbLike FROM VELO WHERE idVelo=".$object->getStation().
                " AND contratVelo='".$object->getDestination()."';";
        $nbLike = Database::getOneData($reqNbLike);
        return $nbLike[0];
    }

    public static function getNbUnlikeVelo($object) {
        $reqNbUnlike = "SELECT nbUnlike FROM VELO WHERE idVelo=".$object->getStation().
                " AND contratVelo='".$object->getDestination()."';";
        $nbUnlike = Database::getOneData($reqNbUnlike);
        return $nbUnlike[0];
    }
}

?>
