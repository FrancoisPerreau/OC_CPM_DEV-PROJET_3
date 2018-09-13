<?php
//session_start();
$this->setTitle('ADMIN-Profil');
$title = $this->getPageTitle();

?>

<div class="container-fluid bgcg container-h100">
	<section class="container col-12 col-md-6 offset-md-3">
		<div class="container-profil">
			<?= (isset($validate)) ? '<div class="alert alert-success">' . $validate . '</div>' :'';?>
			<h4>Vos informations</h4>

			<p class="text-muted">
				<strong>Votre pseudo :</strong> <?= $user->getPseudo(); ?>
			</p>
			<p class="text-muted">
				<strong>Votre e-mail :</strong> <?= $user->getMail(); ?>
			</p>
		</div>

		<hr>

		<h6>Changer de pseudo</h6>
		<form action="../public/index.php?route=adminProfil&amp;action=updatePseudo" method="post" class="row">
			<div class="form-group col ">
				<input type="text" id="pseudo" name="pseudo" class="form-control" required placeholder="<?= $user->getPseudo(); ?>" value="<?= (!empty($_POST['pseudo']) && !isset($validate)) ? $_POST['pseudo'] :'' ; ?>">

				<?= (isset($error['pseudo'])) ? '<div class="text-danger">' . $error['pseudo'] . '</div>' :'';?>

			</div>
			<div class="col-12 col-sm-4 text-right">
				<button class="btn btn-outline-info btn-block" type="submit">modifier</button>
			</div>
		</form>

		<hr>

		<h6>Changer d'e-mail</h6>
		<form action="../public/index.php?route=adminProfil&amp;action=updateMail" method="post" class="row">
			<div class="form-group col">
				<input type="email" id="email" name="email" class="form-control" required placeholder="<?= $user->getMail(); ?>" value="<?= (!empty($_POST['email']) && !isset($validate)) ? $_POST['email'] :'' ; ?>">

				<?= (isset($error['mail'])) ? '<div class="text-danger">' . $error['mail'] . '</div>' :'';?>

			</div>
			<div class="col-12 col-sm-4 text-right">
				<button class="btn btn-outline-info btn-block" type="submit">modifier</button>
			</div>
		</form>

		<hr>

		<h6>Changer de mot de passe <span class="text-muted">(8 caractères minimum)</span></h6>
		<form action="../public/index.php?route=adminProfil&amp;action=updatePass" method="post" class="row">
			<div class="form-group col-12">
				<input type="password" id="password" name="password" class="form-control" required placeholder="nouveau mot de passe" >

				<?= (isset($error['password'])) ? '<div class="text-danger">' . $error['password'] . '</div>' :'';?>

			</div>
			<div class="form-group col">
				<input type="password" id="passwordConfirm" name="passwordConfirm" class="form-control" required placeholder="confirmer le nouveau mot de passe">

				<?= (isset($error['passwordConfirm'])) ? '<div class="text-danger">' . $error['passwordConfirm'] . '</div>' :'';?>

			</div>
			<div class="col-12 col-sm-4 text-right">
				<button class="btn btn-outline-info btn-block" type="submit">modifier</button>
			</div>
		</form>

	</section>


</div>