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
class contentPageMainAbonnementPackListFoZone extends jZone {
 
    protected $_tplname='abonnement~contentPageMainAbonnementPackListFo.zone';
	protected $_useCache = false;

	/**
	* Chargement des données pour affichage
	*/
	protected function _prepareTpl(){
	
		//Classes		
		jClasses::inc('pack~packSrv');

		//Session utilisateur
		$idUtilisateurId = $_SESSION['SESSION_MEMBRE_ID'];
		
		//Abonnement non payé par l'utilisateur	
		$toPacks = packSrv::chargeAllPack();		

		$this->_tpl->assign('toPacks', $toPacks);
	}
}
?>