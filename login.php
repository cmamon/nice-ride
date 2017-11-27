<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <?php require 'head.html'; ?>
        <title>Connexion</title>

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
                    $_SESSION['username'] = $username;
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
            <?php require 'footer.html'; ?>
        </footer>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    </body>
</html>
