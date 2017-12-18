<?php require 'functions.php';
$conn = connect_to_db();
?>
<!DOCTYPE html>
<html>
<head>
    <head>
        <?php require 'head.php'; ?>

        <title>S'inscrire</title>

    </head>
    <body>
        <header>
            <?php require 'header.php'; ?>
        </header>

        <?php

        ?>

        <div class="main">
            <div class="loginForm">
                <form class="" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <label for="inputLastName">Nom</label>
                    <input type="text" id="inputLastName" name="lastname" placeholder="Saisissez votre nom de famille" required>

                    <label for="inputFirstName">Prénom</label>
                    <input type="text" id="inputFirstName" name="firstname" placeholder="Saisissez votre prénom" required>

                    <label for="inputPhoneNumber">Tel</label>
                    <input type="tel" id="inputPhoneNumber" name="phone" placeholder="Saisissez votre numéro de téléphone portable" required>

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
                    <br><br>
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
            <?php require 'footer.php'; ?>
        </footer>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
        <script>
        String.prototype.capitalize = function() {
            return this.charAt(0).toUpperCase() + this.slice(1);
        }

        getElementById('inputLastName').value.capitalize();

        </script>
    </body>
</html>
