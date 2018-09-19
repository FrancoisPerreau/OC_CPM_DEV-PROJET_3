<?php 
$this->setTitle('ADMIN-Supprimer');
$title = $this->getPageTitle();
?>
<div class="container-fluid bgcg container-h100">
	<div class="container container-admin-delete text-center">	
		<h3 class="delete-title">
			Vous vous apprêtez à supprimer le <br>
			<span class="text-uppercase">
				<?= (isset($article)) ? 'Chapitre n° : ' . $article->getChapter() : '' ;?>
				<?= (isset($draft)) ? 'Brouillon n° : ' . $draft->getChapter() : '' ;?>
			</span>
		</h3>
		<?= (isset($success)) ? '<div class="alert alert-success">' . $success . '</div>' :'';?>
		<div class="row">
			<div class="col-md-8 offset-md-2">
				<?php if(!isset($success)) : ?>
					<div class="row">
						<div class="col-6">
							<a class="btn btn-info btn-block" href="../public/index.php?route=adminHome">annuler</a>
						</div>
						<div class="col-6">
							<a class="btn btn-danger btn-block" href="../public/index.php?route=delete&amp;action=deleteConfirm&amp;subject=<?= (isset($article)) ? 'article' : ''; ?><?= (isset($draft)) ? 'draft' : ''; ?>&amp;id=<?= (isset($article)) ? $article->getid() : ''; ?><?= (isset($draft)) ? $draft->getid() : ''; ?>">confirmer</a>
						</div>
					</div>
					<?php else : ?>
						<a class="btn btn-outline-info btn-block" href="../public/index.php?route=adminHome">retour</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>