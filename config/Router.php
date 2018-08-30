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
					elseif (isset($_GET['action']) && $_GET['action'] === 'reported') {
						$this->_frontController->article(str_secur($_GET['idArt']), str_secur($_GET['action']), str_secur($_GET['idComment']));
					}
					else 
					{
						$this->_frontController->article(str_secur($_GET['idArt']));
					}			

				}
				elseif ($_GET['route'] === 'liste')
				{
					$this->_frontController->listeArticles();
				}
				elseif ($_GET['route'] === 'contact')
				{
					$this->_frontController->contact();
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