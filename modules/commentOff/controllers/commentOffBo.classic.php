<?php
/**
* @package ilay-nosy
* @subpackage utilisateur
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Contr�leur BO pour les utilisateurs
* @package ilay-nosy
* @subpackage utilisateur
* @todo : d�finir les diff�rentes actions du contr�leur
*/
require_once (LIB_PATH.'fpdf/fpdf.php');

class utilisateurBoCtrl extends jController {

	//Toutes les actions de ce contr�leur n�cessite une authentification via le plugin jAuth
	public $pluginParams = array('*'=>array('auth.required'=>true));
	
	/**
    * Affiche la liste des utilisateurs
	* Recoit en param�tre le type de l'actualit� : standard ou �v�nement, 
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
    * Affichage le d�tail d'une actualit� en mode edition 
	* Recoit l'id de l'actualit� en param�tre
    */
    function editionUtilisateur() {
		//Pr�paration de la r�ponse
		global $gJConfig;

        $rep = $this->getResponse('htmlBo');
		$rep->addJSLink($gJConfig->urlengine['basePath'] . 'design/back/js/utilisateurs.js');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/back/css/nosyEdit.css');
		
		//Chargement du menu 
		$rep->menusActifs = array(HtmlBoResponse::MENU_COMPTE, HtmlBoResponse::MENU_COMPTE_UTILISATEUR);
		
		//Template � utiliser
		$rep->bodyTpl = 'utilisateur~utilisateurBo';

		//R�cup�ration des param�tres
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

		//Chargement des donn�es
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
    * Enregistrement des donn�es d'une actualit�
	* 
	* Utilis� en cr�ation et modification seulement 
	* Recoit en param�tre l'ensemble des donn�es du formulaire d'�dition d'une actualit�
	* Une fois ls utilisateur sauvegard�e, redirige vers la page de liste des actualit�s
    */
    function sauvegardeUtilisateur() {
		//Pr�paration de la r�ponse
		global $gJConfig;

		//R�cup�ration des param�tres
		$utilisateur = jMagicLoader::arrayToObject($this->request->params, 'utilisateur');

		//R�cup�ration des param�tres
		if ($this->request->params['page']) {
			$this->page = $this->request->params['page'];			
		}else{
			$this->page = 1;
		}	

		//Enregistrement
		jClasses::inc('commun~tools');	

		jClasses::inc('utilisateurSrv');
		utilisateurSrv::sauvegardeUtilisateur($utilisateur);

		//Param�tres
		$tParams = array('page'=> $this->page);

		//Redirection		
		$rep = $this->getResponse('redirect');
		$rep->action  = 'utilisateur~utilisateurBo_listeUtilisateurs';
		$rep->params = $tParams;
        
        return $rep;        
    }

	/**
    * Suppression d'une actualit� donn�e
	* 
	* Recoit l'id de la actualit� en param�tre
	* Une fois ls utilisateur supprim�e, redirige vers la page de liste des actualit�s
    */
    function supprimeUtilisateur() {

		//R�cup�ration des param�tres
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
