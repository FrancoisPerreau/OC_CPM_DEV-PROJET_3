<?php 
$this->setTitle('Le chapitres');
$title = $this->getPageTitle();
?>
<section class="container">
	<h1>Je suis la page de la liste se chapitres</h1>
	<div class="row justify-content-center">
		<?php foreach ($articles as $article):?>
			<div class="col-lg-4">
				<div class="resum-article">
					<div class="img-resum-article">
						<!-- <img src="../public/img/great-horned.jpg" alt="" class="img-resum-article"> -->
					</div>
					<h3><?= str_secur($article->getTitle());?></h3>
					<p class="text-muted"><em>Publié le <?= str_secur($article->getDateAdded());?></em></p>
					<p><?= str_secur($article->getResume());?></p>
					<p class="text-center resum-btn"><a class="btn btn-outline-info btn-block" href="../public/index.php?route=article&amp;idArt=<?= str_secur($article->getId());?>" role="button">Lire la suite &raquo;</a></p>
				</div>
			</div>
		<?php endforeach;?>        
	</div>
</section>