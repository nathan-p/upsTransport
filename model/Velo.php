<?php

class Velo {
    public static function afficherLikeVelo($num, $dest) {
        $reqNbLike = "SELECT nbLike FROM VELO WHERE idVelo=" . $num .
                " AND contratVelo='" . $dest . "';";
        $nbLike = Database::getOneData($reqNbLike);
        return $nbLike[0];
    }

    public static function afficherUnlikeVelo($num, $dest) {
        $reqNbUnlike = "SELECT nbUnlike FROM VELO WHERE idVelo=" . $num .
                " AND contratVelo='" . $dest . "';";
        $nbUnlike = Database::getOneData($reqNbUnlike);
        return $nbUnlike[0];
    }
}

?>
