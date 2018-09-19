<?php 
$this->setTitle('Contact');
$title = $this->getPageTitle();
?>
<div class="container-fluid bgcg container-front-h100">

	<section class="container">		
		<h1 id="contact" class="col-12 col-md-6 offset-md-3 contact-title text-center">Contactez-moi...</h1>

		<form  class="col-12 col-md-6 offset-md-3" action="../public/index.php?route=contact&amp;action=postMessage" method="post">

			<?php if(isset($_SESSION['success'])) : ?>
				<div class="alert alert-success "><?= $_SESSION['success']; ?></div>
			<?php endif; ?>


			<div class="form-group">
				<label for="firstName">Prenom</label><br>
				<input type="text" id="firstName" name="firstName" class="form-control" required value="<?= (!empty($_POST['firstName']) && !isset($_SESSION['success'])) ? $_POST['firstName'] : ''; ?>">
				<?= (isset($_SESSION['errorFirstName'])) ? '<div class="text-danger">' . $_SESSION['errorFirstName'] . '</div>' : '' ;?>
			</div>

			<div class="form-group">
				<label for="lastName">Nom</label><br>
				<input type="text" id="lastName" name="lastName" class="form-control" required value="<?= (!empty($_POST['lastName']) && !isset($_SESSION['success'])) ? $_POST['lastName'] : ''; ?>">
				<?= (isset($_SESSION['errorLastName'])) ? '<div class="text-danger">' . $_SESSION['errorLastName'] . '</div>' : '' ;?>
			</div>

			<div class="form-group">
				<label for="email">E-mail</label><br>
				<input type="email" id="email" name="email" class="form-control" required value="<?= (!empty($_POST['email']) && !isset($_SESSION['success'])) ? $_POST['email'] : ''; ?>">
				<?= (isset($_SESSION['errorEmail'])) ? '<div class="text-danger">' . $_SESSION['errorEmail'] . '</div>' : '' ;?>
			</div>

			<div class="form-group">
				<label for="content">Message</label><br>
				<textarea name="content" id="content" class="form-control" required cols="30" rows="6"><?= (!empty($_POST['content']) && !isset($_SESSION['success'])) ? $_POST['content'] : ''; ?></textarea>
				<?= (isset($_SESSION['errorContent'])) ? '<div class="text-danger">' . $_SESSION['errorContent'] . '</div>' : '' ;?>
			</div>

			<button class="btn btn-outline-info btn-block" type="submit">Envoyer</button>

		</form>
	</section>
</div>


