<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Nice Ride</title>

    <link rel="icon" href="http://example.com/favicon.png">
    <link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/jquery-ui.css">

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <script>
        $( function() {
          $( "#datepicker" ).datepicker();
        } );
    </script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
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
        <h2>Le covoiturage simple<br><small></small></h2>
        <div class="searchGroup">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"  >
                <input type="text" id="departureCity" class="cities" name="searchDepartureCity" placeholder="Ville de départ">
                <input type="text" id="arrivalCity" class="cities" name="searchArrivalCity" placeholder="Ville d'arrivée">
                <input type="text" name="date" id="datepicker">
                <button type="submit" class="button" name="searchButton">Rechercher</button>
            </form>
        </div>
    </header>

    <?php
    if (isset($_POST['searchText'])) {
        # rechercher dans le moteur de recherche de la base
    }
    ?>
    <div class="propose">
        <p>Vous êtes conducteurs et vous voyagez prochainement?</p>
        <h3> <a href="propose.php">Proposez un trajet</a> </h3>
    </div>
    <hr>
    <div class="community">
        <p>Rejoignez notre communauté!</p>

    </div>

    <footer>
        <ul>
            <li><a href="contact.html">Nous contacter</a></li>
            <li><a href="help.html">Aide</a></li>
            <li><a href="faq.html">F.A.Q</a></li>
        </ul>
    </footer>
    <script type="text/javascript" src="JS/mapSettings.js">
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVEJd3oceuJC5ivSIjaWvJomYNxc2JR_A&libraries=places&callback=searchPlaces"></script>
</body>
</html>
