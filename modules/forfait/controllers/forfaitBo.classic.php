<?php
/**
* @package ilay-nosy
* @subpackage forfait
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Contrôleur BO pour les forfaits
* @package ilay-nosy
* @subpackage forfait
* @todo : définir les différentes actions du contrôleur
*/
require_once (LIB_PATH.'fpdf/fpdf.php');

class forfaitBoCtrl extends jController {

	//Toutes les actions de ce contrôleur nécessite une authentification via le plugin jAuth
	public $pluginParams = array('*'=>array('auth.required'=>true));
	
	/**
    * Affiche la liste des forfaits
	* Recoit en paramètre le type de l'actualité : standard ou évènement, 
    */
    function listeForfaits() {
		jClasses::inc('forfait~forfaitSrv');

        $rep = $this->getResponse('htmlBo');

		//Param
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}

		$rep->menusActifs = array(HtmlBoResponse::MENU_ABONNEMENT, HtmlBoResponse::MENU_ABONNEMENT_FORFAIT);
		$rep->bodyTpl = 'forfait~forfaitBo';

		//Param
		$tParams = array('page'=> $this->page);

		$rep->body->assignZone("listeForfaitBo", "forfait~listeForfaitBo", $tParams);

        return $rep;
    }

	/**
    * Affichage le détail d'une actualité en mode edition 
	* Recoit l'id de l'actualité en paramètre
    */
    function editionForfait() {
		//Préparation de la réponse
		global $gJConfig;

        $rep = $this->getResponse('htmlBo');
		$rep->addJSLink($gJConfig->urlengine['basePath'] . 'design/back/js/forfaits.js');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/back/css/nosyEdit.css');
		
		//Chargement du menu 
		$rep->menusActifs = array(HtmlBoResponse::MENU_ABONNEMENT, HtmlBoResponse::MENU_ABONNEMENT_FORFAIT);
		
		//Template à utiliser
		$rep->bodyTpl = 'forfait~forfaitBo';

		//Récupération des paramètres
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}		
		if ($this->intParam('forfait_id')) {
			$this->forfait_id = $this->intParam('forfait_id');
		}else{
			$this->forfait_id = 0;
		}
		if ($this->param('errorMessage')) {
			$this->errorMessage = $this->param('errorMessage');
		}else{
			$this->errorMessage = '';
		}

		//$tParams = array('zone'=> $this->getParam('zone','forfait~listeForfaitBo.zone'));

		//Chargement des données
		jClasses::inc('forfait~forfaitSrv');
		
		if ($this->forfait_id != 0) {
			try {
				$forfait = forfaitSrv::chargeForfait($this->forfait_id);
				
			} catch(Exception $oJException) {
				throw new JException ($oJException->getLocaleKey()) ;
			}				
		}else{
			$forfait = forfaitSrv::getDaoForfait();
			$forfait->forfait_statut = USER_STATUT_ON;			
		}

		$tParams = array('forfait_id'=> $this->forfait_id,'errorMessage'=>$this->errorMessage, 'page'=> $this->page);

		//categorieAn
		jClasses::inc('pack~packSrv');
		$listePack = packSrv::chargeAllpack();
							
		$rep->body->assign('tParams', $tParams);
		$rep->body->assign("listePack", $listePack);		
		$rep->body->assign('forfait', $forfait);													
		$rep->body->assign("forfait_id", $this->forfait_id);		
		$rep->body->assign("page", $this->page);		

        return $rep;
    }
	
	
	/**
    * Enregistrement des données d'une actualité
	* 
	* Utilisé en création et modification seulement 
	* Recoit en paramètre l'ensemble des données du formulaire d'édition d'une actualité
	* Une fois ls forfait sauvegardée, redirige vers la page de liste des actualités
    */
    function sauvegardeForfait() {
		//Préparation de la réponse
		global $gJConfig;

		//Récupération des paramètres
		$forfait = jMagicLoader::arrayToObject($this->request->params, 'forfait');

		//Récupération des paramètres
		if ($this->request->params['page']) {
			$this->page = $this->request->params['page'];			
		}else{
			$this->page = 1;
		}	

		//Classes
		jClasses::inc('commun~tools');	
		jClasses::inc('forfaitSrv');

		$forfait->voirPhoto 		= $this->param('forfait_voirPhoto', 0, true);
		$forfait->voirCoordonnee 	= $this->param('forfait_voirCoordonnee', 0, true);
		$forfait->affichePhoto 		= $this->param('forfait_affichePhoto', 0, true);
		$forfait->afficheCoordonnee = $this->param('forfait_afficheCoordonnee', 0, true);
		$forfait->ajoutLien 		= $this->param('forfait_ajoutLien', 0, true);
		$forfait->hasPlus 			= $this->param('forfait_hasPlus', 0, true);
		$forfait->statistique 		= $this->param('forfait_statistique', 0, true);
		$forfait->texteMEV 			= $this->param('forfait_texteMEV', 0, true);

		//Save
		$id = forfaitSrv::sauvegardeForfait($forfait);

		//Paramètres
		$tParams = array('page'=> $this->page);

		//Redirection		
		$rep = $this->getResponse('redirect');
		$rep->action  = 'forfait~forfaitBo_listeForfaits';
		$rep->params = $tParams;
        
        return $rep;        
    }

	/**
    * Suppression d'une actualité donnée
	* 
	* Recoit l'id de la actualité en paramètre
	* Une fois ls forfait supprimée, redirige vers la page de liste des actualités
    */
    function supprimeForfait() {

		//Récupération des paramètres
		$forfaitId = $this->intParam('forfait_id',0, FALSE);
		if ($forfaitId == 0) {
			throw new Exception('Invalid parameter forfait_id');
		}

		//Suppression
		jClasses::inc('forfaitSrv');
		forfaitSrv::supprimeForfait($forfaitId);
		
		//Redirection
		$rep = $this->getResponse('redirect');
		$rep->action  = 'forfait~forfaitBo_listeForfaits';
        
        return $rep;
    }
	
	/**
    * Charge la liste de rubprique pour la catégorie d'annonce en cours
	* 
	* Recoit l'id de la actualité en paramètre
	* Une fois ls forfait supprimée, redirige vers la page de liste des actualités
    */
	function showForfait(){
		global $gJConfig;
        $rep = $this->getResponse('json');
		jClasses::inc('forfait~forfaitSrv');
		$idPackId = $this->intParam('idPackId', 0, true);
		
		$toForfait = forfaitSrv::getAllForfait($idPackId);
		if(sizeof($toForfait)>0)
		{
			$tForfait = array();
			foreach($toForfait as $oForfait)
			{
				$oForfait->forfait_libelle = htmlentities($oForfait->forfait_libelle);
				array_push($tForfait, $oForfait);
			}
			$result = array('toForfait' => $tForfait);
		}
		else
			$result = array('toForfait' => 0);

		$rep->datas = $result;
		return $rep;	
	}
	
	
}
?>
