<?php
$this->setTitle('ADMIN-Édition');
$title = $this->getPageTitle();

$data;

if (isset($article))
{
	$data = $article;
}
elseif (isset($draft))
{
	$data = $draft;
}

?>

<h1>Je suis la vue AdminEdite</h1>
<?= (isset($data) ? 'Chapitre n° : ' . $data->getChapter() : '');?>


<div class="container-fluid bgcg container-h100">
	<section class="container">
		
		
		<h4>
			Modifier le
			<?php
			if (isset($article))
			{
				echo 'chapitre '  . $data->getChapter();
			} 
			elseif (isset($draft))
			{
				echo 'brouillon du chapitre '  . $data->getChapter();
			}
			?>
		</h4>
		

		<form class="admin-form" action="../public/index.php?route=adminCreate&amp;action=update" method="post" enctype="multipart/form-data">
			<?= (isset($validate)) ? '<div class="alert alert-success">' . $validate . '</div>' :'';?>
			
			<div class="form-row">
				<div class="col-md-6 form-group">					
					<input type="text" id="chapter" name="chapter" class="form-control" placeholder="Chapitre n°"  value="<?= (!empty($data->getChapter()) && !isset($validate)) ? $data->getChapter() :'' ; ?>">

					<?= (isset($error['chapterEmpty'])) ? '<div class="text-danger">' . $error['chapterEmpty'] . '</div>' :'';?>
					<?= (isset($error['chapterExistes'])) ? '<div class="text-danger">' . $error['chapterExistes'] . '</div>' :'';?>
				</div>
				<div class="col-md-6 form-group">
					
					<input type="file" id="imageArticle" name="imageArticle" class="custom-file-input"  value="<?= (!empty($_POST['imageArticle']) && !isset($validate)) ? $_POST['imageArticle'] :'' ; ?>">	
					<label class="<?= (!empty($_POST['imageArticle'])) ? 'custom-file-label-ok' :'custom-file-label' ; ?>" for="imageArticle" lang="fr">Image <span class="text-muted">(.jpg de 960px de large)</span></label>
					<?= (isset($error['imageEmpty'])) ? '<div class="text-danger">' . $error['imageEmpty'] . '</div>' :'';?>
					<?= (isset($error['imageType'])) ? '<div class="text-danger">' . $error['imageType'] . '</div>' :'';?>
					<?= (isset($error['imageSize'])) ? '<div class="text-danger">' . $error['imageSize'] . '</div>' :'';?>	
				</div>
			</div>
			
			<div class="form-group">
				<input type="title" id="title" name="title" class="form-control" placeholder="Titre"  value="<?= (!empty($data->getTitle()) && !isset($validate)) ? $data->getTitle() :'' ; ?>">
				<?= (isset($error['titleEmpty'])) ? '<div class="text-danger">' . $error['titleEmpty'] . '</div>' :'';?>
			</div>
			<div class="form-group">
				<?= (isset($error['contentEmpty'])) ? '<div class="text-danger">' . $error['contentEmpty'] . '</div>' :'';?>
				<textarea name="content" id="contentArticle" class="form-control content-article" cols="30" rows="10"><?= (!empty($data->getContent()) && !isset($validate)) ? $data->getContent() :'' ; ?></textarea>
			</div>
			<div class="form-row">
				<div class="col-md-6" >
					<button type="submit" name="draft" class="btn btn-secondary btn-block">sauvegarder</button>
				</div>
				<div class="col-md-6" >
					<button type="submit" name="publish" class=" btn btn-info btn-block">publier</button>
				</div>
			</div>
		</form>
	</div><!-- /container -->
</div><!-- /container-fluid -->