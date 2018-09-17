<?php 
$this->setTitle('Le chapitres');
$title = $this->getPageTitle();
?>
<section class="container" id="listeChapitre">
	<h1>Les chapitres publiés</h1>
	<div class="row justify-content-center">
		<?php foreach ($articles as $article):?>
			<div class="col-lg-4 block-resum">
				<div class="resum-article"> 
					<div class="content-resum">         
						<div class="img-resum-article">
							<img src="<?= URI_IMAGE_CHAPTER . $article->getImageName();?>" alt="<?= $article->getImageAlt();?>">
						</div>
						<h5 class="text-muted text-uppercase">Chapitre <?= str_secur($article->getChapter());?></h5>
						<h3><?= str_secur($article->getTitle());?></h3>
						<p class="text-muted"><em>Publié le <?= str_secur($article->getDateAdded());?></em></p>
						<p><?= $article->getResume();?></p>
					</div>
					<p class="text-center resum-btn"><a class="btn btn-outline-info btn-block" href="../public/index.php?route=article&amp;idArt=<?= str_secur($article->getId());?>" role="button">Lire la suite &raquo;</a></p>
				</div>
			</div>			
		<?php endforeach;?>   
	</div>


	<div class="container-pagination">
		<nav aria-label="Page navigation chapitres">
			<ul class="pagination justify-content-center">
				<?php if($currentPage > 1): ?>
					<li class="page-item"><a class="page-link text-info" aria-label="Previous" href="../public/index.php?route=liste&amp;page=<?= $currentPage - 1 ; ?>#listeChapitre">&laquo;</a></li>
					
				<?php endif; ?>

				<?php for ($i=1; $i <= $nbPages ; $i++): ?>

					<?php if ($i == $currentPage):?>
						<li class="page-item active"><a class="page-link text-info" href="../public/index.php?route=liste&amp;page=<?= $i; ?>#listeChapitre"><?= $i; ?></a></li>

						<?php else: ?>
							<li class="page-item"><a class="page-link" href="../public/index.php?route=liste&amp;page=<?= $i; ?>#listeChapitre"><?= $i; ?></a></li>
						<?php endif ;?>
					<?php endfor; ?>

					<?php if($currentPage < $nbPages): ?>
						<li class="page-item"><a class="page-link text-info" href="../public/index.php?route=liste&amp;page=<?= $currentPage + 1 ; ?>#listeChapitre">&raquo;</a></li>
					<?php endif; ?>


				</ul>
			</nav>
		</div>
	</section>