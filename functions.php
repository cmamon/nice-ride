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

function format($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function email_in_db($conn, $email)
{
    $selectEmail = $conn->prepare("SELECT * FROM USER WHERE USER.email = :email");
    $selectEmail->bindParam(':email', $email);
    $selectEmail->execute();
    $row = $selectEmail->fetchAll(PDO::FETCH_OBJ);

    return !empty($row);
}

function signup()
{
    if (isset($_POST['connexion'])) {
        if (isset($_POST['email'])) {
            $email = format($_POST['mail']);
            if (filter_var($email, FILTER_VALIDATE_EMAIL)!= false)
            // On vérifie grâce à une regex que l'adresse email est au bon format
            {
                if (!email_in_db($conn, $email)) {
                    if (isset($_POST['password'])) {
                        $securised = password_hash($_POST['password'], PASSWORD_ARGON2I);

                        //Associer le mdp à l'adresse si elle a pu être ajoutée
                        //Analyse immédiate de la saisie du mdp (respect du nombre min de caractères,
                        // des caractères saisissables ...)
                    }
                } else {
                    // sinon on dit à l'utilisateur que l'adresse est déja utilisée
                }
            }
            // else {
            //     adresse email invalide redemander la saisie
            // }
        }
    }
}

function insert_new_user($conn, $firstname, $lastname, $email, $password)
{
    $insertUser = $conn->prepare("INSERT INTO USER (firstname, lastname, email, password)
    VALUES (:firstname, :lastname, :email)");
    $insertUser->bindParam(':firstname', $firstname);
    $insertUser->bindParam(':lastname', $lastname);
    $insertUser->bindParam(':email', $email);
    $$insertUser->execute();
}

function login($conn)
{
    $_SESSION['loggedin'] = false;
    $_SESSION['email'] = "";
    $_SESSION['username'] = "";
    $_SESSION['userLevel'] = "guest";

    $email = login_check($conn);
    if ($email !== '') {
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
    $wrongEmail = $wrongPassword = "";
    $emailErr = $passwordError = $genderErr = ""; //genre inutile ici
    $email = $password = "";
    if (isset($_POST['email'])) {
        $email = format($_POST['email']);
        $selectUser = $conn->prepare("SELECT * FROM USER WHERE USER.email = :email");
        $selectUser->bindParam(':email', $email);
        $selectUser->execute();
        $user = $selectUser->fetchAll(PDO::FETCH_OBJ);
        if (!empty($user[0]->email)) {
            if (isset($_POST['password'])) {
                $password = $_POST['password'];
                $hash = $user[0]->password;
                if (password_verify($password, $hash)) {
                    return $email;
                } else {
                    $wrongPassword = "Le mot de passe saisi est incorrect. ";
                }
            }
        } else {
            $wrongEmail = "L'email saisi ne correspond à aucun utilisateur";
        }
    }
    echo $wrongEmail;
    echo $wrongPassword;
    return "";
}

function is_logged_in()
{
    return (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true);
}

function cant_access_page()
{
    if (!is_logged_in()) {
        echo "Connectez vous pour voir cette page.";
    } else {
        echo "La page que vous demandez est inaccessible.";
    }
}

function get_trips_matching_with_search($conn)
{
    if (isset($_POST['searchDepartureCity'])) {
        $departureCity = $_POST['searchDepartureCity'];
        if (isset($_POST['searchArrivalCity'])) {
            $arrivalCity = $_POST['searchArrivalCity'];
            if (isset($_POST['date'])) {
                $date = $_POST['date'];
                $selectTripsMatching = $conn->prepare(
                    "SELECT * FROM TRIP
                     WHERE departureCity = :departureCity
                       AND arrivalCity = :arrivalCity
                       AND tripDate = :date ");
                $selectTripsMatching->bindParam(':departureCity', $departureCity);
                $selectTripsMatching->bindParam(':arrivalCity', $arrivalCity);
                $selectTripsMatching->bindParam(':tripDate', $date);
                $selectTripsMatching->execute();
                $tripsMatching = $selectTripsMatching->fetchAll(PDO::FETCH_OBJ);
            }
        }
    }
    return $tripsMatching;
}

function print_trip($conn)
{
    $trips = get_trips_matching_with_search($conn);

    if (!empty($trip)) {
        foreach ($trips as $trip) {
            echo "<div class=\"trip\">";
                echo "<div class=\"tripTop\">";
                    echo "<div class=\"note\">";
                        echo "<p class=\"infosTrip\">Publiée le (date) par (prenom du conducteur)</p>";
                    echo "</div>";
                    echo "<div class=\"tripTopLeft\">";
                        echo "<p class=\"cities\">Départ <span class=\"glyphicon glyphicon-arrow-right\"></span> Arrivée</p>";
                        echo "<hr width=\"50%\">";
                        echo "<div class=\"tripPrice\">";
                            echo $trip->price . " euros.";
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
                echo "<div class=\"vl\"></div>";
                echo "<div class=\"tripTopRight\">";
                if (!is_logged_in()) {
                    echo "</p>Connectez vous pour réserver et avoir les coordonées de (prenom du conducteur)</p>";
                } else {
                    echo "<div>";
                        echo "<p>(prenom du conducteur) [dropdown] avec son nuéro de téléphone</p>";
                        echo "<br>";
                        echo "<a href=\"book.php\">Réserver</a>";
                    echo "</div>";
                }
                echo "</div>";
            echo "</div>";
            echo "<hr id=\"tripLimitation\">";
        }
    } else {
        echo "<p>Aucun voyage ne correspond à votre recherche.<br><a href=\"search.php\">Rechercher un autre trajet</a></p>";
    }
}

function print_no_results($queryResults)
{
    if ($queryResults == NULL) {
        echo "Aucun trajet ne correspond à votre demande";
    }
}

function check_input_trip()
//Check if the all the data is correct before insert in db
{
    return true;
}

function trip_in_db($conn)
{

    $selectTrip = $conn->prepare("SELECT * FROM USER WHERE USER.email = :email");
    $selectEmail->bindParam(':email', $email);
    $selectFirstName->execute();
    $row = $selectEmail->fetchAll(PDO::FETCH_OBJ);

    return !empty($row);
}

function insert_trip($conn, $departureCity, $arrivalCity, $date)
{
    if (check_input_trip()) {
        if (!trip_in_db()) {
            $insertTrip = $conn->prepare(
                "INSERT INTO CAR ()
                WHERE TRIP.routeID = ROUTE.routeID
                AND departureCity = :departureCity
                AND arrivalCity = :arrivalCity
                AND date = :date ");
                $insertTrip->bindParam(':departureCity', $departureCity);
                $insertTrip->bindParam(':arrivalCity', $arrivalCity);
                $insertTrip->bindParam(':date', $date);
                $insertTrip->execute();
        }
    }
}

function set_header()
{
    if (is_logged_in()) {
        if ($_SESSION['userLevel'] == 'member') {
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
        if ($_SESSION['userLevel'] == 'member') {
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

function has_a_car($conn)
{
    $selectCar = $conn->prepare("SELECT * FROM CAR, MEMBER WHERE memberID = onwer");
    $selectCar->bindParam(':minimalReview', $minimalReview);
    $selectCar->execute();
    $car = $selectCar->fetchAll(PDO::FETCH_OBJ);
    if (!empty($car)) {
        return true;
    }
    return false;
}

function get_5_more_frequented_trips($conn)
{
    $selectMostFrequentedTrips = $conn->prepare("SELECT ROUTE.departureCity, ROUTE.arrivalCity FROM TRIP, ROUTE WHERE TRIP.routeID = ROUTE.routeID");
    $selectMostFrequentedTrips->execute();
    $mostFrequentedTrips = $selectMostFrequentedTrips->fetchAll(PDO::FETCH_OBJ);
}

function get_5_less_frequented_trips($conn)
{
    $selectLessFrequentedTrips = $conn->prepare("SELECT ROUTE.departureCity, ROUTE.arrivalCity FROM TRIP, ROUTE WHERE TRIP.routeID = ROUTE.routeID");
    $selectLessFrequentedTrips->execute();
    $lessFrequentedTrips = $selectLessFrequentedTrips->fetchAll(PDO::FETCH_OBJ);
}

function print_star_rating($review)
{
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
}

function members_below_limit_review($conn, $minimalReview)
{
    $selectLowReviewMembers = $conn->prepare("SELECT * FROM MEMBER WHERE review < :minimalReview");
    $selectLowReviewMembers->bindParam(':minimalReview', $minimalReview);
    $selectLowReviewMembers->execute();
    $lowReviewmembers = $selectLowReviewMembers->fetchAll(PDO::FETCH_OBJ);

    if ($lowReviewmembers) {
        foreach ($lowReviewmembers as $review) {
            if ($review < $minimalReview) {
                echo "<ul>";
                echo "<li>";
                echo "<div>";
                echo "Nom Prénom";
                print_star_rating($review);
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


function get_member($conn)
{
    $email = format($_SESSION['email']);
    $selectMember = $conn->prepare("SELECT * FROM USER, MEMBER WHERE email = :email");
    $selectMember->bindParam(':email', $email);
    $selectMember->execute();
    $member = $selectMember->fetchAll(PDO::FETCH_OBJ);
    return $member[0];
}
?>
