<?php 
/**
 * Envoi de mail HTML
 * @param  string $subject 
 * @param  string $message
 */
function mailHtmlFromContact ($name, $email, $subject, $message) {

	$headers[] = 'From: ' . $name . ' <' . $email . '>';
	// Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
	$headers[] = 'MIME-Version: 1.0';
	$headers[] = 'Content-type: text/html; charset=utf-8';

	// Envoi
	mail(EMAIL, $subject, $message, implode("\r\n", $headers));
}



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