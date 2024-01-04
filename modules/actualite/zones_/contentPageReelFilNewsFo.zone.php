<?php
/**
* @package ilay-nosy
* @subpackage actualite
* @version  1
* @author DWORD Consulting SARL
*/

/**
* JSON
*/
//require_once (LIB_PATH.'json/JSON.php');


/**
* Zone affichant le bloc content : actualité review en FO
*
* @package ilay-nosy
* @subpackage actualite
*/
class contentPageReelFilNewsFoZone extends jZone {
 
    protected $_tplname='actualite~contentPageReelFilNewsFo.zone';
	protected $_useCache = false;

	/**
	* Chargement des données pour affichage
	*/
	protected function _prepareTpl(){
	
	}
}
?>