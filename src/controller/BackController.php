<?php 
namespace cyannlab\src\controller;

use cyannlab\src\model\AdminModel;
use cyannlab\src\model\View;

class BackController
{
	// ATTRIBUTS
	// ===================================
	private $_AdminModel;
	private $_view;


	// CONSTRUCTEUR
	// ===================================
	public function __construct()
	{
		$this->_AdminModel = new AdminModel();
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
			$data['error'] = $this->_AdminModel->connectAdmin(str_secur($_POST['name']), str_secur($_POST['password']));
		}		
		$this->_view->renderBack('connection', $data);		
	}

	public function adminDeconnection()
	{
		$this->_AdminModel->deconnectionAdmin();
		$this->_view->renderFront('home');
	}

	/**
	 * Controller de la vue adminHome
	 * @return [type] [description]
	 */
	public function adminHome()
	{
		$this->_view->renderBack('adminHome');
	}



}
