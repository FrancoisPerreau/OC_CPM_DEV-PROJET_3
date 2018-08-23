<?php 
// use cyannlab\src\DAO\ArticleDAO;
// use cyannlab\src\DAO\CommentDAO;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Mon beau chapitre</title>

	<link rel="stylesheet" href="../public/css/styles.css">
</head>
<body>
	<h1>Blog de Jean Forteroche</h1>
	<h3>EN CONSTRUCTION</h3>
	<p><a href="../public/index.php">Retour à la liste des chapitres</a></p>

	<?php $data = $article->fetch(); ?>

	<div>
		<h2><?= str_secur($data['title']);?></h2>
		<p><?= str_secur($data['content']);?></p>
		<p><?= str_secur($data['author']);?></p>
		<p><?= str_secur($data['date_added_fr']);?></p>
	</div>
	<?php $article->closeCursor(); ?>

	<div class="comments_container">
		<h3>Commentaires</h3>

		<?php while ($comment = $comments->fetch()): ?>
			<div class="comment_container">
				<h4><?= str_secur($comment['pseudo']); ?></h4>
				<p><?= str_secur($comment['content']); ?></p>
				<p><?= str_secur($comment['date_added_fr']); ?></p>
			</div>

		<?php endwhile; ?>
		<?php $comments->closeCursor(); ?>
		
	</div>
	
</body>
</html>