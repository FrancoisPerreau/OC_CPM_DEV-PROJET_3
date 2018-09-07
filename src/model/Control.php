<?php 
namespace cyannlab\src\model;

class Control
{

	// MÉTHODES
	// =============================
	
	static function controlAddArticleOrDraft($chapter, $title, $content, $status, $imageExist = null)
	{	
		// Vérification pour publish --------------------
		if (isset($status) && $status ==='publish')
		{
			$error = [];

			$chapter = (int) $chapter;
			

			// Vérification du numéro du chapitre (pas déjas pris)
			if (empty($chapter))
			{				
				$error['chapterEmpty'] = 'Vous devez entrer un numéro de chapitre';
			}
			elseif (!is_int($chapter) && $chapter > 0 )
			{
				$error['chapterInt'] = 'Vous devez saisir un numéro';
			}


			// Vérification de l'image (format et poid)
			if (!empty($_FILES['imageArticle']['name']))
			{
				if (isset($_FILES['imageArticle']) && $_FILES['imageArticle']['error'] == 0)
				{
					if ($_FILES['imageArticle']['type'] != 'image/jpeg')
					{
						$error['imageType'] = 'Le format du fichier doit être du jpeg';
					}

					if ($_FILES['imageArticle']['size'] > 512000)
					{
						
						$error['imageSize'] = 'Le fichier ne doit pas faire plus de 500 ko';
					}
				}
			}
			else
			{
				if (!$imageExist) {
					$error['imageEmpty'] = 'Vous devez poster une image';
				}
				
			}


			// Vérification du titre
			if (empty($title))
			{
				$error['titleEmpty'] = 'Vous devez saisir un titre';
			}

			// Vérification du contenu
			if (empty($content))
			{
				$error['contentEmpty'] = 'Vous devez saisir un contenu';
			}
			return $error;
		}


		// Vérification pour draft
		if (isset($status) && $status === 'draft')
		{
			//var_dump('je suis dans la Vérif DRAFT');

			$error = [];

			$chapter = (int) $chapter;

			if (empty($chapter))
			{				
				$error['chapterEmpty'] = 'Vous devez entrer un numéro de chapitre';
			}
			elseif (!is_int($chapter) && $chapter > 0 )
			{
				$error['chapterInt'] = 'Vous devez saisir un numéro';
			}
		}

		return $error;
	}

}