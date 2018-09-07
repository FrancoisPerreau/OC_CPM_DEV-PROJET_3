<?php 
namespace cyannlab\src\DAO;
use cyannlab\src\DAO\DAO;
use cyannlab\src\model\ArticleModel;

class ArticleDAO extends DAO
{

	// MÉTHODES
	// ===================================

	/**
	 * Ajoute un brouillon en base de données
	 * @param [int] $chapter
	 * @param [str] $title 
	 * @param [str] $newImageName
	 * @param [str] $content
	 */
	// public function addDraft($chapter, $title, $newImageName, $content)
	// {
	// 	$sql = 'INSERT INTO drafts(chapter, title, content, author, date_added, image_name)
	// 	VALUES(:chapter, :title, :content, :author, NOW(), :image_name)';

	// 	$parameters = [
	// 		'chapter' => $chapter,
	// 		'title' => $title,
	// 		'content' => $content,
	// 		'author' => AUTHOR,
	// 		'image_name' => $newImageName
	// 	];

	// 	$this->sql($sql, $parameters);
	// }


	/**
	 * Ajoute un article en base de données
	 * @param [int] $chapter
	 * @param [str] $title 
	 * @param [str] $newImageName
	 * @param [str] $content
	 */
	public function addArticle($chapter, $title, $newImageName, $content)
	{
		$sql = 'INSERT INTO articles(chapter, title, content, author, date_added, image_name)
		VALUES(:chapter, :title, :content, :author, NOW(), :image_name)';

		$parameters = [
			'chapter' => $chapter,
			'title' => $title,
			'content' => $content,
			'author' => AUTHOR,
			'image_name' => $newImageName
		];

		$this->sql($sql, $parameters);
	}


	/**
	 * Mise à jour d'un article en base de données
	 * @param [str] $title 
	 * @param [str] $newImageName
	 * @param [str] $content
	 */
	public function updateArticle($idArt, $title, $newImageName, $content)
	{
		$sql = 'UPDATE articles SET title = :title, content = :content, image_name = :image_name WHERE id = :id';

		$parameters = [
			'id' => $idArt,
			'title' => $title,
			'content' => $content,
			'image_name' => $newImageName
		];

		$this->sql($sql, $parameters);
	}



	/**
	 * Retourne la requette pour la liste des articles classés par chapitre triée en ordre decroissant
	 * @return array
	 */
	public function getArticles()
	{
		$sql = 'SELECT id, chapter, title, content, author, DATE_FORMAT(date_added, "%d/%m/%Y à %Hh%i") AS date_added_fr, image_name FROM articles ORDER BY chapter';
		$data = $this->sql($sql);

		$articles = [];

		foreach ($data->fetchAll() as $row)
		{
			$articles[] = $this->buildArticle($row);
		}

		return $articles; 
	}


	/**
	 * Retourne la requette pour la liste des articles classés par chapitre triée en ordre decroissant
	 * @return array
	 */
	public function getLastArticles()
	{
		$sql = 'SELECT id, chapter,title, content, author, DATE_FORMAT(date_added, "%d/%m/%Y à %Hh%i") AS date_added_fr, image_name FROM articles ORDER BY chapter DESC LIMIT 3';
		$data = $this->sql($sql);

		$articles = [];

		foreach ($data->fetchAll() as $row)
		{
			$articles[] = $this->buildArticle($row);
		}

		return $articles; 
	}


	/**
	 * Retourne la requette pour un article en fonction de l'id passé en argument
	 * @param  int $idArt
	 * @return array
	 */
	public function getArticle($idArt)
	{
		$sql = 'SELECT id, chapter, title, content, author, DATE_FORMAT(date_added, "%d/%m/%Y à %Hh%i") AS date_added_fr, image_name FROM articles WHERE id = ?';
		$data = $this->sql($sql, [$idArt]);		

		$article = $this->buildArticle($data->fetch());

		return $article;
	}


	/**
	 * Vérifie l'existance d'une donnée dans une colonne de la bd
	 * @param  string $col
	 * @param  int    $data
	 * @return boolean
	 */
	public function articleDataExists($col, int $data)
	{
		$sql = 'SELECT COUNT(*) FROM articles WHERE ' . $col . ' = ?';
		$parameters = [$data];
		$req = $this->sql($sql, $parameters, $count = 1);

		return $req;
	}


	/**
	 * Suprime un chapitre de la base de donnée
	 * @param  $idArt
	 */
	public function deleteDraft($idArt)
	{
		$sql = 'DELETE FROM articles WHERE id = ?';

		$this->sql($sql, [$idArt]);
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
		$article->setChapter($row['chapter']);
		$article->setTitle($row['title']);
		$article->setContent($row['content']);
		$article->setAuthor($row['author']);
		$article->setDateAdded($row['date_added_fr']);
		$article->setImageName($row['image_name']);

		return $article;
	}
}