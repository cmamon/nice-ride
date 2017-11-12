<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Proposer un voyage</title>

        <link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="style.css"/>

        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <header>
            <nav class="navbar navbar-default navbar-static-top">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="index.php">Nice Ride</a>
                    </div>
                    <form action="index.php" method="post" class="navbar-form navbar-left"  >
                        <div class="form-group">
                            <input type="text" name="searchText" class="form-control" placeholder="Rechercher un trajet">
                        </div>
                        <button type="submit" name="searchButton" class="btn btn-default">Rechercher</button>
                    </form>
                </div><!-- /.container-fluid -->
            </nav>
        </header>

        <?php
            // if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            //     echo "Welcome to the member's area, " . $_SESSION['username'] . "!";
            // } else {
            //     echo "Please log in first to see this page.";
            // }
        ?>
        <h3>Carte de Montpellier</h3>
        <div id="map_canvas"></div>

        <footer>
            <ul class="nav nav-pills">
                <li role="presentation"><a href="contact.html">Nous contacter</a></li>
                <li role="presentation"><a href="help.html">Aide</a></li>
                <li role="presentation"><a href="faq.html">F.A.Q</a></li>
            </ul>
        </footer>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVEJd3oceuJC5ivSIjaWvJomYNxc2JR_A&callback=initMap" async defer></script>
        <script type="text/javascript" src="JS/mapSettings.js"></script>
    </body>
</html>
