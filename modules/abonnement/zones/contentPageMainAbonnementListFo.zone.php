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
* Zone affichant les abonnements en cours dans l'espace membre pour un utilisateur connecté FO
*
* @package ilay-nosy
* @subpackage membre
*/
class contentPageMainAbonnementListFoZone extends jZone {
 
    protected $_tplname='abonnement~contentPageMainAbonnementListFo.zone';
	protected $_useCache = false;

	/**
	* Chargement des données pour affichage
	*/
	protected function _prepareTpl(){
	
		//Classes		
		jClasses::inc('forfait~forfaitSrv');
		jClasses::inc('abonnement~abonnementSrv');

		//Session utilisateur
		$idUtilisateurId = $_SESSION['SESSION_MEMBRE_ID'];
		
		//Liste des abonnement avec le type de forfait correspondant
		$toAbonnements = abonnementSrv::chargeListAbonnementAllByUserFo($idUtilisateurId);		
		
		//Abonnement non payé par l'utilisateur	
		$toAbonnementFrees = abonnementSrv::chargeAllAbonnementFree($idUtilisateurId);
		
		$canAdd = (count($toAbonnementFrees))>=1? 0 : 1; 
		
		//print_r(count($toAbonnementFrees));

		$this->_tpl->assign('toAbonnements', $toAbonnements);
		$this->_tpl->assign('canAdd', $canAdd);
	}
}
?>