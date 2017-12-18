<?php

require 'functions.php';
$conn = connect_to_db();

if (is_logged_in()) {
    redirect('index.php', 303);
}

login($conn);

if (is_admin()) {
    $_SESSION['userLevel'] = 'admin';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <?php require 'head.php'; ?>
        <title>Connexion</title>

    </head>
    <body>
        <header>
            <?php require 'header.php'; ?>
        </header>

        <div class="main">
            <div class="loginForm"> <!-- Print input errors -->
                <form class="" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <label for="inputEmail">Email</label>
                    <input type="email" id="inputEmail" name="email" placeholder="Email" required>
                    <!-- <br> -->
                    <label for="inputPassword">Mot de passe</label>
                    <input type="password" id="inputPassword" name="password" placeholder="Password" required>
                    <!-- <br> -->
                    <label>
                        <input type="checkbox" name="rememberMe" checked="checked"> Se rappeler de moi
                    </label>
                    <br>
                    <button type="submit" class="button" name="connexion">Connexion</button>
                </form>
                <br>
                <p>Vous ne possédez par encore de compte? <a href="signup.php">Inscrivez vous</a>.</p>
            </div>
        </div>

        <footer>
            <?php require 'footer.php'; ?>
        </footer>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    </body>
</html>
