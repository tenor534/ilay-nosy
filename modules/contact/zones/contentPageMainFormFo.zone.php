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
* Zone affichant le bloc culture de droite en FO
*
* @package ilay-nosy
* @subpackage culture
*/
class contentPageMainFormFoZone extends jZone {
 
    protected $_tplname='contact~contentPageMainFormFo.zone';
	protected $_useCache = false;

	/**
	* CSS a afficher
	*/
	public $h3 = "";	
	
	/**
	* Titre a afficher
	*/
	public $topTitre = "";	

	/**
	* Chargement des données pour affichage
	*/
	protected function _prepareTpl(){
		
		//Session utilisateur
		if (isset($_SESSION['SESSION_MEMBRE_ID'])) {
			$idUtilisateurId = $_SESSION['SESSION_MEMBRE_ID'];
		}else{
			$idUtilisateurId = 0;		
		}

		//Classes
		jClasses::inc('pays~paysSrv');
		
		// liste des pays
		$toPays = paysSrv::chargeListPaysAllFo();		

		$tParams = array();
		
		$this->_tpl->assign('toPays', $toPays);
		$this->_tpl->assign('tParams', $tParams);
	}
}
?>