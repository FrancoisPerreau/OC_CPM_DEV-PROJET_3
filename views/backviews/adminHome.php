<?php
//session_start();
$this->setTitle('ADMIN-Home');
$title = $this->getPageTitle();
?>

<div class="container-fluid bgcg">
	<div class="admin-top">
		<div class="container">
			<p class="text-muted">
				<?= $nbReportedComments - $nbNotModerate; ?> commentaire(s) signalé(s) non modérés
			</p>
		</div>
	</div>
	<section class="container">
		<div>
			
		</div>
	</section>
</div>