<?php require 'functions.php';
    $conn = connect_to_db();
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include 'head.php'; ?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Résultats de la recherche</title>
    </head>
    <body>
        <header>
            <?php set_header(); ?>
        </header>
        <div class="main">
            <div class="sort">
                <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
                    <br><br>
                    <label for="sort">Trier par</label>
                    <select name="sort">
                        <option value="triChronologique">Date de Parution</option>
                        <option value="triPrix">Prix</option>
                    </select>
                    <label>
                        <input type="submit" name="sort" value="Valider">
                </form>
            </div>
            <div class="searchResults emphasized">
                <hr id="tripLimitation">
                <?php print_trip($conn); ?>
            </div>
        </div>

        <footer>
            <?php require 'footer.php'; ?>
        </footer>
    </body>
</html>
