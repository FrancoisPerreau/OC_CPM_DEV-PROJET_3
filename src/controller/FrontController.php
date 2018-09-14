<?php 
namespace cyannlab\src\controller;

use cyannlab\src\DAO\ArticleDAO;
use cyannlab\src\DAO\CommentDAO;
use cyannlab\src\model\Contact;
use cyannlab\src\model\View;

class FrontController
{
	// ATTRIBUTS
	// ===================================	
	private $_articleDAO;
	private $_commentDAO;
	private $_contact;
	private $_view;


	// CONSTRUCTEUR
	// ===================================
	public function __construct()
	{
		$this->_articleDAO = new ArticleDAO();
		$this->_commentDAO = new CommentDAO();
		$this->_contact = new Contact();
		$this->_view = new View();
	}




	// MÉTHODES
	// ===================================	

	/**
	 * Controller de la vue home
	 */
	public function home()
	{
		$data = [];

		$data['articles'] = $this->_articleDAO->getLastArticles();		

		$this->_view->renderFront('home', $data);
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
		if ($this->_articleDAO->articleDataExists('id', $idArt))
		{			
			$data =[];

			if ($action === 'addComment')
			{
				$this->_commentDAO->addComment($_POST, $idArt);	
				header('location: ../public/index.php?route=article&idArt='. $idArt . '#comments_post');		
			}

			if ($action === 'reported')
			{				
				$this->_commentDAO->reportedComment($idComment, $idArt, $nbReporte);
				header('location: ../public/index.php?route=article&idArt='. $idArt . '#comments_post');
			}

			$article = $this->_articleDAO->getArticle($idArt);

			$data['article'] = $this->_articleDAO->getArticle($idArt);
			$data['comments'] = $this->_commentDAO->getCommentsFromArticle($idArt);
			$data['previousArticle'] = $this->_articleDAO->getPreviousArticle($article->getChapter());
			$data['nextArticle'] = $this->_articleDAO->getNextArticle($article->getChapter());

			$this->_view->renderFront('single', $data);

			if (isset($_SESSION['errorPseudo']))
			{
				unset($_SESSION['errorPseudo']);
			}

			if (isset($_SESSION['errorContent']))
			{
				unset($_SESSION['errorContent']);
			}
		}
		else
		{
			echo 'cet article n\'existe pas.';
		}
	}

	/**
	 * Controller de la vue contact
	 */
	public function contact($action = null)
	{
		
		if ($action === 'postMessage')
		{
			$this->_contact->postMessage($_POST);			
		}
		
		$this->_view->renderFront('contact');
		

		if (isset($_SESSION['errorFirstName']))
		{
			unset($_SESSION['errorFirstName']);
		}

		if (isset($_SESSION['errorLastName']))
		{
			unset($_SESSION['errorLastName']);
		}

		if (isset($_SESSION['errorEmail']))
		{
			unset($_SESSION['errorEmail']);
		}

		if (isset($_SESSION['errorContent']))
		{
			unset($_SESSION['errorContent']);
		}

		if (isset($_SESSION['success']))
		{
			unset($_SESSION['success']);
		}
	}
}