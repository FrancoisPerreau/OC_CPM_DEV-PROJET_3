<?php 
namespace cyannlab\src\controller;

use cyannlab\src\model\Control;
use cyannlab\src\model\ImageModel;

use cyannlab\src\model\AdminModel;
//use cyannlab\src\model\ArticleModel;
use cyannlab\src\DAO\ArticleDAO;
use cyannlab\src\DAO\CommentDAO;
use cyannlab\src\DAO\DraftDAO;
use cyannlab\src\DAO\UserDAO;
use cyannlab\src\model\View;

class BackController
{
	// ATTRIBUTS
	// ===================================
	private $_adminModel;
	private $_articleDAO;
	private $_commentDAO;
	private $_draftDAO;
	private $_userDAO;
	private $_view;


	// CONSTRUCTEUR
	// ===================================
	public function __construct()
	{
		$this->_adminModel = new AdminModel();
		$this->_articleDAO = new ArticleDAO();
		$this->_commentDAO = new CommentDAO();
		$this->_draftDAO = new DraftDAO();
		$this->_userDAO = new UserDAO();
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

			$this->_view->renderConnexion('connection', $data);	
		}
		elseif ($action === 'forgetPassword')
		{
			
			extract($_POST);

			if (empty($pseudo) || empty($email))
			{
				$data['errorForget'] = 'les deux champs sont obligatoirs';
			}
			elseif (!$this->_userDAO->pseudoOk($pseudo) || !$this->_userDAO->mailOk($email))
			{
				$data['errorForget'] = 'Identifiants érronés';
			}

			if (empty($data['errorForget']))
			{
				$newPassword = $this->_userDAO->generatePassword();

				//var_dump($newPassword);

				$this->_userDAO->updatePassword($newPassword);
				
				$user = $this->_userDAO->getUser();
				$email = $user->getMail();
				mailHtmlForgetPassword($email, $newPassword);

				$data['validate'] = 'Un nouveau mot de passe vous été envoyé';		
			}			

			$this->_view->renderConnexion('connectionForget', $data);
		}
		else
		{
			$this->_view->renderConnexion('connection', $data);
		}


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

