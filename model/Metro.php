<?php

class Metro {
    public static function afficherLikeMetro($num, $dest) {
        $reqNbLike = "SELECT nbLike FROM METRO WHERE idMetro='" . $num .
                "' AND directionMetro='" . $dest . "';";
        $nbLike = Database::getOneData($reqNbLike);
        return $nbLike[0];
    }

    public static function afficherUnlikeMetro($num, $dest) {
        $reqNbUnlike = "SELECT nbUnlike FROM METRO WHERE idMetro='" . $num .
                "' AND directionMetro='" . $dest . "';";
        $nbUnlike = Database::getOneData($reqNbUnlike);
        return $nbUnlike[0];
    }
}

?>
