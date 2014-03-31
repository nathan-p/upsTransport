
<?php

class Tisseo {
    
    public static function idZoneArretPaulSabatier(){ 
        $zonesArrets = file_get_contents('http://pt.data.tisseo.fr/stopAreasList?format=json&key=a03561f2fd10641d96fb8188d209414d8');
        $parsed_json_zonesArrets = json_decode($zonesArrets);
        $tabZonesArrets = $parsed_json_zonesArrets->{'stopAreas'}->{'stopArea'};
        $estTrouve = 0;
        $idZoneArretPaulSabatier = "";
        for ($i = 0; $i < count($tabZonesArrets) && !$estTrouve; $i++) {
            if (strstr($tabZonesArrets[$i]->{'name'}, "Université Paul Sabatier")) {
                $idZoneArretPaulSabatier = $tabZonesArrets[$i]->{'id'};
                $estTrouve = 1;
            }
        }
        
        return $idZoneArretPaulSabatier;
    } 
    
    public static function tabCodeOperateur($idZoneArretPaulSabatier){ 
        $poteauxArrets = file_get_contents('http://pt.data.tisseo.fr/stopPointsList?stopAreaId='.$idZoneArretPaulSabatier.'&format=json&network=Tiss%C3%A9o&key=a03561f2fd10641d96fb8188d209414d8');
        $parsed_json_poteauxArrets = json_decode($poteauxArrets);
        $tabPoteauxArrets = $parsed_json_poteauxArrets->{'physicalStops'}->{'physicalStop'};
        $tabCodeOperateur = array();
        $j = 0;
        $res = "";
        for ($i = 0; $i < count($tabPoteauxArrets); $i++) {
            $res = $tabPoteauxArrets[$i]->{'operatorCodes'};
            $tabCodeOperateur[$j] = $res[0]->{'operatorCode'}->{'value'};
            $j++;
        }
        
        return $tabCodeOperateur;
    }   
    
    public static function linesArrets($tabCodeOperateur) {
        $parsed_json_linesArrets = array();
        $j = 0;
        for ($i = 0; $i < count($tabCodeOperateur); $i++) {
            $linesArrets = file_get_contents('http://pt.data.tisseo.fr/departureBoard?operatorCode=' . $tabCodeOperateur[$i] . '&number=1&format=json&key=a03561f2fd10641d96fb8188d209414d8');
            $parsed_json_linesArrets[$j] = json_decode($linesArrets);
            $j++;
        }
        return $parsed_json_linesArrets;
    }
    
    public static function numLineArrets($parsed_json_linesArrets) {
        $tabLineArrets = array();
        $numLigne = array();
        $j = 0;
        for ($i = 0; $i < count($parsed_json_linesArrets); $i++) {
            $tabLineArrets = $parsed_json_linesArrets[$i]->{'departures'}->{'departure'};
            if (isset($tabLineArrets[0]->{'dateTime'})) {
                $numLigne[$j] = $tabLineArrets[0]->{'line'}->{'shortName'};
            }
            $j++;
        }
        return $numLigne;
    }
    
    public static function destinationLineArrets($parsed_json_linesArrets) {
        $tabLineArrets = array();
        $destinationLine = array();
        $tmp = "";
        $j = 0;
        for ($i = 0; $i < count($parsed_json_linesArrets); $i++) {
            $tabLineArrets = $parsed_json_linesArrets[$i]->{'departures'}->{'departure'};
            if (isset($tabLineArrets[0]->{'dateTime'})) {
                $tmp = $tabLineArrets[0]->{'destination'};
                $destinationLine[$j] = $tmp[0]->{'name'};
            }
            $j++;
        }
        return $destinationLine;
    }
    
    public static function horaireLineArrets($parsed_json_linesArrets) {
        $tabLineArrets = array();
        $horaireLigne = array();
        $j = 0;
        for ($i = 0; $i < count($parsed_json_linesArrets); $i++) {
            $tabLineArrets = $parsed_json_linesArrets[$i]->{'departures'}->{'departure'};
            if (isset($tabLineArrets[0]->{'dateTime'})) {
                $horaireLigne[$j] = $tabLineArrets[0]->{'dateTime'};
            }
            $j++;
        }
        return $horaireLigne;
    }
}

?>
