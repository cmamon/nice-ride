<?php require 'functions.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <?php require 'head.php'; ?>
        <link rel="stylesheet" href="CSS/jquery-ui.css">
        <title>Enregister une voiture</title>

    </head>
    <body>
        <header>
            <?php require 'header.php'; ?>
        </header>

        <div class="main">
                <div class="emphasized twoParts">
                    <h3>Caractéristiques de la voiture</h3>
                    <div class="part1">
                        <form class="" action="index.html" method="post">
                            <h4>Modèle</h4>
                            <input type="text" name="" value="" placeholder="Modèle">
                            <h4>Marque</h4>
                            <input type="text" name="" value="" placeholder="Marque">
                            <h4>Année</h4>
                            <select id="yearselect" size="4" ></select>
                            <h4>Capacité</h4>
                            <input type="number" name="" min="0" max="10" placeholder="Nombre de places">
                        </form>
                    </div>
                    <div class="part2">
                        <form class="" action="index.html" method="post">
                            <h4>Immatriculation</h4>
                            <input type="text" name="" value="" size=12 placeholder="Numéro d'immatriculation">
                            <br>
                            <br>
                            <h4>Importez une image de votre voiture</h4>
                            <input type="file" name="carImg">
                            <br>
                            <input type="submit">
                        </form>
                    </div>
                </div>
            </div>

        <footer>
            <?php require 'footer.php'; ?>
        </footer>

        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script> </head> -->
        <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
        <script type="text/javascript">
        $().ready(function() {
            let date = new Date();
            let year = date.getFullYear();
            var input;
            for (var i = 1980; i < year + 1; i++) {
                input = $('<option value="' + i + '">' + i +'</option>');
                $('#yearselect').append(input);
            }
        });
        </script>
    </body>
</html>
