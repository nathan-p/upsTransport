<?php

class Decaux {
    
    public static function nbBorneTotal(){ 
        $velo = file_get_contents('https://api.jcdecaux.com/vls/v1/stations/227?contract=Toulouse&apiKey=1ef4a16b7ad8c600c6e505f8a5d1167fe873de42');
        $parsed_json_velo = json_decode($velo);
        $nbBorneTotal = $parsed_json_velo->{'bike_stands'};
        
        return $nbBorneTotal;
    } 
    
    public static function nbBorneDispo(){ 
        $velo = file_get_contents('https://api.jcdecaux.com/vls/v1/stations/227?contract=Toulouse&apiKey=1ef4a16b7ad8c600c6e505f8a5d1167fe873de42');
        $parsed_json_velo = json_decode($velo);
        $nbBorneDispo = $parsed_json_velo->{'available_bike_stands'};
        
        return $nbBorneDispo;
    } 
    
    public static function ouvert(){ 
        $velo = file_get_contents('https://api.jcdecaux.com/vls/v1/stations/227?contract=Toulouse&apiKey=1ef4a16b7ad8c600c6e505f8a5d1167fe873de42');
        $parsed_json_velo = json_decode($velo);
        $ouvert = $parsed_json_velo->{'status'};
        
        return $ouvert;
    }
    
    public static function adresse(){ 
        $velo = file_get_contents('https://api.jcdecaux.com/vls/v1/stations/227?contract=Toulouse&apiKey=1ef4a16b7ad8c600c6e505f8a5d1167fe873de42');
        $parsed_json_velo = json_decode($velo);
        $adresse = $parsed_json_velo->{'address'};
        
        return $adresse;
    }
    
    public static function nbVeloDispo(){ 
        $velo = file_get_contents('https://api.jcdecaux.com/vls/v1/stations/227?contract=Toulouse&apiKey=1ef4a16b7ad8c600c6e505f8a5d1167fe873de42');
        $parsed_json_velo = json_decode($velo);
        $nbVeloDispo = $parsed_json_velo->{'available_bikes'};
        
        return $nbVeloDispo;
    }
}

?>
