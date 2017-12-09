<?php session_start(); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php require 'head.html'; ?>
    <title>Nom Prenom</title> <!-- Au pire, faire une page générale
        où on pourra chercher le nom d'un membre dans la base de données-->

</head>

<body>
    <header>
        <?php require 'header.php'; ?>
    </header>

    <h2>Rechercher un membre</h2>

    <h3>Envoyer un email <small>pour prévenir de la radiation ou de l'exclusion temporaire</small></h3>

    <footer>
        <?php require 'footer.html'; ?>
    </footer>
    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
</body>
</html>
