<?php
require 'functions.php';
$conn = connect_to_db();

if (!is_logged_in() || !is_admin()) {
    redirect('index.php', 303);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php require 'head.php'; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Tableau de bord</title>
</head>

<body>
    <header>
        <?php set_header(); ?>
    </header>

    <div class="main">
        <?php

        echo "<h2>Statistiques générales :</h2>";
        echo "<h3>Top 5 des trajets les plus fréquentés :</h3>";

        echo "<ul>";
        echo "<li>Bordeaux - Paris</li>";
        for ($i =0; $i < 0; $i++) {
            echo"<li>";
            echo"</li>";
        }
        echo"</ul>";

        echo "<h3>Top 5 des trajets les moins fréquentés:</h3>";
        echo "<ul>";
        echo "<li>Montpellier - Maugio</li>";
        for ($i=0; $i < 0; $i++) {
            echo "<li>";
            echo "</li>";
        }
        echo "</ul>";

        echo "<h3>Top 5 des trajets les plus onéreux:</h3>";
        echo "<ul>";
        echo "<li>Bordeaux - Paris</li>";
        for ($i=0; $i < 0; $i++) {
            echo"<li>";
            echo"</li>";
        }
        echo "</ul>";

        echo "<h2>Membres</h2>";

        echo "<h3>Membre(s) dans le rouge</h3>";

        //On récupère la limite minimale pour la note d'un membre
        $controls = simplexml_load_file("XML/controls.xml");
        $minimalReview = (float)$controls->adminControls->minimalReview;
        members_below_limit_review($conn, $minimalReview);

        echo "<p>Changer le seuil minimal pour la note</p>";

        echo "<form action=\"". $_SERVER['PHP_SELF'] ."\" method=\"post\">";
        echo "<input type=\"number\" value=\"". $minimalReview ."\" step=\"0.1\" min=\"0.5\" max=\"3.7\">";
        echo "<input type=\"submit\" value=\"Modifier\">";
        echo "</form>";

        echo "<footer>";
        require 'footer.php';
        echo "</footer>";
        ?>

    </div>

    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
</body>
</html>
