<?php
/**
* @package ilay-nosy
* @subpackage accueil
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Zone affichant la liste des menus
*
* @package ilay-nosy
* @subpackage accueil
*/
class listeAccueilBoZone extends jZone {
 
	/**
	* Nom du template HTML
	*/
	protected $_tplname='accueil~listeAccueilBo.zone';

	/**
	* Chargement des données pour affichage
	*/
	protected function _prepareTpl(){

		//$this->_tpl->assign('iServiceId', $_SESSION["SESS_iServiceId"]);		
	}
}
?>
