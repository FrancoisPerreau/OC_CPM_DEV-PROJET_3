<?php 
namespace cyannlab\src\DAO;
use cyannlab\src\DAO\DAO;
use cyannlab\src\model\CommentModel;

class CommentDAO extends DAO
{

	// MÉTHODES
	// ===================================
	/**
	 * Retourne les commentaires en fonction de l'id de l'article
	 * @param  $idArt
	 * @return array
	 */
	public function getCommentsFromArticle($idArt)
	{
		$sql = 'SELECT id, pseudo, content, DATE_FORMAT(date_added, "%d/%m/%Y à %Hh%i") AS date_added_fr, article_id, reported FROM comments WHERE article_id = ?';
		$data = $this->sql($sql, [$idArt]);

		$comments = [];

		foreach ($data->fetchAll() as $row)
		{
			$comments[] = $this->buildComment($row);
		}
		
		return $comments;
	}



	/**
	 * Crée une instance de CommentModel et lui affecte ses valeurs
	 * @param  array  $row 
	 * @return object
	 */
	private function buildComment(array $row)
	{
		$comment = new CommentModel();

		$comment->setId($row['id']);
		$comment->setPseudo($row['pseudo']);
		$comment->setContent($row['content']);
		$comment->setDateAdded($row['date_added_fr']);
		$comment->setReported($row['reported']);

		return $comment;
	}

}