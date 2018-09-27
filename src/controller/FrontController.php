<?php 
namespace cyannlab\src\controller;

use cyannlab\src\DAO\ArticleDAO;
use cyannlab\src\DAO\CommentDAO;
use cyannlab\src\model\Contact;
use cyannlab\src\model\Control;
use cyannlab\src\model\View;
use Exception;

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
		//$articles = $this->_articleDAO->getArticles();

		$data = [];

		$data['perPage'] = $perPage = 6;
		$data['totalArticles'] = $totalArticles = $this->_articleDAO->nbOfArticles();
		$data['nbPages'] = $nbPages = ceil($totalArticles / $perPage); // ceil() arrondi à l'entier supérieur

		// Détermine la page courante
		if (isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] > 0)
		{
			$_GET['page'] = intval($_GET['page']);

			if ($_GET['page'] > $nbPages)
			{
				$data['currentPage'] = $currentPage = $nbPages;
			}
			else
			{
				$data['currentPage'] = $currentPage = $_GET['page'];
			}			
		}
		else
		{
			$data['currentPage'] = $currentPage = 1;
		}

		// Détermine le premier article de la page (pour le LIMIT de la requête)
		$firstOfPage = ($currentPage - 1) * $perPage;


		$data['articles'] = $this->_articleDAO->getArticlesPerPage($firstOfPage, $perPage);
		

		$this->_view->renderFront('listearticles', $data);
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
			throw new Exception('Ce chapitre n\'existe pas, ou plus.');
			
			//echo 'cet article n\'existe pas.';
		}
	}

	/**
	 * Controller de la vue contact
	 */
	public function contact($action = null)
	{
		$data['error'] = [];
		
		if ($action === 'postMessage')
		{
			if (!empty($_POST))
			{
				extract($_POST);
				$data['error'] = Control::controlContactForm($firstName, $lastName, $email, $content);
			}
			

			if (empty($data['error']))
			{
				$message = '
				<h2>Message envoyé depuis le formulaire de contact de jeanforteroche.fr</h2>
				<p>' . str_secur($content) . '</p>
				';

				$name = str_secur($firstName) . ' ' . str_secur($lastName);

				mailHtmlFromContact($name, str_secur($email), 'Message de jeanforteroche.fr', $message);
				
				$data['success'] = 'Message envoyé avec succès';
			}			
		}

		$this->_view->renderFront('contact', $data);
	}

	/**
	 * Controller de la vue error
	 */
	public function errorPage($error)
	{
		$data['error'] = $error;
		$this->_view->renderFront('errorPage', $data);
	}


	/**
	 * Controller de la vue Mentions légales
	 */
	public function mentions()
	{
		$this->_view->renderFront('mentionsLegales');
	}

}