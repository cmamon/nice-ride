<?php require 'functions.php';
    $conn = connect_to_db();
?>
<!DOCTYPE html>
<html>
    <head>
        <?php require 'head.php'; ?>
        <title>Mes voyages</title>
    </head>
    <body>
        <header>
            <?php require 'header.php'; ?>
        </header>
        <div class="main">
            <div class="searchResults emphasized">
                <h3>Trier par date</h3>
                <br><br>
                <h3>Mes trajets en tant que conducteur</h3>

                <p>Liste des trajets où le membre est conducteur</p>
                <p>SELECT date, vd, va, liste de passagers, prix FROM TRIP, MEMBER, TRAVEL WHERE (2 JOINS) AND driver = SELECT memberID FROM MEMBER</p>

                <p>Avec option annulation de trajet + confirmation d'annulation avec un modal</p>

                <h3>Mes trajets en tant que passager</h3>

                <p>Liste des trajets où le membre est conducteur</p>
                <p>SELECT date, vd, va, nombre de passagers, conducteur, prix FROM TRIP, MEMBER, TRAVEL WHERE (2 JOINS) AND driver  < > SELECT memberID FROM MEMBER</p>
            </div>
        </div>

        <footer>
            <?php require 'footer.php'; ?>
        </footer>
    </body>
</html>
