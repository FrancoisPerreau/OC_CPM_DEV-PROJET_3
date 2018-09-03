<?php 
$this->_title = $article->getTitle();
?>
<div class="container-fluid  infos-top">
	<div class="container">
		<p class="text-muted">
			<a class="ariane" href="../public/index.php">Accueil</a> | <a class="ariane" href="../public/index.php?route=liste">La liste des chapitres</a> | <?= str_secur($article->getTitle()); ?>
		</p>
	</div>
</div>


<!-- Affichage du chapitre -->
<!-- ===================== -->
<section class="container article_container">	
	<div class="">
		
		<h2 class="sigle-title"><?= str_secur($article->getTitle());?></h2>
		<p class="text-muted">Publié le <?= str_secur($article->getDateAdded());?></p>
		
		<p class="article-content"><?= nl2br(str_secur($article->getContent()));?></p>			
	</div>
</section>

<!-- Affichage du formulaire et des commentaires -->
<!-- =========================================== -->
<section class="comments_container" id="comments_post">
	<div class="container">
		<div class="col-12 col-lg-8 offset-lg-2">

			<!-- Affichage du formulaire -->
			<div class="comments_form_container">
				<h4>Ajouter un commentaire</h4>
				<form  action="../public/index.php?route=article&amp;idArt=<?= str_secur($article->getId()) ;?>&amp;action=addComment" method="post">
					<div class="form-group">
						<label for="pseudo">Pseudo</label><br>
						<input type="text" id="pseudo" name="pseudo" class="form-control" required value="<?= (!empty($_POST['pseudo'])) ? $_POST['pseudo'] :'' ; ?>">
						<?= (isset($_SESSION['errorPseudo'])) ? '<div class="text-danger">' . $_SESSION['errorPseudo'] . '</div>' :''; ?>
						
					</div>
					<div class="form-group">
						<label for="content">Message</label><br>
						<textarea name="content" id="content" class="form-control" required cols="30" rows="3"><?= (!empty($_POST['content'])) ? $_POST['content'] :'' ; ?></textarea>
						<?= (isset($_SESSION['errorContent'])) ? '<p>' . $_SESSION['errorContent'] . '</p>' :''; ?>
					</div>
					<button class="btn btn-outline-info btn-block" type="submit">Envoyer</button>
				</form>
			</div><!-- /Form-container -->


			<!-- Affichage des commentaires -->		
			<?php foreach ($comments as $comment): ?>
				<ul class="list-group list-group-flush comment_container">
					<li class="list-group-item list-group-item-info list-groupe-title"><strong><?= str_secur($comment->getPseudo()); ?> <span class="date font-weight-light">- le <?= str_secur($comment->getDateAdded()); ?></span></strong>
						
						
						<a class="btn btn-outline-info btn-sm" href="../public/index.php?route=article&amp;idArt=<?= str_secur($article->getId());?>&amp;action=reported&amp;idComment=<?= str_secur($comment->getId());?>&amp;nbReported=<?= str_secur($comment->getReported());?>">Signaler ce commentaire 
							<?php if($comment->getReported() > 0) : ?>
								<span class="badge badge-warning reported"><?= str_secur($comment->getReported()); ?></span>
							<?php endif; ?>
						</a></li>
						<?php if($comment->getModerate()) : ?>
							<li class="list-group-item text-uppercase text-warning">Commentaire modéré</li>
							<?php else : ?>
								<li class="list-group-item"><?= str_secur($comment->getContent()); ?></li>	
							<?php endif; ?>				
						</ul>
					<?php endforeach; ?>
				</div><!-- /col commentaires -->

			</div><!-- /container -->
		</section>
