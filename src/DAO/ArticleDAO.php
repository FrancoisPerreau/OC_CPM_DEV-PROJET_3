<?php 
namespace cyannlab\src\DAO;
use cyannlab\src\DAO\DAO;

class ArticleDAO extends DAO
{

	// MÉTHODES
	// ===================================
	public function getArticles()
	{
		
		$connection = $this->getConnection();

		$sql = $connection->query('SELECT * FROM articles ORDER BY date_added DESC');	
		
		return $sql;

	}
}