<?php 
require '../src/DAO/DAO.php';
use cyannlab\src\DAO\DAO;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Jean Forteroche</title>
</head>
<body>
	<h1>Blog de Jean Forteroche</h1>
	<h3>EN CONSTRUCTION</h3>

	<?php 
	$db = new DAO;
	$db->getConnection();

	?>
</body>
</html>