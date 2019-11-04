<?php
require 'functions.php';
$conn = connect_to_db();

if (isset($_POST['searchButton'])) {
    redirect('searchResults.php', 303);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php require 'head.php'; ?>
    <link rel="stylesheet" href="CSS/jquery-ui.css">

    <title>Nice Ride</title>

</head>
<body>
    <header>
        <?php set_header_home_page(); ?>
    </header>

    <div class="main">
        <?php
            get_trips_matching_with_search($conn);
        ?>
        <div class="propose">
            <p>Vous êtes conducteur et vous voyagez prochainement?</p>
            <?php
                if (!is_logged_in()) {
                    echo "<h3> <a id=\"loadModal\" onclick=\"\" href=\"#\">Proposez un trajet</a> </h3>";
                    echo "<div id=\"myModal\" class=\"modal\">";
                        echo "<div class=\"modal-content\">";
                            echo "<span class=\"close\">&times;</span>";
                            echo "<p>Vous devez vous connecter pour pouvoir proposer un trajet.</p>";
                        echo "</div>";
                    echo "</div>";
                } else {
                    echo "<h3> <a href=\"propose.php\">Proposez un trajet</a> </h3>";
                }
             ?>
        </div>
        <hr>
        <br>
        <p>Top trajets</p>
        <br>
        <hr>
        <div class="twoParts community">
            <div class="part1">
                <div class="panel">
                    <p>Rejoignez <br>notre <br>communauté!</p>
                </div>
            </div>
            <div class="part2">

            </div>
        </div>
    </div>

    <footer>
        <?php require 'footer.php'; ?>
    </footer>

    <script type="text/javascript">
        var modal = document.getElementById("myModal");
        var link = document.getElementById("loadModal");
        var span = document.getElementsByClassName("close")[0];
        link.onclick = function(){
            modal.style.display = "block";
        }

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

    <script type="text/javascript">
    var options = {
        types: ['(cities)'],
        componentRestrictions: {country: "fr"}
    };

    function activatePlacesSearch1(){
        var input = document.getElementById('departureCity');
        var autocomplete = new google.maps.places.Autocomplete(input, options);
    }

    function activatePlacesSearch2(){
        var input = document.getElementById('arrivalCity');
        var autocomplete = new google.maps.places.Autocomplete(input, options);
    }

    function searchPlaces() {
        activatePlacesSearch1();
        activatePlacesSearch2();
    }
    </script>


    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="JS/datepicker.js"></script>
</body>
</html>
