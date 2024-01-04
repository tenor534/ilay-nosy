<?php
/**
* @package ilay-nosy
* @subpackage forum
* @version  1
* @author DWORD Consulting SARL
*/

/**
* JSON
*/
//require_once (LIB_PATH.'json/JSON.php');


/**
* Zone affichant le bloc forum de gauche en FO
*
* @package ilay-nosy
* @subpackage forum
*/
class homePageForumFoZone extends jZone {
 
    protected $_tplname='forum~homePageForumFo.zone';
	protected $_useCache = false;

	/**
	* Chargement des données pour affichage
	*/
	protected function _prepareTpl(){
	
	}
}
?>