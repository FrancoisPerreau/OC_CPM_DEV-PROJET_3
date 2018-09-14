<?php
//session_start();
$this->setTitle('ADMIN-Créer un chapitre');
$title = $this->getPageTitle();
?>

<div class="container-fluid bgcg container-h100">
	<section class="container">
		
		
		<h4>Créer un chapitre</h4>
		

		<form class="admin-form" action="../public/index.php?route=adminCreate&amp;action=create" method="post" enctype="multipart/form-data">
			<?= (isset($validate)) ? '<div class="alert alert-success">' . $validate . '</div>' :'';?>
			
			<div class="form-row">

				<div class="col-md-6 form-group">					
					<input type="text" id="chapter" name="chapter" class="form-control" placeholder="Chapitre n°"  value="<?= (!empty($_POST['chapter']) && !isset($validate)) ? $_POST['chapter'] :'' ; ?>">

					<?= (isset($error['chapterEmpty'])) ? '<div class="text-danger">' . $error['chapterEmpty'] . '</div>' :'';?>
					<?= (isset($error['chapterExistes'])) ? '<div class="text-danger">' . $error['chapterExistes'] . '</div>' :'';?>
				</div>
				<div class="col-md-6 form-group">
					
					<input type="file" id="imageArticle" name="imageArticle" class="custom-file-input"  value="">	
					<label class="custom-file-label" for="imageArticle" lang="fr">Image <?= (isset($_FILES['imageArticle']) ? '<span class="text-info">' . $_FILES['imageArticle']['name'] . '</span>': '<span class="text-muted">(.jpg de 960px de large)</span>');?></label>
					<?= (isset($error['imageEmpty'])) ? '<div class="text-danger">' . $error['imageEmpty'] . '</div>' :'';?>
					<?= (isset($error['imageType'])) ? '<div class="text-danger">' . $error['imageType'] . '</div>' :'';?>
					<?= (isset($error['imageSize'])) ? '<div class="text-danger">' . $error['imageSize'] . '</div>' :'';?>	
				</div>
			</div>

			<div class="form-group">
				<input type="text" id="alt" name="alt" class="form-control" placeholder="Texte alternatif de l'image"  value="<?= (!empty($_POST['alt']) && !isset($validate)) ? $_POST['alt'] :'' ; ?>">
			</div>
			
			<div class="form-group">
				<input type="text" id="title" name="title" class="form-control" placeholder="Titre"  value="<?= (!empty($_POST['title']) && !isset($validate)) ? $_POST['title'] :'' ; ?>">
				<?= (isset($error['titleEmpty'])) ? '<div class="text-danger">' . $error['titleEmpty'] . '</div>' :'';?>
			</div>
			

			<div class="form-group">
				<?= (isset($error['contentEmpty'])) ? '<div class="text-danger">' . $error['contentEmpty'] . '</div>' :'';?>
				<textarea name="content" id="contentArticle" class="form-control content-article" cols="30" rows="10"><?= (!empty($_POST['content']) && !isset($validate)) ? $_POST['content'] :'' ; ?></textarea>
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