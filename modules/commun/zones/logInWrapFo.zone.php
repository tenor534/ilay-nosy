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
* Zone affichant le bloc login en FO
*
* @package ilay-nosy
* @subpackage commun
*/
class logInWrapFoZone extends jZone {
 
    protected $_tplname='commun~logInWrapFo.zone';
	protected $_useCache = false;

	/**
	* Chargement des données pour affichage
	*/
	protected function _prepareTpl(){
	
		if(isset($_SESSION['SESSION_MEMBRE_ID'])){
    		$this->_tplname='commun~logOutWrapFo.zone';					
			
			//Récupérations des valeurs
			$zProfil 	= "";
			$iProfilId 	= $_SESSION['SESSION_MEMBRE_PROFIL_ID'];
			$zNom 		= $_SESSION['SESSION_MEMBRE_NOM'];
			$zPrenom 	= $_SESSION['SESSION_MEMBRE_PRENOM'];

			//Récupère le profil
			$dao=jDao::create('profil~profil');
			$conditions=jDao::createConditions();
			$conditions->addCondition("profil_id", "=", $iProfilId);
			$rs = $dao->findBy($conditions);
			if(($profil=$rs->fetch())!=FALSE){
				$zProfil = $profil->profil_libelle;
			}			
			
			$this->_tpl->assign('zProfil', $zProfil);		
			$this->_tpl->assign('zNom', $zNom);		
			$this->_tpl->assign('zPrenom', $zPrenom);					
		}	
	}
}
?>