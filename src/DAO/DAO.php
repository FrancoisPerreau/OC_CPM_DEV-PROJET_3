<?php 
namespace cyannlab\src\DAO;
use PDO;

require '../config/dev.php';

abstract class DAO {

	// ATTRIBUTS
	// ===================================
	private $_connection;



	// MÉTHODES
	// ===================================
	/**
	 * Vérifie que la connexion n'est pas déjà faite anvant d'en lancer une autre
	 */
	private function checkConnection()
	{
		if ($this->_connection === null)
		{
			return $this->getConnection();
		}
		else {
			return $this->_connection;
		}
	}


	/**
	 * Connection à la base de bonnées
	 */
	private function getConnection()
	{
		try {
			$this->_connection = new PDO(DB_MYSQL, DB_USER, DB_PASS);
			$this->_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//echo 'connexion OK';
			return $this->_connection;			
		}
		catch (Exception $errorConnection) {
			die ('Erreur de connexion : ' . $errorConnection->getMessage());
		}
	}


	protected function sql($sql, $parameters = null)
	{
		if ($parameters)
		{
			$db = $this->checkConnection();
			$data = $db->prepare($sql);
			$data->execute($parameters);
			return $data;
		}
		else {
			$db = $this->checkConnection();
			$data = $db->query($sql);
			return $data;
		}
	}
}