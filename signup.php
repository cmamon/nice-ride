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
            <?php require 'header.php'; ?>
        </header>

        <?php
        if (isset($_POST['connexion'])) {
            if (isset($_POST['email'])) {
                $_POST['mail'] = htmlspecialchars($_POST['mail']);
                if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)!= false)
                // On vérifie grâce à une regex que l'adresse email est au bon format
                {
                    // On teste si l'adresse n'est pas déjà dans la base de donnée
                    // si elle n'est pas dedans, on l'ajoute.
                    // sinon on dit à l'utilisateur que l'adresse est déja utilisée
                    // realisable par une analyse immédiate de l'adresse
                    if (isset($_POST['password'])) {
                        $securised = password_hash($_POST['password'], PASSWORD_ARGON2I);

                        //Associer le mdp à l'adresse si elle a pu être ajoutée
                        //Analyse immédiate de la saisie du mdp (respect du nombre min de caractères,
                        // des caractères saisissables ...)

                        //creer un modal?
                    }
                // } else {
                //     adresse email invalide redemander la saisie
                // }
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
            <!-- <div id="myModal" class="modal">  Ou pas parce qu'il faut d'abord une validation des données par le server -->
            <div class="modal-content">
                <p>Votre inscription a bien été enregistrée.</p>
                <p>Souhaitez vous proposer des trajets en tant que conducteur?</p>
                <p><a href="registerCar.php">Oui</a><br>Il vous sera demandé d'indiquer les caractéristiques d'une voiture.</p>
                <p><a href="#">Non</a><br>Vous pourrez toujours changer d'avis par la suite.</p>
            </div>
            <!-- </div> -->
        </div>


        <footer>
            <?php require 'footer.html'; ?>
        </footer>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    </body>
</html>
