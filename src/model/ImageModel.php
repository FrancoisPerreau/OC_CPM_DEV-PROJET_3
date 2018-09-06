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
	static function savImage($file)
	{
		// tu changes le nom
		$newName = bin2hex(random_bytes(8)) . '.jpg';

		// Tu enregistre l'image
		if(move_uploaded_file($file['tmp_name'], '../public/img/chapters/' . $newName))
		{
			// Tu retournele nouveau nom
			return $newName;
		}		
	}
}