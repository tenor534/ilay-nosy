<?php
/**
* @package ilay-nosy
* @subpackage annonce
* @version  1
* @author DWORD Consulting SARL
*/

/**
* JSON
*/
//require_once (LIB_PATH.'json/JSON.php');

/**
* Zone affichant le bloc annonce de droite en FO
*
* @package ilay-nosy
* @subpackage annonce
*/
class contentPageMainAnnouncesFoZone extends jZone {
 
    protected $_tplname='annonce~contentPageMainAnnouncesFo.zone';
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
	* Nombre d'annonces à afficher
	*/
	public $iNbNews = 15;	

	/**
	* Chargement des données pour affichage
	*/
	protected function _prepareTpl(){

		//Récupération des paramètres
		if ($this->getParam('cat')) {
			$this->cat = $this->getParam('cat');
		}
		
		//Chargement des données
		jClasses::inc('annonce~annonceSrv');
		jClasses::inc('photo~photoSrv');
		jClasses::inc('commun~tools');

		//Annonces à la une
		$toAnnonces  = array();
		$tabAnnonces  = annonceSrv::getTopAnLaUNE($this->iNbNews);

		foreach ($tabAnnonces AS $oAnnonces){
			//la première photo
			if(isset($oAnnonces->annonce_id)){						
				$toPhoto = photoSrv::getAllPhoto($oAnnonces->annonce_id);					
				if(sizeof($toPhoto)){
					$oAnnonces->annonce_photo = $toPhoto[0]->photo_photo;
				}else{
					$oAnnonces->annonce_photo = "noPhoto.jpg";
				}
	
				//
				$oAnnonces->annonce_reference 		= stripslashes($oAnnonces->annonce_reference);
				$oAnnonces->annonce_titre 			= stripslashes($oAnnonces->annonce_titre);
				$oAnnonces->annonce_resume 			= stripslashes($oAnnonces->annonce_resume);
				$oAnnonces->annonce_prixInfo 		= stripslashes($oAnnonces->annonce_prixInfo);			
				$oAnnonces->annonce_description 	= stripslashes($oAnnonces->annonce_description);
				$oAnnonces->annonce_contactNom 		= stripslashes($oAnnonces->annonce_contactNom);
				$oAnnonces->annonce_contactPrenom 	= stripslashes($oAnnonces->annonce_contactPrenom);
				$oAnnonces->annonce_contactEmail 	= stripslashes($oAnnonces->annonce_contactEmail);
				$oAnnonces->annonce_contactAdresse 	= stripslashes($oAnnonces->annonce_contactAdresse);
				$oAnnonces->annonce_photo 			= stripslashes($oAnnonces->annonce_photo);
				$oAnnonces->annonce_origine 		= stripslashes($oAnnonces->annonce_origine);

				//Parution
				$dt = strtotime($oAnnonces->annonce_dateDebut);			
				//echo "<br>".time()." - $dt = " . floor((time() - $dt) / 60 / 60 /24);
				$oAnnonces->annonce_parution 		=  floor((time() - $dt) / 60 / 60 /24);
				
				//CSS du title
				switch($oAnnonces->rubrique_categorieAnId){
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
						$this->topTitre 	= "A la une des annonces";
						break;
				}
				$oAnnonces->annonce_h3 = $this->h3;
				$oAnnonces->annonce_topTitre = $this->topTitre;
				
				//Tronquer
				$oAnnonces->annonce_description = mb_strimwidth($oAnnonces->annonce_description, 0, 600, "...");
				$oAnnonces->annonce_description = nl2br($oAnnonces->annonce_description);
				
				array_push($toAnnonces, $oAnnonces);
			}			
		}	

		$this->_tpl->assign('toAnnonces', $toAnnonces);
		$this->_tpl->assign('h3', $this->h3);
		$this->_tpl->assign('topTitre', $this->topTitre);
	}
}
?>