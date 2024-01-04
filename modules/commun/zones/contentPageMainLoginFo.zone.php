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
* Zone affichant le formulaire de login en FO
*
* @package ilay-nosy
* @subpackage commun
*/
class contentPageMainLoginFoZone extends jZone {
 
    protected $_tplname='commun~contentPageMainLoginFo.zone';
	protected $_useCache = false;

	/**
	* Chargement des données pour affichage
	*/
	protected function _prepareTpl(){
	
	}
}
?>