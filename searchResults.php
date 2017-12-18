<?php require 'functions.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <?php require 'head.php'; ?>
        <title>Résultats de la recherche</title>
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
        <div class="main">
            <div class="searchResults">

            </div>
        </div>

        <footer>
            <?php require 'footer.php'; ?>
        </footer>
    </body>
</html>
