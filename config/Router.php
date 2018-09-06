<?php 
namespace cyannlab\config;

use cyannlab\src\controller\FrontController;
use cyannlab\src\controller\BackController;

class Router
{
	// ATTRIBUT
	// ===================================
	private $_frontController;
	private $_backController;


	// CONSTRUCTEUR
	// ===================================
	public function __construct()
	{
		$this->_frontController = new FrontController();
		$this->_backController = new BackController();
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
				// SIGLE ------------------------------
				if ($_GET['route'] === 'article')
				{	
					if (isset($_GET['action']) && $_GET['action'] === 'addComment')
					{
						$this->_frontController->article(str_secur($_GET['idArt']), str_secur($_GET['action']));
					}
					elseif (isset($_GET['action']) && $_GET['action'] === 'reported') {
						$this->_frontController->article(str_secur($_GET['idArt']), str_secur($_GET['action']), str_secur($_GET['idComment']), str_secur($_GET['nbReported']));
					}
					else 
					{
						$this->_frontController->article(str_secur($_GET['idArt']));
					}
				}

				// LISTE ------------------------------
				elseif ($_GET['route'] === 'liste')
				{
					$this->_frontController->listeArticles();
				}

				// CONTACT ------------------------------
				elseif ($_GET['route'] === 'contact')
				{
					if (isset($_GET['action']) && $_GET['action'] === 'postMessage')
					{
						$this->_frontController->contact(str_secur($_GET['action']));
					}
					else
					{
						$this->_frontController->contact();
					}					
				}

				// CONNEXION ------------------------------
				elseif ($_GET['route'] === 'connection')
				{
					if (isset($_GET['action']) && $_GET['action'] === 'attemptConnection')
					{
						$this->_backController->connection(str_secur($_GET['action']));
					}
					else
					{
						$this->_backController->connection();
					}					
				}
				// DÉCONNEXION ------------------------------
				elseif ($_GET['route'] === 'deconnection')
				{
					$this->_backController->adminDeconnection();
				}

				// ADMIN-HOME ------------------------------
				elseif ($_GET['route'] === 'adminHome')
				{
					
					$this->_backController->adminHome();

				}

				// ADMIN-DELETE ------------------------------
				elseif ($_GET['route'] === 'delete')
				{
					if (isset($_GET['action']) && $_GET['action'] === 'delateArticle')
					{
						$this->_backController->adminDelete(str_secur($_GET['action']), str_secur($_GET['idArt']));
					}
					elseif (isset($_GET['action']) && $_GET['action'] === 'delateDraft')
					{
						$this->_backController->adminDelete(str_secur($_GET['action']), str_secur($_GET['idDraft']));
					}
					elseif (isset($_GET['action']) && $_GET['action'] === 'deleteConfirm')
					{
						$this->_backController->adminDelete(str_secur($_GET['action']), str_secur($_GET['id']), str_secur($_GET['subject']));
					}

				}	

				// ADMIN-EDIT ------------------------
				elseif ($_GET['route'] === 'edit')
				{
					if (isset($_GET['action']) && $_GET['action'] === 'editArticle')
					{
						$this->_backController->adminEdit(str_secur($_GET['action']), str_secur($_GET['idArt']));
					}
					elseif (isset($_GET['action']) && $_GET['action'] === 'editDraft')
					{
						$this->_backController->adminEdit(str_secur($_GET['action']), str_secur($_GET['idDraft']));
					}

				}

				// ADMIN-CREATE CHAPTER ------------------------
				elseif ($_GET['route'] === 'adminCreate')
				{
					
					$this->_backController->adminCreate();

				}	

				// ADMIN-COMMENTS ------------------------------
				elseif ($_GET['route'] ==='adminComments')
				{
					if (isset($_GET['action']) && $_GET['action'] === 'moderate')
					{
						$this->_backController->adminComments(str_secur($_GET['action']), str_secur($_GET['idComment']));
					}
					else
					{
						$this->_backController->adminComments();
					}
				}

				// ADMIN-PROFIL ------------------------
				elseif ($_GET['route'] === 'adminProfil')
				{
					
					$this->_backController->adminProfil();

				}		



				else
				{
					echo 'Cette page n\'existe pas';
				}
			}

			// HOME ------------------------------
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