<?php 
namespace cyannlab\src\model;

class ArticleModel
{
	// ATRIBUTS
	// =============================
	protected $_id;
	protected $_chapter;
	protected $_title;
	protected $_content;
	protected $_author;
	protected $_dateAdded;
	protected $_imageName;
	protected $_imageAlt;



	// MÉTHODES
	// =============================

	/**
	 * Retourne les 400 premiers catactères d'un article
	 * @return string 
	 */
	public function getResume()
	{
		return substr($this->_content, 0, 400) . ' ...';
	}

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
	 * @param $chapter
	 */
	public function setChapter($chapter)
	{
		$chapter = (int) str_secur($chapter);
		if ($chapter > 0)
		{
			$this->_chapter = str_secur($chapter);
		}		
	}

	/**
	 * @param $title
	 */
	public function setTitle($title)
	{
		if (is_string($title) && strlen($title) < 255)
		{
			$this->_title = str_secur($title);
		}		
	}

	/**
	 * @param $content
	 */
	public function setContent($content)
	{
		if (is_string($content)) {
			$this->_content = $content;
		}		
	}

	/**
	 * @param $author
	 */
	public function setAuthor($author)
	{
		if (is_string($author) && strlen($author) <= 100)
		{
			$this->_author = str_secur($author);
		}		
	}

	/**
	 * @param $dateAdded
	 */
	public function setDateAdded($dateAdded)
	{
		$this->_dateAdded = str_secur($dateAdded);
	}

	/**
	 * @param $imageName
	 */
	public function setImageName($imageName)
	{
		if (is_string($imageName) && strlen($imageName) < 100)
		{
			$this->_imageName = str_secur($imageName);
		}		
	}

	/**
	 * @param $imageAlt
	 */
	public function setImageAlt($imageAlt)
	{
		if (is_string($imageAlt) && strlen($imageAlt) < 255)
		{
			$this->_imageAlt = str_secur($imageAlt);
		}		
	}


	// GETTERS ---------------------
	/**
	 * @return $_id
	 */
	public function getId() {return $this->_id;}

	/**
	 * @return $_chapter
	 */
	public function getChapter() {return $this->_chapter;}


	/**
	 * @return $_title
	 */
	public function getTitle() {return $this->_title;}
	
	/**
	 * @return $_content
	 */public function getContent() {return $this->_content;}
	
	/**
	 * @return $_author
	 */
	public function getAuthor() {return $this->_author;}
	
	/**
	 * @return $_date_added
	 */
	public function getDateAdded() {return $this->_dateAdded;}

	/**
	 * @return $_imageName
	 */
	public function getImageName() {return $this->_imageName;}

	/**
	 * @return $_imageName
	 */
	public function getImageAlt() {return $this->_imageAlt;}
}