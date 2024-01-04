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
class innerPageAnnonceFoZone extends jZone {
 
    protected $_tplname='annonce~innerPageAnnonceFo.zone';
	protected $_useCache = false;

	/**
	* Cat a afficher
	*/
	public $cat = 0;

	/**
	* Catégorie a afficher
	*/
	public $categorieIds = 0;
	
	/**
	* CSS a afficher
	*/
	public $mast = "";	
	
	/**
	* Titre a afficher
	*/
	public $topTitre = "";	

	/**
	* Titre a afficher
	*/
	public $nbFalls = 7;	


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

		switch($this->cat){
			case 1: //vehicule
				$this->mast 		= "mast_vehicule";
				$this->topTitre 	= "Annonces - V&eacute;hicules";
				$this->categorieIds	= CATEGORIE_VEHICULES;
				break;
			case 2: //immobilier
				$this->mast 		= "mast_immobilier";
				$this->topTitre 	= "Annonces - Immobilier";
				$this->categorieIds	= CATEGORIE_IMMOBILIERS;
				break;
			case 3: //emploi
				$this->mast 		= "mast_emploi";
				$this->topTitre 	= "Annonces - Emplois";
				$this->categorieIds	= CATEGORIE_EMPLOIS;
				break;
			case 4: //autres annonces
				$this->mast 		= "mast_autres";
				$this->topTitre 	= "Autres annonces";
				$this->categorieIds	= CATEGORIE_ANNONCES;
				$this->nbFalls 		= 20;
				break;
			default: //vehicule
				$this->mast 		= "mast";
				$this->topTitre 	= "Annonces";
				$this->categorieIds	= 0;
				break;
		}
		
		//Liste des 3 dernères annonces selon la 
		$toAnnonces = array(); 
		$toResults  = annonceSrv::getLastAnByCategorie($this->categorieIds, $this->nbFalls);
		
		foreach ($toResults as $oResults){
					//la première photo
			$toPhoto = photoSrv::getAllPhoto($oResults->annonce_id);		
			
			if(sizeof($toPhoto)){
				$oResults->annonce_photo = $toPhoto[0]->photo_photo;
			}else{
				$oResults->annonce_photo = "noPhoto.jpg";
			}
			
			//Parution
			$dt = strtotime($oResults->annonce_dateDebut);			
			//echo "<br>".time()." - $dt = " . floor((time() - $dt) / 60 / 60 /24);
			$oResults->annonce_parution 		=  floor((time() - $dt) / 60 / 60 /24);

			//Tronquer
			$oResults->annonce_resume = mb_strimwidth($oResults->annonce_resume, 0, 30, "...");

			$oResults->annonce_cat = $this->cat;

			$oResults->annonce_reference 		= stripslashes($oResults->annonce_reference);
			$oResults->annonce_titre 			= stripslashes($oResults->annonce_titre);
			$oResults->annonce_resume 			= stripslashes($oResults->annonce_resume);
			$oResults->annonce_prixInfo 		= stripslashes($oResults->annonce_prixInfo);			
			$oResults->annonce_description 	= stripslashes($oResults->annonce_description);
			$oResults->annonce_contactNom 		= stripslashes($oResults->annonce_contactNom);
			$oResults->annonce_contactPrenom 	= stripslashes($oResults->annonce_contactPrenom);
			$oResults->annonce_contactEmail 	= stripslashes($oResults->annonce_contactEmail);
			$oResults->annonce_contactAdresse 	= stripslashes($oResults->annonce_contactAdresse);
			$oResults->annonce_photo 			= stripslashes($oResults->annonce_photo);
			$oResults->annonce_origine 		= stripslashes($oResults->annonce_origine);
			
			array_push( $toAnnonces, $oResults);
		}


		$this->_tpl->assign('mast', $this->mast);
		$this->_tpl->assign('topTitre', $this->topTitre);

		$this->_tpl->assign('toAnnonces', $toAnnonces);
	}
}
?>