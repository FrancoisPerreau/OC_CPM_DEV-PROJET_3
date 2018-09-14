<?php 
namespace cyannlab\src\model;

class Contact
{
	
	// MÉTHODES
    // =============================
	public function postMessage($post)
	{
		if (!empty($post))
		{
			//session_start();

			extract($post);

			// Vérification firstName
			if (empty($firstName))
			{
				$_SESSION['errorFirstName'] = 'Prénom manquant';				
			}

			// Vérification lastName
			if (empty($lastName))
			{
				$_SESSION['errorLastName'] = 'Nom manquant';				
			}

			// Vérification email
			if (empty($email))
			{
				$_SESSION['errorEmail'] = 'Adresse E-mail manquante';				
			}
			elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
			{
				$_SESSION['errorEmail'] = 'Veuillez saisir une adresse E-mail valide';
			}

			// Vérification content
			if (empty($content))
			{
				$_SESSION['errorContent'] = 'Message manquant';
			}

			
			
			// Si il n'y a pas d'erreur
			if (empty($_SESSION))
			{
				$message = '
				<h2>Message envoyé depuis le formulaire de contact de jeanforteroche.fr</h2>
				<p>' . str_secur($content) . '</p>
				';

				$name = str_secur($firstName) . ' ' . str_secur($lastName);

				mailHtmlFromContact($name, str_secur($email), 'Message de jeanforteroche.fr', $message);
				
				$_SESSION['success'] = 'Message envoyé avec succès';

			}
		}		
	}

}