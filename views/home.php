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

	<?php foreach ($articles as $article):?>
		<div>
			<h2><a href="../public/index.php?route=article&amp;idArt=<?= str_secur($article->getId()) ;?>"><?= str_secur($article->getTitle());?></a></h2>
			<p><?= str_secur($article->getContent());?></p>
			<p><?= str_secur($article->getAuthor());?></p>
			<p><?= str_secur($article->getDateAdded());?></p>
		</div>
	<?php endforeach;?>
	
</body>
</html>