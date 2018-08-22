<?php 
require '../src/DAO/DAO.php';
require '../src/DAO/ArticleDAO.php';

use cyannlab\src\DAO\ArticleDAO;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Mon beau chapitre</title>
</head>
<body>
	<h1>Blog de Jean Forteroche</h1>
	<h3>EN CONSTRUCTION</h3>
	<p><a href="http://jeanforteroche.dev/views/home.php">Retour à la liste des chapitres</a></p>

	<?php 
	$articleDao = new ArticleDAO();
	$article = $articleDao->getArticle(htmlspecialchars($_GET['idArt']));

	$data = $article->fetch();
	?>

	<div>
		<h2><?= htmlspecialchars($data['title']);?></h2>
		<p><?= htmlspecialchars($data['content']);?></p>
		<p><?= htmlspecialchars($data['author']);?></p>
		<p><?= htmlspecialchars($data['date_added']);?></p>
	</div>
	
</body>
</html>