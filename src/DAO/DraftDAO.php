<?php 
namespace cyannlab\src\DAO;
use cyannlab\src\DAO\DAO;
use cyannlab\src\model\DraftModel;

class DraftDAO extends DAO
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
	public function addDraft($chapter, $title, $newImageName, $alt, $content)
	{
		$sql = 'INSERT INTO drafts(chapter, title, content, author, date_added, image_name, image_alt)
		VALUES(:chapter, :title, :content, :author, NOW(), :image_name, :image_alt)';

		$parameters = [
			'chapter' => $chapter,
			'title' => $title,
			'content' => $content,
			'author' => AUTHOR,
			'image_name' => $newImageName,
			'image_alt' => $alt
		];

		$this->sql($sql, $parameters);
	}


	/**
	 * Mise à jour d'un brouillon en base de données
	 * @param [str] $title 
	 * @param [str] $newImageName
	 * @param [str] $content
	 */
	public function updateDraft($idDraft, $title, $newImageName, $alt, $content)
	{
		$sql = 'UPDATE drafts SET title = :title, content = :content, image_name = :image_name, image_alt = :image_alt WHERE id = :id';

		$parameters = [
			'id' => $idDraft,
			'title' => $title,
			'content' => $content,
			'image_name' => $newImageName,
			'image_alt' => $alt
		];

		$this->sql($sql, $parameters);
	}


	/**
	 * Retourne la requette pour la liste des brouillons classés par chapitre triée en ordre decroissant
	 * @return array
	 */
	public function getDrafts()
	{
		$sql = 'SELECT id, chapter, title, content, author, DATE_FORMAT(date_added, "%d/%m/%Y à %Hh%i") AS date_added_fr, image_name, image_alt FROM drafts ORDER BY chapter';
		$data = $this->sql($sql);

		$drafts = [];

		foreach ($data->fetchAll() as $row)
		{
			$drafts[] = $this->buildDraft($row);
		}

		return $drafts; 
	}


	/**
	 * Retourne la requette pour un brouillon en fonction de l'id passé en argument
	 * @param  int $idArt
	 * @return array
	 */
	public function getDraft($idDraft)
	{
		$sql = 'SELECT id, chapter, title, content, author, DATE_FORMAT(date_added, "%d/%m/%Y à %Hh%i") AS date_added_fr, image_name, image_alt FROM drafts WHERE id = ?';
		$data = $this->sql($sql, [$idDraft]);		

		$draft = $this->buildDraft($data->fetch());

		return $draft;
	}


	/**
	 * Retourne la requette pour un brouillon en fonction du chapitre passé en argument
	 * @param  int $idArt
	 * @return array
	 */
	public function getDraftByChapter($chapterDraft)
	{
		$sql = 'SELECT id, chapter, title, content, author, DATE_FORMAT(date_added, "%d/%m/%Y à %Hh%i") AS date_added_fr, image_name, image_alt FROM drafts WHERE chapter = ?';
		$data = $this->sql($sql, [$chapterDraft]);		

		$draft = $this->buildDraft($data->fetch());

		return $draft;
	}


	/**
	 * Vérifie l'existance d'une donnée dans une colonne de la bd
	 * @param  string $col
	 * @param  int    $data
	 * @return boolean
	 */
	public function draftDataExists($col, int $data)
	{
		$sql = 'SELECT COUNT(*) FROM drafts WHERE ' . $col . ' = ?';
		$parameters = [$data];
		$req = $this->sql($sql, $parameters, $count = 1);

		return $req;
	}


	/**
	 * Suprime un brouillon de la base de donnée
	 * @param  $idDraft
	 */
	public function deleteDraft($idDraft)
	{
		$sql = 'DELETE FROM drafts WHERE id = ?';

		$this->sql($sql, [$idDraft]);
	}



	/**
	 * Crée une instance de DraftModel et lui affecte ses valeurs
	 * @param  array  $row 
	 * @return object
	 */
	private function buildDraft(array $row)
	{
		$draft = new DraftModel();

		$draft->setId($row['id']);
		$draft->setChapter($row['chapter']);
		$draft->setTitle($row['title']);
		$draft->setContent($row['content']);
		$draft->setAuthor($row['author']);
		$draft->setDateAdded($row['date_added_fr']);
		$draft->setImageName($row['image_name']);
		$draft->setImageAlt($row['image_alt']);

		return $draft;
	}

}