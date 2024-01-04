<?php
/**
* @package ilay-nosy
* @subpackage officiel
* @version  1
* @author DWORD Consulting SARL
*/

/**
* JSON
*/
//require_once (LIB_PATH.'json/JSON.php');

/**
* Zone affichant le bloc officiel de droite en FO
*
* @package ilay-nosy
* @subpackage officiel
*/
class contentPageMainNewsFoZone extends jZone {
 
    protected $_tplname='officiel~contentPageMainNewsFo.zone';
	protected $_useCache = false;

	/**
	* CSS a afficher
	*/
	public $h3 = "";	
	
	/**
	* Titre a afficher
	*/
	public $topTitre = "";	

	/**
	* Chargement des données pour affichage
	*/
	protected function _prepareTpl(){

		//Récupération des paramètres
		if ($this->getParam('cat')) {
			$this->cat = $this->getParam('cat');
		}
		
		//Chargement des données
		jClasses::inc('officiel~officielSrv');
		jClasses::inc('photoOff~photoOffSrv');
		jClasses::inc('commun~tools');

		//Officiels à la une
		$toOfficiels  = array();
		$tabOfficiels  = officielSrv::getTopAnLaUNE(3);

		foreach ($tabOfficiels AS $oOfficiels){
			//la première photo
			if(isset($oOfficiels->officiel_id)){						
				$toPhoto = photoOffSrv::getAllPhoto($oOfficiels->officiel_id);					
				if(sizeof($toPhoto)){
					$oOfficiels->officiel_photo = $toPhoto[0]->photo_photo;
				}else{
					$oOfficiels->officiel_photo = "noPhoto.jpg";
				}
	
				//
				$oOfficiels->officiel_reference 		= stripslashes($oOfficiels->officiel_reference);
				$oOfficiels->officiel_titre 			= stripslashes($oOfficiels->officiel_titre);
				$oOfficiels->officiel_resume 			= stripslashes($oOfficiels->officiel_resume);
				$oOfficiels->officiel_prixInfo 		= stripslashes($oOfficiels->officiel_prixInfo);			
				$oOfficiels->officiel_description 	= stripslashes($oOfficiels->officiel_description);
				$oOfficiels->officiel_contactNom 		= stripslashes($oOfficiels->officiel_contactNom);
				$oOfficiels->officiel_contactPrenom 	= stripslashes($oOfficiels->officiel_contactPrenom);
				$oOfficiels->officiel_contactEmail 	= stripslashes($oOfficiels->officiel_contactEmail);
				$oOfficiels->officiel_contactAdresse 	= stripslashes($oOfficiels->officiel_contactAdresse);
				$oOfficiels->officiel_photo 			= stripslashes($oOfficiels->officiel_photo);
				$oOfficiels->officiel_origine 		= stripslashes($oOfficiels->officiel_origine);

				//Parution
				$dt = strtotime($oOfficiels->officiel_dateDebut);			
				//echo "<br>".time()." - $dt = " . floor((time() - $dt) / 60 / 60 /24);
				$oOfficiels->officiel_parution 		=  floor((time() - $dt) / 60 / 60 /24);
				
				//CSS du title
				switch($oOfficiels->rubrique_categorieOffId){
					case 1: //vehicule
						$this->h3 		= "h3_vehicule";
						$this->topTitre 	= "A la une - V&eacute;hicules";
						break;
					case 6: //immobilier
						$this->h3 		= "h3_immobilier";
						$this->topTitre 	= "A la une - Immobilier";
						break;
					case 2: //emploi
						$this->h3 		= "h3_emploi";
						$this->topTitre 	= "A la une - Emplois";
						break;
					default: //vehicule
						$this->h3 		= "h3_autres";
						$this->topTitre 	= "A la une des officiels";
						break;
				}
				$oOfficiels->officiel_h3 = $this->h3;
				$oOfficiels->officiel_topTitre = $this->topTitre;
				
				//Tronquer
				$oOfficiels->officiel_description = mb_strimwidth($oOfficiels->officiel_description, 0, 600, "...");
				$oOfficiels->officiel_description = nl2br($oOfficiels->officiel_description);
				
				array_push($toOfficiels, $oOfficiels);
			}			
		}	

		$this->_tpl->assign('toOfficiels', $toOfficiels);
		$this->_tpl->assign('h3', $this->h3);
		$this->_tpl->assign('topTitre', $this->topTitre);
	}
}
?>