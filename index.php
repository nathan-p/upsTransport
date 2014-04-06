<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>UPS TRANSPORT</title>
        <link rel="stylesheet" type="text/css" href="css/semantic.css">
        <link rel="stylesheet" type="text/css" href="css/index.css">
    </head>  
    <body>
        <?php
        // /Master/Projet_IAWS
        //include 'transportCommun.php';
        /*
          require_once($_SERVER['DOCUMENT_ROOT'] . "/upsTransport/model/Database.php");
          require_once($_SERVER['DOCUMENT_ROOT'] . "/upsTransport/moyenTransport/Bus.php");
          require_once($_SERVER['DOCUMENT_ROOT'] . "/upsTransport/moyenTransport/Velo.php");
          require_once($_SERVER['DOCUMENT_ROOT'] . "/upsTransport/moyenTransport/Metro.php");
          require_once($_SERVER['DOCUMENT_ROOT'] . "/upsTransport/toolkit/Tisseo.php");
          require_once($_SERVER['DOCUMENT_ROOT'] . "/upsTransport/toolkit/Toolkit.php");
          require_once($_SERVER['DOCUMENT_ROOT'] . "/upsTransport/view/Vue.php");
         */

        require_once($_SERVER['DOCUMENT_ROOT'] . "/Master/Projet_IAWS/upsTransport/model/Database.php");
        require_once($_SERVER['DOCUMENT_ROOT'] . "/Master/Projet_IAWS/upsTransport/moyenTransport/Bus.php");
        require_once($_SERVER['DOCUMENT_ROOT'] . "/Master/Projet_IAWS/upsTransport/moyenTransport/Velo.php");
        require_once($_SERVER['DOCUMENT_ROOT'] . "/Master/Projet_IAWS/upsTransport/moyenTransport/Metro.php");
        require_once($_SERVER['DOCUMENT_ROOT'] . "/Master/Projet_IAWS/upsTransport/toolkit/Tisseo.php");
        require_once($_SERVER['DOCUMENT_ROOT'] . "/Master/Projet_IAWS/upsTransport/toolkit/Toolkit.php");
        require_once($_SERVER['DOCUMENT_ROOT'] . "/Master/Projet_IAWS/upsTransport/view/Vue.php");

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
            <a id="menu_api" class="item menu" href="javascript: affichApi();">
                <i class="archive icon"></i> API
            </a>
        </div>
    </center>

    <center>
        <div id="idDivHome" style="display:block;">
             <div class="ui button" onclick="localStorage.clear();
                location.reload();">
                RESET LOCALSTORAGE
            </div><br/><br/>
            <?php Vue::affichInfoHome(); ?>  
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
        <div id="idDivApi" style="display:none;">
            <?php Vue::affichInfoAPI(); ?>   
        </div>
    </center>

    <footer>
        <!--<div class="ui horizontal divider"></div><br/>-->
        UPS TRANSPORT - UE INTEROPERABILITE DES APPLICATIONS ET DES WEB SERVICES - Laurine Marmisse / Nathan Prior
    </footer>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.js"></script>
    <script src="javascript/semantic.min.js"></script>
    <script src="javascript/itineraire.js"></script> 
    <script src="javascript/fonctions.js"></script>
</body>
</html>