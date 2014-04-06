function affichHome() {
    $('#idDivHome').css('display', 'block');
    $('#idDivBus').css('display', 'none');
    $('#idDivMetro').css('display', 'none');
    $('#idDivVelo').css('display', 'none');
    $('#idDivItineraire').css('display', 'none');
    $('#idDivApi').css('display', 'none');

    $('#menu_home').addClass("active");
    $('#menu_bus').removeClass("active");
    $('#menu_velo').removeClass("active");
    $('#menu_metro').removeClass("active");
    $('#menu_itineraire').removeClass("active");
    $('#menu_api').removeClass("active");
}
function affichBus() {
    $('#idDivHome').css('display', 'none');
    $('#idDivBus').css('display', 'block');
    $('#idDivMetro').css('display', 'none');
    $('#idDivVelo').css('display', 'none');
    $('#idDivItineraire').css('display', 'none');
    $('#idDivApi').css('display', 'none');

    $('#menu_home').removeClass("active");
    $('#menu_bus').addClass("active");
    $('#menu_velo').removeClass("active");
    $('#menu_metro').removeClass("active");
    $('#menu_itineraire').removeClass("active");
    $('#menu_api').removeClass("active");
}
function affichMetro() {
    $('#idDivHome').css('display', 'none');
    $('#idDivBus').css('display', 'none');
    $('#idDivMetro').css('display', 'block');
    $('#idDivVelo').css('display', 'none');
    $('#idDivItineraire').css('display', 'none');
    $('#idDivApi').css('display', 'none');

    $('#menu_home').removeClass("active");
    $('#menu_bus').removeClass("active");
    $('#menu_velo').removeClass("active");
    $('#menu_metro').addClass("active");
    $('#menu_itineraire').removeClass("active");
    $('#menu_api').removeClass("active");
}
function affichVelo() {
    $('#idDivHome').css('display', 'none');
    $('#idDivBus').css('display', 'none');
    $('#idDivMetro').css('display', 'none');
    $('#idDivVelo').css('display', 'block');
    $('#idDivItineraire').css('display', 'none');
    $('#idDivApi').css('display', 'none');

    $('#menu_home').removeClass("active");
    $('#menu_bus').removeClass("active");
    $('#menu_velo').addClass("active");
    $('#menu_metro').removeClass("active");
    $('#menu_itineraire').removeClass("active");
    $('#menu_api').removeClass("active");
}
function affichItineraire() {
    $('#idDivHome').css('display', 'none');
    $('#idDivBus').css('display', 'none');
    $('#idDivMetro').css('display', 'none');
    $('#idDivVelo').css('display', 'none');
    $('#idDivItineraire').css('display', 'block');
    $('#idDivApi').css('display', 'none');

    $('#menu_home').removeClass("active");
    $('#menu_bus').removeClass("active");
    $('#menu_velo').removeClass("active");
    $('#menu_metro').removeClass("active");
    $('#menu_itineraire').addClass("active");
    $('#menu_api').removeClass("active");
}

function affichApi() {
    $('#idDivHome').css('display', 'none');
    $('#idDivBus').css('display', 'none');
    $('#idDivMetro').css('display', 'none');
    $('#idDivVelo').css('display', 'none');
    $('#idDivItineraire').css('display', 'none');
    $('#idDivApi').css('display', 'block');

    $('#menu_home').removeClass("active");
    $('#menu_bus').removeClass("active");
    $('#menu_velo').removeClass("active");
    $('#menu_metro').removeClass("active");
    $('#menu_itineraire').removeClass("active");
    $('#menu_api').addClass("active");
}

