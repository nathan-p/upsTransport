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
    
    public static function affichInfoAPI() {
        echo "L' API mise à disposition ici permet de récupérer les données de l'application.
          Elle est accessible par l'appel d'un lien de type : <br/><br/>
          <center><b>http://127.0.0.1/upsTransport/api/UpsTransport.php?[moyen_de_transport]&key=[votre_cle]</b></center>
          <br/>
          [moyen_de_transport] : 
          <ul>
              <li>bus : </li>
              <li>métro : </li>
              <li>vélo : </li>
          </ul>
          L'API fournit dans la mesure du possible un format JSON.
          <br/><br/>
          L'utilisation de l'API est soumise à l'utilisation d'une clé attribuée à chaque demandeur. 
          Cette clé doit être transmise lors de chaque appel. Pour obtenir une clé, rien de plus simple, 
          appuyez sur le bouton ci-dessous et vous vous verrez attribuer instantanément une clé d'accès à notre API.
          <br/><br/> 
          <center>
          <div class=\"ui button\" onclick=\"genererCle();\">
            DEMANDER UNE CLE
          </div>
          <br/><br/>
          <div id=\"affKey\"></div>
          </center>";
    }
    
    public static function affichInfoHome() {
        echo "<h3>Contexte</h3>Dans le cadre de l'UE Intéropérabilité des Applications et Introduction au Web Services"
        . " du Master 1 Informatique à l'Université Paul Sabatier, <b>Laurine MARMISSE et Nathan Prior</b> ont développé "
        . "ce site Web permettant à vous, personnels de l'Université, de vous déplacer le plus efficacement possible pour quitter l'Université. ";
        echo "<h3>Fonctionnalités</h3>L'ensemble des stories, que vous avez demandées, ont été développées dans ce site Web et ont été regroupées dans différents onglets. Voici une etite explication de chaque contenu :"
        ."<ul><li>Les onglets <b>Bus</b> et <b>Métro</b> mettent en évidence dans combien de temps arrive les prochains bus/métro partant de l'Université Paul Sabatier."
                . "Pour chacun de ces moyens de transports, vous pouvez liker / disliker la ligne pour participer à l'évaluation de sa fiabilité. A côté de chaque symbole, "
                . "vous pourrez apercevoir le nombre de personnes ayant effectué le même choix que vous. A noter que les horaires du métro est calculé sous forme de plage horaires.</li>"
        . "<li>L'onglet <b>Vélo</b> indique le nombre de vélos disponibles ainsi que le nombre de bornes disponibles et effectives pour la station de vélo de l'Université Paul Sabatier.</li>"
        . "<li>L'onglet <b>Itinéraire</b> :</li>"
        . "<li>L'onglet <b>API</b> </li></ul>";
        echo "<h3>Ressources utilisées</h3>L'objectif principal de ce site était de développer et de consommer des services Web. "
        . "Différentes API ont donc été mis à la disposition des étudiants pour répondre efficacement à vos exigences :<br/><br/>"
        . "<center><img src='./images/tisseo.jpg' height='100px' style='vertical-align:middle'></center><br/>"
                . "> Grâce à l'<b>API de Tisséo</b>, vous pouvez ainsi connaître dans combien de temps arrive le prochain bus/métro sur la ligne de "
                . "votre choix et pour l'un des arrêts de l'Université Paul Sabatier.<br/><br/>"
                . "<center><img src='./images/decaux.png' height='100px' style='vertical-align:middle'></center><br/>"
                . "> Grâce à l'<b>Api de Decaux</b>, vous pouvez désormais savoir si la station de VélôToulouse de l'Université Paul Sabatier "
                . "a des vélos disponibles.<br/><br/>"
                . "<center><img src='./images/google.jpg' height='100px' style='vertical-align:middle'></center><br/>"
                . "Grâce à l'<b>Api de Google Maps</b>, vous permet enfin de chosir le moyen de transport le plus rapide pour rentrer chez vous.<br/><br/>";
    }
}

?>