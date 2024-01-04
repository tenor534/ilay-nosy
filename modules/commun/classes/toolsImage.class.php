<?php
/**
* @package groupe3
* @subpackage commun
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Fonctions utilitaires
*
* @package ilay-nosy
* @subpackage commun
*/
class ToolsImage {  

	/*
	* Fonction qui supprime une image
	* @param tableau de string le fichier à supprimer
	* @param string chemin où se trouve le fichier
	*/
	function supprimeImage($fichier, $path)
	{
		if(count($fichier) > 0)
		{
			for($i = 0; $i < count($fichier); $i++)
			{
				if($fichier[$i] != '')
				{
					if(file_exists($path.basename($fichier[$i])) && is_file($path.basename($fichier[$i])))
					@unlink($path.basename($fichier[$i]));
				}
			}
		}
	}

	/*
	* Fonction qui génére une image avec une taille spécifiée
	* @param string nom du fichier
	* @param string extension du fichier qu'on veut avoir à la fin
	* @param string le fichier à traiter
	* @param int largeur
	* @param int longeur
	* @param string path le chemin qu'on veut mettre le fichier nouvellement créé
	* @param string type de l'action 
	*/

	function generateImageWithResize($nomFichier, $extension, $fichier, $width, $height, $path_resize, $zTypeAction='force'){
		jClasses::inc('commun~image');
		//génération du fichier thumbnail, visuel, fichier secondaire
		if(strlen($nomFichier)){
			$nFichier = basename($nomFichier);
			$tNom = explode(".", $nFichier);
			$ext = $tNom[count($tNom) - 1];
			$nomDuFichier = substr($nFichier, 0, strlen($nFichier) - (strlen($ext) + 1));
			$nomImage = $nomDuFichier. "_" . $width . "_" . $height . ".". strtolower($extension);
			$nomImageSansExt = $nomDuFichier. "_" .$width . "_" . $height ;
			// création de l'image
			$i = 1;
			while(file_exists($path_resize . $nomImage) && is_file($path_resize . $nomImage)){
				$nomImage = $nomImageSansExt ."_". $i . "." .strtolower($extension);
				$i++;
			}
			$imgF = new ImageFilter;
			$imgF->loadImage($fichier);
			$imgF->resize($width, $height, $zTypeAction, true);
			$imgF->output(strtoupper($extension), $path_resize . $nomImage, true);	
		}else{
			return false;
		}
		
		return ($nomImage);
	}
}
?>
