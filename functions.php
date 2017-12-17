<?php

session_start();

function connect_to_db()
{
    $servername = "prodpeda-venus";
    $username = "cquenette";
    $password = "galantis";
    try {
        $conn = new PDO("mysql:host=$servername;dbname=cquenette;charset=utf8;", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connexion réussie";

    } catch (Exception $e) {
        echo "Connection échouée: " . $e->getMessage();
    }
    return $conn;
}

function redirect($url, $statusCode = 303)
{
   header('Location: ' . $url, true, $statusCode);
   die();
}

function login($conn)
{
    if ($email = login_check($conn) !== '') {
        //On récupère le prénom
        $selectFirstName = $conn->prepare("SELECT USER.firstname FROM USER WHERE USER.email = :email");
        $selectFirstName->bindParam(':email', $email);
        $selectFirstName->execute();
        $row = $selectFirstName->fetchAll(PDO::FETCH_OBJ);
        $firstname = $row[0]->firstname;

        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $email;
        $_SESSION['username'] = $firstname;
        $_SESSION['userLevel'] = 'member';
    }
}

function login_check($conn)
{
    $errors = "";
    $email = '';
    if (isset($_POST['connexion'])) {
        if (isset($_POST['email'])) {
            $email = $_POST['email'];
            $selectUser = $conn->prepare("SELECT * FROM USER WHERE USER.email = :email");
            $selectUser->bindParam(':email', $email);
            $selectUser->execute();
            $user = $selectUser->fetchAll(PDO::FETCH_OBJ);
            if ($user[0]->email == $email) {
                if (isset($_POST['password'])) {
                    $password = $_POST['password'];
                    $hash = $user[0]->password;
                    if (password_verify($password, $hash)) {
                        return $email;
                    } else {
                        $errors .= "Le mot de passe saisi est incorrect. ";
                    }
                }
            } else {
                $errors .= "L'email saisi ne correspond à aucun utilisateur";
            }
        }
    }
    print($email);
    echo $errors;
}

function is_logged_in()
{
    return isset($_SESSION['loggedin']) && $_SESSION['loggedin'];
}

function log_out()
{
    $_SESSION['loggedin'] = false;
    $_SESSION['email'] = '';
    $_SESSION['username'] = '';
}

function cant_access_page()
{
    if (!is_logged_in()) {
        echo "Connectez vous pour voir cette page.";
    } else {
        echo "La page que vous demandez est inaccessible.";
    }
}

function set_header()
{
    if (is_logged_in()) {
        if($_SESSION['userLevel'] == 'member') {
            require_once('headerMember.php');
        } elseif ($_SESSION['userLevel'] == 'admin') {
            require_once('headerAdmin.php');
        }
    } else {
        require_once('header.php');
    }
}

function set_header_home_page()
{
    if (is_logged_in()) {
        if($_SESSION['userLevel'] == 'member') {
            require_once('headerHomePageMember.php');
        } elseif ($_SESSION['userLevel'] == 'admin') {
            require_once('headerHomePageAdmin.php');
        }
    } else {
        require_once('headerHomePage.php');
    }
}

function is_admin()
{
    return false;
}

function print_username()
{
    echo "Bienvenue , " . $_SESSION['username'] . "!";
}

function has_a_car($conn)
{
    return true;
    // $selectCar = $conn->prepare("SELECT * FROM CAR, USER WHERE memberID = onwer");
    // $selectCar->bindParam(':minimalReview', $minimalReview);
    // $selectCar->execute();
    // $car = $selectCar->setFetchMode(PDO::FETCH_ASSOC);
    // if () {
    //
    // }
}


function get_5_more_frequented_trips($conn)
{
    $selectMostFrequentedTrips = $conn->prepare("SELECT ROUTE.departureCity, ROUTE.arrivalCity FROM TRIP, ROUTE WHERE TRIP.routeID = ROUTE.routeID");
    $selectMostFrequentedTrips->execute();
    // set the resulting array to associative
    $mostFrequentedTrips = $selectMostFrequentedTrips->setFetchMode(PDO::FETCH_ASSOC);
}

function get_5_less_frequented_trips($conn)
{
    $selectLessFrequentedTrips = $conn->prepare("SELECT ROUTE.departureCity, ROUTE.arrivalCity FROM TRIP, ROUTE WHERE TRIP.routeID = ROUTE.routeID");
    $selectLessFrequentedTrips->execute();
    $lessFrequentedTrips = $selectLessFrequentedTrips->setFetchMode(PDO::FETCH_ASSOC);
}

function members_below_limit_review($conn, $minimalReview)
{
    $selectLowReviewMembers = $conn->prepare("SELECT * FROM MEMBER WHERE review < :minimalReview");
    $selectLowReviewMembers->bindParam(':minimalReview', $minimalReview);
    $selectLowReviewMembers->execute();
    $lowReviewmembers = $selectLowReviewMembers->setFetchMode(PDO::FETCH_ASSOC);

    if ($lowReviewmembers) {
        foreach ($lowReviewmembers as $review) {
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
