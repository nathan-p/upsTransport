<?php

class Toolkit {
    
    private static function arriveDans($horaire) {
        $now = date('Y-m-d H:i:s');
        $datetime1 = new DateTime($now);
        $datetime2 = new DateTime($horaire);
        $interval = $datetime1->diff($datetime2);
        return $interval->format('%i');
    }
}

?>
