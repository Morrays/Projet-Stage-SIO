    <br>
    <footer>
        <!-- jQuery library -->
        <script src="asset/jquery-3.4.1.min.js"></script>
        <script src="asset/jquery-ui-1.12.1/jquery-ui.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <!-- PERSO -->
        <script src="asset/main.js" type="text/javascript"></script>
        <!-- FONNT AWESOME -->
        <script src="https://kit.fontawesome.com/d733517621.js" crossorigin="anonymous"></script>


        <script>
        $('#recherche').autocomplete({
            source: 'jsonNom.php'
        });
        </script>

        <script>
        $('#CP').autocomplete({
            source: 'jsonCP.php',
            minLength: 2
        });
        </script>

        <script>
        $('#rechercheEtu').autocomplete({
            source: 'jsonNomEtudiant.php'
        });
        </script>

    </footer>
    </body>

    </html>