<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <?php require 'head.html'; ?>
        <title>Proposer un voyage</title>
    </head>
    <body>
        <header>
            <?php require 'header.php'; ?>
        </header>

        <?php
            // if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                // if (pas de voiture enregistrée) {
                //     echo "Vous n'avez pas encore enregistré de voiture";
                //     echo "<form style=\"display: inline\" action=\"registerCar.php\" method=\"get\">";
                //     echo "<button>Enregistrer un véhicule</button>";
                //     echo "</form>";
                // } else {

                //     echo "Bienvenue , " . $_SESSION['username'] . "!";
            // }
            // } else {
            //     echo "Enregistrez vous pour voir cette page.";
            // }
        ?>
        <div class="main">
            <div class="twoParts">
                <div class="part1" id="info">
                    <div class="searchGroup">
                        <h3>Votre trajet :</h3>
                        <br>
                        <form method="post">
                            <label for="departureCity">De</label>
                            <input type="text" id="departureCity" class="cities" name="searchDepartureCity" placeholder="Ville de départ">
                            <br>
                            <label for="arrivalCity">Adresse de RDV</label>
                            <input type="text" id="meetingAdress" class="cities" name="meetingAdress" placeholder="n°rue Intitulé">
                            <br>
                            <label for="arrivalCity">À</label>
                            <input type="text" id="arrivalCity" class="cities" name="searchArrivalCity" placeholder="Ville d'arrivée">
                            <br>
                            <label for="arrivalCity">Adresse de dépose</label>
                            <input type="text" id="dropAddress" class="cities" name="dropAdress" placeholder="n°rue Intitulé">
                            <br>
                            <label for="date">Le</label>
                            <div class="input-group date">
                                <input type="date" id="date" name="tripDate" placeholder="Date">
                            </div>
                            <br>
                        </form>
                    </div>
                    <br><br>
                    <div class="rule">
                        <hr style="border:3px solid #AAA; border-radius:3px; width:90%">
                    </div>
                    <h3>Renseignez le prix</h3>
                    <form class="" action="propose2.html" method="post">
                        <input type="number" min="0" max ="80" name="" value="">
                    </form>
                </div>
            </div>
            <div class="part2">
                <div id="map"></div>
            </div>
        </div>

        <footer>
            <?php require 'footer.html'; ?>
        </footer>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
        <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVEJd3oceuJC5ivSIjaWvJomYNxc2JR_A&libraries=places&callback=initMap">
        </script>
        <script type="text/javascript" src="JS/initMap.js">
        </script>
    </body>
</html>
