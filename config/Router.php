<?php 
namespace cyannlab\config;

use cyannlab\src\controller\FrontController;

class Router
{
	// ATTRIBUT
	// ===================================
	private $_frontController;


	// CONSTRUCTEUR
	// ===================================
	public function __construct()
	{
		$this->_frontController = new FrontController();
	}




	// MÉTHODES
	// ===================================

	/**
	 * Définie la vue en fonction de l'argument route passé en GET
	 */
	public function run()
	{
		try {
			if (isset($_GET['route']))
			{
				if ($_GET['route'] === 'article')
				{	
					if (isset($_GET['action']) && $_GET['action'] === 'addComment')
					{
						$this->_frontController->article(str_secur($_GET['idArt']), str_secur($_GET['action']));
					}
					else 
					{
						$this->_frontController->article(str_secur($_GET['idArt']));
					}			

				}
				else
				{
					echo 'Cette page n\'existe pas';
				}
			}
			else
			{
				$this->_frontController->home();
			}
		}
		catch (Exception $e)
		{
			echo 'Erreur';
		}
	}
}