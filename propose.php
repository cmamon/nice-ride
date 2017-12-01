<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <?php require 'head.html'; ?>
        <title>Proposer un voyage</title>
    </head>
    <body>
        <header>
            <div class="defaultNav">
                <nav>
                    <a id="brand" href="index.php">Nice Ride</a>
                    <ul>
                        <li><a href="login.php">CONNEXION</a></li>
                        <li><a href="signup.php">S'INSCRIRE</a></li>
                    </ul>
                </nav>
            </div>
        </header>

        <?php
            // if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            //     echo "Welcome to the member's area, " . $_SESSION['username'] . "!";
            // } else {
            //     echo "Please log in first to see this page.";
            // }
        ?>
        <div class="twoParts">
            <div class="part1">
                <div class="searchGroup">
                    <h3>Votre trajet :</h3>
                    <br>
                    <form method="post">
                        <label for="departureCity">De</label>
                        <input type="text" id="departureCity" class="cities" name="searchDepartureCity" placeholder="Ville de départ">
                        <br>
                        <label for="arrivalCity">À</label>
                        <input type="text" id="arrivalCity" class="cities" name="searchArrivalCity" placeholder="Ville d'arrivée">
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
        <script type="text/javascript">

        var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        var labelIndex = 0;

        function addMarker(coords){
            var marker = new google.maps.Marker({
                position: coords,
                animation: google.maps.Animation.DROP,
                label: labels[labelIndex++ % labels.length],
                map: map
            });
        }

        function initMap(){
            var directionsService = new google.maps.DirectionsService;
            var directionsDisplay = new google.maps.DirectionsRenderer;
            var coordMontpellier = {lat: 43.6111, lng: 3.87667};
            var map = new google.maps.Map(document.getElementById('map'), {
                center: coordMontpellier,
                zoom: 10
            });

            directionsDisplay.setMap(map);
            var onChangeHandler = function() {
                calculateAndDisplayRoute(directionsService, directionsDisplay);
            };

            addMarker(coordMontpellier);

            document.getElementById('departureCity').addEventListener('change', onChangeHandler);
            document.getElementById('arrivalCity').addEventListener('change', onChangeHandler);
        }

        function calculateAndDisplayRoute(directionsService, directionsDisplay) {
            directionsService.route({
                origin: document.getElementById('departureCity').value,
                destination: document.getElementById('arrivalCity').value,
                travelMode: 'DRIVING'
            }, function(response, status) {
                if (status === 'OK') {
                    directionsDisplay.setDirections(response);
                } else {
                    window.alert('Directions request failed due to ' + status);
                }
            });
        }


        </script>
        <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVEJd3oceuJC5ivSIjaWvJomYNxc2JR_A&callback=initMap">
        </script>
    </body>
</html>
