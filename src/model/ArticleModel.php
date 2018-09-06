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



	// MÉTHODES
	// =============================

	
	// static function controlAddArticle($chapter, $title, $content, $status)
	// {	
	// 	// Vérification pour publish --------------------
	// 	if (isset($status) && $status ==='publish')
	// 	{
	// 		var_dump('je suis dans la Vérif PUBLISH');			

	// 		$error = [];

	// 		$chapter = (int) $chapter;


	// 		// Vérification du numéro du chapitre (pas déjas pris)
	// 		if (empty($chapter))
	// 		{				
	// 			$error['chapterEmpty'] = 'Vous devez entrer un numéro de chapitre';
	// 		}
	// 		elseif (!is_int($chapter) && $chapter > 0 )
	// 		{
	// 			$error['chapterInt'] = 'Vous devez saisir un numéro';
	// 		}


	// 		// Vérification de l'image (format et poid)
	// 		if (!empty($_FILES['imageArticle']['name']))
	// 		{
	// 			if (isset($_FILES['imageArticle']) && $_FILES['imageArticle']['error'] == 0)
	// 			{
	// 				if ($_FILES['imageArticle']['type'] != 'image/jpeg')
	// 				{
	// 					$error['imageType'] = 'Le format du fichier doit être du jpeg';
	// 				}

	// 				if ($_FILES['imageArticle']['size'] > 512000)
	// 				{

	// 					$error['imageSize'] = 'Le fichier ne doit pas faire plus de 500 ko';
	// 				}
	// 			}
	// 		}
	// 		else
	// 		{
	// 			$error['imageEmpty'] = 'Vous devez poster une image';
	// 		}


	// 		// Vérification du titre
	// 		if (empty($title))
	// 		{
	// 			$error['titleEmpty'] = 'Vous devez saisir un titre';
	// 		}

	// 		// Vérification du contenu
	// 		if (empty($content))
	// 		{
	// 			$error['contentEmpty'] = 'Vous devez saisir un contenu';
	// 		}
	// 		return $error;
	// 	}


	// 	// Vérification pour draft
	// 	if (isset($status) && $status === 'draft')
	// 	{
	// 		//var_dump('je suis dans la Vérif DRAFT');

	// 		$error = [];

	// 		$chapter = (int) $chapter;

	// 		if (empty($chapter))
	// 		{				
	// 			$error['chapterEmpty'] = 'Vous devez entrer un numéro de chapitre';
	// 		}
	// 		elseif (!is_int($chapter) && $chapter > 0 )
	// 		{
	// 			$error['chapterInt'] = 'Vous devez saisir un numéro';
	// 		}
	// 	}

	// 	return $error;
	// }


	// static function savImage($file)
	// {
	// 	// tu changes le nom
	// 	$newName = bin2hex(random_bytes(8)) . '.jpg';

	// 	// Tu enregistre l'image
	// 	if(move_uploaded_file($file['tmp_name'], '../public/img/chapters/' . $newName))
	// 	{
	// 		// Tu retournele nouveau nom
	// 		return $newName;
	// 	}		
	// }


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
}