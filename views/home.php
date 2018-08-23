<?php 
//use cyannlab\src\DAO\ArticleDAO;
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
	
	

	while ($article=$articles->fetch()):?>
		<div>
			<h2><a href="../public/index.php?route=article&amp;idArt=<?= htmlspecialchars($article['id']) ;?>"><?= htmlspecialchars($article['title']);?></a></h2>
			<p><?= htmlspecialchars($article['content']);?></p>
			<p><?= htmlspecialchars($article['author']);?></p>
			<p><?= htmlspecialchars($article['date_added']);?></p>
		</div>

	<?php endwhile;?>
	<?php $articles->closeCursor(); ?>
</body>
</html>