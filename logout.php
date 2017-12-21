<?php
    session_start();
    session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
    <?php require 'head.php'; ?>

    <title>Déconnexion</title>
    <meta http-equiv="refresh" content="2;url=index.php" />

</head>
<body>
    <header>
        <?php require 'header.php'; ?>
    </header>

    <br><br><br>
        <h3>Vous avez été déconnecté(e) avec succès</h3>

        <footer>
            <?php require 'footer.php'; ?>
        </footer>
        <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    </body>
</html>
