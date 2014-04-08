var map;
var panel;
var initialize;
var calculate;
var direction;
var responseBus;
var responseVelo;
var dureeVelo = 0;
var dureeBus = 0;
var dureeVeloMinute = "";
var dureeBusMin = "";
var latStationVelo = 43.561141;
var lngStationVelo = 1.463397;
var afficheVeloProche="";

function calculate(){
    destination = document.getElementById('destination').value; // Le point d'arrivé
    panel = document.getElementById('panel');
    if(!destination){
        document.getElementById('bestTransport').innerHTML = "Veuillez rentrer une destination correcte";
        panel.innerHTML = "";
        return;
    }
    var latLng = new google.maps.LatLng(43.562779, 1.469354); // Correspond au coordonnées de paul sab
    var myOptions = {
        zoom : 14, // Zoom par défaut
        center : latLng, // Coordonnées de départ de la carte de type latLng
        mapTypeId : google.maps.MapTypeId.TERRAIN, // Type de carte, différentes valeurs possible HYBRID, ROADMAP, SATELLITE, TERRAIN
        maxZoom : 20
    };
    
    panel.innerHTML = "";
    map = new google.maps.Map(document.getElementById('map'), myOptions);
    direction = new google.maps.DirectionsRenderer({
        map : map,
        panel : panel
    });
    origin = "Universtité Paul Sabatier"; // Le point départ
    
    
    if(origin && destination){    
        //requete bus
        var request = {
            origin : origin,
            destination : destination,
            travelMode : google.maps.DirectionsTravelMode.DRIVING // Mode de conduite
        }
        var directionsServiceBus = new google.maps.DirectionsService(); // Service de calcul d'itinéraire
        directionsServiceBus.route(request, function(response, status){ // Envoie de la requête pour calculer le parcours
            if(status == google.maps.DirectionsStatus.OK){
                responseBus = response;
                dureeBusMinute = response.routes[0].legs[0].duration.text;
                dureeBus = response.routes[0].legs[0].duration.value;
                
                var geocoder = new google.maps.Geocoder();
                var latDestination;
                var lngDestination;
              
                geocoder.geocode({
                    'address': destination
                }, function (results, status) {  
                    if (status == google.maps.GeocoderStatus.OK) {
                        latDestination = results[0].geometry.location.lat();
                        lngDestination = results[0].geometry.location.lng();
                        
                        $.ajax({
                            type: "POST",
                            url: "toolkit/busAProximite.php",
                            data: {lat : latDestination,lgn : lngDestination},
                            success: function(reponse) {
                                //afficheVeloProche = reponse;
                                 document.getElementById('busAProximite').innerHTML = reponse;
                            }
                        });
                       
                    } else {
                        alert("Request failed.")
                    }
                });
            } else {
                alert("Une erreur est survenue, veuillez saisir une adresse correcte !");
            }
        });

        //requete velo
        var request = {
            origin : origin,
            destination : destination,
            travelMode : google.maps.DirectionsTravelMode.BICYCLING // Mode de conduite
        }
        var directionsServiceVelo = new google.maps.DirectionsService(); // Service de calcul d'itinéraire
        directionsServiceVelo.route(request, function(response, status){ // Envoie de la requête pour calculer le parcours
            if(status == google.maps.DirectionsStatus.OK){
                responseVelo = response;
                dureeVeloMinute = response.routes[0].legs[0].duration.text;
                dureeVelo = response.routes[0].legs[0].duration.value;
                console.log(response.routes[0]);
                var geocoder = new google.maps.Geocoder();
                var latDestination;
                var lngDestination;
              
                geocoder.geocode({
                    'address': destination
                }, function (results, status) {  
                    if (status == google.maps.GeocoderStatus.OK) {
                        latDestination = results[0].geometry.location.lat();
                        lngDestination = results[0].geometry.location.lng();
                        
                        //regarder s'il y a une station de velo au alentours
                        $.ajax({
                            type: "POST",
                            url: "toolkit/veloAProximite.php",
                            data: {lat : latDestination,lgn : lngDestination},
                            success: function(reponse) {
                                //afficheVeloProche = reponse;
                                 document.getElementById('stationVeloAProximite').innerHTML = reponse;
                            }
                        });
                        console.log("Latitude: " + latDestination + "\nLongitude: " + lngDestination);
                        console.log(latDestination+" - "+lngDestination+" - "+latStationVelo+" - "+lngStationVelo);
                        //alert(getDistance(latDestination,lngDestination, latStationVelo, lngStationVelo)+" km");
                        document.getElementById('bestTransport')
                        .innerHTML = ("Le meilleur moyen de transport trouvé est le vélo avec une durée de "
                            +dureeVeloMinute+".<br>");
                        direction.setDirections(responseVelo); // Trace l'itinéraire sur la carte et les différentes étapes du parcours
                    } else {
                        alert("Request failed.")
                    }
                });
                
            }
            else {
                alert("Une erreur est survenue, veuillez saisir une adresse correcte !");
            }
        });
    }
};

