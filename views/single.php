<?php 
require '../src/DAO/DAO.php';
require '../src/DAO/ArticleDAO.php';
require '../src/DAO/CommentDAO.php';

use cyannlab\src\DAO\ArticleDAO;
use cyannlab\src\DAO\CommentDAO;
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
	<?php $article->closeCursor(); ?>

	<div class="comments_container">
		<h3>Commentaires</h3>
		<?php 
		$commentDao = new CommentDAO();
		$comments = $commentDao->getCommentsFromArticle(htmlspecialchars($_GET['idArt']));

		while ($comment = $comments->fetch()): ?>
			<div class="comment_container">
				<h4><?= htmlspecialchars($comment['pseudo']); ?></h4>
				<p><?= htmlspecialchars($comment['content']); ?></p>
				<p><?= htmlspecialchars($comment['date_added']); ?></p>
			</div>

		<?php endwhile; ?>
		<?php $comments->closeCursor(); ?>
		
	</div>
	
</body>
</html>