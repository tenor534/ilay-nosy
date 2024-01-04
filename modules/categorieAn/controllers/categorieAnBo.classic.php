<?php
/**
* @package ilay-nosy
* @subpackage categorieAn
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Contrôleur BO pour les categorieAns
* @package ilay-nosy
* @subpackage categorieAn
* @todo : définir les différentes actions du contrôleur
*/
require_once (LIB_PATH.'fpdf/fpdf.php');

class categorieAnBoCtrl extends jController {

	//Toutes les actions de ce contrôleur nécessite une authentification via le plugin jAuth
	public $pluginParams = array('*'=>array('auth.required'=>true));
	
	/**
    * Affiche la liste des categorieAns
	* Recoit en paramètre le type de l'actualité : standard ou évènement, 
    */
    function listeCategorieAns() {
		jClasses::inc('categorieAn~categorieAnSrv');

        $rep = $this->getResponse('htmlBo');

		//Param
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}

		$rep->menusActifs = array(HtmlBoResponse::MENU_PARAMETRE, HtmlBoResponse::MENU_PARAMETRE_CAT_ANNONCE);
		$rep->bodyTpl = 'categorieAn~categorieAnBo';

		//Param
		$tParams = array('page'=> $this->page);

		$rep->body->assignZone("listeCategorieAnBo", "categorieAn~listeCategorieAnBo", $tParams);

        return $rep;
    }

	/**
    * Affichage le détail d'une actualité en mode edition 
	* Recoit l'id de l'actualité en paramètre
    */
    function editionCategorieAn() {
		//Préparation de la réponse
		global $gJConfig;

        $rep = $this->getResponse('htmlBo');
		$rep->addJSLink($gJConfig->urlengine['basePath'].'design/back/js/categorieAns.js');
		
		//Chargement du menu 
		$rep->menusActifs = array(HtmlBoResponse::MENU_PARAMETRE, HtmlBoResponse::MENU_PARAMETRE_CAT_ANNONCE);
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/back/css/nosyEdit.css');
		
		//Template à utiliser
		$rep->bodyTpl = 'categorieAn~categorieAnBo';

		//Récupération des paramètres
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}		
		if ($this->intParam('categorieAn_id')) {
			$this->categorieAn_id = $this->intParam('categorieAn_id');
		}else{
			$this->categorieAn_id = 0;
		}
		if ($this->param('errorMessage')) {
			$this->errorMessage = $this->param('errorMessage');
		}else{
			$this->errorMessage = '';
		}

		//$tParams = array('zone'=> $this->getParam('zone','categorieAn~listeCategorieAnBo.zone'));

		//Chargement des données
		jClasses::inc('categorieAn~categorieAnSrv');
		
		if ($this->categorieAn_id != 0) {
			try {
				$categorieAn = categorieAnSrv::chargeCategorieAn($this->categorieAn_id);
				
			} catch(Exception $oJException) {
				throw new JException ($oJException->getLocaleKey()) ;
			}				
		}else{
			$categorieAn = categorieAnSrv::getDaoCategorieAn();
		}

		$tParams = array('categorieAn_id'=> $this->categorieAn_id, 'errorMessage'=>$this->errorMessage);
							
		$rep->body->assign('tParams', $tParams);
		$rep->body->assign('categorieAn', $categorieAn);													
		$rep->body->assign("categorieAn_id", $this->categorieAn_id);		
		$rep->body->assign("page", $this->page);		

        return $rep;
    }
	
	
	/**
    * Enregistrement des données d'une actualité
	* 
	* Utilisé en création et modification seulement 
	* Recoit en paramètre l'ensemble des données du formulaire d'édition d'une actualité
	* Une fois ls categorieAn sauvegardée, redirige vers la page de liste des actualités
    */
    function sauvegardeCategorieAn() {
		//Préparation de la réponse
		global $gJConfig;

		//Récupération des paramètres
		$categorieAn = jMagicLoader::arrayToObject($this->request->params, 'categorieAn');

		//Récupération des paramètres
		if ($this->request->params['page']) {
			$this->page = $this->request->params['page'];			
		}else{
			$this->page = 1;
		}	

		//Enregistrement
		jClasses::inc('commun~tools');	

		jClasses::inc('categorieAnSrv');
		categorieAnSrv::sauvegardeCategorieAn($categorieAn);

		//Paramètres
		$tParams = array('page'=> $this->page);

		//Redirection		
		$rep = $this->getResponse('redirect');
		$rep->action  = 'categorieAn~categorieAnBo_listeCategorieAns';
		$rep->params = $tParams;
        
        return $rep;        
    }

	/**
    * Suppression d'une actualité donnée
	* 
	* Recoit l'id de la actualité en paramètre
	* Une fois ls categorieAn supprimée, redirige vers la page de liste des actualités
    */
    function supprimeCategorieAn() {

		//Récupération des paramètres
		$categorieAnId = $this->intParam('categorieAn_id',0, FALSE);
		if ($categorieAnId == 0) {
			throw new Exception('Invalid parameter categorieAn_id');
		}

		//Suppression
		jClasses::inc('categorieAnSrv');
		categorieAnSrv::supprimeCategorieAn($categorieAnId);
		
		//Redirection
		$rep = $this->getResponse('redirect');
		$rep->action  = 'categorieAn~categorieAnBo_listeCategorieAns';
        
        return $rep;
    }
}
?>
