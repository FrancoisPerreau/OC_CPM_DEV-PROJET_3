<?php 
namespace cyannlab\src\model;

class CommentModel
{
	// ATRIBUTS
	// =============================
	private $_id;
	private $_pseudo;
	private $_content;
	private $_dateAdded;
	private $_articleId;
	private $_reported;




	// MÉTHODES
	// =============================
	/**
	 * Vérifie les données passées avant de les enregistrées en base de données
	 * @param  string $pseudo
	 * @param  string $content
	 * @return boolean
	 */
	static function controlAddComment($pseudo, $content)
	{
		session_start();

		if (isset($pseudo) && !empty($pseudo) && strlen($pseudo) <= 100)
		{
			if (isset($content) && !empty($content))
			{
				return true;
			}
			else
			{
				$_SESSION['errorContent'] = 'Vous devez saisir un message.';
			}
		}
		else
		{
			$_SESSION['errorPseudo'] = 'Vous devez saisir un pseudo de moins de 100 caractères.';
		}
	}



	// SETTERS ---------------------

	public function setId($id)
	{
		$id = (int) str_secur($id);

		if ($id > 0)
		{
			$this->_id = $id;
		}
	}

	/**
	 * Setter $_pseudo
	 * @param string $pseudo
	 */
	public function setPseudo($pseudo)
	{
		if (is_string($pseudo) && strlen($pseudo) <= 100)
		{
			$this->_pseudo = str_secur($pseudo);
		}
	}

	/**
	 * Setter $_content
	 * @param string $content
	 */
	public function setContent($content)
	{
		if (is_string($content))
		{
			$this->_content = str_secur($content);
		}
	}

	/**
	 * Setter $_dateAdded
	 * @param string $dateAdded
	 */
	public function setDateAdded($dateAdded)
	{
		$this->_dateAdded = str_secur($dateAdded);
	}

	/**
	 * Setter $_articleId
	 * @param int $idArt
	 */
	public function setArticleId($idArt)
	{
		$idArt = (int) str_secur($idArt);
		if ($idArt > 0) {
			$this->_articleId = $idArt;
		}
	}

	/**
	 * Setter $_reported
	 * @param boll $reported
	 */
	public function setReported($reported)
	{
		if (is_bool($reported))
		{
			$this->_reported = $reported;
		}
	}


	// GETTERS ---------------------
	/**
	 * @return $_id
	 */
	public function getId() { return $this->_id; }

	/**
	 * @return $_pseudo
	 */
	public function getPseudo() { return $this->_pseudo; }

	/**
	 * @return $_content
	 */
	public function getContent() { return $this->_content; }

	/**
	 * @return $_dateAdded
	 */
	public function getDateAdded() { return $this->_dateAdded; }

	/**
	 * @return $_articleId
	 */
	public function getArticleId() { return $this->_articleId; }

	/**
	 * @return $_reported
	 */
	public function getReported() { return $this->_reported; }

}	




