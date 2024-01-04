<?php
/**
* @package dwordconsulting
* @subpackage service
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Contr�leur BO pour les services
* @package dwordconsulting
* @subpackage service
* @todo : d�finir les diff�rentes actions du contr�leur
*/
require_once (LIB_PATH.'fpdf/fpdf.php');

class serviceBoCtrl extends jController {

	//Toutes les actions de ce contr�leur n�cessite une authentification via le plugin jAuth
	public $pluginParams = array('*'=>array('auth.required'=>true));
	
	/**
    * Affiche la liste des services
	* Recoit en param�tre le type de l'actualit� : standard ou �v�nement, 
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
    * Affichage le d�tail d'une actualit� en mode edition 
	* Recoit l'id de l'actualit� en param�tre
    */
    function editionService() {
		//Pr�paration de la r�ponse
		global $gJConfig;

        $rep = $this->getResponse('htmlBo');
		$rep->addJSLink($gJConfig->urlengine['basePath'].'design/back/js/services.js');
		
		//Chargement du menu 
		$rep->menusActifs = array(HtmlBoResponse::MENU_COMPTE, HtmlBoResponse::MENU_COMPTE_SERVICE);
		
		//Template � utiliser
		$rep->bodyTpl = 'service~serviceBo';

		//R�cup�ration des param�tres
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

		//Chargement des donn�es
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
    * Enregistrement des donn�es d'une actualit�
	* 
	* Utilis� en cr�ation et modification seulement 
	* Recoit en param�tre l'ensemble des donn�es du formulaire d'�dition d'une actualit�
	* Une fois ls service sauvegard�e, redirige vers la page de liste des actualit�s
    */
    function sauvegardeService() {
		//Pr�paration de la r�ponse
		global $gJConfig;

		//R�cup�ration des param�tres
		$service = jMagicLoader::arrayToObject($this->request->params, 'service');

		//R�cup�ration des param�tres
		if ($this->request->params['page']) {
			$this->page = $this->request->params['page'];			
		}else{
			$this->page = 1;
		}	

		//Enregistrement
		jClasses::inc('commun~tools');	

		jClasses::inc('serviceSrv');
		serviceSrv::sauvegardeService($service);

		//Param�tres
		$tParams = array('page'=> $this->page);

		//Redirection		
		$rep = $this->getResponse('redirect');
		$rep->action  = 'service~serviceBo_listeServices';
		$rep->params = $tParams;
        
        return $rep;        
    }

	/**
    * Suppression d'une actualit� donn�e
	* 
	* Recoit l'id de la actualit� en param�tre
	* Une fois ls service supprim�e, redirige vers la page de liste des actualit�s
    */
    function supprimeService() {

		//R�cup�ration des param�tres
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
