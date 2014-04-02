<?php

class Vue {
    
    public static function affichInfoVelo() {
        echo '<div id="actu" class="center aligned column" >
                    <div class="ui animated list">
                        <div class="item ui piled segment ">
                            <img class="ui avatar image transport_lis_icon" src="images/velo.png">
                            <div class="content">
                                <div class="header">Vélo Toulouse</div>';
                                    $nbVeloDispo = Decaux::nbVeloDispo();
                                    $nbBorneTotal = Decaux::nbBorneTotal();
                                    $nbBorneDispo = Decaux::nbBorneDispo();
                                    $adresse = Decaux::adresse();
                                    echo "$adresse <br> Nombre de vélos disponibles : $nbVeloDispo";
                                    echo "<div class=\"more_infos\">";
                                    echo "Nombre de bornes : $nbBorneTotal <br> Nombre de bornes disponibles : $nbBorneDispo";
                                    echo "</div>";
                            echo '</div>
                            <div class="right floated ui"><br>
                                <i class="thumbs up icon like"></i>
                                <div class="infosAjax">VELO;227;Toulouse</div>
                                <span class="ui green circular label">';
                                echo Velo::afficherLikeVelo(227, "Toulouse");
                                echo '</span><br/><br/>
                                <i class="thumbs down icon unlike" style="margin-top: 2%;"></i>
                                <span class="ui red circular label">';
                                echo Velo::afficherUnlikeVelo(227, "Toulouse");
                                echo '</span>
                            </div>
                        </div>
                    </div>
                </div>';
    }
    
    public static function affichInfoBus() {
        echo '<div id="actu" class="center aligned column" >
                    <div class="ui animated list">';
                        $idZoneArretPaulSabatier = Tisseo::idZoneArretPaulSabatier();
                        $tabCodeOperateur = Tisseo::tabCodeOperateur($idZoneArretPaulSabatier);
                        $parsed_json_linesArrets = Tisseo::linesArrets($tabCodeOperateur);
                        $numLigne = Tisseo::numLineArrets($parsed_json_linesArrets);
                        $destinationLine = Tisseo::destinationLineArrets($parsed_json_linesArrets);
                        $horaireLigne = Tisseo::horaireLineArrets($parsed_json_linesArrets);
                        $j = 0;
                        for ($i = 0; $i < count($parsed_json_linesArrets); $i++) {
                            $tabLineArrets = $parsed_json_linesArrets[$i]->{'departures'}->{'departure'};
                            if (isset($tabLineArrets[0]->{'dateTime'})) { 
                                if(Bus::existeBusDansBD($numLigne[$j],$destinationLine[$j]) == 0){
                                    Bus::insererBusDansBd($numLigne[$j],$destinationLine[$j]);
                                }
                            }
                            $j++;
                        }
                        
                        $j = 0;
                        for ($i = 0; $i < count($parsed_json_linesArrets); $i++) {
                            $tabLineArrets = $parsed_json_linesArrets[$i]->{'departures'}->{'departure'};
                            if (isset($tabLineArrets[0]->{'dateTime'})) { 
                                //verifier s'il y a un "s" en fin de numero de ligne, "s" pour soir
                                if( substr($numLigne[$j],strlen($numLigne[$j])-1,strlen($numLigne[$j])) == "s"){
                                    $numLigne[$j] = substr($numLigne[$j], 0, strlen($numLigne[$j])-1);
                                }
                              
                                $nbLike = Bus::nbLikeBus($numLigne[$j],$destinationLine[$j]);
                                
                                if ($nbLike < 10) {
                                    $nbLike = $nbLike."&nbsp;";
                                }
                                
                                $nbUnlike = Bus::nbUnlikeBus($numLigne[$j],$destinationLine[$j]);
                                
                                if ($nbUnlike < 10) {
                                    $nbUnlike = $nbUnlike . "&nbsp;";
                                }
                                
                                $horaire = new DateTime($horaireLigne[$j]);
                                $arriveDans = Toolkit::arriveDans($horaireLigne[$j]);
                                if ($arriveDans == 0) {
                                    $arriveDans = "un instant";
                                } else {
                                    $arriveDans = $arriveDans . " min";
                                }
                                echo '
                                <div class = "item ui piled segment">
                                    <img class = "ui avatar image transport_lis_icon" src = "images/bus.png">
                                    <div class = "content">
                                        <div class = "header">Ligne ' . $numLigne[$j] . '</div>
                                            Bus en direction de ' . $destinationLine[$j] . '<br>Arrivée dans ' . $arriveDans . '
                                        <div class="more_infos">
                                            Heure d\'arrivée : ' . $horaire->format('H:i') . '  
                                        </div>
                                    </div>
                                    <div class = "right floated ui"><br>
                                        <i class="thumbs up icon like" ></i>
                                        <div class="infosAjax">BUS;' . $numLigne[$j] . ';'.$destinationLine[$j].'</div>
                                        <span class="ui green circular label">' . $nbLike . '</span><br><br/>
                                        <i class="thumbs down icon unlike" style="margin-top: 2%;"></i>
                                        <span class="ui red circular label">' . $nbUnlike . '</span>
                                    </div>
                                </div >';
                            }
                            $j++;
                        }
          echo '</div></div>';                    
    }
    
