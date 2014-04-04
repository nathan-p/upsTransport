<?php

class Google {

    public static function dureeTrajetVelo($dest) {
        
        //https://maps.googleapis.com/maps/api/directions/json?origin=Universit%C3%A9PaulSabatier&destination=Gleyze-Vieille&mode=bicycling&sensor=false&key=AIzaSyAaspHQw2EYKhz9zXwu-_6g1RozGe4K_co
        $req ='https://maps.googleapis.com/maps/api/directions/json?origin=Universit%C3%A9PaulSabatier&destination='.$dest.'&mode=bicycling&sensor=false&key=AIzaSyAaspHQw2EYKhz9zXwu-_6g1RozGe4K_co';
        //echo $req."<br>";
        $trajet = file_get_contents('https://maps.googleapis.com/maps/api/directions/json?origin=Universit%C3%A9PaulSabatier&destination=Gleyze-Vieille&mode=bicycling&sensor=false&key=AIzaSyAaspHQw2EYKhz9zXwu-_6g1RozGe4K_co');
        $parsed_json_trajet = json_decode($trajet);
        var_dump($parsed_json_trajet->{'routes'});
        print_r($parsed_json_trajet);
    }
    
    public static function dureeTrajetVoiture($dest) {
        echo "Dest : ".$dest."<br>";
        //https://maps.googleapis.com/maps/api/directions/json?origin=Universit%C3%A9PaulSabatier&destination=Gleyze-Vieille&sensor=false&key=AIzaSyAaspHQw2EYKhz9zXwu-_6g1RozGe4K_co
        $req ='https://maps.googleapis.com/maps/api/directions/json?origin=Universit%C3%A9PaulSabatier&destination='.$dest.'&sensor=false&key=AIzaSyAaspHQw2EYKhz9zXwu-_6g1RozGe4K_co';
        echo $req;
        $trajet = file_get_contents($req);
        $parsed_json_trajet = json_decode($trajet);
        
        print_r($parsed_json_trajet);
    }
 
}