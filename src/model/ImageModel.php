<?php 
namespace cyannlab\src\model;

class ImageModel
{
	// MÉTHODES
	// =============================

	/**
	 * Enregistrement de l'image
	 * @param  $file
	 * @return [str] $newName
	 */
	static function savImage($file, $oldName = null)
	{
		// Génère un nom
		$newName = bin2hex(random_bytes(8)) . '.jpg';

		// Enregistre l'image
		if(move_uploaded_file($file['tmp_name'], '../public/img/chapters/' . $newName))
		{
			// var_dump($oldName);
			// var_dump('../public/img/chapters/' . $oldName);
			// var_dump(!empty($oldName));
			// var_dump(file_exists('../public/img/chapters/' . $oldName));

			if (!empty($oldName))
			{
				unlink('../public/img/chapters/' . $oldName);
			}

			// Retourne le nouveau nom
			return $newName;
		}		
	}

	static function deleteImage($imageName)
	{

	}
}