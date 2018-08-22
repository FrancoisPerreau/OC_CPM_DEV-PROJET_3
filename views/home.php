<?php 

require '../src/DAO/DAO.php';
require '../src/DAO/ArticleDAO.php';

use cyannlab\src\DAO\ArticleDAO;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Jean Forteroche</title>
</head>
<body>
	<h1>Blog de Jean Forteroche</h1>
	<h3>EN CONSTRUCTION</h3>

	<?php 
	
	$data = new ArticleDAO();
	$articles = $data->getArticles();

	while ($article=$articles->fetch()):?>
		<div>
			<h2><a href="http://jeanforteroche.dev/views/single.php?idArt=<?= htmlspecialchars($article['id']) ;?>"><?= htmlspecialchars($article['title']);?></a></h2>
			<p><?= htmlspecialchars($article['content']);?></p>
			<p><?= htmlspecialchars($article['author']);?></p>
			<p><?= htmlspecialchars($article['date_added']);?></p>
		</div>

	<?php endwhile;?>
	<?php $articles->closeCursor(); ?>
</body>
</html>