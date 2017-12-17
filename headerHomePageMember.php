<div class="homePageBanner">
    <nav>
        <a id="brand" href="index.php">Nice Ride</a>
        <ul>
            <li> <?php echo $_SESSION['username']; ?> </li>
            <li> <a href="index.php">DÉCONNEXION</a> </li>
        </ul>
    </nav>
    <h2 id="title">Le covoiturage simple<br><small></small></h2>
    <div class="searchGroup">
        <form action="search.php" method="post">
            <input type="text" id="departureCity" class="cities" name="searchDepartureCity" placeholder="Ville de départ">
            <input type="text" id="arrivalCity" class="cities" name="searchArrivalCity" placeholder="Ville d'arrivée">
            <input type="text" id="datepicker" name="date" placeholder="Date">
            <button type="submit" class="button buttonHome" name="searchButton">Rechercher</button>
        </form>
    </div>
</div>
