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
* Zone affichant le tableau de bord dans l'espace membre pour un utilisateur connecté FO
*
* @package ilay-nosy
* @subpackage membre
*/
class contentPageMainTableFoZone extends jZone {
 
    protected $_tplname='membre~contentPageMainTableFo.zone';
	protected $_useCache = false;

	/**
	* Chargement des données pour affichage
	*/
	protected function _prepareTpl(){
	
		//Classes
		/*
		jClasses::inc('profil~profilSrv');
		jClasses::inc('pays~paysSrv');
		
		// liste des pays
		$toPays = paysSrv::chargeListPaysAllFo();		
		// liste des profils membres
		$toProfilMembres = profilSrv::chargeListProfilMembreAllFo();		

		$this->_tpl->assign('toPays', $toPays);
		$this->_tpl->assign('toProfilMembres', $toProfilMembres);
		*/
	}
}
?>