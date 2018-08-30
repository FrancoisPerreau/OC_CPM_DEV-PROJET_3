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

  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="#">JEAN FORTEROCHE</a>
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
              <!-- <form class="form-inline my-2 my-lg-0">
              <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form> -->
          </div>
        </nav>
        <header >
          <div class="container text-center align-self-center">
            <h1 class="display-2">
              Billet simple pour l'Alaska
            </h1>
            <p class="font-weight-light">
              Un roman de <strong>Jean Forteroche,</strong> publié en ligne au fil de l'eau...
            </p>
          </div>
        </header>
        <main role="main">


          <?= $content; ?>


        </main>
        <footer class="container">
          <hr>
          <p>&copy; Company 2017-2018</p>
        </footer>

              <!-- Bootstrap core JavaScript
                ================================================== -->
                <!-- Placed at the end of the document so the pages load faster -->
                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
                <script src="../public/js/popper.min.js"></script>
                <script src="../public/js/bootstrap.min.js"></script>
              </body>
              </html>

