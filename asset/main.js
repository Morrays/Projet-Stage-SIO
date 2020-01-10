window.onload = function() {
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
        source: function(request, response) {
            $.ajax({
                url: "https://api-adresse.data.gouv.fr/search/?city=" + $("input[name='ville']").val(),
                data: { q: request.term },
                dataType: "json",
                success: function(data) {
                    var cities = [];
                    response($.map(data.features, function(item) {
                        // Ici on est obligé d'ajouter les villes dans un array pour ne pas avoir plusieurs fois la même
                        if ($.inArray(item.properties.citycode, cities) == -1) {
                            cities.push(item.properties.citycode);
                            return {
                                label: item.properties.citycode + " - " + item.properties.city,
                                postcode: item.properties.citycode,
                                value: item.properties.city
                            };
                        }
                    }));
                }
            });
        },
        // On remplit aussi le CP
        select: function(event, ui) {
            $('#cpville').val(ui.item.postcode);
        }
    });
}

$('#selectR').on("change", function() {
        valeur = document.getElementById('selectR');
        if (valeur.value == "nom") {

            $(".libelNaf").prop('type', 'hidden');
            $(".CP").prop('type', 'hidden')
        } else if (valeur.value == "naf") {
            $(".recherche").prop('type', 'hidden');
            $(".CP").prop('type', 'hidden')
        } else if (valeur.value == "CP") {
            $(".libelNaf").prop('type', 'hidden');
            $(".recherche").prop('type', 'hidden');
        }
    }

);

function cacherInput() {

    var valeur = document.getElementById('selectR').value;
    var nom = document.getElementById('recherche')
    var naf = document.getElementById('libelNaf')
    var cp = document.getElementById('CP')
    if (valeur == "nom") {
        nom.className = "form-control";
        naf.className = "hidden";
        cp.className = "hidden";

    } else if (valeur == "naf") {
        naf.className = "form-control";
        nom.className = "hidden";
        cp.className = "hidden";

    } else if (valeur == "cp") {
        document.getElementById('CP').className = "form-control";
        document.getElementById('recherche').className = "hidden";
        document.getElementById('libelNaf').className = "hidden";
    }


}



function addcontact() {
    var SIRET = document.getElementById('entreprise').value;
    document.location.href = "addcontact.php?SIRET=" + SIRET;
}

function afficherimage(p) {
    document.getElementById('image').src = "images/" + p.value;
}

function changeEtat($i) {
    $n = 1;
    while ($n <= $i) {
        e = document.getElementById('scales' + $n).value;
    }
}

function registerForm() {
    var classRegister = document.getElementById("register");
    classRegister.classList.remove("hidden");

    var classLogin = document.getElementById("login");
    classLogin.classList.add("hidden");
}

function loginForm() {
    var classLogin = document.getElementById("login");
    classLogin.classList.remove("hidden");

    var classRegister = document.getElementById("register");
    classRegister.classList.add("hidden");
}