<?php
/**
* @package ilay-nosy
* @subpackage utilisateur
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Contrôleur BO pour les utilisateurs
* @package ilay-nosy
* @subpackage utilisateur
* @todo : définir les différentes actions du contrôleur
*/
require_once (LIB_PATH.'fpdf/fpdf.php');

class utilisateurBoCtrl extends jController {

	//Toutes les actions de ce contrôleur nécessite une authentification via le plugin jAuth
	public $pluginParams = array('*'=>array('auth.required'=>true));
	
	/**
    * Affiche la liste des utilisateurs
	* Recoit en paramètre le type de l'actualité : standard ou évènement, 
    */
    function listeUtilisateurs() {
		jClasses::inc('utilisateur~utilisateurSrv');

        $rep = $this->getResponse('htmlBo');

		//Param
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}

		$rep->menusActifs = array(HtmlBoResponse::MENU_COMPTE, HtmlBoResponse::MENU_COMPTE_UTILISATEUR);
		$rep->bodyTpl = 'utilisateur~utilisateurBo';

		//Param
		$tParams = array('page'=> $this->page);

		$rep->body->assignZone("listeUtilisateurBo", "utilisateur~listeUtilisateurBo", $tParams);

        return $rep;
    }

	/**
    * Affichage le détail d'une actualité en mode edition 
	* Recoit l'id de l'actualité en paramètre
    */
    function editionUtilisateur() {
		//Préparation de la réponse
		global $gJConfig;

        $rep = $this->getResponse('htmlBo');
		$rep->addJSLink($gJConfig->urlengine['basePath'] . 'design/back/js/utilisateurs.js');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/back/css/nosyEdit.css');
		
		//Chargement du menu 
		$rep->menusActifs = array(HtmlBoResponse::MENU_COMPTE, HtmlBoResponse::MENU_COMPTE_UTILISATEUR);
		
		//Template à utiliser
		$rep->bodyTpl = 'utilisateur~utilisateurBo';

		//Récupération des paramètres
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}		
		if ($this->intParam('utilisateur_id')) {
			$this->utilisateur_id = $this->intParam('utilisateur_id');
		}else{
			$this->utilisateur_id = 0;
		}
		if ($this->param('errorMessage')) {
			$this->errorMessage = $this->param('errorMessage');
		}else{
			$this->errorMessage = '';
		}

		//$tParams = array('zone'=> $this->getParam('zone','utilisateur~listeUtilisateurBo.zone'));

		//Chargement des données
		jClasses::inc('utilisateur~utilisateurSrv');
		
		if ($this->utilisateur_id != 0) {
			try {
				$utilisateur = utilisateurSrv::chargeUtilisateur($this->utilisateur_id);
				
			} catch(Exception $oJException) {
				throw new JException ($oJException->getLocaleKey()) ;
			}				
		}else{
			$utilisateur = utilisateurSrv::getDaoUtilisateur();
			$utilisateur->utilisateur_statut = USER_STATUT_ON;			
		}

		$tParams = array('utilisateur_id'=> $this->utilisateur_id,'errorMessage'=>$this->errorMessage, 'page'=> $this->page);

		//Profil
		jClasses::inc('profil~profilSrv');
		$listeProfil = profilSrv::chargeAllProfil();
		//Pays
		jClasses::inc('pays~paysSrv');
		$listePays = paysSrv::chargeAllPays();
							
		$rep->body->assign('tParams', $tParams);
		$rep->body->assign("listeProfil", $listeProfil);		
		$rep->body->assign("listePays", $listePays);		
		$rep->body->assign('utilisateur', $utilisateur);													
		$rep->body->assign("utilisateur_id", $this->utilisateur_id);		
		$rep->body->assign("page", $this->page);		

        return $rep;
    }
	
	
	/**
    * Enregistrement des données d'une actualité
	* 
	* Utilisé en création et modification seulement 
	* Recoit en paramètre l'ensemble des données du formulaire d'édition d'une actualité
	* Une fois ls utilisateur sauvegardée, redirige vers la page de liste des actualités
    */
    function sauvegardeUtilisateur() {
		//Préparation de la réponse
		global $gJConfig;

		//Récupération des paramètres
		$utilisateur = jMagicLoader::arrayToObject($this->request->params, 'utilisateur');

		//Récupération des paramètres
		if ($this->request->params['page']) {
			$this->page = $this->request->params['page'];			
		}else{
			$this->page = 1;
		}	

		//Enregistrement
		jClasses::inc('commun~tools');	

		jClasses::inc('utilisateurSrv');
		utilisateurSrv::sauvegardeUtilisateur($utilisateur);

		//Paramètres
		$tParams = array('page'=> $this->page);

		//Redirection		
		$rep = $this->getResponse('redirect');
		$rep->action  = 'utilisateur~utilisateurBo_listeUtilisateurs';
		$rep->params = $tParams;
        
        return $rep;        
    }

	/**
    * Suppression d'une actualité donnée
	* 
	* Recoit l'id de la actualité en paramètre
	* Une fois ls utilisateur supprimée, redirige vers la page de liste des actualités
    */
    function supprimeUtilisateur() {

		//Récupération des paramètres
		$utilisateurId = $this->intParam('utilisateur_id',0, FALSE);
		if ($utilisateurId == 0) {
			throw new Exception('Invalid parameter utilisateur_id');
		}

		//Suppression
		jClasses::inc('utilisateurSrv');
		utilisateurSrv::supprimeUtilisateur($utilisateurId);
		
		//Redirection
		$rep = $this->getResponse('redirect');
		$rep->action  = 'utilisateur~utilisateurBo_listeUtilisateurs';
        
        return $rep;
    }
}
?>
