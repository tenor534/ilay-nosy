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
* Zone affichant les officiels en cours dans l'espace membre pour un utilisateur connecté FO
*
* @package ilay-nosy
* @subpackage membre
*/
class contentPageMainOfficielTarifListFoZone extends jZone {
 
	/**
	* Nom du template HTML
	*/
    protected $_tplname='officiel~contentPageMainOfficielTarifListFo.zone';

	protected $_useCache = false;


	/**
	* Chargement des données pour affichage
	*/
	protected function _prepareTpl(){

		$tParams = array('zone'=> $this->getParam('zone','officiel~contentPageMainOfficielTarifListFo'));
	
		//Chargement des données
		jClasses::inc('pack~packSrv');
		jClasses::inc('forfait~forfaitSrv');
		jClasses::inc('commun~tools');
		
		//Charge all PACK
		$toPacks 		= packSrv::chargeAllPack();		
		
		//Forfaits pour le pack en cours
		$toForfaitVs 		= forfaitSrv::getAllForfait(1);
		$toForfaitIs 		= forfaitSrv::getAllForfait(2);
		$toForfaitEs 		= forfaitSrv::getAllForfait(3);
		$toForfaitAs 		= forfaitSrv::getAllForfait(4);
		$toForfaitVis 		= forfaitSrv::getAllForfait(5);
	

		$this->_tpl->assign('toPacks', $toPacks);

		$this->_tpl->assign('toForfaitVs', $toForfaitVs);
		$this->_tpl->assign('toForfaitIs', $toForfaitIs);
		$this->_tpl->assign('toForfaitEs', $toForfaitEs);
		$this->_tpl->assign('toForfaitAs', $toForfaitAs);
		$this->_tpl->assign('toForfaitVis', $toForfaitVis);

		$this->_tpl->assign('tParams', $tParams);
	}
}
?>