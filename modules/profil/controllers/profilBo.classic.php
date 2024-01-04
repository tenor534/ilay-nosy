<?php
/**
* @package ilay-nosy
* @subpackage profil
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Contrôleur BO pour les profils
* @package ilay-nosy
* @subpackage profil
* @todo : définir les différentes actions du contrôleur
*/
require_once (LIB_PATH.'fpdf/fpdf.php');

class profilBoCtrl extends jController {

	//Toutes les actions de ce contrôleur nécessite une authentification via le plugin jAuth
	public $pluginParams = array('*'=>array('auth.required'=>true));
	
	/**
    * Affiche la liste des profils
	* Recoit en paramètre le type de l'actualité : standard ou évènement, 
    */
    function listeProfils() {
		jClasses::inc('profil~profilSrv');

        $rep = $this->getResponse('htmlBo');

		//Param
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}

		$rep->menusActifs = array(HtmlBoResponse::MENU_COMPTE, HtmlBoResponse::MENU_COMPTE_PROFIL);
		$rep->bodyTpl = 'profil~profilBo';

		//Param
		$tParams = array('page'=> $this->page);

		$rep->body->assignZone("listeProfilBo", "profil~listeProfilBo", $tParams);

        return $rep;
    }

	/**
    * Affichage le détail d'une actualité en mode edition 
	* Recoit l'id de l'actualité en paramètre
    */
    function editionProfil() {
		//Préparation de la réponse
		global $gJConfig;

        $rep = $this->getResponse('htmlBo');
		$rep->addJSLink($gJConfig->urlengine['basePath'].'design/back/js/profils.js');
		
		//Chargement du menu 
		$rep->menusActifs = array(HtmlBoResponse::MENU_COMPTE, HtmlBoResponse::MENU_COMPTE_PROFIL);
		
		//Template à utiliser
		$rep->bodyTpl = 'profil~profilBo';

		//Récupération des paramètres
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}		
		if ($this->intParam('profil_id')) {
			$this->profil_id = $this->intParam('profil_id');
		}else{
			$this->profil_id = 0;
		}
		if ($this->param('errorMessage')) {
			$this->errorMessage = $this->param('errorMessage');
		}else{
			$this->errorMessage = '';
		}

		//$tParams = array('zone'=> $this->getParam('zone','profil~listeProfilBo.zone'));

		//Chargement des données
		jClasses::inc('profil~profilSrv');
		
		if ($this->profil_id != 0) {
			try {
				$profil = profilSrv::chargeProfil($this->profil_id);
				
			} catch(Exception $oJException) {
				throw new JException ($oJException->getLocaleKey()) ;
			}				
		}else{
			$profil = profilSrv::getDaoProfil();
		}

		$tParams = array('profil_id'=> $this->profil_id, 'errorMessage'=>$this->errorMessage);
							
		$rep->body->assign('tParams', $tParams);
		$rep->body->assign('profil', $profil);													
		$rep->body->assign("profil_id", $this->profil_id);		
		$rep->body->assign("page", $this->page);		

        return $rep;
    }
	
	
	/**
    * Enregistrement des données d'une actualité
	* 
	* Utilisé en création et modification seulement 
	* Recoit en paramètre l'ensemble des données du formulaire d'édition d'une actualité
	* Une fois ls profil sauvegardée, redirige vers la page de liste des actualités
    */
    function sauvegardeProfil() {
		//Préparation de la réponse
		global $gJConfig;

		//Récupération des paramètres
		$profil = jMagicLoader::arrayToObject($this->request->params, 'profil');

		//Récupération des paramètres
		if ($this->request->params['page']) {
			$this->page = $this->request->params['page'];			
		}else{
			$this->page = 1;
		}	

		//Enregistrement
		jClasses::inc('commun~tools');	

		jClasses::inc('profilSrv');
		profilSrv::sauvegardeProfil($profil);

		//Paramètres
		$tParams = array('page'=> $this->page);

		//Redirection		
		$rep = $this->getResponse('redirect');
		$rep->action  = 'profil~profilBo_listeProfils';
		$rep->params = $tParams;
        
        return $rep;        
    }

	/**
    * Suppression d'une actualité donnée
	* 
	* Recoit l'id de la actualité en paramètre
	* Une fois ls profil supprimée, redirige vers la page de liste des actualités
    */
    function supprimeProfil() {

		//Récupération des paramètres
		$profilId = $this->intParam('profil_id',0, FALSE);
		if ($profilId == 0) {
			throw new Exception('Invalid parameter profil_id');
		}

		//Suppression
		jClasses::inc('profilSrv');
		profilSrv::supprimeProfil($profilId);
		
		//Redirection
		$rep = $this->getResponse('redirect');
		$rep->action  = 'profil~profilBo_listeProfils';
        
        return $rep;
    }
}
?>