	/**
	 * Controller de la vue adminEdit
	 */
	public function adminEdit($action, $id, $subject = null)
	{
		$data = [];	

		extract($_POST);	

		// Controle de la vue de base ---------------------
		if ($action === 'editArticle')
		{
			$data['article'] = $this->_articleDAO->getArticle($id);
		}


		if ($action === 'editDraft')
		{
			$data['draft'] = $this->_draftDAO->getDraft($id);
		}
		

		// Controle de la Mise à jour d'article -----------
		if ($action === 'updateArticle' && $subject === 'article')
		{
			//extract($_POST);

			$data['article'] = $article = $this->_articleDAO->getArticle($id);
			$chapter = $article->getChapter();
			$idArt = $article->getId();
			$status = 'publish';

			if (!empty($imageName = $article->getImageName()))
			{
				$imageExist = true;
			}
			else
			{
				$imageExist = false;
			}
			
			$data['error']=Control::controlAddArticleOrDraft($chapter, $title, $content, $status, $imageExist);

			if(!$data['error'])
			{				
				if (!empty($_FILES['imageArticle']['name']))
				{
					$oldName = $article->getImageName();
					$newImageName = ImageModel::savImage($_FILES['imageArticle'], $oldName);
				}
				else
				{
					$newImageName = $article->getImageName();
				}

				$this->_articleDAO->updateArticle($idArt, $title, $newImageName, $alt, $content);	

				$data['validate'] = 'Mise à jour du chapitre réussie';
			}			
		}

		// Controle de la Mise à jour de brouillon  --------
		if (isset($draft) && $action === 'updateDraft' && $subject === 'draft')
		{		
			$data['draft'] = $draft = $this->_draftDAO->getDraft($id);
			$chapter = $draft->getChapter();
			$idDraft = $draft->getId();
			$status = 'draft';
			
			if (!empty($imageName = $draft->getImageName()))
			{
				$imageExist = true;
			}
			else
			{
				$imageExist = false;
			}

			$data['error']=Control::controlAddArticleOrDraft($chapter, $title, $content, $status, $imageExist);
			
			if(!$data['error'])
			{				
				if (!empty($_FILES['imageArticle']['name']))
				{
					$oldName = $draft->getImageName();
					$newImageName = ImageModel::savImage($_FILES['imageArticle'], $oldName);
				}
				elseif ($imageExist)
				{
					$newImageName = $draft->getImageName();
				}
				
				$this->_draftDAO->updateDraft($idDraft, $title, $newImageName, $alt, $content);	

				$data['validate'] = 'Mise à jour du Brouillon réussie';
			}
		}

		// Controle de la publication d'un brouillon  --------
		if (isset($publish) && $action === 'updateDraft' && $subject === 'draft')
		{
			$data['draft'] = $draft = $this->_draftDAO->getDraft($id);
			$chapter = $draft->getChapter();
			$status = 'publish';

			if (!empty($imageName = $draft->getImageName()))
			{
				$imageExist = true;
			}

			$data['error']=Control::controlAddArticleOrDraft($chapter, $title, $content, $status, $imageExist);

			if ($this->_articleDAO->articleDataExists('chapter', (int) $chapter))
			{
				$data['error']['chapterExistes'] = 'Ce numéro de chapitre existe déjà';
			}

			if(!$data['error'])
			{
				if (!empty($_FILES['imageArticle']['name']))
				{
					$newImageName = ImageModel::savImage($_FILES['imageArticle']);
				}
				elseif ($imageExist)
				{
					$newImageName = $draft->getImageName();
				}				

				$this->_articleDAO->addArticle($chapter, $title, $newImageName,$alt, $content);	

				unset($chapter);
				unset($title);
				unset($content);

				$data['validate'] = 'Publication du chapitre réussie';
			}
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

				$this->_articleDAO->addArticle($chapter, $title, $newImageName, $alt, $content);	

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

			$data['error'] = Control::controlAddArticleOrDraft($chapter, $title, $content, $draft);
			
			if ($this->_articleDAO->articleDataExists('chapter', (int) $chapter))
			{
				$data['error']['chapterExistes'] = 'Ce numéro de chapitre existe déjà';
			}

			if(!$data['error'])
			{
				$newImageName = ImageModel::savImage($_FILES['imageArticle']);				

				$this->_draftDAO->addDraft($chapter, $title, $newImageName, $alt, $content);

				$data['validate'] = 'Sauvegarde du brouillon réussie';
			}
		}		

		$this->_view->renderBack('adminCreate',$data);
	}


	public function adminProfil($action = null)
	{
		
		$data['error'] = [];

		extract($_POST);

		// Contrôle Formulaires
		if (isset($action) && str_secur($action) === 'updatePseudo')
		{
			$data['error'] = Control::controlProfilPseudo($pseudo);

			if (!$data['error'])
			{
				$this->_userDAO->updatePseudo($pseudo);
				$data['validate'] = 'Votre pseudo a été modifié';
			}
		}

		elseif (isset($action) && str_secur($action) === 'updateMail')
		{
			$data['error'] = Control::controlProfilMail($email);

			if (!$data['error'])
			{
				$this->_userDAO->updateMail($email);
				$data['validate'] = 'Votre e-mail a été modifié';
			}
		}

		elseif (isset($action) && str_secur($action) === 'updatePass')
		{
			$data['error'] = Control::controlProfilPassword($password, $passwordConfirm);

			if (!$data['error'])
			{
				$this->_userDAO->updatePassword($password);
				$data['validate'] = 'Votre mot de passe a été modifié';
			}
		}

		$data['user'] = $this->_userDAO->getUser();

		$this->_view->renderBack('adminProfil', $data);
	}


}
