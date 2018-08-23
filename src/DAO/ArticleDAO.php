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
		$sql = 'SELECT id, title, content, author, DATE_FORMAT(date_added, "%d/%m/%Y à %Hh%i") AS date_added_fr FROM articles ORDER BY date_added DESC';
		$data = $this->sql($sql);
		
		return $data;
	}

	/**
	 * Retourne la requette pour un article en fonction de l'id passé en argument
	 * @param  int $idArt
	 * @return array
	 */
	public function getArticle($idArt)
	{
		$sql = 'SELECT id, title, content, author, DATE_FORMAT(date_added, "%d/%m/%Y à %Hh%i") AS date_added_fr FROM articles WHERE id = ?';
		$data = $this->sql($sql, [$idArt]);

		return $data;
	}
}