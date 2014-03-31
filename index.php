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
        include_once 'model/Database.php';

        $db = new Database();
        //$db->getConnection();
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
                                $reqLigneExisteEnBD = "SELECT count(*) FROM BUS WHERE numBus='" . $numLigne[$j]
                                        . "' AND directionBus='" . htmlentities($destinationLine[$j]) . "';";
                                $nbTuples = $db->getOneData($reqLigneExisteEnBD);

                                if ($nbTuples[0] == 0) {
                                    $reqAjouterLigneEnBD = "INSERT INTO BUS VALUES('"
                                            . $numLigne[$j] . "','" . htmlentities($destinationLine[$j]) . "',0,0);";
                                    $db->getOneData($reqAjouterLigneEnBD);
                                }
                            }
                            $j++;
                        }

                        $j = 0;
                        for ($i = 0; $i < count($parsed_json_linesArrets); $i++) {
                            $tabLineArrets = $parsed_json_linesArrets[$i]->{'departures'}->{'departure'};
                            if (isset($tabLineArrets[0]->{'dateTime'})) {
                                //verifier s'il y a un "s" en fin de numero de ligne, "s" pour soir
                                if (substr($numLigne[$j], strlen($numLigne[$j]) - 1, strlen($numLigne[$j])) == "s") {
                                    $numLigne[$j] = substr($numLigne[$j], 0, strlen($numLigne[$j]) - 1);
                                }
                                /* --------like------------ */
                                $reqNbLike = "SELECT nbLike FROM BUS WHERE numBus='" . $numLigne[$j]
                                        . "' AND directionBus='" . htmlentities($destinationLine[$j]) . "';";
                                //echo "REQ : ".$reqNbLike;
                                $nbLike = $db->getOneData($reqNbLike);
                                $nbLike = $nbLike[0];
                                //echo "NBLIKE : ".$nbLike;
                                if ($nbLike < 10) {
                                    $nbLike = $nbLike . "&nbsp;";
                                }
                                /* --------unlike------------ */
                                $reqNbUnike = "SELECT nbUnlike FROM BUS WHERE numBus='" . $numLigne[$j]
                                        . "' AND directionBus='" . htmlentities($destinationLine[$j]) . "';";
                                //echo "REQ : ".$reqNbLike;
                                $nbUnlike = $db->getOneData($reqNbUnike);
                                $nbUnlike = $nbUnlike[0];
                                //echo "NBLIKE : ".$nbLike;
                                if ($nbUnlike < 10) {
                                    $nbUnlike = $nbUnlike . "&nbsp;";
                                }
                                /* --------fin unlike------------ */

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
                                        <div class="infosAjax">BUS;' . $numLigne[$j] . ';' . $destinationLine[$j] . '</div>
                                        <span class="ui green circular label">' . $nbLike . '</span><br>
                                        <i class="thumbs down icon unlike" style="margin-top: 2%;"></i>
                                        <span class="ui red circular label">' . $nbUnlike . '</span>
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
                                <div class="infosAjax">METRO;B;Ramonville</div>
                                <span class="ui green circular label">
                                    <?php echo afficherLikeMetro("B", "Ramonville",$db) ?>
                                </span><br>
                                <i class="thumbs down icon unlike" style="margin-top: 2%;"></i>
                                <span class="ui red circular label">
                                     <?php echo afficherUnlikeMetro("B", "Ramonville",$db) ?>
                                </span>
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
                                <div class="infosAjax">METRO;B;Borderouge</div>
                                <span class="ui green circular label">
                                     <?php echo afficherLikeMetro("B", "Borderouge",$db) ?>
                                </span><br>
                                <i class="thumbs down icon unlike" style="margin-top: 2%;"></i>
                                <span class="ui red circular label">
                                    <?php echo afficherUnlikeMetro("B", "Borderouge",$db) ?>
                                </span>
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
                                <div class="infosAjax">VELO;227;Toulouse</div>
                                <span class="ui green circular label">
                                    <?php echo afficherLikeVelo(227, "Toulouse",$db) ?>
                                </span><br>
                                <i class="thumbs down icon unlike" style="margin-top: 2%;"></i>
                                <span class="ui red circular label">
                                    <?php echo afficherUnlikeVelo(227, "Toulouse",$db) ?>
                                </span>
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
        
        //parcourir toutes les lignes et regarder si on a un localstorage
        var tab = $(".infosAjax");
        $(".infosAjax").each(function(){
            //recuperer en ajax le nombre de like/unlike
            array = $(this).text().split(";");
            ligne = array[1];
            destination = array[2];
            itemLocalSorage = ligne+""+destination;
            
            if(localStorage.getItem(itemLocalSorage) == "like"){
                //alert("ligne "+ligne +" like ok");
                $(this).prev().css('color','green');
                $(this).prev().css('cursor','auto');
            }
            if(localStorage.getItem(itemLocalSorage) == "unlike"){
                //alert("ligne "+ligne +" unlike ok");
                $(this).parent().children(".unlike").css('color','#bb2b2b');
                $(this).parent().children(".unlike").css('cursor','auto');
            } 
        });
 

        //affichages des infos suplementaire    
        $( ".content" ).click(function() {
            $(this).children(".more_infos").toggleClass( "more_infos_active" );         
        });
           
        $(".like").click(function() {
            var dataAjax = $(this).next().text();
            var infos = dataAjax.split(";");
            var ligne = infos[1];
            var destination = infos[2];
            var elt = $(this);
            var erase=false;
            var itemLocalSorage = ligne+""+destination;
            
            if(localStorage.getItem(itemLocalSorage) == "unlike" ){
                erase = true;
            }
            
            if(localStorage.getItem(itemLocalSorage) == "like" ){
                alert("DEJA LIKER   ligne "+ligne +"  "+  localStorage.getItem(itemLocalSorage));
            }
            else {
                alert(dataAjax+" erase : "+erase+" type : like");
                $.ajax({
                    type: "POST",
                    url: "like.php",
                    data: {data:dataAjax,eraseLike:erase,type:"like"},
                    success: function(msg){
                        alert(msg);
                        labelLike = elt.parent().children(".green");
                        
                        //alert(elt.next().text()+" TEST : "+elt.parent().children(".green").text());
                        labelLike.html(msg);
                        //changer l'icone en like/unlike
                        elt.css('color','green');
                        elt.css('cursor','auto');
                        if(erase){
                            buttonUnlike = elt.parent().children(".unlike");
                            buttonUnlike.css('color','black');
                            buttonUnlike.css('cursor','pointer');
                        }
                        localStorage.setItem(itemLocalSorage, "like"); 
                        
                    }}); 
            }
        });
        
        
        $(".unlike").click(function() {
            var dataAjax = $(this).parent().children(".infosAjax").text();
            var infos = dataAjax.split(";");
            var ligne = infos[1];
            var destination = infos[2];
            var elt = $(this);
            var erase=false;
            var itemLocalSorage = ligne+""+destination;
            if(localStorage.getItem(itemLocalSorage) == "like" ){
                erase = true;
            }
            
            
            if(localStorage.getItem(itemLocalSorage) == "unlike" ){
                alert("DEJA UNLIKER ligne "+ligne +"  "+  localStorage.getItem(itemLocalSorage));
            }
            else {
                alert(dataAjax+" erase : "+erase+" type : unlike");
                $.ajax({
                    type: "POST",
                    url: "like.php",
                    data: {data:dataAjax,eraseLike:erase,type:"unlike"},
                    success: function(msg){
                        alert(msg);
                        labelUnlike = elt.parent().children(".red");
                        //alert(elt.next().text()+" TEST : "+elt.parent().children(".green").text());
                        labelUnlike.html(msg);
                        
                        //changer l'icone en like/unlike
                        elt.css('color','#bb2b2b');
                        elt.css('cursor','auto');
                        
                        if(erase){
                            buttonLike = elt.parent().children(".like");
                            buttonLike.css('color','black');
                            buttonLike.css('cursor','pointer');
                        }
                        localStorage.setItem(itemLocalSorage, "unlike");
                        
                    }});
            }
        });
                             
    </script>
   
</body>
</html>