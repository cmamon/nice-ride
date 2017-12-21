<div class="homePageBanner">
    <nav>
        <a id="brand" href="index.php">Nice Ride</a>
        <ul>
            <li> <a href="login.php">CONNEXION</a> </li>
            <li> <a href="signup.php">S'INSCRIRE</a> </li>
        </ul>
    </nav>
    <h2 id="title">Le covoiturage simple<br><small></small></h2>
    <div class="searchGroup">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <input type="text" id="departureCity" class="cities" name="searchDepartureCity" placeholder="Ville de départ" required>
            <input type="text" id="arrivalCity" class="cities" name="searchArrivalCity" placeholder="Ville d'arrivée" required>
            <input type="text" id="datepicker" name="date" placeholder="Date" required>
            <button type="submit" class="button buttonHome" name="searchButton">Rechercher</button>
        </form>
    </div>
</div>
