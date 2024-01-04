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
* Zone affichant le bloc fil d'ariane bas en FO
*
* @package ilay-nosy
* @subpackage commun
*/
class breadcrumbsFoZone extends jZone {
 
    protected $_tplname='commun~breadcrumbsFo.zone';
	protected $_useCache = false;

	/**
	* Chargement des données pour affichage
	*/
	protected function _prepareTpl(){
		$zAriane = $this->getParam('zAriane');
	
		//Le fil d'ariane
		$this->_tpl->assign('zAriane', $zAriane);	
	}
}
?>