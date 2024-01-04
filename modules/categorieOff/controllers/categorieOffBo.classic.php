<?php
/**
* @package ilay-nosy
* @subpackage categorieOff
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Contrôleur BO pour les categorieOffs
* @package ilay-nosy
* @subpackage categorieOff
* @todo : définir les différentes actions du contrôleur
*/
require_once (LIB_PATH.'fpdf/fpdf.php');

class categorieOffBoCtrl extends jController {

	//Toutes les actions de ce contrôleur nécessite une authentification via le plugin jAuth
	public $pluginParams = array('*'=>array('auth.required'=>true));
	
	/**
    * Affiche la liste des categorieOffs
	* Recoit en paramètre le type de l'actualité : standard ou évènement, 
    */
    function listeCategorieOffs() {
		jClasses::inc('categorieOff~categorieOffSrv');

        $rep = $this->getResponse('htmlBo');

		//Param
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}

		$rep->menusActifs = array(HtmlBoResponse::MENU_PARAMETRE, HtmlBoResponse::MENU_PARAMETRE_CAT_OFFICIEL);
		$rep->bodyTpl = 'categorieOff~categorieOffBo';

		//Param
		$tParams = array('page'=> $this->page);

		$rep->body->assignZone("listeCategorieOffBo", "categorieOff~listeCategorieOffBo", $tParams);

        return $rep;
    }

	/**
    * Affichage le détail d'une actualité en mode edition 
	* Recoit l'id de l'actualité en paramètre
    */
    function editionCategorieOff() {
		//Préparation de la réponse
		global $gJConfig;

        $rep = $this->getResponse('htmlBo');
		$rep->addJSLink($gJConfig->urlengine['basePath'].'design/back/js/categorieOffs.js');
		
		//Chargement du menu 
		$rep->menusActifs = array(HtmlBoResponse::MENU_PARAMETRE, HtmlBoResponse::MENU_PARAMETRE_CAT_OFFICIEL);
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/back/css/nosyEdit.css');
		
		//Template à utiliser
		$rep->bodyTpl = 'categorieOff~categorieOffBo';

		//Récupération des paramètres
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}		
		if ($this->intParam('categorieOff_id')) {
			$this->categorieOff_id = $this->intParam('categorieOff_id');
		}else{
			$this->categorieOff_id = 0;
		}
		if ($this->param('errorMessage')) {
			$this->errorMessage = $this->param('errorMessage');
		}else{
			$this->errorMessage = '';
		}

		//$tParams = array('zone'=> $this->getParam('zone','categorieOff~listeCategorieOffBo.zone'));

		//Chargement des données
		jClasses::inc('categorieOff~categorieOffSrv');
		
		if ($this->categorieOff_id != 0) {
			try {
				$categorieOff = categorieOffSrv::chargeCategorieOff($this->categorieOff_id);
				
			} catch(Exception $oJException) {
				throw new JException ($oJException->getLocaleKey()) ;
			}				
		}else{
			$categorieOff = categorieOffSrv::getDaoCategorieOff();
		}

		$tParams = array('categorieOff_id'=> $this->categorieOff_id, 'errorMessage'=>$this->errorMessage);
							
		$rep->body->assign('tParams', $tParams);
		$rep->body->assign('categorieOff', $categorieOff);													
		$rep->body->assign("categorieOff_id", $this->categorieOff_id);		
		$rep->body->assign("page", $this->page);		

        return $rep;
    }
	
	
	/**
    * Enregistrement des données d'une actualité
	* 
	* Utilisé en création et modification seulement 
	* Recoit en paramètre l'ensemble des données du formulaire d'édition d'une actualité
	* Une fois ls categorieOff sauvegardée, redirige vers la page de liste des actualités
    */
    function sauvegardeCategorieOff() {
		//Préparation de la réponse
		global $gJConfig;

		//Récupération des paramètres
		$categorieOff = jMagicLoader::arrayToObject($this->request->params, 'categorieOff');

		//Récupération des paramètres
		if ($this->request->params['page']) {
			$this->page = $this->request->params['page'];			
		}else{
			$this->page = 1;
		}	

		//Enregistrement
		jClasses::inc('commun~tools');	

		jClasses::inc('categorieOffSrv');
		categorieOffSrv::sauvegardeCategorieOff($categorieOff);

		//Paramètres
		$tParams = array('page'=> $this->page);

		//Redirection		
		$rep = $this->getResponse('redirect');
		$rep->action  = 'categorieOff~categorieOffBo_listeCategorieOffs';
		$rep->params = $tParams;
        
        return $rep;        
    }

	/**
    * Suppression d'une actualité donnée
	* 
	* Recoit l'id de la actualité en paramètre
	* Une fois ls categorieOff supprimée, redirige vers la page de liste des actualités
    */
    function supprimeCategorieOff() {

		//Récupération des paramètres
		$categorieOffId = $this->intParam('categorieOff_id',0, FALSE);
		if ($categorieOffId == 0) {
			throw new Exception('Invalid parameter categorieOff_id');
		}

		//Suppression
		jClasses::inc('categorieOffSrv');
		categorieOffSrv::supprimeCategorieOff($categorieOffId);
		
		//Redirection
		$rep = $this->getResponse('redirect');
		$rep->action  = 'categorieOff~categorieOffBo_listeCategorieOffs';
        
        return $rep;
    }
}
?>
