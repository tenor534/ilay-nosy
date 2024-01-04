<?php
/**
* @package dwordconsulting
* @subpackage service
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Contrôleur BO pour les services
* @package dwordconsulting
* @subpackage service
* @todo : définir les différentes actions du contrôleur
*/
require_once (LIB_PATH.'fpdf/fpdf.php');

class serviceBoCtrl extends jController {

	//Toutes les actions de ce contrôleur nécessite une authentification via le plugin jAuth
	public $pluginParams = array('*'=>array('auth.required'=>true));
	
	/**
    * Affiche la liste des services
	* Recoit en paramètre le type de l'actualité : standard ou évènement, 
    */
    function listeServices() {
		jClasses::inc('service~serviceSrv');

        $rep = $this->getResponse('htmlBo');

		//Param
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}

		$rep->menusActifs = array(HtmlBoResponse::MENU_COMPTE, HtmlBoResponse::MENU_COMPTE_SERVICE);
		$rep->bodyTpl = 'service~serviceBo';

		//Param
		$tParams = array('page'=> $this->page);

		$rep->body->assignZone("listeServiceBo", "service~listeServiceBo", $tParams);

        return $rep;
    }

	/**
    * Affichage le détail d'une actualité en mode edition 
	* Recoit l'id de l'actualité en paramètre
    */
    function editionService() {
		//Préparation de la réponse
		global $gJConfig;

        $rep = $this->getResponse('htmlBo');
		$rep->addJSLink($gJConfig->urlengine['basePath'].'design/back/js/services.js');
		
		//Chargement du menu 
		$rep->menusActifs = array(HtmlBoResponse::MENU_COMPTE, HtmlBoResponse::MENU_COMPTE_SERVICE);
		
		//Template à utiliser
		$rep->bodyTpl = 'service~serviceBo';

		//Récupération des paramètres
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}		
		if ($this->intParam('service_id')) {
			$this->service_id = $this->intParam('service_id');
		}else{
			$this->service_id = 0;
		}
		if ($this->param('errorMessage')) {
			$this->errorMessage = $this->param('errorMessage');
		}else{
			$this->errorMessage = '';
		}

		//$tParams = array('zone'=> $this->getParam('zone','service~listeServiceBo.zone'));

		//Chargement des données
		jClasses::inc('service~serviceSrv');
		
		if ($this->service_id != 0) {
			try {
				$service = serviceSrv::chargeService($this->service_id);
				
			} catch(Exception $oJException) {
				throw new JException ($oJException->getLocaleKey()) ;
			}				
		}else{
			$service = serviceSrv::getDaoService();
		}

		$tParams = array('service_id'=> $this->service_id, 'errorMessage'=>$this->errorMessage);
							
		$rep->body->assign('tParams', $tParams);
		$rep->body->assign('service', $service);													
		$rep->body->assign("service_id", $this->service_id);		
		$rep->body->assign("page", $this->page);		

        return $rep;
    }
	
	
	/**
    * Enregistrement des données d'une actualité
	* 
	* Utilisé en création et modification seulement 
	* Recoit en paramètre l'ensemble des données du formulaire d'édition d'une actualité
	* Une fois ls service sauvegardée, redirige vers la page de liste des actualités
    */
    function sauvegardeService() {
		//Préparation de la réponse
		global $gJConfig;

		//Récupération des paramètres
		$service = jMagicLoader::arrayToObject($this->request->params, 'service');

		//Récupération des paramètres
		if ($this->request->params['page']) {
			$this->page = $this->request->params['page'];			
		}else{
			$this->page = 1;
		}	

		//Enregistrement
		jClasses::inc('commun~tools');	

		jClasses::inc('serviceSrv');
		serviceSrv::sauvegardeService($service);

		//Paramètres
		$tParams = array('page'=> $this->page);

		//Redirection		
		$rep = $this->getResponse('redirect');
		$rep->action  = 'service~serviceBo_listeServices';
		$rep->params = $tParams;
        
        return $rep;        
    }

	/**
    * Suppression d'une actualité donnée
	* 
	* Recoit l'id de la actualité en paramètre
	* Une fois ls service supprimée, redirige vers la page de liste des actualités
    */
    function supprimeService() {

		//Récupération des paramètres
		$serviceId = $this->intParam('service_id',0, FALSE);
		if ($serviceId == 0) {
			throw new Exception('Invalid parameter service_id');
		}

		//Suppression
		jClasses::inc('serviceSrv');
		serviceSrv::supprimeService($serviceId);
		
		//Redirection
		$rep = $this->getResponse('redirect');
		$rep->action  = 'service~serviceBo_listeServices';
        
        return $rep;
    }
}
?>
