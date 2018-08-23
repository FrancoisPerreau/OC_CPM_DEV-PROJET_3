<?php 

/**
 * Permet de sécuriser une chaine de caractères
 * @param $string
 * @return $string
 */
function str_secur($string) {
	// trim : On supprime les éventuels caractères invisibles avant et après.
 	// htmlspecialchars : On Convertit les éventuels caractères spéciaux.
	return trim(htmlspecialchars($string));
}