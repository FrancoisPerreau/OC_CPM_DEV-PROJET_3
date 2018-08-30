<?php 
namespace cyannlab\src\controller;

use cyannlab\src\DAO\ArticleDAO;
use cyannlab\src\DAO\CommentDAO;
use cyannlab\src\model\View;

class FrontController
{
	// ATTRIBUTS
	// ===================================	
	private $_articleDAO;
	private $_commentDAO;
	private $_view;


	// CONSTRUCTEUR
	// ===================================
	public function __construct()
	{
		$this->_articleDAO = new ArticleDAO();
		$this->_commentDAO = new CommentDAO();
		$this->_view = new View();
	}




	// MÉTHODES
	// ===================================	

	/**
	 * Controller de la vue home
	 */
	public function home()
	{
		$articles = $this->_articleDAO->getLastArticles();

		$this->_view->renderFront('home', ['articles' => $articles]);

		// require '../views/frontviews/home.php';
	}

	/**
	 * Controller de la vue listearticles
	 */
	public function listeArticles()
	{
		$articles = $this->_articleDAO->getArticles();

		$this->_view->renderFront('listearticles', ['articles' => $articles]);
	}

	/**
	 * Controller de la vue single
	 */
	public function article($idArt, $action = null, $idComment = null, $nbReporte = null)
	{
		$data =[];

		if ($action === 'addComment')
		{
			$this->_commentDAO->addComment($_POST, $idArt);			
		}

		if ($action === 'reported') {
			// $data['reported'] = $this->_commentDAO->reportedComment($idComment, $idArt);
			
			$this->_commentDAO->reportedComment($idComment, $idArt, $nbReporte);
		}

		$data['article'] = $this->_articleDAO->getArticle($idArt);
		$data['comments'] = $this->_commentDAO->getCommentsFromArticle($idArt);

		$this->_view->renderFront('single', $data);

		if (isset($_SESSION['errorPseudo'])) {
			unset($_SESSION['errorPseudo']);
		}
		
		if (isset($_SESSION['errorContent'])) {
			unset($_SESSION['errorContent']);
		}
	}


	public function contact()
	{
		$this->_view->renderFront('contact');
	}
}