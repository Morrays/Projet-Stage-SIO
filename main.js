window.onload=function(){
//$("#cpville").autocomplete({
//    source: function (request, response) {
//        $.ajax({
//            url: "https://api-adresse.data.gouv.fr/search/?citycode=" + $("input[name='cpville']").val(),
//            data: {q: request.term},
//            dataType: "json",
//            success: function (data) {
//                var postcodes = [];
//                response($.map(data.features, function (item) {
//                    // Ici on est obligé d'ajouter les CP dans un array pour ne pas avoir plusieurs fois le même
//                    if ($.inArray(item.properties.postcode, postcodes) == -1) {
//                        postcodes.push(item.properties.postcode);
//                        return {label: item.properties.postcode + " - " + item.properties.city,
//                            city: item.properties.city,
//                            value: item.properties.postcode
//                        };
//                    }
//                }));
//            }
//        });
//    },
//    // On remplit aussi la ville
//    select: function (event, ui) {
//        $('#ville').val(ui.item.city);
//    }
//});
$("#ville").autocomplete({
    source: function (request, response) {
        $.ajax({
            url: "https://api-adresse.data.gouv.fr/search/?city=" + $("input[name='ville']").val(),
            data: {q: request.term},
            dataType: "json",
            success: function (data) {
                var cities = [];
                response($.map(data.features, function (item) {
                    // Ici on est obligé d'ajouter les villes dans un array pour ne pas avoir plusieurs fois la même
                    if ($.inArray(item.properties.citycode, cities) == -1) {
                        cities.push(item.properties.citycode);
                        return {label: item.properties.citycode + " - " + item.properties.city,
                            postcode: item.properties.citycode,
                            value: item.properties.city
                        };
                    }
                }));
            }
        });
    },
    // On remplit aussi le CP
    select: function (event, ui) {
        $('#cpville').val(ui.item.postcode);
    }
});
}

function addcontact(){
    var SIRET = document.getElementById('entreprise').value;
    document.location.href="addcontact.php?SIRET="+SIRET;
}

function afficherimage(p){
    document.getElementById('image').src = "images/"+p.value;
}

function changeEtat($i){
    $n=1;
    while ($n <= $i){
        e = document.getElementById('scales'+$n).value;
    }   
}
