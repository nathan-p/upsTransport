<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>UPS TRANSPORT</title>
	<link rel="stylesheet" type="text/css" href="css/semantic.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
  	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.js"></script>
</head>
<body>
	
	<header id="header" class="test">
		<h1 class="title">UPS TRANSPORT</h1>
	</header><!-- /header -->
		
	<div id="corps">
		<div class="ui two column middle aligned relaxed grid basic segment">
    <div class="center aligned column">
      
      <div class="ui animated list" style="width:80%;">
      <div class="item">
        <img class="ui avatar image" src="images/bus.png">
        <div class="content">
          <div class="header">Ligne 34</div>
          Bus en direction de ...
        </div>
         <div class="right floated tiny teal ui corner label">
          <i class="thumbs up icon"></i>
        </div>

      </div>
      <div class="item">
        <img class="ui avatar image" src="images/bus.png">
        <div class="content">
          <div class="header">Ligne 38</div>
          Bus en direction de ...
        </div>
      </div>
      <div class="item">
        <img class="ui avatar image" src="images/bus.png">
        <div class="content">
          <div class="header">Ligne 42</div>
          Bus en direction de ...
        </div>
      </div>
      <div class="item">
        <img class="ui avatar image" src="images/metro.png">
        <div class="content">
          <div class="header">Metro ligne B</div>
          Direction Ramonville
        </div>
      </div>
      <div class="item">
        <img class="ui avatar image" src="images/metro.png">
        <div class="content">
          <div class="header">Metro ligne B</div>
          Direction Borderouge
        </div>
      </div>
      <div class="item">
        <img class="ui avatar image" src="images/velo.png">
        <div class="content">
          <div class="header">VélôToulouse</div>
          ....
        </div>
      </div>
    </div>



    </div>


    <div class="ui vertical divider">
      OU
    </div>


      <div class="column">
        <h3>RENTRER CHEZ MOI</h3>
      <div class="ui form segment">
        <div class="field">
          <label>Adresse</label>
          <div class="ui left labeled icon input">
            <input type="text" placeholder="Veuillez rentrer votre destination">
            <i class="map marker icon"></i>
           <!--  <div class="ui corner label">
              <i class="thumbs up icon"></i>
            </div> -->
          </div>
        </div>
        </div>
        <div class="ui blue submit button">RECHERCHER</div>
      </div>


    </div>
</div>
	</div>
	
	<footer>
		
	</footer>
	

	<?php 	
		//RECUPERATION FORMAT JSON DE TOUTES LES LIGNES TISSEO
		$lines = json_decode(file_get_contents('http://pt.data.tisseo.fr/linesList?format=json&key=a03561f2fd10641d96fb8188d209414d8'),true);
		//print_r($lines);
	 ?>

</body>
</html>