<?php
/**
* @package ilay-nosy
* @subpackage categorieAct
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Contrôleur BO pour les categorieActs
* @package ilay-nosy
* @subpackage categorieAct
* @todo : définir les différentes actions du contrôleur
*/
require_once (LIB_PATH.'fpdf/fpdf.php');

class categorieActBoCtrl extends jController {

	//Toutes les actions de ce contrôleur nécessite une authentification via le plugin jAuth
	public $pluginParams = array('*'=>array('auth.required'=>true));
	
	/**
    * Affiche la liste des categorieActs
	* Recoit en paramètre le type de l'actualité : standard ou évènement, 
    */
    function listeCategorieActs() {
		jClasses::inc('categorieAct~categorieActSrv');

        $rep = $this->getResponse('htmlBo');

		//Param
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}

		$rep->menusActifs = array(HtmlBoResponse::MENU_PARAMETRE, HtmlBoResponse::MENU_PARAMETRE_CAT_ACTUALITE);
		$rep->bodyTpl = 'categorieAct~categorieActBo';

		//Param
		$tParams = array('page'=> $this->page);

		$rep->body->assignZone("listeCategorieActBo", "categorieAct~listeCategorieActBo", $tParams);

        return $rep;
    }

	/**
    * Affichage le détail d'une actualité en mode edition 
	* Recoit l'id de l'actualité en paramètre
    */
    function editionCategorieAct() {
		//Préparation de la réponse
		global $gJConfig;

        $rep = $this->getResponse('htmlBo');
		$rep->addJSLink($gJConfig->urlengine['basePath'].'design/back/js/categorieActs.js');
		
		//Chargement du menu 
		$rep->menusActifs = array(HtmlBoResponse::MENU_PARAMETRE, HtmlBoResponse::MENU_PARAMETRE_CAT_ACTUALITE);
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/back/css/nosyEdit.css');
		
		//Template à utiliser
		$rep->bodyTpl = 'categorieAct~categorieActBo';

		//Récupération des paramètres
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}		
		if ($this->intParam('categorieAct_id')) {
			$this->categorieAct_id = $this->intParam('categorieAct_id');
		}else{
			$this->categorieAct_id = 0;
		}
		if ($this->param('errorMessage')) {
			$this->errorMessage = $this->param('errorMessage');
		}else{
			$this->errorMessage = '';
		}

		//$tParams = array('zone'=> $this->getParam('zone','categorieAct~listeCategorieActBo.zone'));

		//Chargement des données
		jClasses::inc('categorieAct~categorieActSrv');
		
		if ($this->categorieAct_id != 0) {
			try {
				$categorieAct = categorieActSrv::chargeCategorieAct($this->categorieAct_id);
				
			} catch(Exception $oJException) {
				throw new JException ($oJException->getLocaleKey()) ;
			}				
		}else{
			$categorieAct = categorieActSrv::getDaoCategorieAct();
		}

		$tParams = array('categorieAct_id'=> $this->categorieAct_id, 'errorMessage'=>$this->errorMessage);
							
		$rep->body->assign('tParams', $tParams);
		$rep->body->assign('categorieAct', $categorieAct);													
		$rep->body->assign("categorieAct_id", $this->categorieAct_id);		
		$rep->body->assign("page", $this->page);		

        return $rep;
    }
	
	
	/**
    * Enregistrement des données d'une actualité
	* 
	* Utilisé en création et modification seulement 
	* Recoit en paramètre l'ensemble des données du formulaire d'édition d'une actualité
	* Une fois ls categorieAct sauvegardée, redirige vers la page de liste des actualités
    */
    function sauvegardeCategorieAct() {
		//Préparation de la réponse
		global $gJConfig;

		//Récupération des paramètres
		$categorieAct = jMagicLoader::arrayToObject($this->request->params, 'categorieAct');

		//Récupération des paramètres
		if ($this->request->params['page']) {
			$this->page = $this->request->params['page'];			
		}else{
			$this->page = 1;
		}	

		//Enregistrement
		jClasses::inc('commun~tools');	

		jClasses::inc('categorieActSrv');
		categorieActSrv::sauvegardeCategorieAct($categorieAct);

		//Paramètres
		$tParams = array('page'=> $this->page);

		//Redirection		
		$rep = $this->getResponse('redirect');
		$rep->action  = 'categorieAct~categorieActBo_listeCategorieActs';
		$rep->params = $tParams;
        
        return $rep;        
    }

	/**
    * Suppression d'une actualité donnée
	* 
	* Recoit l'id de la actualité en paramètre
	* Une fois ls categorieAct supprimée, redirige vers la page de liste des actualités
    */
    function supprimeCategorieAct() {

		//Récupération des paramètres
		$categorieActId = $this->intParam('categorieAct_id',0, FALSE);
		if ($categorieActId == 0) {
			throw new Exception('Invalid parameter categorieAct_id');
		}

		//Suppression
		jClasses::inc('categorieActSrv');
		categorieActSrv::supprimeCategorieAct($categorieActId);
		
		//Redirection
		$rep = $this->getResponse('redirect');
		$rep->action  = 'categorieAct~categorieActBo_listeCategorieActs';
        
        return $rep;
    }
}
?>
