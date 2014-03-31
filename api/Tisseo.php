
<?php

class Tisseo {
    private static $cle = a03561f2fd10641d96fb8188d209414d8;
    
    public static function idZoneArretPaulSabatier(){ 
        $zonesArrets = file_get_contents('http://pt.data.tisseo.fr/stopAreasList?format=json&key='.$cle);
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
        $poteauxArrets = file_get_contents('http://pt.data.tisseo.fr/stopPointsList?stopAreaId='.$idZoneArretPaulSabatier.'&format=json&network=Tiss%C3%A9o&key='.$cle);
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
}

?>
