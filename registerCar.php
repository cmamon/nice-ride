<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <?php require 'head.html'; ?>
        <link rel="stylesheet" href="CSS/jquery-ui.css">
        <title>Enregister une voiture</title>

    </head>
    <body>
        <header>
            <?php require 'header.php'; ?>
        </header>

        <div class="main">
                <div class="carSpecs twoParts">
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
                        <h4>Importez une image de votre voiture</h4>
                        
                    </div>
                </div>
            </div>

        <footer>
            <?php require 'footer.html'; ?>
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

        // $('#yearselect').yearselect({
        //     start: 1985,
        //     step:5,
        //     end: 2017,
        //     order: 'asc',
        //     selected: 2017,
        //     formatDisplay: function(yr) { return yr },
        //     displayAsValue: true
        // });

        // $("#yearpicker").datepicker( {
        //     format: "yyyy", // Notice the Extra space at the beginning
        //     viewMode: "years",
        //     minViewMode: "years"
        // });
        </script>
    </body>
</html>
