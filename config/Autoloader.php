<?php 
namespace cyannlab\config;

class Autoloader
{
	// MÉTHODES
	// ===================================
	/**
	 * Lance spl_autoload_register()
	 * Et enregistrer l'autoloader	 
	 */
	static function register()
	{
		// spl_autoload_register() enregistre une fonction dans la pile __autoload() fournie.
		// Si la pile n'est pas encore active, elle est activée.
		// 
		// Prend en paramètre un array avec le nom de la classe (où ce trouve la fonction appelée) et la fonction appelée
		// Ici __CLASS__ est une constante qui contient le nom de la classe courante
		spl_autoload_register(array(__CLASS__, 'autoload'));
	}

	static function autoload($className)
	{
		// Pour "corriger" le nom réccupéré avec le namespace
		$className = str_replace('cyannlab', '', $className);
		$className = str_replace('\\', '/', $className);
		require '../' . $className . '.php';

	}


}