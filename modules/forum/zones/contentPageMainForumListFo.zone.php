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
* Zone affichant le bloc forum de droite en FO
*
* @package ilay-nosy
* @subpackage forum
*/
class contentPageMainForumListFoZone extends jZone {
 
    protected $_tplname='forum~contentPageMainForumListFo.zone';
	protected $_useCache = false;

	/**
	* Chargement des données pour affichage
	*/
	protected function _prepareTpl(){		
		//Récupération des paramètres
		//Session utilisateur
		$idUtilisateurId = 0;

		$this->_tpl->assign('idUtilisateurId', $idUtilisateurId);
		
		
	}
}
?>