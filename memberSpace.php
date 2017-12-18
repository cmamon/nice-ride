<?php require 'functions.php';
$conn = connect_to_db();

$member = get_member($conn);

if(!is_logged_in()){
    redirect('login.php', 303);
}

?>
<!DOCTYPE html>
<html>
    <head>
        <?php require 'head.php'; ?>
        <title>QUENETTE Christophe</title> <!-- Set name by a request to the database -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <header>
            <?php require 'header.php'; ?>
        </header>
        <div class="main">
            <div class="emphasized member">
                <div class="twoParts">
                    <div class="part1">
                        <a target="_blank" href="images/avatar.png">
                            <img id="profilePicture" src="images/avatar.png" alt="avatar">
                        </a>
                    </div>
                    <div class="part2">
                        <?php
                            echo "<h4>" . $member->lastName . " ". $member->firstName . "</h4><br>";
                            print_star_rating($member->review);
                        ?>
                    </div>
                </div>
                <div class="details">
                    <?php
                        echo "<h4>Adresse : </h4>";
                        echo "<h5>" . $member->adressNumber . " " . $member->adressStreetType . " " . $member->adressStreetName ."</h5>";
                        echo "<br>";
                        echo "<h4>Téléphone : </h4>";
                        echo "<h5>" . $member->phone . "</h5>";
                    ?>
                </div>
            </div>
        </div>

        <footer>
            <?php require 'footer.php'; ?>
        </footer>
    </body>
</html>