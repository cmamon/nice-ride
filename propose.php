<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Proposer un voyage</title>

        <link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="CSS/style.css"/>

        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <header>
            <nav>
                <a id="brand" href="index.php">Nice Ride</a>
                <ul>
                    <li> <a href="login.php">CONNEXION</a> </li>
                    <li> <a href="signup.php">S'INSCRIRE</a> </li>
                </ul>
            </nav>
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
            <div id="bottomLinks">
                <a href="contact.html">Nous contacter</a>
                <a href="help.html">Aide</a>
                <a href="faq.html">F.A.Q</a>
            </div>
        </footer>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
        <script type="text/javascript">
        function initMap(){
            var montpellier = {lat: 43.6111, lng: 3.87667};
            var map = new google.maps.Map(document.getElementById('map'), {
                center: montpellier,
                zoom: 8
            });
            var marker = new google.maps.Marker({
                position: montpellier,
                map: map
            });
        }
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVEJd3oceuJC5ivSIjaWvJomYNxc2JR_A&callback=initMap" async defer></script>
    </body>
</html>
