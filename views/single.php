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


	<!-- Affichage du chapitre -->
	<!-- ===================== -->
	<div class="article_container">
		<h2><?= str_secur($article->getTitle());?></h2>
		<p><?= nl2br(str_secur($article->getContent()));?></p>
		<p><?= str_secur($article->getAuthor());?></p>
		<p><?= str_secur($article->getDateAdded());?></p>
	</div>
	<?php //$article->closeCursor(); ?>


	<!-- Affichage des commentaires -->
	<!-- ========================== -->
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


	<!-- Affichage du formulaire -->
	<!-- ======================= -->
	<div class="form_container">
		<h3>Ajouter un commentaire</h3>
		<form action="../public/index.php?route=article&amp;idArt=<?= str_secur($article->getId()) ;?>&amp;action=adComment" method="post">
			<p>
				<label for="pseudo">Pseudo</label><br>
				<input type="text" id="pseudo" name="pseudo" value="<?= (!empty($_POST['pseudo'])) ? $_POST['pseudo'] :'' ; ?>">
			</p>
			<p>
				<label for="content">Message</label><br>
				<textarea name="content" id="content" cols="30" rows="10"><?= (!empty($_POST['content'])) ? $_POST['content'] :'' ; ?></textarea>
			</p>
			<button type="submit">Envoyer</button>
		</form>
	</div>
	
</body>
</html>