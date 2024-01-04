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
* Zone affichant le  header du frontoffice
*
* @package ilay-nosy
* @subpackage commun
*/
class HeaderFoZone extends jZone {
 
    protected $_tplname='commun~headerFo.zone';
	protected $_useCache = false;

	/**
	* Chargement des données pour affichage
	*/
	protected function _prepareTpl(){
		//jClasses::inc('visite~visiteSrv');	
		
		//$oMarqueSelected = MarqueSrv::chargeMarqueFo($iMarqueId); 			
	}
}
?>