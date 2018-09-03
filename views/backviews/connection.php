<div class="container-fluid container-h100 bgcg vertical-align-center">
	<section class="container">		
		
		<form  class="col-12 col-md-6 offset-md-3 " action="../public/index.php?route=connection&amp;action=attemptConnection" method="post">

			<?= (!empty($error)) ? '<div class="alert alert-danger">' . $error . '</div>' : ''; ?>
			
			<div class="form-group">
				<label for="name">Nom</label><br>
				<input type="text" id="name" name="name" class="form-control" required value="">
				
			</div>

			<div class="form-group">
				<label for="password">Mot de passe</label><br>
				<input type="password" id="password" name="password" class="form-control" required value="">
				
			</div>


			<button class="btn btn-outline-info btn-block" type="submit">Connexion</button>

			<p><a class="text-muted" href="">Mot de passe oublié ?</a></p>

		</form>

	</section>
</div>