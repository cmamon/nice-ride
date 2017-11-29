<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <?php require 'head.html'; ?>
        <title></title>
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

        <div class="sort">
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
                <label for="tri">Trier par</label>
                <select name="tri">
                    <option value="triChronologique">Date de Parution</option>
                    <option value="triPrix">Prix</option>
                </select>

                <label>
                    <input type="submit" name="sort" value="Valider">
                </form>
        </div>

        <div class="searchResults">
            <div class="trip">
                <div class="tripTop">
                    <div class="tripTopLeft">
                        Départ | Arrivée
                        <hr width="50%">
                        <div class="tripPrice">
                            Prix
                        </div>
                    </div>
                    <div class="vl"></div>
                    <div class="tripTopRight">
                        <p>Publiée le (date) par (prenom du conducteur)</p>
                    </div>
                </div>
                <div class="note">
                    <hr width="80%">
                </p>Connectez vous pour avoir les coordonées de (prenom du conducteur)</p>
                </div>
            </div>
        </div>

        <footer>
            <?php require 'footer.html'; ?>
        </footer>
    </body>
</html>
