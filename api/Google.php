<?php

class Google {

    public static function dureeTrajetVelo() {
        $trajet = file_get_contents('https://maps.googleapis.com/maps/api/directions/json?origin=Universit%C3%A9PaulSabatier&destination=Figeac&mode=bicycling&sensor=false&key=AIzaSyAaspHQw2EYKhz9zXwu-_6g1RozGe4K_co');
        $parsed_json_trajet = json_decode($trajet);
        print_r($parsed_json_trajet);
    }
 
}
