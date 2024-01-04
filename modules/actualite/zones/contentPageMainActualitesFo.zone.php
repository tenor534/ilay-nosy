<?php
/**
* @package ilay-nosy
* @subpackage actualite
* @version  1
* @author DWORD Consulting SARL
*/

/**
* JSON
*/
//require_once (LIB_PATH.'json/JSON.php');

/**
* Zone affichant le bloc actualite de droite en FO
*
* @package ilay-nosy
* @subpackage actualite
*/
class contentPageMainNewsFoZone extends jZone {
 
    protected $_tplname='actualite~contentPageMainNewsFo.zone';
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
		jClasses::inc('actualite~actualiteSrv');
		jClasses::inc('photoAct~photoActSrv');
		jClasses::inc('commun~tools');

		//Actualites à la une
		$toActualites  = array();
		$tabActualites  = actualiteSrv::getTopAnLaUNE(3);

		foreach ($tabActualites AS $oActualites){
			//la première photo
			if(isset($oActualites->actualite_id)){						
				$toPhoto = photoActSrv::getAllPhoto($oActualites->actualite_id);					
				if(sizeof($toPhoto)){
					$oActualites->actualite_photo = $toPhoto[0]->photo_photo;
				}else{
					$oActualites->actualite_photo = "noPhoto.jpg";
				}
	
				//
				$oActualites->actualite_reference 		= stripslashes($oActualites->actualite_reference);
				$oActualites->actualite_titre 			= stripslashes($oActualites->actualite_titre);
				$oActualites->actualite_resume 			= stripslashes($oActualites->actualite_resume);
				$oActualites->actualite_prixInfo 		= stripslashes($oActualites->actualite_prixInfo);			
				$oActualites->actualite_description 	= stripslashes($oActualites->actualite_description);
				$oActualites->actualite_contactNom 		= stripslashes($oActualites->actualite_contactNom);
				$oActualites->actualite_contactPrenom 	= stripslashes($oActualites->actualite_contactPrenom);
				$oActualites->actualite_contactEmail 	= stripslashes($oActualites->actualite_contactEmail);
				$oActualites->actualite_contactAdresse 	= stripslashes($oActualites->actualite_contactAdresse);
				$oActualites->actualite_photo 			= stripslashes($oActualites->actualite_photo);
				$oActualites->actualite_origine 		= stripslashes($oActualites->actualite_origine);

				//Parution
				$dt = strtotime($oActualites->actualite_dateDebut);			
				//echo "<br>".time()." - $dt = " . floor((time() - $dt) / 60 / 60 /24);
				$oActualites->actualite_parution 		=  floor((time() - $dt) / 60 / 60 /24);
				
				//CSS du title
				switch($oActualites->rubrique_categorieActId){
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
						$this->topTitre 	= "A la une des actualites";
						break;
				}
				$oActualites->actualite_h3 = $this->h3;
				$oActualites->actualite_topTitre = $this->topTitre;
				
				//Tronquer
				$oActualites->actualite_description = mb_strimwidth($oActualites->actualite_description, 0, 600, "...");
				$oActualites->actualite_description = nl2br($oActualites->actualite_description);
				
				array_push($toActualites, $oActualites);
			}			
		}	

		$this->_tpl->assign('toActualites', $toActualites);
		$this->_tpl->assign('h3', $this->h3);
		$this->_tpl->assign('topTitre', $this->topTitre);
	}
}
?>