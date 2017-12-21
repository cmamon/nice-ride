<?php

session_start();

// function connect_to_db()
// {
//     $servername = "prodpeda-venus";
//     $username = "cquenette";
//     $password = "galantis";
//     try {
//         $conn = new PDO("mysql:host=$servername;dbname=cquenette;charset=utf8;", $username, $password);
//         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//         // echo "Connexion réussie";
//
//     } catch (Exception $e) {
//         echo "Connection échouée: " . $e->getMessage();
//     }
//     return $conn;
// }

function connect_to_db()
{
    $servername = "localhost";
    $username = "phpmyadmin";
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

function signup_check($conn)
{
    $firstname = $lastname = $birthDate = $email = $password = $adressStreetType = $adressStreetName = $adressCity = $phone = '';
    $adressNumber = 0;

    if (isset($_POST['connexion'])) {
        if (isset($_POST['firstname'])) {
            $firstname = $_POST['firstname'];
            if (isset($_POST['lastname'])) {
                $lastname = $_POST['lastname'];
                if (isset($_POST['birthDate'])) {
                    $birthDate = $_POST['birthDate'];
                    if (isset($_POST['email'])) {
                        $email = format($_POST['email']);
                        $selectUser = $conn->prepare("SELECT * FROM USER WHERE USER.email = :email");
                        $selectUser->bindParam(':email', $email);
                        $selectUser->execute();
                        $user = $selectUser->fetchAll(PDO::FETCH_OBJ);
                        if (empty($user[0]->email)) {
                            if (isset($_POST['password'])) {
                                $password = $_POST['password'];
                                if (isset($_POST['passwordConfirmation'])) {
                                    $passwordConfirmation = $_POST['passwordConfirmation'];
                                    if ($password === $passwordConfirmation) {
                                        $password = password_hash($password, PASSWORD_DEFAULT);
                                        if (isset($_POST['adressNumber'])) {
                                            $adressNumber = $_POST['adressNumber'];
                                            if (isset($_POST['adressStreetType'])) {
                                                $adressStreetType = $_POST['adressStreetType'];
                                                if (isset($_POST['adressStreetName'])) {
                                                    $adressStreetName = $_POST['adressStreetName'];
                                                    if (isset($_POST['adressCity'])) {
                                                        $adressCity = $_POST['adressCity'];
                                                        if (isset($_POST['phone'])) {
                                                            $phone = $_POST['phone'];
                                                        } else {
                                                            return false;
                                                        }
                                                    } else {
                                                        return false;
                                                    }
                                                } else {
                                                    return false;
                                                }
                                            } else {
                                                return false;
                                            }
                                        } else {
                                            return false;
                                        }
                                    } else {
                                        echo "Les mots de passe ne correspondent pas";
                                        return false;
                                    }
                                } else {
                                    echo "Le champ confirmation du mot de passe est requis";
                                    return false;
                                }
                            } else {
                                echo "Le champ mot de passe est requis";
                                return false;
                            }
                        } else {
                            echo "L'email choisi est déja utilisé par un autre utilisateur";
                            return false;
                        }
                    } else {
                        echo "Le champ email est requis";
                        return false;
                    }
                } else {
                    echo "Le champ Date de naissance est requis";
                    return false;
                }
            } else {
                echo "Le champ nom de famille est requis";
                return false;
            }
        } else {
            echo "Le champ prénom est requis";
            return false;
        }
    } else {
        return false;
    }

    $info = array($firstname, $lastname, $birthDate, $email, $password, $adressNumber, $adressStreetType, $adressStreetName, $adressCity, $phone);
    return $info;
}

function insert_new_member($conn)
{
    if (($info = signup_check($conn)) != false) {
            print_r($info);
            $insertUser = $conn->prepare("INSERT INTO USER (firstname, lastname, admin, email, password, adressNumber, adressStreetType, adressStreetName, adressCity, phone)
            VALUES (:firstname, :lastname, 0, :email, :password, :adressNumber, :adressStreetType, :adressStreetName, :adressCity, :phone)");
            $insertUser->bindParam(':firstname', $info[0]);
            $insertUser->bindParam(':lastname', $info[1]);
            $insertUser->bindParam(':email', $info[3]);
            $insertUser->bindParam(':password', $info[4]);
            $insertUser->bindParam(':adressNumber', $info[5], PDO::PARAM_INT);
            $insertUser->bindParam(':adressStreetType', $info[6]);
            $insertUser->bindParam(':adressStreetName', $info[7]);
            $insertUser->bindParam(':adressCity', $info[8]);
            $insertUser->bindParam(':phone', $info[9]);
            $insertUser->execute();


        // On récupère l 'id de l'utilisateur que l'on vient de créer
        try {
            $email = $info[3];
            $selectUserID = $conn->prepare("SELECT userID FROM USER WHERE email = :email");
            $selectUserID->bindParam(':email', $email);
            $selectUserID->execute();
            $userID = $selectUserID->fetchAll(PDO::FETCH_OBJ);
            $userID = $userID[0]->userID;
            echo $userID;

            $birthDate = transform_date($info[2]);

            $insertMember = $conn->prepare("INSERT INTO MEMBER (memberID, birthDate,review) VALUES (:memberID, :birthDate, 0.0)");
            $insertUser->bindParam(':birthDate', $birthDate);
            $insertUser->bindParam(':memberID', $userID);
            $insertMember->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return true;
    }
    return false;
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

        $_SESSION['username'] = $firstname;
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $email;

        if (is_admin($conn)) {
            $_SESSION['userLevel'] = 'admin';
        } else {
            $_SESSION['userLevel'] = 'member';
        }
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

function set_order() // A TESTER
{
    $order = 'TRIP.price';
    if (isset($_POST['sort'])) {
        $sort = ($_POST['sort']);
        if ($sort === 'Date de Parution') {
            $order = 'TRAVEL.travelDate';
        }
    }
    return $order;
}

function transform_date($dateDatepicker)
{
    $dateSQL= "";
    $dateSQL .= substr($dateDatepicker, -4);
    $dateSQL .= "-";
    $dateSQL .= substr($dateDatepicker, 3, 2);
    $dateSQL .= "-";
    $dateSQL .= substr($dateDatepicker, 0, 2);

    return $dateSQL;
}

function get_trips_matching_with_search($conn)
{
    $order = set_order();
    if (isset($_POST['searchDepartureCity'])) {
        $departureCity = $_POST['searchDepartureCity'];
        if (isset($_POST['searchArrivalCity'])) {
            $arrivalCity = $_POST['searchArrivalCity'];
            if (isset($_POST['date'])) {
                try {
                    $travelDate = $_POST['date'];
                    $travelDate = transform_date($travelDate);
                    $selectTripsMatching = $conn->prepare(
                        "SELECT * FROM TRIP, TRAVEL
                        WHERE TRIP.tripID = TRAVEL.tripID
                        AND departureCity = :departureCity
                        AND arrivalCity = :arrivalCity
                        AND travelDate = :travelDate
                        ORDER BY $order");
                        $selectTripsMatching->bindParam(':departureCity', $departureCity);
                        $selectTripsMatching->bindParam(':arrivalCity', $arrivalCity);
                        $selectTripsMatching->bindParam(':travelDate', $travelDate);
                        $selectTripsMatching->execute();
                        $tripsMatching = $selectTripsMatching->fetchAll(PDO::FETCH_OBJ);
                        $_SESSION['tripsMatching'] = $tripsMatching;
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }

            }
        }
    }
    return $tripsMatching;
}

function get_driver_first_name($conn, $tripID, $travelDate)
{
    try {
        $selectDriverID = $conn->prepare(
            "SELECT MEMBER.driverID
             FROM MEMBER, TRAVEL, TRIP
             WHERE MEMBER.memberID = TRAVEL.memberID
             AND TRIP.tripID = TRAVEL.tripID
             AND TRIP.tripID = :tripID
             AND TRAVEL.travelDate = :travelDate");
        $selectDriverID->bindParam(':tripID', $tripID);
        $selectDriverID->bindParam(':travelDate', $travelDate);
        $driverID = $selectDriverID->fetchAll(PDO::FETCH_OBJ);
        $driverID = $driverID[0]->driverID;

        echo $driverID;

    $selectFN = $conn->prepare(
        "SELECT USER.firstname
        FROM USER, MEMBER
        WHERE USER.userID = MEMBER.memberID
          AND memberID = :driverID");
    $selectFN->bindParam(':driverID', $driverID);
    $selectFN->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $firstname = $selectFN->fetchAll(PDO::FETCH_OBJ);
    $firstname = $firstname[0]->firstname;

    echo $firstname;

    return $firstname;
}

function print_trip($conn)
{
    $trips = $_SESSION['tripsMatching'];
    // print_r($trips);

    if (!empty($trips)) {
        foreach ($trips as $trip) {
            $firstname = get_driver_first_name($conn, $trip->tripID, $trip->travelDate);
            echo "<div class=\"trip\">";
                    echo "<div class=\"note\">";
                        echo "<p class=\"infosTrip\">Publiée par " . $firstname . "</p>";
                    echo "</div>";
                    echo "<div class=\"tripTopLeft\">";
                        echo "<p class=\"citiesTrip\">" . $trip->departureCity . "&nbsp;&nbsp; <span class=\"glyphicon glyphicon-arrow-right\"></span>&nbsp;&nbsp;". $trip->arrivalCity ." &nbsp;&nbsp;&nbsp;&nbsp; Le " . date("d-m-Y", strtotime($trip->travelDate)) . "</p>";
                        echo "<div class=\"tripPrice\">";
                            echo $trip->price . " <i class=\"fa fa-eur\" aria-hidden=\"true\"></i>";
                        echo "</div>";
                    echo "</div>";
                echo "<div class=\"tripRight\">";
                if (!is_logged_in()) {
                    echo "</p>Connectez vous pour réserver et avoir les coordonées de " . $firstname . "</p>";
                } else {
                    echo "<div>";
                        echo "<p> ". $firstname ." [dropdown] avec son nuéro de téléphone</p>";
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
    $departureCity = $arrivalCity = $travelDate = '';
    if (isset($_POST['departureCity'])) {
        $departureCity = $_POST['departureCity'];
        if (isset($_POST['arrivalCity'])) {
            $arrivalCity = $_POST['arrivalCity'];
            if (isset($_POST['travelDate'])) {
                $travelDate = $_POST['travelDate'];
            } else {
                echo "Vous devez saisir une ville date";
                return false;
            }
        } else {
            echo "Vous devez saisir une ville d'arrivée";
            return false;
        }
    } else {
        echo "Vous devez saisir une ville de départ";
        return false;
    }
    $tripData = array($departureCity, $arrivalCity, $travelDate);
    return $tripData;
}

function travel_in_db($conn, $travel)
{
    $email = $_SESSION['email'];

    $selectTrip = $conn->prepare(
        "SELECT *
        FROM TRIP, TRAVEL, USER, MEMBER
        WHERE TRIP.tripID = TRAVEL.tripID
          AND TRIP.memberID = MEMBER.memberID
          AND USER.userID = MEMBER.memberID
          AND USER.email = :email
          AND MEMBER.driver = USER.userID
          AND departureCity = :departureCity
          AND arrivalCity = :arrivalCity
          AND travelDate = :travelDate ");
    $selectEmail->bindParam(':departureCity', $travel[0]);
    $selectEmail->bindParam(':arrivalCity', $travel[1]);
    $selectEmail->bindParam(':travelDate', $travel[2]);
    $selectFirstName->execute();
    $row = $selectEmail->fetchAll(PDO::FETCH_OBJ);

    return !empty($row);
}

function insert_trip($conn, $departureCity, $arrivalCity, $date)
{
    if (($trip = check_input_trip()) != false) {
        if (!travel_in_db($conn)) {
            if (!trip_in_db()) {
                $insertTrip = $conn->prepare(
                    "INSERT INTO TRIP (departureCity, arrivalCity)
                     VALUES (:departureCity, :arrivalCity)
                    WHERE TRIP.routeID = ROUTE.routeID
                    ");
                $insertTrip->bindParam(':departureCity', $trip[0]);
                $insertTrip->bindParam(':arrivalCity', $trip[1]);
                $insertTrip->bindParam(':date', $date);
                $insertTrip->execute();
            } else {
                //on récupère l'id du voyage en question, on l'utilise pour l'insérer dans la table travel avec l'id du conducteur.

            }
        } else {
            echo "<h4>Vous avez déja proposé un voyage pour cette date. Vous ne pouvez pas en proposer d'avantage.<h4>";
        }
    }
}

function book_trip()
{
    if (is_logged_in()) {
        // something
    } else {
        echo "Vous n'êtes pas connectés. Vous ne pouvez pas réserver de voyages";
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

function is_admin($conn)
{
    $email = $_SESSION['email'];
    $selectStatus = $conn->prepare("SELECT admin FROM USER WHERE email = :email");
    $selectStatus->bindParam(':email', $email);
    $selectStatus->execute();
    $status = $selectStatus->fetchAll(PDO::FETCH_OBJ);
    $status = $status[0]->admin;

    return $status;
}

function has_a_car($conn)
{
    $selectCar = $conn->prepare("SELECT * FROM CAR, MEMBER WHERE memberID = onwer");
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

    if (!empty($lowReviewmembers)) {
        foreach ($lowReviewmembers as $review) {
            echo "<ul>";
            echo "<li>";
            echo "<div>";
            echo "Nom Prénom";
            print_star_rating($review);
            echo "<a href=\"#\">Voir le profil</a>";
            echo "</div>";
            echo"</li>";
            echo"</ul>";
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
