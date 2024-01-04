<?php
/**
* @package ilay-nosy
* @subpackage pays
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Contrôleur BO pour les payss
* @package ilay-nosy
* @subpackage pays
* @todo : définir les différentes actions du contrôleur
*/
require_once (LIB_PATH.'fpdf/fpdf.php');

class paysBoCtrl extends jController {

	//Toutes les actions de ce contrôleur nécessite une authentification via le plugin jAuth
	public $pluginParams = array('*'=>array('auth.required'=>true));
	
	/**
    * Affiche la liste des payss
	* Recoit en paramètre le type de l'actualité : standard ou évènement, 
    */
    function listePayss() {
		jClasses::inc('pays~paysSrv');

        $rep = $this->getResponse('htmlBo');

		//Param
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}

		$rep->menusActifs = array(HtmlBoResponse::MENU_PARAMETRE, HtmlBoResponse::MENU_PARAMETRE_PAYS);
		$rep->bodyTpl = 'pays~paysBo';

		//Param
		$tParams = array('page'=> $this->page);

		$rep->body->assignZone("listePaysBo", "pays~listePaysBo", $tParams);

        return $rep;
    }

	/**
    * Affichage le détail d'une actualité en mode edition 
	* Recoit l'id de l'actualité en paramètre
    */
    function editionPays() {
		//Préparation de la réponse
		global $gJConfig;

        $rep = $this->getResponse('htmlBo');
		$rep->addJSLink($gJConfig->urlengine['basePath'].'design/back/js/payss.js');
		
		//Chargement du menu 
		$rep->menusActifs = array(HtmlBoResponse::MENU_PARAMETRE, HtmlBoResponse::MENU_PARAMETRE_PAYS);
		
		//Template à utiliser
		$rep->bodyTpl = 'pays~paysBo';

		//Récupération des paramètres
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}		
		if ($this->intParam('pays_id')) {
			$this->pays_id = $this->intParam('pays_id');
		}else{
			$this->pays_id = 0;
		}
		if ($this->param('errorMessage')) {
			$this->errorMessage = $this->param('errorMessage');
		}else{
			$this->errorMessage = '';
		}

		//$tParams = array('zone'=> $this->getParam('zone','pays~listePaysBo.zone'));

		//Chargement des données
		jClasses::inc('pays~paysSrv');
		
		if ($this->pays_id != 0) {
			try {
				$pays = paysSrv::chargePays($this->pays_id);
				
			} catch(Exception $oJException) {
				throw new JException ($oJException->getLocaleKey()) ;
			}				
		}else{
			$pays = paysSrv::getDaoPays();
		}

		$tParams = array('pays_id'=> $this->pays_id, 'errorMessage'=>$this->errorMessage);
							
							
		$rep->body->assign('tParams', $tParams);
		$rep->body->assign('pays', $pays);													
		$rep->body->assign("pays_id", $this->pays_id);		
		$rep->body->assign("page", $this->page);		

        return $rep;
    }
	
	
	/**
    * Enregistrement des données d'une actualité
	* 
	* Utilisé en création et modification seulement 
	* Recoit en paramètre l'ensemble des données du formulaire d'édition d'une actualité
	* Une fois ls pays sauvegardée, redirige vers la page de liste des actualités
    */
    function sauvegardePays() {
		//Préparation de la réponse
		global $gJConfig;

		//Récupération des paramètres
		$pays = jMagicLoader::arrayToObject($this->request->params, 'pays');

		//Enregistrement
		jClasses::inc('commun~tools');	

		//Récupération des paramètres
		if ($this->request->params['page']) {
			$this->page = $this->request->params['page'];			
		}else{
			$this->page = 1;
		}	

		jClasses::inc('paysSrv');
		paysSrv::sauvegardePays($pays);

		//Paramètres
		$tParams = array('page'=> $this->page);
		
		//Redirection		
		$rep = $this->getResponse('redirect');
		$rep->action  = 'pays~paysBo_listePayss';
		$rep->params = $tParams;
        
        return $rep;        
    }

	/**
    * Suppression d'une actualité donnée
	* 
	* Recoit l'id de la actualité en paramètre
	* Une fois ls pays supprimée, redirige vers la page de liste des actualités
    */
    function supprimePays() {

		//Récupération des paramètres
		$paysId = $this->intParam('pays_id',0, FALSE);
		if ($paysId == 0) {
			throw new Exception('Invalid parameter pays_id');
		}

		//Suppression
		jClasses::inc('paysSrv');
		paysSrv::supprimePays($paysId);
		
		//Redirection
		$rep = $this->getResponse('redirect');
		$rep->action  = 'pays~paysBo_listePayss';
        
        return $rep;
    }
}
?>
