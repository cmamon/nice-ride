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

function get_5_more_frequented_trips($conn)
{
    $selectMostFrequentedTrips = $conn->prepare("SELECT ROUTE.departureCity, ROUTE.arrivalCity FROM TRIP, ROUTE WHERE ");
    $selectMostFrequentedTrips->execute();
    // set the resulting array to associative
    $mostFrequentedTrips = $selectMostFrequentedTrips->setFetchMode(PDO::FETCH_ASSOC);
}

function get_5_less_frequented_trips($conn)
{
    $selectLessFrequentedTrips = $conn->prepare("SELECT ROUTE.departureCity, ROUTE.arrivalCity FROM TRIP, ROUTE");
    $selectLessFrequentedTrips->execute();
    $lessFrequentedTrips = $selectLessFrequentedTrips->setFetchMode(PDO::FETCH_ASSOC);
}

function members_below_limit_review($conn)
{
    $controls = simplexml_load_file("XML/controls.xml");
    $minimalReview = (float)$controls->adminControls->minimalReview;

    $selectLowReviewMembers = $conn->prepare("SELECT MEMBER.firstname, MEMBER.lastname, MEMBER.review FROM MEMBER WHERE review < ");
    $selectLowReviewMembers->execute();
    $lowReviewmembers = $selectLowReviewMembers->setFetchMode(PDO::FETCH_ASSOC);

    for($review in lowReviewmembers) {
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
}
?>
