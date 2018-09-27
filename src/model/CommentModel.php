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
	private $_moderate;

	private $_artChapter;



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
		if (is_string(nl2br($content)))
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
		$reported = (int) str_secur($reported);
		$this->_reported = $reported;
	}

	public function setModerate($moderate)
	{
		$moderate =  str_secur($moderate);
		$this->_moderate = $moderate;
	}


	public function setArticleChapter($artChapter)
	{
		$this->_artChapter = str_secur($artChapter);
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

	public function getModerate() { return $this->_moderate; }

	public function getArticleChapter() { return $this->_artChapter; }

}	




