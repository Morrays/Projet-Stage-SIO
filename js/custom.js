window.onload = function() {

    $('#selectEnt').change(function() {
        var idEnt = $(this).val();
        if (idEnt != "") {
            $.ajax({
                url: 'data/ajax.php',
                type: 'POST',
                data: 'action=tuteur&idEnt=' + idEnt,
                success: function(data) {
                    $('#tuteurAjax').html(data);
                }
            });
        } else {
            $("#tuteurAjax").empty();
        }
    });

    $('#selectEtat').change(function() {
        var idEtat = $(this).val();
        if (idEtat == 6) {
            $.ajax({
                url: 'data/ajax.php',
                type: 'POST',
                data: 'action=refus&idEtat=' + idEtat,
                success: function(data) {
                    $('#refusAjax').html(data);
                }
            });
        } else {
            $("#refusAjax").empty();
        }
    });

    $('#searchEnt').change(function() {
        var valueSearchEnt = $(this).val();
        $.ajax({
            url: 'data/ajax.php',
            type: 'POST',
            data: 'action=searchEnt&valueSearchEnt=' + valueSearchEnt,
            success: function(data) {
                $('#filterEnt').html(data);
            }
        });
    });
}