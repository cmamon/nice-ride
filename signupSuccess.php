
<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <?php require 'head.php'; ?>

    <title>Inscription Réussie</title>

</head>
<body>
    <header>
        <?php require 'header.php'; ?>
    </header>

    <br><br><br>
        <h4>Votre inscription a bien été enregistrée.</h4>
        <br><br>
            <p><a href="registerCar.php">Oui</a><br>Il vous sera demandé d'indiquer les caractéristiques d'une voiture.</p>
            <div class="vl">
            </div>
            <p><a href="index.php">Non</a><br>Vous pourrez toujours changer d'avis dans votre espace membre.</p>
            <p>Vous pouvez maintenant vous connecter</p>

        <footer>
            <?php require 'footer.php'; ?>
        </footer>
        <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    </body>
</html>

<!-- <div id="myModal" class="modal">  Ou pas parce qu'il faut d'abord une validation des données par le server -->
<!-- </div> -->
