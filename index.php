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
  <div class="column">
    <div class="ui form segment">
      <div class="field">
        <label>Username</label>
        <div class="ui left labeled icon input">
          <input type="text" placeholder="Username">
          <i class="user icon"></i>
          <div class="ui corner label">
            <i class="thumbs up icon"></i>
          </div>
        </div>
      </div>
      <div class="field">
        <label>Password</label>
        <div class="ui left labeled icon input">
          <input type="password">
          <i class="lock icon"></i>
          <div class="ui corner label">
            <i class="thumbs up icon"></i>
          </div>
        </div>
      </div>
      <div class="ui blue submit button">Login</div>
    </div>
  </div>
  <div class="ui vertical divider">
    OU
  </div>
  <div class="center aligned column">
    <div class="huge green ui labeled icon button">
      <i class="signup icon"></i>
      Sign Up
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