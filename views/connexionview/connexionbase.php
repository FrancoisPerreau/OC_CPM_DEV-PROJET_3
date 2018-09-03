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
	<link href="../public/css/stylesbackend.css" rel="stylesheet">
</head>

<body>

	<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark">
		<a class="navbar-brand" href="#">JEAN FORTEROCHE</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarsExampleDefault">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item  <?= (empty($_GET['route'])) ? 'active' : '' ; ?>">
					<a class="nav-link" href="../public/index.php">Retour au site</a></li>
				</ul>
				
			</ul>
		</div>
	</nav>

	<main role="main">
		

		<?= $content; ?>


	</main>
	<?php require '../views/footer.php' ?>