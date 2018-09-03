<?php session_start(); ?>

<div class="container-fluid bgcg">
	<div class="container">
		<h1>
			Je suis la page d'accueil de l'administration
		</h1>

		<?php if (isset($_SESSION['id'])) {
			echo "Ok";
		} ; ?>
	</div>
</div>