<!DOCTYPE html>
<html lang="fr">

<head>

  <meta charset="utf-8">
  <link rel="shortcut icon" href="public/img/favicon.ico" type="image/x-icon">
  <link rel="icon" href="public/img/favicon.ico" type="image/x-icon">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Blog de Jean Forteroche">
  <meta name="author" content="Jean Forteroche">

  <title><?= $title ?></title>
  <!-- FB Open Graph data -->
    <meta property="og:title" content="Un billet pour l'Alaska de Jean Forteroche" />
    <meta property="og:type" content="Roman en ligne" />
    <meta property="og:url" content="http://www.projet4.sophiemurat.fr" />
    <meta property="og:image" content="public/img/logo.jpg" />
    <meta property="og:description" content="Venez découvrir en ligne le dernier roman de Jean Forteroche"/>
  
  <!-- Twitter Card data -->
  <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="Roman en ligne" />
    <meta name="twitter:title" content="Un billet pour l'Alaska de Jean Forteroche" />
    <meta name="twitter:image:src" content="http://www.projet4.sophiemurat.fr/public/img/logo.png" />
    <meta name="twitter:description" content="Venez découvrir en ligne le dernier roman de Jean Forteroche"/>

  <!-- Bootstrap core CSS -->
  <link href="public/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

  <!-- Custom styles for this template -->
  <link href="public/css/clean-blog.min.css" rel="stylesheet">

</head>
<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand" href="index.php">Billet simple pour l'Alaska</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Accueil</a>
          </li>
          <li class="nav-item">
          <?php
          if(!empty($_SESSION)){ ?>
            <a class="nav-link" href="index.php?action=unlog">Se déconnecter</a>
          <?php }
          else { ?>
            <a class="nav-link" href="index.php?action=login">Connexion</a>
          <?php } ?> 
          </li>
          <li class="nav-item">
          <?php
          if(empty($_SESSION)){?>
            <a class="nav-link" href="index.php?action=accountCreate">Inscription</a>
          <?php }
          elseif($_SESSION['role']== 'admin'){?>
          <a class="nav-link" href="index.php?action=admin">Retour accueil admin</a>
          <?php }
          else { ?>
          <a>Bonjour <?=$_SESSION['user_name']?> !</a>
          <?php } ?>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Header -->
  <header class="masthead" style="background-image: url('<?=$image ?>')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1><?= $titlePage ?></h1>
            <span class="subheading"><?= $subheadingPage ?></span>
          </div>
        </div>
      </div>
    </div>
  </header>
  <?= $content ?>
</body>

  <!-- Footer -->
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <ul class="list-inline text-center">
            <li class="list-inline-item">
              <a href="#">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
          </ul>
          <p class="copyright text-muted">Copyright &copy; Jean Forteroche 2019</p>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="public/vendor/jquery/jquery.min.js"></script>
  <script src="public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="public/js/clean-blog.min.js"></script>

</body>

</html>