<div class="container-fluid container-h100 bgcg vertical-align-center">
	<section class="container container-forget">		

		<h3 class="text-center">Mot de passe oublié</h3>
		
		<form  class="col-12 col-md-6 offset-md-3 " action="../public/index.php?route=connection&amp;action=forgetPassword" method="post">

			<?= (!empty($errorForget)) ? '<div class="alert alert-danger">' . $errorForget . '</div>' : ''; ?>

			<?= (isset($validate)) ? '<div class="alert alert-success">' . $validate . '</div>' :'';?>
			
			<div class="form-group">
				<label for="pseudo">Pseudo du compte</label><br>
				<input type="text" id="pseudo" name="pseudo" class="form-control">				
			</div>

			<div class="form-group">
				<label for="password">E-mail du compte</label><br>
				<input type="email" id="email" name="email" class="form-control">				
			</div>

			<button class="btn btn-outline-info btn-block" type="submit">Envoyer</button>
		</form>
	</section>
</div>