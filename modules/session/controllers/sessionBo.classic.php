<?php
/**
* @package dwordconsulting
* @subpackage session
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Contrôleur BO pour les sessions
* @package dwordconsulting
* @subpackage session
* @todo : définir les différentes actions du contrôleur
*/
require_once (LIB_PATH.'fpdf/fpdf.php');

class sessionBoCtrl extends jController {

	//Toutes les actions de ce contrôleur nécessite une authentification via le plugin jAuth
	public $pluginParams = array('*'=>array('auth.required'=>true));
	
	/**
    * Affiche la liste des sessions
    */
    function listeSessions() {
		jClasses::inc('session~sessionSrv');

        $rep = $this->getResponse('htmlBo');

		//Param
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}

		$rep->menusActifs = array(HtmlBoResponse::MENU_SESSION);
		$rep->bodyTpl = 'session~sessionBo';

		//Param
		$tParams = array('page'=> $this->page);

		$rep->body->assignZone("listeSessionBo", "session~listeSessionBo", $tParams);

		$canAdmin = ($_SESSION['JELIX_USER']->profilId != 1)? 0 : 1;
		$rep->body->assign("canAdmin", $canAdmin);

        return $rep;
    }

	/**
    * Affichage le détail d'une entité session en mode edition 
	* Recoit l'id de l'entité en paramètre
    */
    function editionSession() {
		//Préparation de la réponse
		global $gJConfig;

        $rep = $this->getResponse('htmlBo');
		$rep->addJSLink($gJConfig->urlengine['basePath'].'design/back/js/sessions.js');
		
		//Chargement du menu 
		$rep->menusActifs = array(HtmlBoResponse::MENU_SESSION);
		
		//Template à utiliser
		$rep->bodyTpl = 'session~sessionBo';

		//Récupération des paramètres
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}		
		if ($this->intParam('session_id')) {
			$this->session_id = $this->intParam('session_id');
		}else{
			$this->session_id = 0;
		}
		if ($this->param('errorMessage')) {
			$this->errorMessage = $this->param('errorMessage');
		}else{
			$this->errorMessage = '';
		}

		//$tParams = array('zone'=> $this->getParam('zone','session~listeSessionBo.zone'));

		//Chargement des données
		jClasses::inc('session~sessionSrv');
		
		if ($this->session_id != 0) {
			try {
				$session = sessionSrv::chargeSession($this->session_id);
				
			} catch(Exception $oJException) {
				throw new JException ($oJException->getLocaleKey()) ;
			}				
		}else{
			$session = sessionSrv::getDaoSession();
			$session->session_statut = USER_STATUT_ON;			
		}

		$tParams = array('session_id'=> $this->session_id,'errorMessage'=>$this->errorMessage, 'page'=> $this->page);



							
		$rep->body->assign('tParams', $tParams);
		

		
		$rep->body->assign('session', $session);													
		$rep->body->assign("session_id", $this->session_id);		
		$rep->body->assign("page", $this->page);		

        return $rep;
    }
	
	
	/**
    * Enregistrement des données d'une entité session
	* 
	* Utilisé en création et modification seulement 
	* Recoit en paramètre l'ensemble des données du formulaire d'édition d'une session
	* Une fois une entité session sauvegardée, redirige vers la page de liste des sessions
    */
    function sauvegardeSession() {
		//Préparation de la réponse
		global $gJConfig;

		//Récupération des paramètres
		$session = jMagicLoader::arrayToObject($this->request->params, 'session');

		//Récupération des paramètres
		if ($this->request->params['page']) {
			$this->page = $this->request->params['page'];			
		}else{
			$this->page = 1;
		}	

		//Enregistrement
		jClasses::inc('commun~tools');	

		jClasses::inc('sessionSrv');
		sessionSrv::sauvegardeSession($session);

		//Paramètres
		$tParams = array('page'=> $this->page);

		//Redirection		
		$rep = $this->getResponse('redirect');
		$rep->action  = 'session~sessionBo_listeSessions';
		$rep->params = $tParams;
        
        return $rep;        
    }

	/**
    * Suppression d'une entité session donnée
	* 
	* Recoit l'id de l'entité en paramètre
	* Une fois l'entité supprimée, redirige vers la page de liste des sessions
    */
    function supprimeSession() {

		//Récupération des paramètres
		$sessionId = $this->intParam('session_id',0, FALSE);
		if ($sessionId == 0) {
			throw new Exception('Invalid parameter session_id');
		}

		//Suppression
		jClasses::inc('sessionSrv');
		sessionSrv::supprimeSession($sessionId);
		
		//Redirection
		$rep = $this->getResponse('redirect');
		$rep->action  = 'session~sessionBo_listeSessions';
        
        return $rep;
    }
	
	/**
    * Mise à jour la session utilisateur en base - BO; en fonction de la langue et de l'id utilisateur en cours
	* 
    */
	function updateSessionUser()
	{
		global $gJConfig;
        $rep = $this->getResponse('json');
		jClasses::inc('session~sessionSrv');

		$idLangue 		= $this->intParam('idLangue', 1, true);		
		$idUtilisateur  = $_SESSION['JELIX_USER']->id;
		
		sessionSrv::updateSessionUser($idLangue, $idUtilisateur);
		
		
		return $rep;	
	}
	
	
}
?>
