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
        <script type="text/javascript">
        function affichHome() {
            $('#idDivHome').css('display','block');
            $('#idDivBus').css('display','none');
            $('#idDivMetro').css('display','none');
            $('#idDivVelo').css('display','none');
            $('#idDivItineraire').css('display','none');
            
            $('#menu_home').addClass("active");
            $('#menu_bus').removeClass("active");
            $('#menu_velo').removeClass("active");
            $('#menu_metro').removeClass("active");
            $('#menu_itineraire').removeClass("active");
        } 
        function affichBus() {
            $('#idDivHome').css('display','none');
            $('#idDivBus').css('display','block');
            $('#idDivMetro').css('display','none');
            $('#idDivVelo').css('display','none');
            $('#idDivItineraire').css('display','none');
            
            $('#menu_home').removeClass("active");
            $('#menu_bus').addClass("active");
            $('#menu_velo').removeClass("active");
            $('#menu_metro').removeClass("active");
            $('#menu_itineraire').removeClass("active");
        } 
        function affichMetro() {
            $('#idDivHome').css('display','none');
            $('#idDivBus').css('display','none');
            $('#idDivMetro').css('display','block');
            $('#idDivVelo').css('display','none');
            $('#idDivItineraire').css('display','none');
            
            $('#menu_home').removeClass("active");
            $('#menu_bus').removeClass("active");
            $('#menu_velo').removeClass("active");
            $('#menu_metro').addClass("active");
            $('#menu_itineraire').removeClass("active");
        }
        function affichVelo() {
            $('#idDivHome').css('display','none');
            $('#idDivBus').css('display','none');
            $('#idDivMetro').css('display','none');
            $('#idDivVelo').css('display','block');
            $('#idDivItineraire').css('display','none');
            
            $('#menu_home').removeClass("active");
            $('#menu_bus').removeClass("active");
            $('#menu_velo').addClass("active");
            $('#menu_metro').removeClass("active");
            $('#menu_itineraire').removeClass("active");
        } 
        function affichItineraire() {
            $('#idDivHome').css('display','none');
            $('#idDivBus').css('display','none');
            $('#idDivMetro').css('display','none');
            $('#idDivVelo').css('display','none');
            $('#idDivItineraire').css('display','block');
            
            $('#menu_home').removeClass("active");
            $('#menu_bus').removeClass("active");
            $('#menu_velo').removeClass("active");
            $('#menu_metro').removeClass("active");
            $('#menu_itineraire').addClass("active");
        }
        </script>
    </head>  
    <body>
        <?php
       
        //include 'transportCommun.php';
        require_once($_SERVER['DOCUMENT_ROOT']."Master/Projet_IAWS/upsTransport/model/Database.php");
        require_once($_SERVER['DOCUMENT_ROOT']."Master/Projet_IAWS/upsTransport/model/Bus.php");
        require_once($_SERVER['DOCUMENT_ROOT']."Master/Projet_IAWS/upsTransport/model/Metro.php");
        require_once($_SERVER['DOCUMENT_ROOT']."Master/Projet_IAWS/upsTransport/model/Velo.php");
        require_once($_SERVER['DOCUMENT_ROOT']."Master/Projet_IAWS/upsTransport/api/Decaux.php");
        require_once($_SERVER['DOCUMENT_ROOT']."Master/Projet_IAWS/upsTransport/api/Tisseo.php");
        require_once($_SERVER['DOCUMENT_ROOT']."Master/Projet_IAWS/upsTransport/api/Google.php");
        require_once($_SERVER['DOCUMENT_ROOT']."Master/Projet_IAWS/upsTransport/toolkit/Toolkit.php");
        require_once($_SERVER['DOCUMENT_ROOT']."Master/Projet_IAWS/upsTransport/toolkit/Vue.php");
        $db = new Database();
        $db->getConnection();
        ?>
        
        <header id="header">
            <img src="./images/logo2.png"/>
        </header>

        <center>
            <div class="ui secondary  menu">
                <a id="menu_home" class="active item menu" href="javascript: affichHome();">
                  <i class="home icon"></i> Home
                </a>
                <a id="menu_bus" class="item menu" href="javascript: affichBus();">
                  <img src="images/bus.png" width="20px" style="display:inline;vertical-align:middle"> Bus
                </a>
                <a id="menu_metro" class="item menu" href="javascript: affichMetro();">
                  <img src="images/metro.png" width="20px" style="display:inline;vertical-align:middle"> Métro
                </a>
                <a id="menu_velo" class="item menu" href="javascript: affichVelo();">
                  <img src="images/velo.png" width="20px" style="display:inline;vertical-align:middle"> Vélo
                </a>
                <a id="menu_itineraire" class="item menu" href="javascript: affichItineraire();">
                  <i class="location icon"></i> Itinéraire
                </a>
            </div>
        </center>
    
    <center>
        <div id="idDivHome" style="display:block;">
          idDivHome  
        </div>
        <div id="idDivBus" style="display:none;">
            <?php Vue::affichInfoBus(); ?>  
        </div>
        <div id="idDivMetro" style="display:none;">
             <?php Vue::affichInfoMetro(); ?>
        </div>
        <div id="idDivVelo" style="display:none;">
            <?php Vue::affichInfoVelo(); ?>
        </div>
        <div id="idDivItineraire" style="display:none;">
            <?php Vue::affichInfoItineraire(); ?>         
        </div>
    </center>
    <footer>
            UPS TRANSPORT - UE INTEROPERABILITE DES APPLICATIONS ET DES WEB SERVICES - Laurine Marmisse / Nathan Prior
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
                alert("Vous avez déjà liker la ligne "+ligne);
            }
            else {
                //alert(dataAjax+" erase : "+erase+" type : like");
                $.ajax({
                    type: "POST",
                    url: "like.php",
                    dataType: "json",
                    data: {data:dataAjax,eraseLike:erase,type:"like"},
                    success: function(msg){
                        //alert(msg);
                        labelLike = elt.parent().children(".green");
                        labelUnlike = elt.parent().children(".red");
                        if(erase){
                            alert(msg.nbLikeAjout + "  ___  "+ msg.nbLikeRetrait);
                            labelLike.html(msg.nbLikeAjout);
                            labelUnlike.html(msg.nbLikeRetrait);
                        } else {
                            labelLike.html(msg.nbLikeAjout);
                        }
                        
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
                alert("Vous avez déjà unliker la ligne "+ligne);
            }
            else {
                //alert(dataAjax+" erase : "+erase+" type : unlike");
                $.ajax({
                    type: "POST",
                    url: "like.php",
                    dataType: "json",
                    data: {data:dataAjax,eraseLike:erase,type:"unlike"},
                    success: function(msg){
                        
                        labelUnlike = elt.parent().children(".red");
                        labelLike = elt.parent().children(".green");
                        if(erase){
                            alert(msg.nbLikeAjout + "  ___  "+ msg.nbLikeRetrait);
                            labelUnlike.html(msg.nbLikeAjout);
                            labelLike.html(msg.nbLikeRetrait);
                        } else {
                             labelUnlike.html(msg.nbLikeAjout);
                        }

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
