<?php 
namespace cyannlab\src\DAO;
use cyannlab\src\DAO\DAO;

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
		$sql = 'SELECT * FROM comments WHERE article_id = ?';
		$data = $this->sql($sql, [$idArt]);

		return $data;
	}

}