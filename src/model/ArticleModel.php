<?php 
namespace cyannlab\src\model;

class Article
{
	// ATRIBUTS
	// =============================
	private $_id;
	private $_title;
	private $_content;
	private $_author;
	private $_date_added;



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
	 * @param $title
	 */
	public function setTitle($title)
	{
		if (is_string($title) && strlen($title) < 255)
		{
			$this->_title = $title;
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
			$this->_author = $author;
		}		
	}

	/**
	 * @param $date_added
	 */
	public function setDateAdded($date_added)
	{
		$this->_date_added = $date_added;
	}


	// GETTERS ---------------------
	/**
	 * @return $_id
	 */
	public function getId() {return $this->_id;}


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
	public function getDateAdded() {return $this->_date_added;}
}