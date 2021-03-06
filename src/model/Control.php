<?php 
namespace cyannlab\src\model;

class Control
{

	// MÉTHODES
	// =============================

	// ADD COMMENT
	static function controlAddComment($pseudo, $content)
	{
		$error = [];

		if (empty($pseudo))
		{
			$error['errorPseudo'] = 'Vous devez saisir un pseudo';
		}
		elseif (strlen($pseudo) >= 100) {
			$error['errorPseudo'] = 'Vous devez saisir un pseudo de moins de 100 caractères.';
		}

		if (empty($content))
		{
			$error['errorContent'] = 'Vous devez saisir un message.';
		}

		return $error;
	}



	// CONTACT
	static function controlContactForm($firstName, $lastName, $email, $content)
	{
		$error = [];

		// Vérification firstName
		if (empty($firstName))
		{
			$error['errorFirstName'] = 'Prénom manquant';				
		}

		// Vérification lastName
		if (empty($lastName))
		{
			$error['errorLastName'] = 'Nom manquant';				
		}

		// Vérification email
		if (empty($email))
		{
			$error['errorEmail'] = 'Adresse E-mail manquante';				
		}
		elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$error['errorEmail'] = 'Veuillez saisir une adresse E-mail valide';
		}

		// Vérification content
		if (empty($content))
		{
			$error['errorContent'] = 'Message manquant';
		}

		return $error;
	}


	// ADD CHAPITRE OU BROUILLON
	static function controlAddArticleOrDraft($chapter, $title, $content, $status, $imageExist = null)
	{	
		// Vérification pour publish --------------------
		if (isset($status) && $status ==='publish')
		{
			$error = [];

			$chapter = (int) $chapter;
			

			// Vérification du numéro du chapitre (pas déjas pris)
			if (empty($chapter))
			{				
				$error['chapterEmpty'] = 'Vous devez entrer un numéro de chapitre';
			}
			elseif (!is_int($chapter) && $chapter > 0 )
			{
				$error['chapterInt'] = 'Vous devez saisir un numéro';
			}


			// Vérification de l'image (format et poid)
			if (!empty($_FILES['imageArticle']['name']))
			{
				if (isset($_FILES['imageArticle']) && $_FILES['imageArticle']['error'] == 0)
				{
					if ($_FILES['imageArticle']['type'] != 'image/jpeg')
					{
						$error['imageType'] = 'Le format du fichier doit être du jpeg';
					}

					if ($_FILES['imageArticle']['size'] > 512000)
					{
						
						$error['imageSize'] = 'Le fichier ne doit pas faire plus de 500 ko';
					}
				}
			}
			else
			{
				if (!$imageExist) {
					$error['imageEmpty'] = 'Vous devez poster une image';
				}				
			}


			// Vérification du titre
			if (empty($title))
			{
				$error['titleEmpty'] = 'Vous devez saisir un titre';
			}

			// Vérification du contenu
			if (empty($content))
			{
				$error['contentEmpty'] = 'Vous devez saisir un contenu';
			}
			return $error;
		}


		// Vérification pour draft
		if (isset($status) && $status === 'draft')
		{
			$error = [];

			$chapter = (int) $chapter;

			if (empty($chapter))
			{				
				$error['chapterEmpty'] = 'Vous devez entrer un numéro de chapitre';
			}
			elseif (!is_int($chapter) && $chapter > 0 )
			{
				$error['chapterInt'] = 'Vous devez saisir un numéro';
			}
		}

		return $error;
	}

	

	// PROFIL PSEUDO
	static function controlProfilPseudo($pseudo)
	{
		$error = [];

		if (empty($pseudo))
		{
			$error['pseudo'] = 'Vous devez saisir un pseudo';
		}
		return $error;
	}


	// PROFIL MAIL
	static function controlProfilMail($mail)
	{
		$error = [];
		if (empty($mail))
		{
			$error['mail'] = 'Vous devez saisir une adresse e-mail';
		}
		elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL))
		{
			$error['mail'] = 'Vous devez saisir une adresse e-mail valide';
		}
		return $error;
	}


	// PROFIL PASSWORD
	static function controlProfilPassword($password, $passwordConfirm)
	{
		$error = [];

		if (empty($password))
		{
			$error['password'] = 'Vous devez saisir un mot de passe';
		}
		elseif (strlen($password) < 8)
		{
			$error['password'] = 'Le mot de passe doit faire au moins 8 caractères';
		}

		if (empty($passwordConfirm))
		{
			$error['passwordConfirm'] = 'Vous devez saisir la confirmation du mot de passe';
		}
		elseif ($password != $passwordConfirm)
		{
			$error['passwordConfirm'] = 'La confirmation du mot de passe est différente du mot de passe';
		}

		return $error;
	}

}