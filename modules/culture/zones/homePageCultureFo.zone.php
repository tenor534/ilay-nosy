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
* Zone affichant le bloc actualit� de gauche en FO
*
* @package ilay-nosy
* @subpackage culture
*/
class homePageCultureFoZone extends jZone {
 
    protected $_tplname='culture~homePageCultureFo.zone';
	protected $_useCache = false;

	/**
	* Chargement des donn�es pour affichage
	*/
	protected function _prepareTpl(){
	
	}
}
?>