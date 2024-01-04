<?php
/**
* @package ilay-nosy
* @subpackage petiteAnnonce
* @version  1
* @author DWORD Consulting SARL
*/

/**
* JSON
*/
//require_once (LIB_PATH.'json/JSON.php');

/**
* Zone affichant le bloc petiteAnnonce de droite en FO
*
* @package ilay-nosy
* @subpackage petiteAnnonce
*/
class innerPagePetiteAnnonceFoZone extends jZone {
 
    protected $_tplname='petiteAnnonce~innerPagePetiteAnnonceFo.zone';
	protected $_useCache = false;

	/**
	* Cat a afficher
	*/
	public $cat = 0;

	/**
	* Catégorie a afficher
	*/
	public $categorieIds = "";
	
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
	public $nbFalls = 15;	


	/**
	* Chargement des données pour affichage
	*/
	protected function _prepareTpl(){

		//Récupération des paramètres
		if ($this->getParam('cat')) {
			$this->cat = $this->getParam('cat');
		}
		
		//Chargement des données
		jClasses::inc('petiteAnnonce~petiteAnnonceSrv');
		jClasses::inc('commun~tools');

		//Liste des 15 dernères petiteAnnonces classées par ordre anti chronologique
		$toPetiteAnnonces = array(); 
		
		$this->categorieIds = CATEGORIE_VEHICULES.",".CATEGORIE_EMPLOIS.",".CATEGORIE_IMMOBILIERS.",".CATEGORIE_ANNONCES;
		
		$toResults  = petiteAnnonceSrv::getLastAnByCategorie($this->categorieIds, $this->nbFalls);
		
		foreach ($toResults as $oResults){
			
			//Parution
			$dt = strtotime($oResults->petiteAnnonce_dateCreation);			
			//echo "<br>".time()." - $dt = " . floor((time() - $dt) / 60 / 60 /24);
			$oResults->petiteAnnonce_parution 		=  floor((time() - $dt) / 60 / 60 /24);

			//Tronquer
			$oResults->petiteAnnonce_description = nl2br(mb_strimwidth($oResults->petiteAnnonce_description, 0, 500, "..."));

			$oResults->petiteAnnonce_reference 		= stripslashes($oResults->petiteAnnonce_reference);
			$oResults->petiteAnnonce_prixInfo 		= stripslashes($oResults->petiteAnnonce_prixInfo);			
			$oResults->petiteAnnonce_description 	= stripslashes($oResults->petiteAnnonce_description);
			$oResults->petiteAnnonce_contact 		= stripslashes($oResults->petiteAnnonce_contact);
			
			array_push( $toPetiteAnnonces, $oResults);
		}


		//$this->_tpl->assign('mast', $this->mast);
		$this->_tpl->assign('topTitre', $this->topTitre);

		$this->_tpl->assign('toPetiteAnnonces', $toPetiteAnnonces);
	}
}
?>