<?php 
$this->setTitle('Le chapitres');
$title = $this->getPageTitle();
?>
<section class="container">
	<h1>Les chapitres publiés</h1>
	<div class="row justify-content-center">
		<?php foreach ($articles as $article):?>
			<div class="col-lg-4 block-resum">
				<div class="resum-article">
					<div class="img-resum-article">
						<img src="<?= URI_IMAGE_CHAPTER . $article->getImageName();?>" alt="<?= $article->getImageAlt();?>">
					</div>
					<h5 class="text-muted text-uppercase">Chapitre <?= str_secur($article->getChapter());?></h5>
					<h3><?= str_secur($article->getTitle());?></h3>
					<p class="text-muted"><em>Publié le <?= str_secur($article->getDateAdded());?></em></p>
					<p><?= $article->getResume();?></p>
					<p class="text-center resum-btn"><a class="btn btn-outline-info btn-block" href="../public/index.php?route=article&amp;idArt=<?= str_secur($article->getId());?>" role="button">Lire la suite &raquo;</a></p>
				</div>
			</div>
		<?php endforeach;?>        
	</div>
</section>