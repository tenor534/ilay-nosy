<?php
/**
* @package ilay-nosy
* @subpackage culture
* @version  1
* @author DWORD Consulting SARL
*/

/**
* JSON
*/
//require_once (LIB_PATH.'json/JSON.php');

/**
* Zone affichant le bloc culture de droite en FO
*
* @package ilay-nosy
* @subpackage culture
*/
class contentPageMainPresentationFoZone extends jZone {
 
    protected $_tplname='static~contentPageMainPresentationFo.zone';
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
		jClasses::inc('culture~cultureSrv');
		jClasses::inc('photo~photoSrv');
		jClasses::inc('commun~tools');

		//Culture à la une
		$toCulture  = cultureSrv::getTopAnLaUNE();

		//la première photo
		if(isset($toCulture->culture_id)){
			$toPhoto = photoSrv::getAllPhoto($toCulture->culture_id);					
			if(sizeof($toPhoto)){
				$toCulture->culture_photo = $toPhoto[0]->photo_photo;
			}else{
				$toCulture->culture_photo = "noPhoto.jpg";
			}

			//Parution
			$dt = strtotime($toCulture->culture_dateDebut);			
			//echo "<br>".time()." - $dt = " . floor((time() - $dt) / 60 / 60 /24);
			$toCulture->culture_parution 		=  floor((time() - $dt) / 60 / 60 /24);
			
			//CSS du title
			switch($toCulture->rubrique_categorieAnId){
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
					$this->topTitre 	= "A la une des cultures";
					break;
			}
			
			//Tronquer
			$toCulture->culture_description = mb_strimwidth($toCulture->culture_description, 0, 600, "...");
			
		}else{
			$toCulture  = array();		
		}			

		$this->_tpl->assign('toCulture', $toCulture);
		$this->_tpl->assign('h3', $this->h3);
		$this->_tpl->assign('topTitre', $this->topTitre);
		*/
	}
}
?>