<?php
/**
* @package ilay-nosy
* @subpackage categorieFor
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Contrôleur BO pour les categorieFors
* @package ilay-nosy
* @subpackage categorieFor
* @todo : définir les différentes actions du contrôleur
*/
require_once (LIB_PATH.'fpdf/fpdf.php');

class categorieForBoCtrl extends jController {

	//Toutes les actions de ce contrôleur nécessite une authentification via le plugin jAuth
	public $pluginParams = array('*'=>array('auth.required'=>true));
	
	/**
    * Affiche la liste des categorieFors
	* Recoit en paramètre le type de l'actualité : standard ou évènement, 
    */
    function listeCategorieFors() {
		jClasses::inc('categorieFor~categorieForSrv');

        $rep = $this->getResponse('htmlBo');

		//Param
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}

		$rep->menusActifs = array(HtmlBoResponse::MENU_PARAMETRE, HtmlBoResponse::MENU_PARAMETRE_CAT_FORUM);
		$rep->bodyTpl = 'categorieFor~categorieForBo';

		//Param
		$tParams = array('page'=> $this->page);

		$rep->body->assignZone("listeCategorieForBo", "categorieFor~listeCategorieForBo", $tParams);

        return $rep;
    }

	/**
    * Affichage le détail d'une actualité en mode edition 
	* Recoit l'id de l'actualité en paramètre
    */
    function editionCategorieFor() {
		//Préparation de la réponse
		global $gJConfig;

        $rep = $this->getResponse('htmlBo');
		$rep->addJSLink($gJConfig->urlengine['basePath'].'design/back/js/categorieFors.js');
		
		//Chargement du menu 
		$rep->menusActifs = array(HtmlBoResponse::MENU_PARAMETRE, HtmlBoResponse::MENU_PARAMETRE_CAT_FORUM);
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/back/css/nosyEdit.css');
		
		//Template à utiliser
		$rep->bodyTpl = 'categorieFor~categorieForBo';

		//Récupération des paramètres
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}		
		if ($this->intParam('categorieFor_id')) {
			$this->categorieFor_id = $this->intParam('categorieFor_id');
		}else{
			$this->categorieFor_id = 0;
		}
		if ($this->param('errorMessage')) {
			$this->errorMessage = $this->param('errorMessage');
		}else{
			$this->errorMessage = '';
		}

		//$tParams = array('zone'=> $this->getParam('zone','categorieFor~listeCategorieForBo.zone'));

		//Chargement des données
		jClasses::inc('categorieFor~categorieForSrv');
		
		if ($this->categorieFor_id != 0) {
			try {
				$categorieFor = categorieForSrv::chargeCategorieFor($this->categorieFor_id);
				
			} catch(Exception $oJException) {
				throw new JException ($oJException->getLocaleKey()) ;
			}				
		}else{
			$categorieFor = categorieForSrv::getDaoCategorieFor();
		}

		$tParams = array('categorieFor_id'=> $this->categorieFor_id, 'errorMessage'=>$this->errorMessage);
							
		$rep->body->assign('tParams', $tParams);
		$rep->body->assign('categorieFor', $categorieFor);													
		$rep->body->assign("categorieFor_id", $this->categorieFor_id);		
		$rep->body->assign("page", $this->page);		

        return $rep;
    }
	
	
	/**
    * Enregistrement des données d'une actualité
	* 
	* Utilisé en création et modification seulement 
	* Recoit en paramètre l'ensemble des données du formulaire d'édition d'une actualité
	* Une fois ls categorieFor sauvegardée, redirige vers la page de liste des actualités
    */
    function sauvegardeCategorieFor() {
		//Préparation de la réponse
		global $gJConfig;

		//Récupération des paramètres
		$categorieFor = jMagicLoader::arrayToObject($this->request->params, 'categorieFor');

		//Récupération des paramètres
		if ($this->request->params['page']) {
			$this->page = $this->request->params['page'];			
		}else{
			$this->page = 1;
		}	

		//Enregistrement
		jClasses::inc('commun~tools');	

		jClasses::inc('categorieForSrv');
		categorieForSrv::sauvegardeCategorieFor($categorieFor);

		//Paramètres
		$tParams = array('page'=> $this->page);

		//Redirection		
		$rep = $this->getResponse('redirect');
		$rep->action  = 'categorieFor~categorieForBo_listeCategorieFors';
		$rep->params = $tParams;
        
        return $rep;        
    }

	/**
    * Suppression d'une actualité donnée
	* 
	* Recoit l'id de la actualité en paramètre
	* Une fois ls categorieFor supprimée, redirige vers la page de liste des actualités
    */
    function supprimeCategorieFor() {

		//Récupération des paramètres
		$categorieForId = $this->intParam('categorieFor_id',0, FALSE);
		if ($categorieForId == 0) {
			throw new Exception('Invalid parameter categorieFor_id');
		}

		//Suppression
		jClasses::inc('categorieForSrv');
		categorieForSrv::supprimeCategorieFor($categorieForId);
		
		//Redirection
		$rep = $this->getResponse('redirect');
		$rep->action  = 'categorieFor~categorieForBo_listeCategorieFors';
        
        return $rep;
    }
}
?>
