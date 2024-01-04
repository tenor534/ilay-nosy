<?php
/**
* @package ilay-nosy
* @subpackage projet
* @version  1
* @author DWORD Consulting SARL
*/

/**
* JSON
*/
//require_once (LIB_PATH.'json/JSON.php');

/**
* Zone affichant le bloc projet de droite en FO
*
* @package ilay-nosy
* @subpackage projet
*/
class innerPageProjetFoZone extends jZone {
 
    protected $_tplname='projet~innerPageProjetFo.zone';
	protected $_useCache = false;

	/**
	* Chargement des données pour affichage
	*/
	protected function _prepareTpl(){
	
	}
}
?>