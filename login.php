<?php
session_start();
// if (!$logged_id)
// {
//     $_SESSION['redirect_url'] = $_SERVER['PHP_SELF'];
//     header('Location: login.php');
//     exit;
// }
//
// $redirect_url = (isset($_SESSION['redirect_url'])) ? $_SESSION['redirect_url'] : '/';
// unset($_SESSION['redirect_url']);
// header("Location: $redirect_url", true. 303);
// exit;
?>
<!DOCTYPE html>
<html>
    <head>
        <?php require 'head.php'; ?>
        <title>Connexion</title>

    </head>
    <body>
                              <!-- HEADER -->
        <header>
            <?php require 'header.php'; ?>
        </header>

        <?php
            // if (isset($_POST['remerberMe'])) {
            //
            // }
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
            <?php require 'footer.php'; ?>
        </footer>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    </body>
</html>
