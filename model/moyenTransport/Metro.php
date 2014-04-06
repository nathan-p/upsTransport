<?php

class Metro {
    
    private $id;
    private $direction;
    
    public function __construct($_id, $_direction) {
        $this->setId($_id);
        $this->setDirection($_direction);
    }
    
    public function getId(){
        return $this->id;
    }

    public function setId($_id) {
        $this->id = $_id;
    }
    
    public function getDirection(){
        return $this->direction;
    }

    public function setDirection($_direction) {
        $this->direction = $_direction;
    }
    
    public static function getNbLikeMetro($object) {
        $reqNbLike = "SELECT nbLike FROM METRO WHERE idMetro='".$object->getId().
                "' AND directionMetro='".$object->getDirection()."';";
        $nbLike = Database::getOneData($reqNbLike);
        return $nbLike[0];
    }

    public static function getNbUnlikeMetro($object) {
        $reqNbUnlike = "SELECT nbUnlike FROM METRO WHERE idMetro='".$object->getId().
                "' AND directionMetro='".$object->getDirection()."';";
        $nbUnlike = Database::getOneData($reqNbUnlike);
        return $nbUnlike[0];
    }
}

?>
