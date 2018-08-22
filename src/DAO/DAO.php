<?php 
namespace cyannlab\src\DAO;
use PDO;

require '../config/dev.php';

class DAO {

	// ATTRIBUTS
	// ===================================
	private $_connection;
	




	// MÉTHODES
	// ===================================
	/**
	 * Vérifie que la connexion n'est pas déjà faite anvant d'en lancer une autre
	 */
	protected function checkConnection()
	{
		if ($this->_connection === null) {
			return $this->getConnection();
		}
		else
		{
			return $this->_connection;
		}
	}




	/**
	 * Connection à la base de bonnées
	 */
	protected function getConnection()
	{
		try {
			$connection = new PDO(DB_MYSQL, DB_USER, DB_PASS);
			$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//echo 'connexion OK';

			return $connection;

			
		} catch (Exception $errorConnection) {
			die ('Erreur de connexion : ' . $errorConnection->getMessage());
		}
	}
}