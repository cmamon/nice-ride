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
    require 'functions.php';

    $conn = connect_to_db();

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

        members_below_limit_review($conn);

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
