<!DOCTYPE html>
<html>
<head>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Connexion</title>

        <link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="index.css"/>

        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
                              <!-- HEADER -->
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
                        <button type="submit" name="searchButton" class="btn btn-default">Recherche</button>
                    </form>
                </div><!-- /.container-fluid -->
            </nav>
        </header>

        <?php
        if ($_POST['connexion']) {
            if (isset($_POST['email'])) {
                //  Vérifier que l'adresse email existe bien dans la base de donnee
            }
            if (isset($_POST['password'])) {
                //  Verifier que le mot de passe existe bien dans la base de donnee
            }
        }

        if (isset($_POST['remerberMe'])) {

        }
         ?>

                             <!-- MAIN CONTENT -->

        <form class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="inputEmail3" name="email" placeholder="Email">
            </div>
          </div>
          <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Mot de passe</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="inputPassword3" name="password" placeholder="Password" >
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="rememberMe"> Se rappeler de moi
                </label>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <input type="submit" name="connexion" value="Connexion" />
            </div>
          </div>
        </form>

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
