<?php
$this->setTitle('ADMIN-Édition');
$title = $this->getPageTitle();

$dadaToUpdate;

if (isset($article))
{
	$dadaToUpdate = $article;
}
elseif (isset($draft))
{
	$dadaToUpdate = $draft;
}
?>

<div class="container-fluid bgcg container-h100">
	<section class="container">				

		<form class="admin-form" action="../public/index.php?route=adminEdit&amp;action=<?= (isset($article) ? 'updateArticle' :''); ?><?= (isset($draft) ? 'updateDraft' :''); ?>&amp;idToUpdate=<?= $dadaToUpdate->getId(); ?>&amp;subject=<?= (isset($article) ? 'article' :''); ?><?= (isset($draft) ? 'draft' :''); ?>" method="post" enctype="multipart/form-data">

			<?= (isset($validate)) ? '<div class="alert alert-success">' . $validate . '</div>' :'';?>
			
			<div class="form-row">
				<div class="col-md-9 align-self-end">
					<h4 class="edit-chapter">
						Modifier le
						<?php
						if (isset($article))
						{
							echo 'chapitre '  . $dadaToUpdate->getChapter();
						} 
						elseif (isset($draft))
						{
							echo 'brouillon du chapitre '  . $dadaToUpdate->getChapter();
						}
						?>
					</h4>
					<div class="form-group block-input-file">
						<input type="file" id="imageArticle" name="imageArticle" class="custom-file-input"  value="<?= (!empty($_POST['imageArticle']) && !isset($validate)) ? $_POST['imageArticle'] :'' ; ?>">	
						<label class="<?= (!empty($_POST['imageArticle'])) ? 'custom-file-label-ok' :'custom-file-label' ; ?>" for="imageArticle" lang="fr">Image <?= (isset($_FILES['imageArticle']) ? '<span class="text-info">' . $_FILES['imageArticle']['name'] . '</span>': '<span class="text-muted">(.jpg de 960px de large)</span>');?></label>
						<?= (isset($error['imageEmpty'])) ? '<div class="text-danger">' . $error['imageEmpty'] . '</div>' :'';?>
						<?= (isset($error['imageType'])) ? '<div class="text-danger">' . $error['imageType'] . '</div>' :'';?>
						<?= (isset($error['imageSize'])) ? '<div class="text-danger">' . $error['imageSize'] . '</div>' :'';?>	
					</div>
				</div>
				<div class="col-md-3">
					<div class="create-block-image">
						<?php if (!empty($dadaToUpdate->getImageName())) : ?>
							<img src="<?= URI_IMAGE_CHAPTER . $dadaToUpdate->getImageName(); ?>" alt="">
							<?php else : ?>
								<img src="<?= '../public/img/image-type.jpg'; ?>" alt="">
							<?php endif; ?>
						</div>
					</div>
				</div>

				<div class="form-group">
					<input type="title" id="title" name="title" class="form-control" placeholder="Titre"  value="<?= (!empty($dadaToUpdate->getTitle()) && !isset($validate)) ? $dadaToUpdate->getTitle() :'' ; ?>">
					<?= (isset($error['titleEmpty'])) ? '<div class="text-danger">' . $error['titleEmpty'] . '</div>' :'';?>
				</div>
				<div class="form-group">
					<?= (isset($error['contentEmpty'])) ? '<div class="text-danger">' . $error['contentEmpty'] . '</div>' :'';?>
					<textarea name="content" id="contentArticle" class="form-control content-article" cols="30" rows="10"><?= (!empty($dadaToUpdate->getContent()) && !isset($validate)) ? $dadaToUpdate->getContent() :'' ; ?></textarea>
				</div>
				<div class="form-row">


					<?php if (isset($article)) : ?>
						<div class="col-md-6" >
							<button type="submit" name="update" class=" btn btn-info btn-block">mettre à jour</button>
						</div>

						<?php elseif (isset($draft)) : ?>
							<div class="col-md-6" >
								<button type="submit" name="draft" class="btn btn-secondary btn-block">mettre à jour</button>
							</div>
							<div class="col-md-6" >
								<button type="submit" name="publish" class=" btn btn-info btn-block">publier</button>
							</div>
						<?php endif; ?>

						
					</div><!-- /form-row -->
				</form>
			</section><!-- /container -->
</div><!-- /container-fluid -->