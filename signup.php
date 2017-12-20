<?php require 'functions.php';
$conn = connect_to_db();

if (is_logged_in()) {
    redirect('index.php', 303);
}

if (insert_new_member($conn))
{
    echo "NEW MEMBER INSERTED";
    redirect('signupSuccess.php', 303);
}

?>
<!DOCTYPE html>
<html>
<head>
    <head>
        <?php require 'head.php'; ?>
        <link rel="stylesheet" href="CSS/jquery-ui.css">
        <title>S'inscrire</title>

    </head>
    <body>
        <header>
            <?php require 'header.php'; ?>
        </header>

        <div class="main">
            <div class="loginForm">
                <form class="" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <label for="inputLastName">Nom</label>
                    <input type="text" id="inputLastName" name="lastname" placeholder="Saisissez votre nom de famille" required>

                    <label for="inputFirstName">Prénom</label>
                    <input type="text" id="inputFirstName" name="firstname" placeholder="Saisissez votre prénom" required>

                    <label for="birthDatePicker">Date de naissance</label>
                    <input type="text" id="birthDatePicker" name="birthDate" placeholder="Votre date de naissance" required>

                    <label for="inputPhoneNumber">Tel</label>
                    <input type="tel" id="inputPhoneNumber" name="phone" placeholder="Saisissez votre numéro de téléphone portable" required>

                    <label for="inputEmail">Email</label>
                    <input type="email" id="inputEmail" name="email" placeholder="Email" required>
                    <!-- <br> -->

                    <label for="inputPassword">Mot de passe</label>
                    <input type="password" id="inputPassword" name="password" minlength="8" maxlength="14" size="15" placeholder="Mot de passe" required>


                    <label for="inputConfirmationPassword">Confirmez</label>
                    <input type="password" id="inputConfirmationPassword" name="passwordConfirmation" minlength="8" maxlength="14" size="15" placeholder="Saisissez à nouveau votre mot de passe" oninput="check(this)" required>

                    <h3>Adresse</h3>

                    <label for="inputStreetNumber">Numero de Rue</label>
                    <input type="number" id="inputStreetNumber" name="adressNumber" min ="0" placeholder="Numéro de rue" required>

                    <label for="inputStreetType">Type de rue</label>
                    <select id="inputStreetType" name="adressStreetType" required>
                        <option value="Rue">Rue</option>
                        <option value="Allee">Allée</option>
                        <option value="Impasse">Impasse</option>
                        <option value="Route">Route</option>
                        <option value="Avenue">Avenue</option>
                        <option value="Boulevard">Boulevard</option>
                    </select>

                    <br>
                    <label for="inputStreetName">Nom de la rue</label>
                    <input type="text" id="inputStreetName" name="adressStreetName" placeholder="Nom de la rue" required>

                    <br>
                    <label for="inputStreet">Ville</label>
                    <input type="text" id="inputStreetName" name="adressCity" placeholder="Ville" required>

                    <!-- <br> -->
                    <br><br>
                    <button type="submit" class="button" name="connexion">S'enregistrer</button>
                    <br><br>
                    <p>Vous possédez déjà un compte? <a href="login.php">Connectez vous</a> !</p>
                </form>
            </div>
        </div>


        <footer>
            <?php require 'footer.php'; ?>
        </footer>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="JS/birthDatePicker.js"></script>


        <script type="text/javascript">
        // $("input").keydown(function(e) {                 //START BY +33
        //     var oldvalue=$(this).val();
        //     var field=this;
        //     setTimeout(function () {
        //         if(field.value.indexOf('+33 ') !== 0) {
        //             $(field).val(oldvalue);
        //         }
        //     }, 1);
        // });

        // var $this = $( this );                      //  ONLY NUMBERS
        // var input = $this.val();
        // var input = input.replace(/[\D\s\._\-]+/g, "");
        //
        // $this.val( function() {
        //     return ( input === 0 ) ? "" : input.toLocaleString( "" );
        // } );
        </script>

        <script type="text/javascript">
            function check(input) {
                if (input.value != document.getElementById('inputPassword').value) {
                    input.setCustomValidity('Password Must be Matching.');
                } else {
                    // input is valid -- reset the error message
                    input.setCustomValidity('');
                }
            }
        </script>

        <script>
        // String.prototype.capitalize = function() {
        //     return this.charAt(0).toUpperCase() + this.slice(1);
        // }
        //
        // getElementById('inputLastName').value.capitalize();

        </script>
    </body>
</html>
