<?php
$this->setTitle('ADMIN-Home');
$title = $this->getPageTitle();
?>

<div class="container-fluid bgcg container-h100">
	<div class="admin-top">
		<div class="container">
			<p class="text-muted">
				<?= $nbReportedComments - $nbNotModerate; ?> commentaire(s) signalé(s) non modérés
			</p>
		</div>
	</div>

	<!-- Les chapitres -->
	<section class="container">
		<div class="container-admin-articles">
			<?= (isset($validate)) ? '<div class="alert alert-success">' . $validate . '</div>' :'';?>
			<h4>Liste des chapitres</h4>
			<?php foreach ($articles as $article): ?>
				<div>
					<ul class="list-group list-group-flush comment_container">
						<li class="list-group-item list-group-item-info list-groupe-title admin-listGroup">
							<p>
								<span class="listGroupe-bolck-imag">
									<img src="<?= URI_IMAGE_CHAPTER . $article->getImageName(); ?>" alt="">
								</span>
								<span class="text-muted text-uppercase">
									Chapitre <?= $article->getChapter(); ?>									
								</span>
							</p>
							<span class="admin-groupBTN">
								<a href="../public/index.php?route=article&amp;idArt=<?= str_secur($article->getId());?>" class="btn btn-outline-secondary btn-sm">voir</a>

								<a href="../public/index.php?route=adminEdit&amp;action=editArticle&amp;idArt=<?= str_secur($article->getId());?>" class="btn btn-outline-info btn-sm">éditer</a>

								<a href="../public/index.php?route=delete&amp;action=delateArticle&amp;idArt=<?= str_secur($article->getId());?>" class="btn btn-outline-danger btn-sm">supprimer</a>
							</span>
						</li>
					</ul>
				</div>
			<?php endforeach; ?>			
		</div><!-- /admin-articles -->
	</section>


	<!-- Les brouillons -->
	<section class="container">
		<div class="container-admin-articles">
			<h4>Liste des Brouillons</h4>
			<?php foreach ($drafts as $draft): ?>
				<div>
					<ul class="list-group list-group-flush comment_container">
						<li class="list-group-item list-group-item-secondary list-groupe-title admin-listGroup">
							<p>
								<span class="listGroupe-bolck-imag">
									<?php if (!empty($draft->getImageName())) : ?>
										<img src="<?= URI_IMAGE_CHAPTER . $draft->getImageName(); ?>" alt="">
										<?php else : ?>
											<img src="<?= '../public/img/image-type.jpg'; ?>" alt="">
										<?php endif; ?>
									</span>
									<span class="text-muted text-uppercase">
										Brouillon chapitre <?= $draft->getChapter(); ?>
									</span>
								</p>
								<span class="admin-groupBTN">
									<a href="../public/index.php?route=adminEdit&amp;action=editDraft&amp;idDraft=<?= str_secur($draft->getId());?>" class="btn btn-outline-info btn-sm">éditer</a>

									<a href="../public/index.php?route=delete&amp;action=delateDraft&amp;idDraft=<?= str_secur($draft->getId());?>" class="btn btn-outline-danger btn-sm">supprimer</a>
								</span>
							</li>
						</ul>
					</div>
				<?php endforeach; ?>			
			</div><!-- /admin-articles -->
		</section>

	</div>