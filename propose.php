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
                        <li> <a href="login.php">CONNEXION</a> </li>
                        <li> <a href="signup.php">S'INSCRIRE</a> </li>
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
                <h3>Carte de Montpellier</h3>
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

            function initMap(){
                var coordMontpellier = {lat: 43.6111, lng: 3.87667};
                var map = new google.maps.Map(document.getElementById('map'), {
                    center: coordMontpellier,
                    zoom: 10
                });
                // var marker = new google.maps.Marker({
                //     position: coordMontpellier,
                //     map: map
                // });

                addMarker(coordMontpellier);

                function addMarker(coords){
                    var marker = new google.maps.Marker({
                        position: coords,
                        animation: google.maps.Animation.DROP,
                        label: labels[labelIndex++ % labels.length],
                        map: map
                    });
                }
            }
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVEJd3oceuJC5ivSIjaWvJomYNxc2JR_A&callback=initMap" async defer></script>
    </body>
</html>
