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
                // liste de tt les lignes du réseau tisséo
                $lines = file_get_contents('http://pt.data.tisseo.fr/linesList?format=json&network=Tiss%C3%A9o&key=a03561f2fd10641d96fb8188d209414d8');
		$parsed_json_lines = json_decode($lines);
                $tab = $parsed_json_lines->{'lines'}->{'line'};
                $tabId = array();
                $j = 0;
                for ($i = 0; $i < count($tab) ;$i++) {
                    if(strstr($tab[$i]->{'name'},"Université Paul Sabatier")) {
                        $tabId[$j] = $tab[$i]->{'id'};
                        $j++;
                    }
                }
                print_r($tabId);
                $arrets = file_get_contents('http://pt.data.tisseo.fr/stopAreasList?format=json&key=a03561f2fd10641d96fb8188d209414d8');
		$parsed_json_arrets = json_decode($arrets);
                
                $poteaux = file_get_contents('http://pt.data.tisseo.fr/stopPointsList?stopAreaId=1970324837185012&network=Tisséo&key=a03561f2fd10641d96fb8188d209414d8');
                $parsed_json_poteaux = json_decode($poteaux);

                //print_r($parsed_json_poteaux);
                
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
        <div class="content"">
             <div class="header">Vélo Toulouse</div>
                <?php 
                     echo "$adresse <br> Nombre de vélos disponibles : $nbVeloDispo" 
                ?>
            <div class="test more_infos">
                 <?php 
                    echo "Nombre de bornes : $nbBorneTotal <br> Nombre de bornes disponibles : $nbBorneDispo" 
                 ?>   
            </div>
        </div>
        <div class="right floated ui like corner label">
          <i class="thumbs up icon"></i>
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
	</div>
	
	<footer>
		<br><br>
	</footer>
        
        <script>
      $( ".item" ).click(function() {
          //remplacer par this, mais ne marche pas
          $( ".test" ).toggleClass( "more_infos_active" );
      });
      
                                
    </script>
        

	<?php 
        var_dump($velo);
        ?>
</body>
</html>