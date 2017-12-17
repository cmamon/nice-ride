<?php require 'functions.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <?php require 'head.php'; ?>
        <title></title>
    </head>
    <body>
        <header>
            <?php require 'header.php'; ?>
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
                        <p class="cities">Départ <span class="glyphicon glyphicon-arrow-right"></span> Arrivée</p>
                        <hr width="50%">
                        <div class="tripPrice">
                            Prix
                        </div>
                    </div>
                    <div class="vl"></div>
                    <div class="tripTopRight">
                        <p class="infosTrip">Publiée le (date) par (prenom du conducteur)</p>
                    </div>
                </div>
                <div class="note">
                    <hr width="80%">
                    </p>Connectez vous pour avoir les coordonées de (prenom du conducteur)</p>
                </div>
            </div>
        </div>

        <footer>
            <?php require 'footer.php'; ?>
        </footer>
    </body>
</html>
