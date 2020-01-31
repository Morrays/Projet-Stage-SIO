window.onload = function() {

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

    )

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
}