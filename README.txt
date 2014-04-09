UE IAWS 

Membres du groupe : 
  - Laurine Marmisse
  - Nathan Prior

Installation et contraintes techniques : 

Nous avons utilisé les langages PHP / MYSQL pour ce projet. 
Il faudra donc utiliser WAMP ou similaire pour pouvoir le lancer.

Il faudra de plus modifier le fichier php.ini car nous utilisons une
fonction de PHP qui nécessite une extension. Il faut donc décommenter la ligne 
"extension=php_openssl.dll" du fichier php.ini pour que les requêtes vers Tisséo 
fonctionnent.

Vous trouverez le fichier SQL permettant d'installer la base de donnée dans le 
dossier data. De plus, le fichier Database.php permettant la configuration de 
la base de données se trouve dans le dossier model du projet. 
C'est dans ce fichier que vous indiquerez votre identifiant et mot de passe
pour la base de données.

Nous avons utilisé l'API Google Map pour calculer les itinéraires.
De plus, nous utilisons les coordonées géographiques (latitude,longitude)
pour déterminer les vélos, bus se trouvant à proximités de la destination.

Nous chargeons tous les web services (Tisseo, JCDecaux) au chargement de la page
il se peut donc suivant la connexion que le premier chargement mette quelques
secondes, cependant il n'y a aucun chargement ensuite.
