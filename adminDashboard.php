<?php session_start(); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php require 'head.html'; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Dashboard</title>
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

    // $username = "cquenette";
    // $password = "galantis";
    // $host = "prodpeda-venus";
    // $dsn = "mysql:host=$host;dbname=$username;charset=utf8";
    //
    // try {
    //     $conn = new PDO($dsn, $username, $password);
    //     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //
    //     $selectMostFrequentedTrips = $conn->prepare("SELECT ROUTE.departureCity, ROUTE.arrivalCity lastname FROM TRIP, ROUTE");
    //     $selectMostFrequentedTrips->execute();
    //     // set the resulting array to associative
    //     $mostFrequentedTrips = $selectMostFrequentedTrips->setFetchMode(PDO::FETCH_ASSOC);
    //
    //     $selectLessFrequentedTrips = $conn->prepare("SELECT ROUTE.departureCity, ROUTE.arrivalCity lastname FROM TRIP, ROUTE");
    //     $selectLessFrequentedTrips->execute();
    //     $mostFrequentedTrips = $selectMostFrequentedTrips->setFetchMode(PDO::FETCH_ASSOC);
    //
    // }
    // catch(PDOException $e) {
    //     //Make it appear in a modal
    //     echo "Error: " . $e->getMessage();
    // }
    // $conn = null;

    echo"<h2>Statistiques générales :</h2>";
    echo"<h3>Top 5 des trajets les plus fréquentés :</h3>";

    echo "<ul>";
    echo "<li>Bordeaux - Paris</li>";
        for ($i=0; $i < 0; $i++) {
            echo"<li>";
            echo"</li>";
        }
    echo"</ul>";

    echo"<h3>Top 5 des trajets les moins fréquentés:</h3>";
    echo"<ul>";
        echo"<li>Montpellier - Maugio</li>";
        for ($i=0; $i < 0; $i++) {
            echo"<li>";
            echo"</li>";
        }
    echo"</ul>";

    echo"<h3>Top 5 des trajets les plus onéreux:</h3>";
    echo"<ul>";
        echo"<li>Bordeaux - Paris</li>";
        for ($i=0; $i < 0; $i++) {
            echo"<li>";
            echo"</li>";
        }
    echo"</ul>";

    echo"<h2>Membres</h2>";

    echo"<h3>Membre(s) dans le rouge</h3>";

    $review = 1.6; // requete pour avoir lavis du membre

    //  Récupérer la note minimale acceptable d'un fichier XML
    $controls = simplexml_load_file("XML/controls.xml");
    $minimalReview = (float)$controls->adminControls->minimalReview;

        if ($review < $minimalReview) { // $rate < 2
            echo "<ul>";
            echo "<li>";
            echo "<div>";
            echo "Nom Prénom";
            $nbFullStars = floor($review);
            $nbHalfStars = floor(($review-floor($review))/0.5);
            $nbEmptyStars = 5 - ceil($review);
            for ($i = 0; $i < $nbFullStars; $i++) {
                echo "<span class=\"fa fa-star checked\"></span>";
            }
            for ($i = 0; $i < $nbHalfStars; $i++) {
                echo "<i class=\"fa fa-star-half-o\"></i>";
            }
            for ($i = 0; $i < $nbEmptyStars; $i++) {
                echo"<span class=\"fa fa-star-o\"></span>";
            }
            echo " (". $review .")";
            echo "<a href=\"#\">Voir le profil</a>";
            echo "</div>";
            echo"</li>";
            echo"</ul>";
        } else {
            echo "<p>Il n'y a aucun membre ayant une note moyenne en dessous de " . $minimalReview ."</p>";
        }

        echo "<p>Changer le seuil minimal pour la note</p>";

        echo "<form action=\"". $_SERVER['PHP_SELF'] ."\" method=\"post\">";
            echo "<input type=\"number\" value=\"". $minimalReview ."\" step=\"0.1\" min=\"0.5\" max=\"3.7\">";
            echo "<input type=\"submit\" value=\"Modifier\">";
        echo "</form>";

        //fix accessibility (rights) problems 
        $controls->adminControls->minimalReview = $controls->asXML('XML/controls.xml');

    echo "<footer>";
        require 'footer.html';
    echo"</footer>";
    ?>
    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
</body>
</html>
