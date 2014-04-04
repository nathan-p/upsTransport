var map;
var panel;
var initialize;
var calculate;
var direction;
var responseBus;
var responseVelo;
var dureeVelo = 0;
var dureeBus = 0;
var dureeVeloMin = "";
var dureeBusMin = "";

function initialize(){
    var latLng = new google.maps.LatLng(43.562779, 1.469354); // Correspond au coordonnées de paul sab
    var myOptions = {
        zoom : 14, // Zoom par défaut
        center : latLng, // Coordonnées de départ de la carte de type latLng
        mapTypeId : google.maps.MapTypeId.TERRAIN, // Type de carte, différentes valeurs possible HYBRID, ROADMAP, SATELLITE, TERRAIN
        maxZoom : 20
    };
    panel = document.getElementById('panel');
    panel.innerHTML = "";
    map = new google.maps.Map(document.getElementById('map'), myOptions);
    direction = new google.maps.DirectionsRenderer({
        map : map,
        panel : panel
    });
};

function calculate(){
    initialize();
    origin = "Universtité Paul Sabatier"; // Le point départ
    destination = document.getElementById('destination').value; // Le point d'arrivé
    
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
                dureeBusMin = response.routes[0].legs[0].duration.text;
                dureeBus = response.routes[0].legs[0].duration.value;
            }
            else {
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
                dureeVeloMin = response.routes[0].legs[0].duration.text;
                dureeVelo = response.routes[0].legs[0].duration.value;
            }
            else {
                alert("Une erreur est survenue, veuillez saisir une adresse correcte !");
            }
        });
        
        
        if(dureeVelo < dureeBus){
            document.getElementById('bestTransport')
            .innerHTML = ("Le meilleur moyen de transport trouvé est le vélo avec une durée de "+dureeVeloMin+" minutes");
            direction.setDirections(responseVelo); // Trace l'itinéraire sur la carte et les différentes étapes du parcours
        }else{
            document.getElementById('bestTransport')
            .innerHTML = ("Le meilleur moyen de transport trouvé est le bus avec une durée de "+dureeBusMin+" minutes");
            direction.setDirections(responseBus); // Trace l'itinéraire sur la carte et les différentes étapes du parcours
        }
    }
};