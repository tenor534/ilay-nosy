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
* Zone affichant le bloc actualit� de droite en FO
*
* @package ilay-nosy
* @subpackage actualite
*/
class innerPageNewFoZone extends jZone {
 
    protected $_tplname='actualite~innerPageNewFo.zone';
	protected $_useCache = false;

	/**
	* Chargement des donn�es pour affichage
	*/
	protected function _prepareTpl(){
	
	}
}
?>