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
* Zone affichant le bloc content : actualité à la une en FO
*
* @package ilay-nosy
* @subpackage actualite
*/
class contentPageMainNewsFoZone extends jZone {
 
    protected $_tplname='actualite~contentPageMainNewsFo.zone';
	protected $_useCache = false;

	/**
	* Chargement des données pour affichage
	*/
	protected function _prepareTpl(){
	
	}
}
?>