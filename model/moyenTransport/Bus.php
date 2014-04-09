<?php

class Bus {
    
    private $num;
    private $direction;
    
    public function __construct($_num, $_direction) {
        $this->setNum($_num);
        $this->setDirection($_direction);
    }
    
    public function getNum(){
        return $this->num;
    }

    public function setNum($_num) {
        $this->num = $_num;
    }
    
    public function getDirection(){
        return $this->direction;
    }

    public function setDirection($_direction) {
        $this->direction = $_direction;
    }
    
    public static function existeBusDansBD($object){ 
       $reqLigneExisteEnBD = "SELECT count(*) FROM BUS WHERE numBus='".$object->getNum()
                . "' AND directionBus='".htmlentities($object->getDirection())."';";

        $nbTuples = Database::getOneData($reqLigneExisteEnBD);
        return $nbTuples[0];
    } 
    
    public static function insererBusDansBd($object) {
        $reqAjouterLigneEnBD = "INSERT INTO BUS VALUES('".$object->getNum()."','"
                .htmlentities($object->getDirection())."',0,0);";
        Database::getOneData($reqAjouterLigneEnBD);
    }
    
    public static function getNbLikeBus($object) {
        $reqNbLike = "SELECT nbLike FROM BUS WHERE numBus='".$object->getNum()
                . "' AND directionBus='".htmlentities($object->getDirection())."';";

        $nbLike = Database::getOneData($reqNbLike);
        return $nbLike[0];
    }
    
    public static function getNbUnlikeBus($object) {
        $reqNbLike = "SELECT nbUnlike FROM BUS WHERE numBus='".$object->getNum()
                . "' AND directionBus='".htmlentities($object->getDirection())."';";

        $nbLike = Database::getOneData($reqNbLike);
        return $nbLike[0];
    }
    
    public static function getAllBus() {
        $rqt = "SELECT * FROM BUS";

        $res = Database::getAllData($rqt);
        return $res;
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
