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
* Zone affichant le bloc actualité de gauche en FO
*
* @package ilay-nosy
* @subpackage actualite
*/
class homePageNewFoZone extends jZone {
 
    protected $_tplname='actualite~homePageNewFo.zone';
	protected $_useCache = false;

	/**
	* Chargement des données pour affichage
	*/
	protected function _prepareTpl(){
	
	}
}
?>