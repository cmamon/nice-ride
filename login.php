<!DOCTYPE html>
<html>
<head>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Connexion</title>

        <link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="CSS/style.css"/>

        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
                              <!-- HEADER -->
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
        if ($_POST['connexion']) {
            if (isset($_POST['email'])) {
                if (match_found_in_database()) {
                    $_SESSION['loggedin'] = true;
                }
            }
        }

        if (isset($_POST['remerberMe'])) {

        }
        ?>

        <!-- MAIN CONTENT -->
        <div class="main">
            <div class="loginForm">
                <form class="" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
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
            </div>
        </div>

        <footer>
            <div id="bottomLinks">
                <a href="contact.html">Nous contacter</a>
                <a href="help.html">Aide</a>
                <a href="faq.html">F.A.Q</a>
            </div>
        </footer>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    </body>
</html>
