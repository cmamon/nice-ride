
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Carpool</title>

    <link rel="icon" href="http://example.com/favicon.png">

    <!-- Bootstrap -->
    <link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="index.css"/>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
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
                      <a class="navbar-brand" href="index.html">Carpool</a>
                  </div>
                  <form action="index.php" method="post" class="navbar-form navbar-left"  >
                      <div class="form-group">
                          <input type="text" name="searchText" class="form-control" placeholder="Rechercher un trajet">
                      </div>
                      <button type="submit" name="searchButton" class="btn btn-default">Rechercher</button>
                  </form>
                  <?php
                  if (isset($_POST['searchText'])) {
                      # rechercher dans le moteur de recherche de la base
                  }
                   ?>
                  <div class="container">
                      <ul class="nav navbar-nav">
                          <li> <a href="login.html">Connexion</a> </li>
                          <li> <a href="signup.html">Nouveau membre</a> </li>
                      </ul>
                      <!-- <button type="button" class="btn btn-default navbar-btn">Se connecter</button> -->
                  </div>
              </div><!-- /.container-fluid -->
          </nav>
      </header>

      <h1>Bienvenue sur votre site de covoiturage préféré<br><small>Vous ne le quitterez plus ;)</small></h1>

      <ul>
          <li><a href="Something1">Voyager </a></li>
          <li><a href="Something2">Proposer un trajet </a></li>
      </ul>


      <footer>
          <ul class="nav nav-pills">
              <li role="presentation"><a href="contact.html">Nous contacter</a></li>
              <li role="presentation"><a href="help.html">Aide</a></li>
              <li role="presentation"><a href="faq.html">F.A.Q</a></li>
          </ul>
      </footer>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

  </body>
</html>
