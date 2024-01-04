<?php
/**
* @package ilay-nosy
* @subpackage commun
* @version  1
* @author DWORD Consulting SARL
*/

/**
* JSON
*/
//require_once (LIB_PATH.'json/JSON.php');


/**
* Zone affichant la  partie main du frontoffice
*
* @package ilay-nosy
* @subpackage commun
*/
class contentMainFoZone extends jZone {
 
    protected $_tplname='commun~contentMainFo.zone';
	protected $_useCache = false;

	/**
	* Chargement des données pour affichage
	*/
	protected function _prepareTpl(){
		/*$iMarqueId = $this->getParam('iMarqueId');
		jClasses::inc('marque~marqueSrv');
		$oMarqueSelected = NULL;
		if ($iMarqueId){
			$oMarqueSelected = MarqueSrv::chargeMarqueFo($iMarqueId); 			
		}		
		
		// liste des marques
		$toMarques = MarqueSrv::chargeListeMarqueFo();

		$this->_tpl->assign('oMarqueSelected', $oMarqueSelected);
		$this->_tpl->assign('toMarques', $toMarques);
		*/
	}
}
?>