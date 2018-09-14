<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="../../../../favicon.ico">

  <title><?= $title; ?> | Jean Forteroche</title>

  <!-- Bootstrap core CSS -->
  <link href="../public/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="../public/css/styles.css" rel="stylesheet">
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark">
    <span class="navbar-brand">JEAN FORTEROCHE</span>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item  <?= (empty($_GET['route'])) ? 'active' : '' ; ?>">
          <a class="nav-link" href="../public/index.php">Accueil</a></li>
          <li class="nav-item <?= (isset($_GET['route']) && $_GET['route'] === 'liste') ? 'active' : '' ; ?>">
            <a class="nav-link" href="../public/index.php?route=liste">Les chapitres</a>
          </li>
          <li class="nav-item <?= (isset($_GET['route']) && $_GET['route'] === 'contact') ? 'active' : '' ; ?>">
            <a class="nav-link" href="../public/index.php?route=contact">contact</a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <?php if(!isset($_SESSION['id'])): ?>
            <li class="nav-item">
              <a class="nav-link" href="../public/index.php?route=connection">connexion</a>
            </li>
            <?php else : ?>
             <li class="nav-item">
              <a class="nav-link" href="../public/index.php?route=adminHome">administration</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../public/index.php?route=deconnection">déconnexion</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </nav>