<?php

function connect_to_db()
{
    $servername = "prodpeda-venus";
    $username = "cquenette";
    $password = "galantis";
    try {
        $conn = new PDO("mysql:host=$servername;dbname=cquenette;charset=utf8;", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully";

    } catch (Exception $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    return $conn;
}

function login_check()
{
    $hash = ""; // hash est le mot de passe crypté écrit dans la base de donnée
    if (isset($_POST['connexion'])) {
        if (isset($_POST['email'])) {
            if (match_found_in_database()) {
                if (isset($_POST['password'])) {
                    if (password_verify ($_POST['password'], $hash )) {
                        $_SESSION['loggedin'] = true;
                        $_SESSION['username'] = $username;
                    } else {
                        echo "L'email saisi est incorrect";
                    }
                }
            } else {
                echo "L'email saisi ne correspond à aucun utilisateur";
            }
        }
    }
}

function get_trips_matching_with_search($conn)
{
    if (isset($_POST['searchButton'])) {
        if (isset($_POST['searchDepartureCity'])) {
            $departureCity = $_POST['searchDepartureCity'];
            if (isset($_POST['searchArrivalCity'])) {
                $arrivalCity = $_POST['searchArrivalCity']
                if (isset($_POST['date'])) {
                    $date = $_POST['date'];
                    $selectTripsMatching = $conn->prepare(
                        "SELECT * FROM TRIP, ROUTE
                         WHERE TRIP.routeID = ROUTE.routeID
                           AND departureCity = :departureCity
                           AND arrivalCity = :arrivalCity
                           AND date = :date ");
                    $selectTripsMatching->bindParam(':departureCity', $departureCity);
                    $selectTripsMatching->bindParam(':arrivalCity', $arrivalCity);
                    $selectTripsMatching->bindParam(':date', $date);
                    $selectTripsMatching->execute();
                    $tripsMatching = $selectTripsMatching->fetchAll(PDO::FETCH_OBJ);
                }
            }
        }
    }
    return $tripsMatching;
}

function print_no_results($queryResults)
{
    if ($queryResults == NULL) {
        echo "Aucun trajet ne correspond à votre demande";
    }
}

function check_input_trip()
{
    return true;
}

function insert_trip_in_db($conn)
{
    if (check_input_trip()) {
        $insertTripInDB = $conn->prepare(
            "INSERT INTO TRIP ()
             WHERE TRIP.routeID = ROUTE.routeID
               AND departureCity = :departureCity
               AND arrivalCity = :arrivalCity
               AND date = :date ");
    }
}


function get_5_more_frequented_trips($conn)
{
    $selectMostFrequentedTrips = $conn->prepare("SELECT ROUTE.departureCity, ROUTE.arrivalCity FROM TRIP, ROUTE WHERE ");
    $selectMostFrequentedTrips->execute();
    $mostFrequentedTrips = $selectMostFrequentedTrips->fetchAll(PDO::FETCH_OBJ);
}

function get_5_less_frequented_trips($conn)
{
    $selectLessFrequentedTrips = $conn->prepare("SELECT ROUTE.departureCity, ROUTE.arrivalCity FROM TRIP, ROUTE");
    $selectLessFrequentedTrips->execute();
    $lessFrequentedTrips = $selectLessFrequentedTrips->fetchAll(PDO::FETCH_OBJ);
}

function members_below_limit_review($conn, $minimalReview)
{

    $selectLowReviewMembers = $conn->prepare("SELECT MEMBER.firstname, MEMBER.lastname, MEMBER.review FROM MEMBER WHERE review < ");
    $selectLowReviewMembers->execute();
    $lowReviewmembers = $selectLowReviewMembers->fetchAll(PDO::FETCH_OBJ);

    if ($lowReviewmembers) {
        for($review in $lowReviewmembers) {
            if ($review < $minimalReview) {
                echo "<ul>";
                echo "<li>";
                echo "<div>";
                echo "Nom Prénom";
                $nbFullStars = floor($review);
                $nbHalfStars = floor(($review-floor($review))/0.5);
                $nbEmptyStars = 5 - ceil($review);
                for ($i = 0; $i < $nbFullStars; $i++) {
                    echo "<span class=\"fa fa-star checked\"></span>";
                }
                for ($i = 0; $i < $nbHalfStars; $i++) {
                    echo "<i class=\"fa fa-star-half-o\"></i>";
                }
                for ($i = 0; $i < $nbEmptyStars; $i++) {
                    echo"<span class=\"fa fa-star-o\"></span>";
                }
                echo " (". $review .")";
                echo "<a href=\"#\">Voir le profil</a>";
                echo "</div>";
                echo"</li>";
                echo"</ul>";
            } else {
                echo "<p>Il n'y a aucun membre ayant une note moyenne en dessous de " . $minimalReview ."</p>";
            }
        }
    } else {
        echo "<p>Il n'y a aucun membre ayant une note moyenne en dessous de " . $minimalReview ."</p>";
    }
}
?>
