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
class contentPageMainWorkFoZone extends jZone {
 
    protected $_tplname='static~contentPageMainWorkFo.zone';
	protected $_useCache = false;

	/**
	* Chargement des données pour affichage
	*/
	protected function _prepareTpl(){
		
	}
}
?>