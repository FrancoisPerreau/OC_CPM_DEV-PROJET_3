<?php
namespace cyannlab\src\model;

use cyannlab\src\DAO\AdminDAO;
use cyannlab\src\DAO\UserDAO;
use cyannlab\src\model\UserModel;

class AdminModel
{
	// ATTRIBUTS
	// ===================================
	private $_adminDAO;
	private $_userDAO;
	private $_user;



	// CONSTRUCTEUR
	// ===================================
	public function __construct()
	{
		$this->_adminDAO = new AdminDAO();
		$this->_userDAO = new UserDAO();
	}


	// MÉTHODES
	// ===================================

	/**
	 * Connexion à l'administration
	 * Et création de la $_SESSION
	 * @param   $name     
	 * @param   $password 
	 * @return $error
	 */
	public function connectAdmin($name, $password)
	{
		session_start();

		if($this->accountExists($name, $password))
		{
			$_SESSION['id'] = $this->_user->getId();

			header('Location: ../public/index.php?route=adminHome');
		}
		else
		{
			$error = 'Identifiants erronés';
		}

		return $error;
	}


	public function deconnectionAdmin()
	{
		// Initialisation de la session.
		session_start();

		// Détruit toutes les variables de session
		$_SESSION= [];

		// Si vous voulez détruire complètement la session, effacez également
		// le cookie de session.
		// Note : cela détruira la session et pas seulement les données de session !
		if (ini_get("session.use_cookies")) {
			$params = session_get_cookie_params();
			setcookie(session_name(), '', time() - 42000,
				$params["path"], $params["domain"],
				$params["secure"], $params["httponly"]
			);
		}
		// Finalement, on détruit la session.
		session_destroy();
	}


	/**
	 * Vérifie que le nom et le mot de passe passés 
	 * @param  $name
	 * @param  $password
	 * @return bool
	 */
	public function accountExists($name, $password)
	{
		$this->_user = $this->_userDAO->getUser();

		if ($name === $this->_user->getPseudo() &&  $this->_userDAO->passwordOk($password))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}