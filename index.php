<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>UPS TRANSPORT</title>
        <link rel="stylesheet" type="text/css" href="css/semantic.css">
        <link rel="stylesheet" type="text/css" href="css/index.css">
        <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.js"></script>
        <script src="javascript/semantic.js"></script>

    </head>  
    <body>
        <?php
        include 'transportCommun.php';
        include_once 'controller/Database.php';

        $db = new Database();
        $db->getConnection();
        ?>
        <header id="header" class="test">
            <div class="logo"><img  src="images/logo2.png"></div>

        </header><!-- /header -->

        <div id="corps">
            <div class="ui two column middle aligned relaxed grid basic segment">
                <div id="actu" class="center aligned column" >
                    <h2 class="section">TRANSPORTS EN COMMUN DISPONIBLES</h2><br>

                    <div class="ui animated list">
                        <?php
                        $j = 0;
                        for ($i = 0; $i < count($parsed_json_linesArrets); $i++) {
                            $tabLineArrets = $parsed_json_linesArrets[$i]->{'departures'}->{'departure'};
                            if (isset($tabLineArrets[0]->{'dateTime'})) {

                                $reqNbLike = "SELECT nbLike FROM USERLIKE WHERE numLigne=" . $numLigne[$j] . " AND moyenTransport='BUS';";
                                $nbLike = $db->getOneData($reqNbLike);

                                $nbLike = $nbLike[0];
                                if ($nbLike < 10) {
                                    $nbLike = $nbLike . "&nbsp;";
                                }

                                $horaire = new DateTime($horaireLigne[$j]);
                                $arriveDans = arriveDans($horaireLigne[$j]);
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
                                        <div class="infosAjax">BUS;' . $numLigne[$j] . '</div>
                                        <span class="ui green circular label">' . $nbLike . '</span><br>
                                        <i class="thumbs down icon unlike" style="margin-top: 2%;"></i>
                                        <span class="ui red circular label">19</span>
                                    </div>
                                </div >';
                            }
                            $j++;
                        }
                        ?>

                        <div class="item ui piled segment">
                            <img class="ui avatar image transport_lis_icon" src="images/metro.png">
                            <div class="content">
                                <div class="header">Metro ligne B</div>
                                Direction Ramonville <br>Arrivée dans 12min
                            </div>
                            <div class="right floated ui"><br>
                                <i class="thumbs up icon like"></i>
                                <div class="infosAjax">METRO;1</div>
                                <span class="ui green circular label">12</span><br>
                                <i class="thumbs down icon unlike" style="margin-top: 2%;"></i>
                                <span class="ui red circular label">13</span>
                            </div>
                        </div>
                        <div class="item ui piled segment">
                            <img class="ui avatar image transport_lis_icon" src="images/metro.png">
                            <div class="content">
                                <div class="header">Metro ligne B</div>
                                Direction Borderouge <br>Arrivée dans 7min
                            </div>
                            <div class="right floated ui"><br>
                                <i class="thumbs up icon like"></i>
                                <div class="infosAjax">METRO;0</div>
                                <span class="ui green circular label">11</span><br>
                                <i class="thumbs down icon unlike" style="margin-top: 2%;"></i>
                                <span class="ui red circular label">19</span>
                            </div>
                        </div>
                        <div class="item ui piled segment ">
                            <img class="ui avatar image transport_lis_icon" src="images/velo.png">
                            <div class="content">
                                <div class="header">Vélo Toulouse</div>
                                <?php
                                echo "$adresse <br> Nombre de vélos disponibles : $nbVeloDispo"
                                ?>
                                <div class="more_infos">
                                    <?php
                                    echo "Nombre de bornes : $nbBorneTotal <br> Nombre de bornes disponibles : $nbBorneDispo"
                                    ?>   
                                </div>
                            </div>
                            <div class="right floated ui"><br>
                                <i class="thumbs up icon like"></i>
                                <div class="infosAjax">VELO;227</div>
                                <span class="ui green circular label">16</span><br>
                                <i class="thumbs down icon unlike" style="margin-top: 2%;"></i>
                                <span class="ui red circular label">10</span>
                            </div>


                        </div>
                    </div>

                </div>
                <div class="ui vertical divider">
                    OU
                </div>
                <div id="itineraire" class="aligned column">
                    <h2 class="section">RENTRER CHEZ MOI</h2><br>
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

                </div>


            </div>
        </div>
    </div><br><br>
    <footer>
        <br><br><br><center>
            UPS TRANSPORT - UE INTEROPERABILITE DES APPLICATIONS ET DES WEB SERVICES - Laurine Marmisse / Nathan Prior
        </center>
        <br><br><br>
    </footer>

    <script>
        
        //parcourir tous les bus et regarder si on a un localstorage
        
        
        
        
        
        //affichages des infos suplementaire    
        $( ".content" ).click(function() {
            $(this).children(".more_infos").toggleClass( "more_infos_active" );         
        });
           
        $(".like").click(function() {
            var dataAjax = $(this).next().text();
            var ligne = dataAjax.split(";");
            ligne = ligne[1];
            var elt = $(this);
            
            if(localStorage.getItem(ligne) == "like" ){
                alert("DEJA LIKER   ligne "+ligne +"  "+  localStorage.getItem(ligne));
                //removeItem(ligne);
            }
            else
            {
            
                //alert(dataAjax);
                $.ajax({
                    type: "POST",
                    url: "like.php",
                    data: {data:dataAjax},
                    success: function(msg){
                        //alert(msg);
                        labelLike = elt.parent().children(".green");
                        //alert(elt.next().text()+" TEST : "+elt.parent().children(".green").text());
                        labelLike.html(msg);
                   
                    }
                });
            
                localStorage.setItem(ligne, "like");
            
                //changer l'icone en like/unlike
                $(this).css('color','green');
                $(this).next().next().next().css('color','blue');
            
                
            }
            
          
          
        });
                             
    </script>
</body>
</html>
