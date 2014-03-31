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
            document.getElementById('idDivHome').style.display = 'block';
            document.getElementById('idDivBus').style.display = 'none';
            document.getElementById('idDivMetro').style.display = 'none';
            document.getElementById('idDivVelo').style.display = 'none';
            document.getElementById('idDivItineraire').style.display = 'none';
        } 
        function affichBus() {
            document.getElementById('idDivHome').style.display = 'none';
            document.getElementById('idDivBus').style.display = 'block';
            document.getElementById('idDivMetro').style.display = 'none';
            document.getElementById('idDivVelo').style.display = 'none';
            document.getElementById('idDivItineraire').style.display = 'none';
        } 
        function affichMetro() {
            document.getElementById('idDivHome').style.display = 'none';
            document.getElementById('idDivBus').style.display = 'none';
            document.getElementById('idDivMetro').style.display = 'block';
            document.getElementById('idDivVelo').style.display = 'none';
            document.getElementById('idDivItineraire').style.display = 'none';
        }
        function affichVelo() {
            document.getElementById('idDivHome').style.display = 'none';
            document.getElementById('idDivBus').style.display = 'none';
            document.getElementById('idDivMetro').style.display = 'none';
            document.getElementById('idDivVelo').style.display = 'block';
            document.getElementById('idDivItineraire').style.display = 'none';
        } 
        function affichItineraire() {
            document.getElementById('idDivHome').style.display = 'none';
            document.getElementById('idDivBus').style.display = 'none';
            document.getElementById('idDivMetro').style.display = 'none';
            document.getElementById('idDivVelo').style.display = 'none';
            document.getElementById('idDivItineraire').style.display = 'block';
        }
        </script>
    </head>  
    <body>
        <?php
       
        //include 'transportCommun.php';
        require_once($_SERVER['DOCUMENT_ROOT']."/upsTransport/model/Database.php");
        require_once($_SERVER['DOCUMENT_ROOT']."/upsTransport/model/Bus.php");
        require_once($_SERVER['DOCUMENT_ROOT']."/upsTransport/model/Metro.php");
        require_once($_SERVER['DOCUMENT_ROOT']."/upsTransport/model/Velo.php");
        require_once($_SERVER['DOCUMENT_ROOT']."/upsTransport/api/Decaux.php");
        require_once($_SERVER['DOCUMENT_ROOT']."/upsTransport/api/Tisseo.php");
        require_once($_SERVER['DOCUMENT_ROOT']."/upsTransport/api/Google.php");
        require_once($_SERVER['DOCUMENT_ROOT']."/upsTransport/toolkit/Toolkit.php");
        require_once($_SERVER['DOCUMENT_ROOT']."/upsTransport/toolkit/Vue.php");
        $db = new Database();
        $db->getConnection();
        ?>
        
        <header id="header">
            <img src="./images/logo2.png"/>
        </header>

        <center>
            <div class="ui secondary  menu">
                <a class="active item" href="javascript: affichHome();">
                  <i class="home icon"></i> Home
                </a>
                <a class="item" href="javascript: affichBus();">
                  <img src="images/bus.png" width="20px" style="display:inline;vertical-align:middle"> Bus
                </a>
                <a class="item" href="javascript: affichMetro();">
                  <img src="images/metro.png" width="20px" style="display:inline;vertical-align:middle"> Métro
                </a>
                <a class="item" href="javascript: affichVelo();">
                  <img src="images/velo.png" width="20px" style="display:inline;vertical-align:middle"> Vélo
                </a>
                <a class="item" href="javascript: affichItineraire();">
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
            
            if(localStorage.getItem(ligne) == "like"){
                //alert("ligne "+ligne +" like ok");
                $(this).prev().css('color','green');
                $(this).prev().css('cursor','auto');
            }
            if(localStorage.getItem(ligne) == "unlike"){
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
            var ligne = dataAjax.split(";");
            ligne = ligne[1];
            var elt = $(this);
            var erase=false;
            
            if(localStorage.getItem(ligne) == "unlike" ){
                //il faut enlever le unlike de la base de donnée
                // et mettre a jour le nombre de unlike 
                erase = true;
            }
            
            if(localStorage.getItem(ligne) == "like" ){
                alert("DEJA LIKER   ligne "+ligne +"  "+  localStorage.getItem(ligne));
            }
            else {
                //alert(dataAjax);
                $.ajax({
                    type: "POST",
                    url: "like.php",
                    data: {data:dataAjax,eraseLike:erase,type:"like"},
                    success: function(msg){
                        alert(msg);
                        labelLike = elt.parent().children(".green");
                        //alert(elt.next().text()+" TEST : "+elt.parent().children(".green").text());
                        labelLike.html(msg);
                    }
                });
                localStorage.setItem(ligne, "like");
                //changer l'icone en like/unlike
                $(this).css('color','green');
                $(this).css('cursor','auto');
            }
        });
        
        
        $(".unlike").click(function() {
            var dataAjax = $(this).parent().children(".infosAjax").text();
            //alert("TEST : "+dataAjax);
            var ligne = dataAjax.split(";");
            ligne = ligne[1];
            var elt = $(this);
            
            if(localStorage.getItem(ligne) == "like" ){
                //il faut enlever le like de la base de donnée
                // et mettre a jour le nombre de like 
            }
            
            
            if(localStorage.getItem(ligne) == "unlike" ){
                alert("DEJA UNLIKER   ligne "+ligne +"  "+  localStorage.getItem(ligne));
            }
            else {
                //alert(dataAjax);
                $.ajax({
                    type: "POST",
                    url: "unlike.php",
                    data: {data:dataAjax},
                    success: function(msg){
                        //alert(msg);
                        labelUnlike = elt.parent().children(".red");
                        //alert(elt.next().text()+" TEST : "+elt.parent().children(".green").text());
                        labelUnlike.html(msg);
                    }
                });
                localStorage.setItem(ligne, "unlike");
                //changer l'icone en like/unlike
                $(this).css('color','#bb2b2b');
                $(this).css('cursor','auto');
            }
        });
                             
    </script>
</body>
</html>