//parcourir toutes les lignes et regarder si on a un localstorage
var tab = $(".infosAjax");
$(".infosAjax").each(function() {
    //recuperer en ajax le nombre de like/unlike
    array = $(this).text().split(";");
    ligne = array[1];
    destination = array[2];
    itemLocalSorage = ligne + "" + destination;
    if (localStorage.getItem(itemLocalSorage) == "like") {
        $(this).prev().css('color', 'green');
        $(this).prev().css('cursor', 'auto');
    }
    if (localStorage.getItem(itemLocalSorage) == "unlike") {
        $(this).parent().children(".unlike").css('color', '#bb2b2b');
        $(this).parent().children(".unlike").css('cursor', 'auto');
    }
});
function genererCle() {
    if (localStorage.getItem("apiKey") === null) {
        $.ajax({
            type: "POST",
            url: "api/GeneratingKey.php",
            success: function(key) {
                $("#affKey").html("Votre clé est : <b>" + key + "</b>");
                localStorage.setItem("apiKey", key);
            }
        });
    }
    else {
        $("#affKey").html("Vous avez déjà reçu une clé ! La voici : <b>" + localStorage.getItem("apiKey") + "</b>");
    }
}
/*$('#calculItineraire').click(function(){
         adress = $('#inputItineraire').val();
         $.ajax({
         type: "POST",
         url: "toolkit/itineraire.php",
         dataType: "json",
         data: {dest:adress},
         success: function(msg){
         }});
         });*/

//affichages des infos suplementaire
$(".content").click(function() {
    $(this).children(".more_infos").toggleClass("more_infos_active");
});
$(".like").click(function() {
    var dataAjax = $(this).next().text();
    var infos = dataAjax.split(";");
    var ligne = infos[1];
    var destination = infos[2];
    var elt = $(this);
    var erase = false;
    var itemLocalSorage = ligne + "" + destination;
    if (localStorage.getItem(itemLocalSorage) == "unlike") {
        erase = true;
    }
    if (localStorage.getItem(itemLocalSorage) == "like") {
        alert("Vous avez déjà liker la ligne " + ligne);
    }
    else {
        $.ajax({
            type: "POST",
            url: "toolkit/like.php",
            dataType: "json",
            data: {
                data: dataAjax, 
                eraseLike: erase, 
                type: "like"
            },
            success: function(msg) {
                labelLike = elt.parent().children(".green");
                labelUnlike = elt.parent().children(".red");
                if (erase) {
                    labelLike.html(msg.nbLikeAjout);
                    labelUnlike.html(msg.nbLikeRetrait);
                } else {
                    labelLike.html(msg.nbLikeAjout);
                }
                //changer l'icone en like/unlike
                elt.css('color', 'green');
                elt.css('cursor', 'auto');
                if (erase) {
                    buttonUnlike = elt.parent().children(".unlike");
                    buttonUnlike.css('color', 'black');
                    buttonUnlike.css('cursor', 'pointer');
                }
                localStorage.setItem(itemLocalSorage, "like");
            }
        });
}
});
$(".unlike").click(function() {
    var dataAjax = $(this).parent().children(".infosAjax").text();
    var infos = dataAjax.split(";");
    var ligne = infos[1];
    var destination = infos[2];
    var elt = $(this);
    var erase = false;
    var itemLocalSorage = ligne + "" + destination;
    if (localStorage.getItem(itemLocalSorage) == "like") {
        erase = true;
    }
    if (localStorage.getItem(itemLocalSorage) == "unlike") {
        alert("Vous avez déjà unliker la ligne " + ligne);
    }
    else {
        $.ajax({
            type: "POST",
            url: "toolkit/like.php",
            dataType: "json",
            data: {
                data: dataAjax, 
                eraseLike: erase, 
                type: "unlike"
            },
            success: function(msg) {
                labelUnlike = elt.parent().children(".red");
                labelLike = elt.parent().children(".green");
                if (erase) {
                    labelUnlike.html(msg.nbLikeAjout);
                    labelLike.html(msg.nbLikeRetrait);
                } else {
                    labelUnlike.html(msg.nbLikeAjout);
                }
                //changer l'icone en like/unlike
                elt.css('color', '#bb2b2b');
                elt.css('cursor', 'auto');
                if (erase) {
                    buttonLike = elt.parent().children(".like");
                    buttonLike.css('color', 'black');
                    buttonLike.css('cursor', 'pointer');
                }
                localStorage.setItem(itemLocalSorage, "unlike");
            }
        });
}
});