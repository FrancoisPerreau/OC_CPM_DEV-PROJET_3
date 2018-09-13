<?php
namespace cyannlab\src\model;

class UserModel
{
	// ATTRIBUTS
	// ===================================
	private $_id;
	private $_pseudo;
	private $_mail;
	private $_password;



	// MÉTHODES
	// =============================

	// SETTERS ---------------------	
	/**
	 * @param $id
	 */
	public function setId($id)
	{
		$id = (int) str_secur($id);
		if ($id > 0) {
			$this->_id = $id;
		}		
	}

	/**
	 * @param $pseudo
	 */
	public function setPseudo($pseudo)
	{
		if(is_string($pseudo) && strlen($pseudo) <= 100)
		{
			$this->_pseudo = str_secur($pseudo);
		}
	}

	/**
	 * @param $mail
	 */
	public function setMail($mail)
	{
		if (filter_var($mail, FILTER_VALIDATE_EMAIL))
		{
			$this->_mail = str_secur($mail);
		}
	}

	/**
	 * @param $password
	 */
	public function setPassword($password)
	{
		if(strlen(str_secur($password)) >= 8)
		{
			$this->_password = str_secur($password);
		}
	}





	// GETTERS ---------------------
	/**
	 * @return $_id
	 */
	public function getId() {return $this->_id;}

	/**
	 * @return $_name
	 */
	public function getPseudo() {return $this->_pseudo;}


	/**
	 * @return $_mail
	 */
	public function getMail() {return $this->_mail;}


	/**
	 * @return $_password
	 */
	public function getPassword() {return $this->_password;}

}