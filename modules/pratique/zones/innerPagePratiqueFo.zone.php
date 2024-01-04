<?php
/**
* @package ilay-nosy
* @subpackage pratique
* @version  1
* @author DWORD Consulting SARL
*/

/**
* JSON
*/
//require_once (LIB_PATH.'json/JSON.php');

/**
* Zone affichant le bloc pratique de droite en FO
*
* @package ilay-nosy
* @subpackage pratique
*/
class innerPagePratiqueFoZone extends jZone {
 
    protected $_tplname='pratique~innerPagePratiqueFo.zone';
	protected $_useCache = false;

	/**
	* Chargement des données pour affichage
	*/
	protected function _prepareTpl(){
	
	}
}
?>