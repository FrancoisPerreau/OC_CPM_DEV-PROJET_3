<?php 
namespace cyannlab\src\DAO;

use cyannlab\src\DAO\DAO;
//use cyannlab\src\model\AdminModel;

class AdminDAO extends DAO
{
	// MÉTHODES
	// ===================================

	public function getUserForConnection()
	{
		$sql = 'SELECT id, name, password FROM user';
		$req = $this->sql($sql);
		$data = $req->fetch();

		//var_dump($data);
		return $data;
	}

}
