<?php
/**
* @marqueage ilay-nosy
* @submarqueage marque
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Contrôleur BO pour les marques
* @marqueage ilay-nosy
* @submarqueage marque
* @todo : définir les différentes actions du contrôleur
*/
require_once (LIB_PATH.'fpdf/fpdf.php');

class marqueBoCtrl extends jController {

	//Toutes les actions de ce contrôleur nécessite une authentification via le plugin jAuth
	public $pluginParams = array('*'=>array('auth.required'=>true));
	
	/**
    * Affiche la liste des marques
	* Recoit en paramètre le type de l'actualité : standard ou évènement, 
    */
    function listeMarques() {
		jClasses::inc('marque~marqueSrv');

        $rep = $this->getResponse('htmlBo');

		//Param
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}

		$rep->menusActifs = array(HtmlBoResponse::MENU_PARAMETRE, HtmlBoResponse::MENU_PARAMETRE_MARQUE);
		$rep->bodyTpl = 'marque~marqueBo';

		//Param
		$tParams = array('page'=> $this->page);

		$rep->body->assignZone("listeMarqueBo", "marque~listeMarqueBo", $tParams);

        return $rep;
    }

	/**
    * Affichage le détail d'une actualité en mode edition 
	* Recoit l'id de l'actualité en paramètre
    */
    function editionMarque() {
		//Préparation de la réponse
		global $gJConfig;

        $rep = $this->getResponse('htmlBo');
		$rep->addJSLink($gJConfig->urlengine['basePath'].'design/back/js/marques.js');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/back/css/nosyEdit.css');
	
		//Chargement du menu 
		$rep->menusActifs = array(HtmlBoResponse::MENU_PARAMETRE, HtmlBoResponse::MENU_PARAMETRE_MARQUE);
		
		//Template à utiliser
		$rep->bodyTpl = 'marque~marqueBo';

		//Récupération des paramètres
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}		
		if ($this->intParam('marque_id')) {
			$this->marque_id = $this->intParam('marque_id');
		}else{
			$this->marque_id = 0;
		}
		if ($this->param('errorMessage')) {
			$this->errorMessage = $this->param('errorMessage');
		}else{
			$this->errorMessage = '';
		}

		//$tParams = array('zone'=> $this->getParam('zone','marque~listeMarqueBo.zone'));

		//Chargement des données
		jClasses::inc('marque~marqueSrv');
		
		if ($this->marque_id != 0) {
			try {
				$marque = marqueSrv::chargeMarque($this->marque_id);
								
			} catch(Exception $oJException) {
				throw new JException ($oJException->getLocaleKey()) ;
			}				
		}else{
			$marque = marqueSrv::getDaoMarque();
		}

		$tParams = array('marque_id'=> $this->marque_id, 'errorMessage'=>$this->errorMessage);
							
		$rep->body->assign('tParams', $tParams);
		$rep->body->assign('marque', $marque);													
		$rep->body->assign("marque_id", $this->marque_id);		
		$rep->body->assign("page", $this->page);		

        return $rep;
    }
	
	
	/**
    * Enregistrement des données d'une actualité
	* 
	* Utilisé en création et modification seulement 
	* Recoit en paramètre l'ensemble des données du formulaire d'édition d'une actualité
	* Une fois ls marque sauvegardée, redirige vers la page de liste des actualités
    */
    function sauvegardeMarque() {
		//Préparation de la réponse
		global $gJConfig;

		//Récupération des paramètres
		$marque = jMagicLoader::arrayToObject($this->request->params, 'marque');

		//Récupération des paramètres
		if ($this->request->params['page']) {
			$this->page = $this->request->params['page'];			
		}else{
			$this->page = 1;
		}	

		//Enregistrement
		jClasses::inc('commun~tools');	
		jClasses::inc('marqueSrv');

		//Transaction
		$id = marqueSrv::sauvegardeMarque($marque);
		
		//Paramètres
		$tParams = array('page'=> $this->page);

		//Redirection		
		$rep = $this->getResponse('redirect');
		$rep->action  = 'marque~marqueBo_listeMarques';
		$rep->params = $tParams;
        
        return $rep;        
    }

	/**
    * Suppression d'une actualité donnée
	* 
	* Recoit l'id de la actualité en paramètre
	* Une fois ls marque supprimée, redirige vers la page de liste des actualités
    */
    function supprimeMarque() {

		//Récupération des paramètres
		$marqueId = $this->intParam('marque_id',0, FALSE);
		if ($marqueId == 0) {
			throw new Exception('Invalid parameter marque_id');
		}

		//Suppression
		jClasses::inc('marqueSrv');
		marqueSrv::supprimeMarque($marqueId);
		
		//Redirection
		$rep = $this->getResponse('redirect');
		$rep->action  = 'marque~marqueBo_listeMarques';
        
        return $rep;
    }
}
?>
