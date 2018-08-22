<?php 
namespace cyannlab\src\DAO;
use cyannlab\src\DAO\DAO;

class ArticleDAO extends DAO
{

	// MÉTHODES
	// ===================================
	/**
	 * Retourne la requette pour la liste des articles classés par date triée en ordre decroissant
	 * @return array
	 */
	public function getArticles()
	{
		
		$connection = $this->getConnection();

		$sql = $connection->query('SELECT * FROM articles ORDER BY date_added DESC');	
		
		return $sql;

	}

	/**
	 * Retourne la requette pour un article en fonction de l'id passé en argument
	 * @param  int $idArt
	 * @return array
	 */
	public function getArticle($idArt)
	{
		$connection = $this->getConnection();

		$sql = $connection->prepare('SELECT * FROM articles WHERE id = ?');
		$sql->execute([$idArt]);

		var_dump($sql);

		return $sql;

	}
}