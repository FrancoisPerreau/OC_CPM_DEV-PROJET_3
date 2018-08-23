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
			<h2><a href="../public/index.php?route=article&amp;idArt=<?= str_secur($article['id']) ;?>"><?= str_secur($article['title']);?></a></h2>
			<p><?= str_secur($article['content']);?></p>
			<p><?= str_secur($article['author']);?></p>
			<p><?= str_secur($article['date_added_fr']);?></p>
		</div>

	<?php endwhile;?>
	<?php $articles->closeCursor(); ?>
</body>
</html>