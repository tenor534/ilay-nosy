<?php
/**
* @package ilay-nosy
* @subpackage membre
* @version  1
* @author DWORD Consulting SARL
*/

/**
* JSON
*/
//require_once (LIB_PATH.'json/JSON.php');


/**
* Zone affichant les annonces en cours dans l'espace membre pour un utilisateur connecté FO
*
* @package ilay-nosy
* @subpackage membre
*/
class contentPageMainAnnonceCategorieListFoZone extends jZone {
 
	/**
	* Nom du template HTML
	*/
    protected $_tplname='annonce~contentPageMainAnnonceCategorieListFo.zone';

	protected $_useCache = false;

	/**
	* Chargement des données pour affichage
	*/
	protected function _prepareTpl(){

		//Session utilisateur
		//$idUtilisateurId = $_SESSION['SESSION_MEMBRE_ID'];
		if (isset($_SESSION['SESSION_MEMBRE_ID'])) {
			$idUtilisateurId = $_SESSION['SESSION_MEMBRE_ID'];
		}else{
			$idUtilisateurId = 0;		
		}

		//Récupération des paramètres
		$tParams = array('zone'=> $this->getParam('zone','annonce~contentPageMainAnnonceListFo'));
	
		//Chargement des données
		jClasses::inc('categorieAn~categorieAnSrv');
		jClasses::inc('rubrique~rubriqueSrv');
		jClasses::inc('annonce~annonceSrv');		
		jClasses::inc('photo~photoSrv');		
		jClasses::inc('commun~tools');
		
		//Provinces
		$toProvinces	= annonceSrv::chargeListProvinceAllFo();
		
		//Catégories
		$toCategorieAns	= categorieAnSrv::chargeAllCategorieAn();		
		
		$toCategories = array();
		$i = 0;
		$j = 0;
		foreach ($toCategorieAns as $oCategorieAns){
			$oCategorieAns->id 		= "c" . $oCategorieAns->categorieAn_id;
			$oCategorieAns->libelle = strtoupper($oCategorieAns->categorieAn_libelle);			
			$oCategorieAns->level 	= 0;			
			array_push($toCategories, $oCategorieAns);			
			$i++;
			//Rubrique de la  catégorie
			$toRubriques	= rubriqueSrv::getAllRubrique($oCategorieAns->categorieAn_id);	
			foreach ($toRubriques as $oRubriques){
				$oRubriques->id 		= "r" . $oRubriques->rubrique_id;
				$oRubriques->libelle = $oRubriques->rubrique_libelle;			
				$oRubriques->level 	= $oRubriques->rubrique_level;			
				array_push($toCategories, $oRubriques);
				$i++;
			}						
		}

		$toCategorieAnRandoms = array();
		$i = 0;
		$j = 0;
		foreach ($toCategorieAns as $oCategorieAns){
		
			//Toutes les annonces
			$toAnnonce	= annonceSrv::getRandAnByCategorie($oCategorieAns->categorieAn_id);	
			
			$toCategorieAnRandoms[$oCategorieAns->categorieAn_id] = array();		
			$toCategorieAnRandoms[$oCategorieAns->categorieAn_id]["id"] 	= isset($toAnnonce[0]->annonce_id)?$toAnnonce[0]->annonce_id:0;
			$toCategorieAnRandoms[$oCategorieAns->categorieAn_id]["titre"]	= isset($toAnnonce[0]->annonce_titre)?$toAnnonce[0]->annonce_titre:"";			
			
			//Première photo
			if(isset($toAnnonce[0]->annonce_id) && $toAnnonce[0]->annonce_id){
				$toPhotos 		= photoSrv::getAllPhoto($toAnnonce[0]->annonce_id);	
				$toCategorieAnRandoms[$oCategorieAns->categorieAn_id]["photo"]	= $toPhotos[0]->photo_photo;		
			
			}else{
				$toCategorieAnRandoms[$oCategorieAns->categorieAn_id]["photo"]	= "";			
			}
		}
		//print_r($toCategorieAnRandoms);
		//die();

		
		//Rubriques
		$toResults = rubriqueSrv::chargeListeRubrique("rubrique_sortCode", "ASC",0 , 1);
		$toRubriques = $toResults["listeRubrique"];
		
		//Dernière ligne
		$oRubriques->rubrique_id 		= 0;
		$oRubriques->rubrique_categorieAnId = 0;			
		$oRubriques->rubrique_libelle = "";			
		$oRubriques->rubrique_level 	= 0;			
		array_push($toRubriques, $oRubriques);

		//NB d'annonce par catégorie
		$toCategorieAnNBs	= categorieAnSrv::chargeAllCategorieAnNB();
		foreach ($toCategorieAnNBs as $oCategorieAnNBs){
			$toCategorieAnNBs[$oCategorieAnNBs->categorieAn_id] = $oCategorieAnNBs->categorieAn_nbAnnonce;		
		}			
		
		$this->_tpl->assign('toProvinces', $toProvinces);
		$this->_tpl->assign('toCategories', $toCategories);
		$this->_tpl->assign('toRubriques', $toRubriques);
		$this->_tpl->assign('toCategorieAnNBs', $toCategorieAnNBs);
		$this->_tpl->assign('toCategorieAnRandoms', $toCategorieAnRandoms);
	}
}
?>