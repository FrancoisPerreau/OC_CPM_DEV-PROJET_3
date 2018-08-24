<?php 
namespace cyannlab\src\DAO;
use cyannlab\src\DAO\DAO;
use cyannlab\src\model\ArticleModel;

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

		$articles = [];

		foreach ($data->fetchAll() as $row)
		{
			$articles[] = $this->buildArticle($row);
		}

		//var_dump($articles);
		return $articles; 
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

		$article = $this->buildArticle($data->fetch());

		return $article;
	}

	/**
	 * Crée une instance de ArticleModel et lui affecte ses valeurs
	 * @param  array  $row 
	 * @return object
	 */
	private function buildArticle(array $row)
	{
		$article = new ArticleModel();

		$article->setId($row['id']);
		$article->setTitle($row['title']);
		$article->setContent($row['content']);
		$article->setAuthor($row['author']);
		$article->setDateAdded($row['date_added_fr']);

		return $article;
	}
}