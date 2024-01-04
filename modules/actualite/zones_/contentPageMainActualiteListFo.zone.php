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
class contentPageMainActualiteListFoZone extends jZone {
 
    protected $_tplname='actualite~contentPageMainActualiteListFo.zone';
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
		jClasses::inc('actualite~actualiteSrv');
		jClasses::inc('photo~photoActSrv');
		jClasses::inc('commun~tools');

		//Actualite à la une
		$toActualite  = actualiteSrv::getTopAnLaUNE();

		//la première photo
		if(isset($toActualite->actualite_id)){
			$toPhoto = photoActSrv::getAllPhoto($toActualite->actualite_id);					
			if(sizeof($toPhoto)){
				$toActualite->actualite_photo = $toPhoto[0]->photo_photo;
			}else{
				$toActualite->actualite_photo = "noPhoto.jpg";
			}

			//Parution
			$dt = strtotime($toActualite->actualite_dateDebut);			
			//echo "<br>".time()." - $dt = " . floor((time() - $dt) / 60 / 60 /24);
			$toActualite->actualite_parution 		=  floor((time() - $dt) / 60 / 60 /24);
			
			//CSS du title
			switch($toActualite->rubrique_categorieActId){
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
			
			//Tronquer
			$toActualite->actualite_description = mb_strimwidth($toActualite->actualite_description, 0, 600, "...");
			
		}else{
			$toActualite  = array();		
		}			

		$this->_tpl->assign('toActualite', $toActualite);
		$this->_tpl->assign('h3', $this->h3);
		$this->_tpl->assign('topTitre', $this->topTitre);
		*/
	}
}
?>