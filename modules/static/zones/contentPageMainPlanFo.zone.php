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
class contentPageMainPlanFoZone extends jZone {
 
    protected $_tplname='static~contentPageMainPlanFo.zone';
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
		
		//Session utilisateur
		if (isset($_SESSION['SESSION_MEMBRE_ID'])) {
			$idUtilisateurId = $_SESSION['SESSION_MEMBRE_ID'];
		}else{
			$idUtilisateurId = 0;		
		}

		//Récupération des paramètres
		$tParams = array('zone'=> $this->getParam('zone','static~contentPageMainPlanFo'));
	
		//Chargement des données
		jClasses::inc('categorieAn~categorieAnSrv');
		jClasses::inc('commun~tools');

		//Catégories
		$toCategories	= categorieAnSrv::chargeAllCategorieAn();		

		//NB d'annonce par catégorie
		$toCategorieAnNBs	= categorieAnSrv::chargeAllCategorieAnNB();
		foreach ($toCategorieAnNBs as $oCategorieAnNBs){
			$toCategorieAnNBs[$oCategorieAnNBs->categorieAn_id] = $oCategorieAnNBs->categorieAn_nbAnnonce;		
		}			

		$this->_tpl->assign('idUtilisateurId', $idUtilisateurId);
		$this->_tpl->assign('toCategories', $toCategories);
		$this->_tpl->assign('toCategorieAnNBs', $toCategorieAnNBs);
	}
}
?>