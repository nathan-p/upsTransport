<?php

class ApiKey {
    
    public static function isValidKey($key) {
        $reqKeyExisteEnBD = "SELECT count(*) FROM apiKey WHERE ref='".$key."';";
        $result = Database::getOneData($reqKeyExisteEnBD);
        
        return $result[0];
    }
}

?>
