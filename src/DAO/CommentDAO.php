<?php 
namespace cyannlab\src\DAO;
use cyannlab\src\DAO\DAO;
use cyannlab\src\model\CommentModel;

class CommentDAO extends DAO
{

	// MÉTHODES
	// ===================================

	/**
	 * Ajout un commentaire en BDD
	 * @param string $post
	 * @param string $idArt
	 */
	public function addComment($post, $idArt)
	{
		extract($post);
		
		if (CommentModel::controlAddComment($pseudo, $content))
		{
			$sql = 'INSERT INTO comments(pseudo, content, date_added, article_id) VALUES(?, ?, NOW(), ?)';
			$this->sql($sql, [str_secur($pseudo), str_secur($content), $idArt]);
		}		
	}


	/**
	 * Retourne un commentaire en fonction de son id
	 * @param  $id
	 * @return array
	 */
	public function getComment($id)
	{
		$sql = ('SELECT id, pseudo, content, DATE_FORMAT(date_added, "%d/%m/%Y à %Hh%i") AS date_added_fr, article_id, reported, moderate FROM comments WHERE id = ?');
		$req = $this->sql($sql, [$id]);
		$data = $req->fetch();

		$row = $this->buildComment($data);

		return $row;
	}

	/**
	 * Retourne les commentaires en fonction de l'id de l'article
	 * @param  $idArt
	 * @return array
	 */
	public function getCommentsFromArticle($idArt)
	{
		$sql = 'SELECT id, pseudo, content, DATE_FORMAT(date_added, "%d/%m/%Y à %Hh%i") AS date_added_fr, article_id, reported, moderate FROM comments  WHERE article_id = ? ORDER BY date_added DESC';
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
		$comment->setModerate($row['moderate']);


		$comment->setArticleId($row['article_id']);
		if (isset($row['artChapter'])) {
			$comment->setArticleChapter($row['artChapter']);
		}
		

		return $comment;
	}

	/**
	 * Incrémente le nombre de fois où le commentaire est signalé
	 * @param  $idComment [description]
	 * @param  $idArt     [description]
	 * @param  $nbReporte [description]
	 */
	public function reportedComment($idComment, $idArt, $nbReporte)
	{		
		$data = $nbReporte + 1;		

		$sql = 'UPDATE comments SET reported = ? WHERE id = ?';
		$this->sql($sql,[$data, str_secur($idComment)]);
	}

	/**
	 * Retourne les commentaires Signalés ainsi que le titre de l'article lié
	 * @return array
	 */
	public function getReoprtedComments()
	{
		$sql = 'SELECT com.id, com.pseudo, com.content, DATE_FORMAT(com.date_added, "%d/%m/%Y à %Hh%i") AS date_added_fr, com.article_id, com.reported, art.chapter AS artChapter, com.moderate
		FROM comments AS com
		INNER JOIN articles AS art ON art.id = com.article_id
		WHERE reported > 0 ORDER BY reported DESC';

		$data = $this->sql($sql);

		$commentsReported = [];

		foreach ($data->fetchAll() as $row)
		{
			$commentsReported[] = $this->buildComment($row);
		}
		
		return $commentsReported;
	}

	/**
	 * Retourne le nombre de commentaires signalés
	 * @return int
	 */
	public function getCountReportedComments()
	{
		$sql = 'SELECT COUNT(*) AS nbReported FROM comments WHERE reported > 0';
		$req = $this->sql($sql);
		$data = $req->fetch();
		extract($data);

		return $nbReported;
	}


	/**
	 * Remise à zéro du compteur de commentaires signalés
	 * @param  int $id
	 */
	public function resetCountReportedComments($id)
	{
		$sql = 'UPDATE comments SET reported = 0 WHERE id = ?';
		$parameter = [str_secur($id)];
		$this->sql($sql, $parameter);
	}


	/**
	 * Retourne le nombre de commentaires signalés et non modérés
	 * @return int
	 */
	public function getCountNotModerateComment()
	{
		$sql = 'SELECT COUNT(*) AS nbNotModerate FROM comments WHERE moderate = true';
		$req = $this->sql($sql);
		$data = $req->fetch();
		extract($data);

		return $nbNotModerate;
	}


	/**
	 * Change le boolean moderate
	 * @param  $id
	 */
	public function moderateComment($id)
	{	
		$comment = $this->getComment($id);

		if ($comment->getModerate())
		{
			$sql = 'UPDATE comments SET moderate = false WHERE id = ?';
			$this->sql($sql, [$id]);
		}
		else
		{
			$sql = 'UPDATE comments SET moderate = true WHERE id = ?';
			$this->sql($sql, [$id]);
		}
	}

}