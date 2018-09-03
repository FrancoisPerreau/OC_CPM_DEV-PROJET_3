<?php 
namespace cyannlab\src\controller;

use cyannlab\src\model\AdminModel;
use cyannlab\src\DAO\ArticleDAO;
use cyannlab\src\DAO\CommentDAO;
use cyannlab\src\model\View;

class BackController
{
	// ATTRIBUTS
	// ===================================
	private $_adminModel;
	private $_articleDAO;
	private $_commentDAO;
	private $_view;


	// CONSTRUCTEUR
	// ===================================
	public function __construct()
	{
		$this->_adminModel = new AdminModel();
		$this->_articleDAO = new ArticleDAO();
		$this->_commentDAO = new CommentDAO();
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
	 * @return [type] [description]
	 */
	public function adminHome($action = null, $idComment = null)
	{
		$data = [];		

		// $data['reportedComments'] = $this->_commentDAO->getReoprtedComments();
		$data['nbReportedComments'] = $this->_commentDAO->getCountReportedComments();
		$data['nbNotModerate'] = $this->_commentDAO->getCountNotModerateComment();		

		$this->_view->renderBack('adminHome', $data);
	}


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


}
