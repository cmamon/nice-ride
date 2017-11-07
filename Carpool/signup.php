<!DOCTYPE html>
<html>
<head>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>S'inscrire</title>

        <link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="index.css"/>

        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <header>
            <nav class="navbar navbar-default navbar-static-top">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="index.php">Nice ride</a>
                    </div>
                    <form action="index.php" method="post" class="navbar-form navbar-left"  >
                        <div class="form-group">
                            <input type="text" name="searchText" class="form-control" placeholder="Rechercher un trajet">
                        </div>
                        <button type="submit" name="searchButton" class="btn btn-default">Rechercher</button>
                    </form>
                </div><!-- /.container-fluid -->
            </nav>
        </header>

        <?php
        if ($_POST['connexion']) {
            if (isset($_POST['email'])) {
                $_POST['mail'] = htmlspecialchars($_POST['mail']);
                if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['mail']))
                // On vérifie grâce à une regex que l'adresse email est au bon format
                {
                    // On teste si l'adresse n'est pas déjà dans la base de donnée
                    // si elle n'est pas dedans, on l'ajoute.
                    // sinon on dit à l'utilisateur que l'adresse est déja utilisée
                    // realisable par une analyse immédiate de l'adresse
                }
            }
            if (isset($_POST['password'])) {
                $securised = md5($_POST['password']);
                //Associer le mdp à l'adresse si elle a pu être ajoutée
                //Analyse immédiate de la saisie du mdp (respect du nombre min de caractères,
                // des caractères saisissables ...)
            }
        }
        ?>

        <form class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="inputEmail3" placeholder="Saisissez votre adresse email">
            </div>
          </div>
          <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Mot de passe</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="inputPassword3" placeholder="">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <div class="checkbox">
                <label>
                  <input type="checkbox"> Se rappeler de moi
                </label>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <input type="submit" value="S'enregistrer"/>
            </div>
          </div>
        </form>

        <p>Vous possédez déjà un compte? <a href="login.php">Enregistrez vous</a> !</p>

        <footer>
            <ul class="nav nav-pills">
                <li role="presentation"><a href="contact.html">Nous contacter</a></li>
                <li role="presentation"><a href="help.html">Aide</a></li>
                <li role="presentation"><a href="faq.html">F.A.Q</a></li>
            </ul>
        </footer>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    </body>
</html>
