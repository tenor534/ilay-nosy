<?php
/**
* @package ilay-nosy
* @subpackage publication
* @version  1
* @author DWORD Consulting SARL
*/

/**
* JSON
*/
//require_once (LIB_PATH.'json/JSON.php');

/**
* Zone affichant le bloc publication haut de droite en FO
*
* @package ilay-nosy
* @subpackage publication
*/
class innerPageAdSpaceFoZone extends jZone {
 
    protected $_tplname='publication~innerPageAdSpaceFo.zone';
	protected $_useCache = false;

	/**
	* Chargement des données pour affichage
	*/
	protected function _prepareTpl(){
	
	}
}
?>