<?php 
namespace cyannlab\src\controller;

use cyannlab\src\DAO\ArticleDAO;
use cyannlab\src\DAO\CommentDAO;

class FrontController
{
	// ATTRIBUTS
	// ===================================	
	private $_articleDAO;
	private $_commentDAO;


	// CONSTRUCTEUR
	// ===================================
	public function __construct()
	{
		$this->_articleDAO = new ArticleDAO();
		$this->_commentDAO = new CommentDAO();
	}




	// MÉTHODES
	// ===================================	

	public function home()
	{
		$articles = $this->_articleDAO->getArticles();

		require '../views/home.php';
	}


	public function article($idArt)
	{
		$article = $this->_articleDAO->getArticle($idArt);
		$comments = $this->_commentDAO->getCommentsFromArticle($idArt);

		require '../views/single.php';

	}
}