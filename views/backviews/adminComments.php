<?php
//session_start();
$this->setTitle('ADMIN-Commentaires');
$title = $this->getPageTitle();
?>

<div class="container-fluid bgcg">
	<div class="admin-top">
		<div class="container">
			<p class="text-muted">
				<?= $nbReportedComments; ?> commentaire(s) signalé(s) dont <?= $nbReportedComments - $nbNotModerate; ?> non modérés
			</p>
		</div>
	</div>
	<section class="container">		
		<div class="container-reported">
			<h4>Commentaires en attente de modération</h4>
			<?php foreach ($reportedComments as $reportedComment) : ?>
				<?php if(!$reportedComment->getModerate()) : ?>
					<div class="admin-reported-list">
						<ul class="list-group list-group-flush comment_container">
							<li class="list-group-item list-group-item-info list-groupe-title">
								<p class="text-muted comment-list">
									<span class="badge badge-warning reported"><?= str_secur($reportedComment->getReported()); ?></span> Signalement(s)
								</p>	
								<span>						
									<a href="../public/index.php?route=adminComments&amp;action=moderate&amp;idComment=<?= str_secur($reportedComment->getId()); ?>" class="btn btn-outline-danger btn-sm">modérer</a>
									<a href="../public/index.php?route=adminComments&amp;action=reset&amp;idComment=<?= str_secur($reportedComment->getId()); ?>" class="btn btn-outline-info btn-sm"">ignorer</a>
								</span>	
							</li>

							<li class="list-group-item">
								<p class="comment-list text-muted text-uppercase">Chapitre <?= $reportedComment->getArticleChapter(); ?></p>
								<p class="comment-list"><strong><?= str_secur($reportedComment->getPseudo()); ?></strong> - ajouté le : <?= str_secur($reportedComment->getDateAdded()); ?><br>
									<?= str_secur($reportedComment->getContent()); ?></p>
								</li>					
							</ul>
						</div>
					<?php endif; ?>

				<?php endforeach; ?>
			</div>
			<hr>
			<div class="container-reported">
				<h4>Commentaires modérés</h4>
				<?php foreach ($reportedComments as $reportedComment) : ?>
					<?php if($reportedComment->getModerate()) : ?>
						<div class="admin-reported-list">
							<ul class="list-group list-group-flush comment_container">
								<li class="list-group-item list-group-item-secondary list-groupe-title">
									<p class="text-muted comment-list">
										<span class="badge badge-warning reported">Chapitre <?= str_secur($reportedComment->getReported()); ?></span> Signalement(s)
									</p>
									<a href="../public/index.php?route=adminComments&amp;action=moderate&amp;idComment=<?= str_secur($reportedComment->getId()); ?>" class="btn btn-outline-danger btn-sm">annuler</a>
								</li>

								<li class="list-group-item">
									<p class="comment-list text-muted text-uppercase"><?= $reportedComment->getArticleChapter(); ?></p>
									<p class="comment-list"><strong><?= str_secur($reportedComment->getPseudo()); ?></strong> - ajouté le : <?= str_secur($reportedComment->getDateAdded()); ?><br>
										<?= str_secur($reportedComment->getContent()); ?></p>
									</li>					
								</ul>
							</div>
						<?php endif; ?>
					<?php endforeach; ?>
				</div>					
			</section>
		</div>