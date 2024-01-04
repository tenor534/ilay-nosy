<?php
/**
* @package ilay-nosy
* @subpackage pratique
* @version  1
* @author DWORD Consulting SARL
*/

/**
* JSON
*/
//require_once (LIB_PATH.'json/JSON.php');

/**
* Zone affichant le bloc pratique de droite en FO
*
* @package ilay-nosy
* @subpackage pratique
*/
class contentPageMainPratiqueListFoZone extends jZone {
 
    protected $_tplname='pratique~contentPageMainPratiqueListFo.zone';
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
		
		/*
		//Récupération des paramètres
		if ($this->getParam('cat')) {
			$this->cat = $this->getParam('cat');
		}
		
		//Chargement des données		
		jClasses::inc('pratique~pratiqueSrv');
		jClasses::inc('photo~photoSrv');
		jClasses::inc('commun~tools');

		//Pratique à la une
		$toPratique  = pratiqueSrv::getTopAnLaUNE();

		//la première photo
		if(isset($toPratique->pratique_id)){
			$toPhoto = photoSrv::getAllPhoto($toPratique->pratique_id);					
			if(sizeof($toPhoto)){
				$toPratique->pratique_photo = $toPhoto[0]->photo_photo;
			}else{
				$toPratique->pratique_photo = "noPhoto.jpg";
			}

			//Parution
			$dt = strtotime($toPratique->pratique_dateDebut);			
			//echo "<br>".time()." - $dt = " . floor((time() - $dt) / 60 / 60 /24);
			$toPratique->pratique_parution 		=  floor((time() - $dt) / 60 / 60 /24);
			
			//CSS du title
			switch($toPratique->rubrique_categorieAnId){
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
					$this->topTitre 	= "A la une des pratiques";
					break;
			}
			
			//Tronquer
			$toPratique->pratique_description = mb_strimwidth($toPratique->pratique_description, 0, 600, "...");
			
		}else{
			$toPratique  = array();		
		}			

		$this->_tpl->assign('toPratique', $toPratique);
		$this->_tpl->assign('h3', $this->h3);
		$this->_tpl->assign('topTitre', $this->topTitre);
		*/
	}
}
?>