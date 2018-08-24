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

	<div>
		<h2><?= str_secur($article->getTitle());?></h2>
		<p><?= str_secur($article->getContent());?></p>
		<p><?= str_secur($article->getAuthor());?></p>
		<p><?= str_secur($article->getDateAdded());?></p>
	</div>
	<?php //$article->closeCursor(); ?>

	<div class="comments_container">
		<h3>Commentaires</h3>

		<?php foreach ($comments as $comment): ?>
			<div class="comment_container">
				<h4><?= str_secur($comment->getPseudo()); ?></h4>
				<p><?= str_secur($comment->getContent()); ?></p>
				<p><?= str_secur($comment->getDateAdded()); ?></p>
			</div>

		<?php endforeach; ?>
		<?php //$comments->closeCursor(); ?>
		
	</div>
	
</body>
</html>