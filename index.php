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
        // clé tisséo
        // a03561f2fd10641d96fb8188d209414d8
    
        $zonesArrets = file_get_contents('http://pt.data.tisseo.fr/stopAreasList?format=json&key=a03561f2fd10641d96fb8188d209414d8');
        $parsed_json_zonesArrets = json_decode($zonesArrets);
        $tabZonesArrets = $parsed_json_zonesArrets->{'stopAreas'}->{'stopArea'};
        $estTrouve = 0;
        $idZoneArretPaulSabatier = "";
        for ($i = 0; $i < count($tabZonesArrets) && !$estTrouve;$i++) {
            if(strstr($tabZonesArrets[$i]->{'name'},"Université Paul Sabatier")) {
                $idZoneArretPaulSabatier = $tabZonesArrets[$i]->{'id'};
                $estTrouve = 1;
            }
        }

        $poteauxArrets = file_get_contents('http://pt.data.tisseo.fr/stopPointsList?stopAreaId='.$idZoneArretPaulSabatier.'&format=json&network=Tiss%C3%A9o&key=a03561f2fd10641d96fb8188d209414d8');
        $parsed_json_poteauxArrets = json_decode($poteauxArrets);
        $tabPoteauxArrets = $parsed_json_poteauxArrets->{'physicalStops'}->{'physicalStop'};
        $tabCodeOperateur = array();
        $j = 0;
        $res = "";
        for ($i = 0; $i < count($tabPoteauxArrets);$i++) {
            $res = $tabPoteauxArrets[$i]->{'operatorCodes'};
            $tabCodeOperateur[$j] = $res[0]->{'operatorCode'}->{'value'};
            $j++;
        }

        $parsed_json_linesArrets = array();
        $j = 0;
        for ($i = 0; $i < count($tabCodeOperateur);$i++) {
            $linesArrets = file_get_contents('http://pt.data.tisseo.fr/departureBoard?operatorCode='.$tabCodeOperateur[$i].'&number=1&format=json&key=a03561f2fd10641d96fb8188d209414d8');
            $parsed_json_linesArrets[$j] = json_decode($linesArrets);
            $j++;
        }
        
        $tabLineArrets = array();
        $horaireLigne = array();
        $numLigne = array();
        $j = 0;
        for ($i = 0; $i < count($parsed_json_linesArrets);$i++) {
            $tabLineArrets = $parsed_json_linesArrets[$i]->{'departures'}->{'departure'};
            $horaireLigne[$j] = $tabLineArrets[0]->{'dateTime'};
            $numLigne[$j] = $tabLineArrets[0]->{'line'}->{'shortName'};
            $j++;
        }
        
        print_r($tabCodeOperateur);  
         
        // clé google
        // AIzaSyAaspHQw2EYKhz9zXwu-_6g1RozGe4K_co
        // https://maps.googleapis.com/maps/api/directions/json?origin=Universit%C3%A9PaulSabatier&destination=Figeac&sensor=false&key=AIzaSyAaspHQw2EYKhz9zXwu-_6g1RozGe4K_co
            
        //cle JCDECEAUX
        //1ef4a16b7ad8c600c6e505f8a5d1167fe873de42

        $velo = file_get_contents('https://api.jcdecaux.com/vls/v1/stations/227?contract=Toulouse&apiKey=1ef4a16b7ad8c600c6e505f8a5d1167fe873de42');
        $parsed_json_velo = json_decode($velo);
        $nbBorneTotal = $parsed_json_velo->{'bike_stands'};
        $nbBorneDispo = $parsed_json_velo->{'available_bike_stands'};
        $ouvert = $parsed_json_velo->{'status'};
        $adresse = $parsed_json_velo->{'address'};
        $nbVeloDispo = $parsed_json_velo->{'available_bikes'}; 
    ?>

	
	<header id="header" class="test">
            <div class="logo"><img  src="images/logo2.png"></div>
                   
	</header><!-- /header -->
		
	<div id="corps">
		<div class="ui two column middle aligned relaxed grid basic segment">
    <div id="actu" class="center aligned column" >
      <h2 class="section">TRANSPORTS EN COMMUN DISPONIBLES</h2><br>
      <div class="ui animated list" style="width:90%;">
      <div class="item ui piled segment">
        <img class="ui avatar image transport_lis_icon" src="images/bus.png">
        <div class="content">
          <div class="header">Ligne 34</div>
          Bus en direction de ...    <br>Arrivée dans 15min
        </div>
         <div class="right floated ui like corner label">
          <i class="thumbs up icon"></i>
        </div>
      </div>
      <div class="item ui piled segment">
        <img class="ui avatar image transport_lis_icon" src="images/bus.png">
        <div class="content">
          <div class="header">Ligne 38</div>
          Bus en direction de ... <br>Arrivée dans 5min
        </div>
        <div class="right floated ui like corner label">
          <i class="thumbs up icon"></i>
        </div>
      </div>
      <div class="item ui piled segment">
        <img class="ui avatar image transport_lis_icon" src="images/bus.png">
        <div class="content">
          <div class="header">Ligne 42</div>
          Bus en direction de ... <br>Arrivée dans 21min
        </div>
        <div class="right floated ui like corner label">
          <i class="thumbs up icon"></i>
        </div>
      </div>
      <div class="item ui piled segment">
        <img class="ui avatar image transport_lis_icon" src="images/metro.png">
        <div class="content">
          <div class="header">Metro ligne B</div>
          Direction Ramonville <br>Arrivée dans 12min
        </div>
        <div class="right floated ui like corner label">
          <i class="thumbs up icon"></i>
        </div>
      </div>
      <div class="item ui piled segment">
        <img class="ui avatar image transport_lis_icon" src="images/metro.png">
        <div class="content">
          <div class="header">Metro ligne B</div>
          Direction Borderouge <br>Arrivée dans 7min
        </div>
        <div class="right floated ui like corner label">
          <i class="thumbs up icon"></i>
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
        <div class="right floated ui like corner label">
          <i class="thumbs up icon"></i>
          <div class="infosAjax" style="display:none;">  
            <?php echo "VELO;227"; ?>
          </div>
        </div>
        
      </div>
    </div>
    </div>
    <div class="ui vertical divider">
      
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
	</div>
	<div class="ui modal">
        <i class="close icon"></i>
        <div class="header">
          Like
        </div>
        <div class="content">
          Votre like a bien été pris en compte
        </div>
        <div class="actions">
          <div class="ui button">OK</div>
        </div>
      </div>
	<footer>
		<br><br>
	</footer>
        
        <script>
        //affichages des infos suplementaire    
      $( ".content" ).click(function() {
          $(this).children(".more_infos").toggleClass( "more_infos_active" );         
       });
           
      $(".like").click(function() {
          var dataAjax = $(this).children(".infosAjax").text();
        alert(dataAjax);
      
        $.ajax({
          type: "POST",
          url: "like.php",
          data: {data:dataAjax},
          success: function(msg){
            alert( "Data Saved: " + msg );
          }
          });
        
        //changer l'icone en like/unlike
        
        //lancer une modale pour informer l'utilisateur
        $('.ui.modal').modal('show');
        //montrer que le like a augmenté ou baissé
          
          
      });
                             
    </script>
       
	<?php 
        var_dump($velo);
        ?>
</body>
</html>
