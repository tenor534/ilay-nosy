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
* Zone affichant le bloc publication de droite en FO
*
* @package ilay-nosy
* @subpackage publication
*/
class contentPageMainPublicationsFoZone extends jZone {
 
    protected $_tplname='publication~contentPageMainPublicationsFo.zone';
	protected $_useCache = false;

	/**
	* Chargement des données pour affichage
	*/
	protected function _prepareTpl(){

	}
}
?>