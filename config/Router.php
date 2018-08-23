<?php 
namespace cyannlab\config;

class Router
{
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
					//$idArt = $_GET['idArt'];
					require '../views/single.php';
				}
				else
				{
					echo 'Cette page n\'existe pas';
				}
			}
			else {
				require '../views/home.php';
			}
		}
		catch (Exception $e)
		{
			echo 'Erreur';
		}
	}
}