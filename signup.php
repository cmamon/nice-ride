<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <head>
        <?php require 'head.html'; ?>

        <title>S'inscrire</title>

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
        if ($_POST['connexion']) {
            if (isset($_POST['email'])) {
                $_POST['mail'] = htmlspecialchars($_POST['mail']);
                if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['mail']))
                // On vérifie grâce à une regex que l'adresse email est au bon format
                {
                    // On teste si l'adresse n'est pas déjà dans la base de donnée
                    // si elle n'est pas dedans, on l'ajoute.
                    // sinon on dit à l'utilisateur que l'adresse est déja utilisée
                    // realisable par une analyse immédiate de l'adresse
                }
            }
            if (isset($_POST['password'])) {
                $securised = md5($_POST['password']);
                //Associer le mdp à l'adresse si elle a pu être ajoutée
                //Analyse immédiate de la saisie du mdp (respect du nombre min de caractères,
                // des caractères saisissables ...)
            }
        }
        ?>

        <div class="main">
            <div class="loginForm">
                <form class="" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <label for="inputLastName">Nom</label>
                    <input type="text" id="inputLastName" placeholder="Saisissez votre nom de famille" required>

                    <label for="inputFirstName">Prénom</label>
                    <input type="text" id="inputFirstName" placeholder="Saisissez votre prénom" required>

                    <label for="inputPhoneNumber">Tel</label>
                    <input type="tel" id="inputPhoneNumber" placeholder="Saisissez votre numéro de téléphone portable" required>

                    <label for="inputEmail">Email</label>
                    <input type="email" id="inputEmail" name="email" placeholder="Email" required>
                    <!-- <br> -->

                    <label for="inputPassword">Mot de passe</label>
                    <input type="password" id="inputPassword" name="password" placeholder="Mot de passe" required>

                    <label for="inputConfirmationPassword">Confirmez</label>
                    <input type="password" id="inputConfirmationPassword" placeholder="Saisissez à nouveau votre mot de passe" required>

                    <!-- <br> -->
                    <br><br>
                    <button type="submit" class="button" name="connexion">S'enregistrer</button>
                    <br>
                    <p>Vous possédez déjà un compte? <a href="login.php">Connectez vous</a> !</p>
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
