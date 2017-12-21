<?php

require 'functions.php';

if (isset($_POST['searchButton'])) {
    redirect('searchResults.php', 303);
}

?>

<!DOCTYPE html>
<html>
<head>
    <?php require 'head.php'; ?>

    <title>Rechercher un trajet</title>

</head>
<body>
    <header>
        <?php
            set_header();
            get_trips_matching_with_search($conn);
         ?>
    </header>
    <div class="main">
        <div class="searchGroup emphasized">
            <form action="search.php" method="post">
                <label for="departureCity">Ville de départ</label><br>
                <input type="text" id="departureCity" class="cities" name="searchDepartureCity" placeholder="Ville de départ" required>
                <br>
                <label for="departureCity">Ville de d'arrivée</label><br>
                <input type="text" id="arrivalCity" class="cities" name="searchArrivalCity" placeholder="Ville d'arrivée" required>
                <br>
                <label for="departureCity">Date de votre voyage</label><br>
                <input type="text" id="datepicker" name="travelDate" placeholder="Date" required>
                <br><br>
                <button type="submit" class="button buttonHome" name="searchButton">Rechercher</button>
            </form>
        </div>
    </div>
    <footer>
        <?php require 'footer.php'; ?>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
</body>
</html>