    public static function affichInfoMetro() {
        //Google::dureeTrajetVelo();
        echo '<div class="ui animated list">
            <div class="item ui piled segment">
                            <img class="ui avatar image transport_lis_icon" src="images/metro.png">
                            <div class="content">
                                <div class="header">Metro ligne B</div>
                                Direction Ramonville <br>Arrivée toutes les ';
                                echo substr(Toolkit::getHoraire(), 0, 1).' min';
                                if (substr(Toolkit::getHoraire(), 1, 2) != 0) {
                                    echo " ".substr(Toolkit::getHoraire(), 1, 3).' s ';
                                }
                            echo '</div>
                            <div class="right floated ui"><br>
                                <i class="thumbs up icon like"></i>
                                <div class="infosAjax">METRO;B;Ramonville</div>
                                <span class="ui green circular label">';
                                    echo Metro::afficherLikeMetro("B", "Ramonville");
                                echo '</span><br><br>
                                <i class="thumbs down icon unlike" style="margin-top: 2%;"></i>
                                <span class="ui red circular label">';
                                     echo Metro::afficherUnlikeMetro("B", "Ramonville");
                                echo '</span>
                            </div>
                        </div>
                        <div class="item ui piled segment">
                            <img class="ui avatar image transport_lis_icon" src="images/metro.png">
                            <div class="content">
                                <div class="header">Metro ligne B</div>
                                Direction Borderouge <br>Arrivée toutes les ';
                                echo substr(Toolkit::getHoraire(), 0, 1).' min';
                                if (substr(Toolkit::getHoraire(), 1, 2) != 0) {
                                    echo " ".substr(Toolkit::getHoraire(), 1, 3).' s ';
                                }
                            echo '</div>
                            <div class="right floated ui"><br>
                                <i class="thumbs up icon like"></i>
                                <div class="infosAjax">METRO;B;Borderouge</div>
                                <span class="ui green circular label">';
                                     echo Metro::afficherLikeMetro("B", "Borderouge");
                                echo '</span><br><br>
                                <i class="thumbs down icon unlike" style="margin-top: 2%;"></i>
                                <span class="ui red circular label">';
                                    echo Metro::afficherUnlikeMetro("B", "Borderouge");
                                echo '</span>
                            </div>
                        </div></div>';
    }
    
    public static function affichInfoItineraire() {
        echo '<div class="ui two column middle aligned relaxed grid basic segment">
                <div id="itineraire" class="aligned column">
                    <div class="ui form segment">
                        <div class="field">
                            <h5>ADRESSE</h5>
                            <div class="ui left labeled icon input">
                                <input type="text" placeholder="Veuillez rentrer votre destination">
                                <i class="map marker icon"></i>
                                <div class="ui corner label">
                                    <i class="asterisk icon"></i>
                                </div> 
                            </div>

                        </div>
                        <div class="ui blue submit button">RECHERCHER</div>
                    </div>

                </div></div>';
    }
}

?>