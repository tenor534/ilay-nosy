<?php
/**
* @package agidis  
* @subpackage commun
* @version  1
* @author DWORD Consulting SARL
*/


/**
* Affichage du header du Fo
*
* @package agidis
* @subpackage commun
*/
class loginFoZone extends jZone {
 
    protected $_tplname='accueil~loginFo.zone';  
	protected $_useCache = false;
	
	protected function _prepareTpl(){
		//Classes
		
		
		//recuperation parametres
		/*
		$zCle   		= (isset($GLOBALS["gJCoord"]->request->params["cle"]) ? $GLOBALS["gJCoord"]->request->params["cle"]:'') ;
		$iFamilleId   	= (isset($GLOBALS["gJCoord"]->request->params["famille"]) ? $GLOBALS["gJCoord"]->request->params["famille"]:0) ;
		$iGammeId   	= (isset($GLOBALS["gJCoord"]->request->params["gamme"]) ? $GLOBALS["gJCoord"]->request->params["gamme"]:0) ;
		$iPartenaireId 	= (isset($GLOBALS["gJCoord"]->request->params["fournisseur"]) ? $GLOBALS["gJCoord"]->request->params["fournisseur"]:0) ;
		*/

		$is_loged = $this->getParam('is_loged');

		$iErrConnexion 	= (isset($GLOBALS["gJCoord"]->request->params["errconnexion"]) ? $GLOBALS["gJCoord"]->request->params["errconnexion"]:0) ;
		
		
		if(isset($_SESSION['SESSION_MEMBRE_ID'])){
			jClasses::inc('utilisateur~utilisateurSrv');
			$tUtilisateur=array();
			$tUtilisateur[]=utilisateurSrv::infosMembre($_SESSION['SESSION_MEMBRE_ID']);
			$this->_tpl->assign('utilisateur', $tUtilisateur[0]);
			$this->_tpl->assign('datedujour', date('d/m/Y'));
		}
		
		
		//assign
		$this->_tpl->assign('is_loged', $is_loged);
		$this->_tpl->assign('errconnexion', $iErrConnexion);
	}
}	
?>
