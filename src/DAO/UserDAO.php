<?php 
namespace cyannlab\src\DAO;

use cyannlab\src\DAO\DAO;
use cyannlab\src\model\UserModel;

class UserDAO extends DAO
{
	// MÉTHODES
	// ===================================

	/**
	 * Mise à jour du nom
	 * @param  [str] $pseudo
	 */
	public function updatePseudo($pseudo)
	{
		$sql = 'UPDATE user SET name = ? WHERE id = 1';
		$parameter = [$pseudo];

		$this->sql($sql, $parameter);
	}


	/**
	 * Mise à jour de l'e-mail
	 * @param  [str] $mail
	 */
	public function updateMail($mail)
	{
		$sql = 'UPDATE user SET mail = ? WHERE id = 1';
		$parameter = [$mail];

		$this->sql($sql, $parameter);
	}


	/**
	 * Génère un mot de passe
	 * @return string
	 */
	public function generatePassword()
	{
		return bin2hex(random_bytes(8));
	}


	/**
	 * Mise à jour du mot de passe
	 * @param  [str] $mail
	 */
	public function updatePassword($password)
	{
		$passwordHash = password_hash($password, PASSWORD_DEFAULT);

		$sql = 'UPDATE user SET password = ? WHERE id = 1';
		$parameter = [$passwordHash];

		$this->sql($sql, $parameter);
	}

	/**
	 * Verifie le mot de passe (hash)
	 * @param  $passwordToVerify
	 * @return boolean
	 */
	public function passwordOk($passwordToVerify)
	{
		$sql = 'SELECT password FROM user WHERE id = 1';
		$req = $this->sql($sql);
		$req = $req->fetch();
		$password = $req['password'];

		if (password_verify($passwordToVerify, $password))
		{
			return true;
		}
		else
		{
			return false;
		}
	}


	public function pseudoOk($pseudoToVerify)
	{
		$sql = 'SELECT name FROM user WHERE id = 1';
		$req = $this->sql($sql);
		$req = $req->fetch();
		$pseudo = $req['name'];

		if ($pseudoToVerify === $pseudo)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function mailOk($mailToVerify)
	{
		$sql = 'SELECT mail FROM user WHERE id = 1';
		$req = $this->sql($sql);
		$req = $req->fetch();
		$mail = $req['mail'];

		if ($mailToVerify === $mail)
		{
			return true;
		}
		else
		{
			return false;
		}
	}


	/**
	 * Retourne la requette pour un user en fonction de l'id passé en argument
	 * @param  int $idArt
	 * @return array
	 */
	public function getUser()
	{
		$sql = 'SELECT id, name, mail, password FROM user';
		$data = $this->sql($sql);		

		$user = $this->buildUser($data->fetch());

		return $user;
	}


	/**
	 * Crée une instance de UserModel et lui affecte ses valeurs
	 * @param  array  $row 
	 * @return object
	 */
	private function buildUser(array $row)
	{
		$user = new UserModel();

		$user->setId($row['id']);
		$user->setPseudo($row['name']);
		$user->setMail($row['mail']);
		$user->setPassword($row['password']);

		return $user;
	}

}