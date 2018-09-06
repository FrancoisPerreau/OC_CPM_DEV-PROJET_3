<?php 
namespace cyannlab\src\controller;

use cyannlab\src\model\Control;
use cyannlab\src\model\ImageModel;

use cyannlab\src\model\AdminModel;
//use cyannlab\src\model\ArticleModel;
use cyannlab\src\DAO\ArticleDAO;
use cyannlab\src\DAO\CommentDAO;
use cyannlab\src\DAO\DraftDAO;
use cyannlab\src\model\View;

class BackController
{
	// ATTRIBUTS
	// ===================================
	private $_adminModel;
	private $_articleDAO;
	private $_commentDAO;
	private $_draftDAO;
	private $_view;


	// CONSTRUCTEUR
	// ===================================
	public function __construct()
	{
		$this->_adminModel = new AdminModel();
		$this->_articleDAO = new ArticleDAO();
		$this->_commentDAO = new CommentDAO();
		$this->_draftDAO = new DraftDAO();
		$this->_view = new View();
	}



	// MÉTHODES
	// ===================================

	/**
	 * Controller de la vue connection
	 */
	public function connection($action = null)
	{
		$data = [];

		if ($action === 'attemptConnection')
		{
			$data['error'] = $this->_adminModel->connectAdmin(str_secur($_POST['name']), str_secur($_POST['password']));
		}		
		$this->_view->renderConnexion('connection', $data);		
	}

	public function adminDeconnection()
	{
		$this->_adminModel->deconnectionAdmin();
		$this->_view->renderFront('home');
	}

	/**
	 * Controller de la vue adminHome
	 */
	public function adminHome($action = null, $idComment = null)
	{
		$data = [];		
		
		$data['nbReportedComments'] = $this->_commentDAO->getCountReportedComments();
		$data['nbNotModerate'] = $this->_commentDAO->getCountNotModerateComment();
		$data['articles'] = $this->_articleDAO->getArticles();
		$data['drafts']	= $this->_draftDAO->getDrafts();

		$this->_view->renderBack('adminHome', $data);
	}


	/**
	 * Controller de la vue adminDelete
	 */
	public function adminDelete($action, $id, $subject = null)
	{
		$data = [];

		if ($action === 'delateArticle')
		{
			$data['article'] = $this->_articleDAO->getArticle($id);
		}
		elseif ($action === 'delateDraft')
		{
			$data['draft'] = $this->_draftDAO->getDraft($id);
		}
		elseif ($action === 'deleteConfirm')
		{
			if ($subject === 'article')
			{
				$article = $this->_articleDAO->getArticle($id);

				$this->_articletDAO->deleteArticle($id);

				if (!$this->_articletDAO->articleDataExists('id', $id))
				{
					$data['success'] = 'Vous avez supprimé ce brouillon avec succès';
				}
			}

			if ($subject === 'draft')
			{
				$draft = $this->_draftDAO->getDraft($id);				

				$this->_draftDAO->deleteDraft($id);

				if (!$this->_draftDAO->draftDataExists('id', $id))
				{
					$data['success'] = 'Vous avez supprimé ce brouillon avec succès';
				}

			}
		}

		$this->_view->renderBack('adminDelete', $data);
	}


	public function adminEdit($action, $id)
	{
		$data = [];

		if ($action === 'editArticle')
		{
			$data['article'] = $this->_articleDAO->getArticle($id);
		}

		if ($action === 'editDraft')
		{
			$data['draft'] = $this->_draftDAO->getDraft($id);
		}

		$this->_view->renderBack('adminEdit', $data);
	}


	/**
	 * Controller de la vue adminComments
	 */
	public function adminComments($action = null, $idComment = null)
	{
		$data = [];

		if($action === 'moderate')
		{
			$this->_commentDAO->moderateComment($idComment);
			
		}

		$data['reportedComments'] = $this->_commentDAO->getReoprtedComments();
		$data['nbReportedComments'] = $this->_commentDAO->getCountReportedComments();
		$data['nbNotModerate'] = $this->_commentDAO->getCountNotModerateComment();
		
		$this->_view->renderBack('adminComments', $data);
	}

	/**
	 * Controller de la vue adminCreate
	 */
	public function adminCreate()
	{
		$data = [];
		
		extract($_POST);

		// PUBLISH ----------------------
		if (isset($publish))
		{
			$publish ='publish';

			$data['error']=Control::controlAddArticleOrDraft($chapter, $title, $content, $publish);

			if ($this->_articleDAO->articleDataExists('chapter', (int) $chapter))
			{
				$data['error']['chapterExistes'] = 'Ce numéro de chapitre existe déjà';
			}

			if(!$data['error'])
			{
				$newImageName = ImageModel::savImage($_FILES['imageArticle']);				

				$this->_articleDAO->addArticle($chapter, $title, $newImageName, $content);	

				unset($chapter);
				unset($title);
				unset($content);

				$data['validate'] = 'Publication du chapitre réussie';
			}
		}


		// DRAFT ----------------------
		if (isset($draft))
		{			
			$draft = 'draft';

			$data['error']=Control::controlAddArticleOrDraft($chapter, $title, $content, $draft);
			
			if ($this->_articleDAO->articleDataExists('chapter', (int) $chapter))
			{
				$data['error']['chapterExistes'] = 'Ce numéro de chapitre existe déjà';
			}	

			// var_dump($data['error']);		

			if(!$data['error'])
			{
				$newImageName = ImageModel::savImage($_FILES['imageArticle']);				

				$this->_draftDAO->addDraft($chapter, $title, $newImageName, $content);	

				// unset($chapter);
				// unset($title);
				// unset($content);

				$data['validate'] = 'Sauvegarde du brouillon réussie';
			}
		}		

		$this->_view->renderBack('adminCreate',$data);
	}


	public function adminProfil()
	{
		$this->_view->renderBack('adminProfil');
	}


}
