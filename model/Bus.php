<?php

class Bus {
    
    public static function existeBusDansBD($numLigne, $destinationLine){ 
       $reqLigneExisteEnBD = "SELECT count(*) FROM BUS WHERE numBus='". $numLigne
                . "' AND directionBus='".htmlentities($destinationLine)."';";

        $nbTuples = Database::getOneData($reqLigneExisteEnBD);
        return $nbTuples[0];
    } 
    
    public static function insererBusDansBd($numLigne, $destinationLine) {
        $reqAjouterLigneEnBD = "INSERT INTO BUS VALUES('".$numLigne."','".htmlentities($destinationLine)."',0,0);";
        Database::getOneData($reqAjouterLigneEnBD);
    }
    
    public static function nbLikeBus($numLigne, $destinationLine) {
        $reqNbLike = "SELECT nbLike FROM BUS WHERE numBus='". $numLigne
                . "' AND directionBus='".htmlentities($destinationLine)."';";

        $nbLike = Database::getOneData($reqNbLike);
        return $nbLike[0];
    }
    
    public static function nbUnlikeBus($numLigne, $destinationLine) {
        $reqNbLike = "SELECT nbUnlike FROM BUS WHERE numBus='". $numLigne
                . "' AND directionBus='".htmlentities($destinationLine)."';";

        $nbLike = Database::getOneData($reqNbLike);
        return $nbLike[0];
    }
}

?>
