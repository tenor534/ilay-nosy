<?php
/**
* @package ilay-nosy
* @subpackage credit
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Contrôleur BO pour les credits
* @package ilay-nosy
* @subpackage credit
* @todo : définir les différentes actions du contrôleur
*/
require_once (LIB_PATH.'fpdf/fpdf.php');

class creditBoCtrl extends jController {

	//Toutes les actions de ce contrôleur nécessite une authentification via le plugin jAuth
	public $pluginParams = array('*'=>array('auth.required'=>true));
	
	/**
    * Affiche la liste des credits
	* Recoit en paramètre le type de l'actualité : standard ou évènement, 
    */
    function listeCredits() {
		jClasses::inc('credit~creditSrv');

        $rep = $this->getResponse('htmlBo');

		//Param
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}

		$rep->menusActifs = array(HtmlBoResponse::MENU_CREDIT, HtmlBoResponse::MENU_CREDIT_LISTE);
		$rep->bodyTpl = 'credit~creditBo';

		//Param
		$tParams = array('page'=> $this->page);

		$rep->body->assignZone("listeCreditBo", "credit~listeCreditBo", $tParams);

        return $rep;
    }

	/**
    * Affichage le détail d'une actualité en mode edition 
	* Recoit l'id de l'actualité en paramètre
    */
    function editionCredit() {
		//Préparation de la réponse
		global $gJConfig;

        $rep = $this->getResponse('htmlBo');
		$rep->addJSLink($gJConfig->urlengine['basePath'] . 'design/back/js/credits.js');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/back/css/nosyEdit.css');
		
		//Chargement du menu 
		$rep->menusActifs = array(HtmlBoResponse::MENU_CREDIT, HtmlBoResponse::MENU_CREDIT_LISTE);
		
		//Template à utiliser
		$rep->bodyTpl = 'credit~creditBo';

		//Récupération des paramètres
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}		
		if ($this->intParam('credit_id')) {
			$this->credit_id = $this->intParam('credit_id');
		}else{
			$this->credit_id = 0;
		}
		if ($this->param('errorMessage')) {
			$this->errorMessage = $this->param('errorMessage');
		}else{
			$this->errorMessage = '';
		}

		//$tParams = array('zone'=> $this->getParam('zone','credit~listeCreditBo.zone'));

		//Chargement des données
		jClasses::inc('credit~creditSrv');
		
		if ($this->credit_id != 0) {
			try {
				$credit = creditSrv::chargeCredit($this->credit_id);
				
			} catch(Exception $oJException) {
				throw new JException ($oJException->getLocaleKey()) ;
			}				
		}else{
			$credit = creditSrv::getDaoCredit();
			$credit->credit_statut = USER_STATUT_ON;			
		}

		$tParams = array('credit_id'=> $this->credit_id,'errorMessage'=>$this->errorMessage, 'page'=> $this->page);

		//forfait
		jClasses::inc('forfait~forfaitSrv');
		$listeForfait = forfaitSrv::chargeAllForfait();
							
		$rep->body->assign('tParams', $tParams);
		$rep->body->assign("listeForfait", $listeForfait);		
		$rep->body->assign('credit', $credit);													
		$rep->body->assign("credit_id", $this->credit_id);		
		$rep->body->assign("page", $this->page);		

        return $rep;
    }
	
	
	/**
    * Enregistrement des données d'une actualité
	* 
	* Utilisé en création et modification seulement 
	* Recoit en paramètre l'ensemble des données du formulaire d'édition d'une actualité
	* Une fois ls credit sauvegardée, redirige vers la page de liste des actualités
    */
    function sauvegardeCredit() {
		//Préparation de la réponse
		global $gJConfig;

		//Récupération des paramètres
		$credit = jMagicLoader::arrayToObject($this->request->params, 'credit');

		//Récupération des paramètres
		if ($this->request->params['page']) {
			$this->page = $this->request->params['page'];			
		}else{
			$this->page = 1;
		}	

		//Classes
		jClasses::inc('commun~tools');	
		jClasses::inc('creditSrv');

		$credit->isPlus		 		= $this->param('credit_isPlus', 0, true);

		//Save
		$id = creditSrv::sauvegardeCredit($credit);

		//Paramètres
		$tParams = array('page'=> $this->page);

		//Redirection		
		$rep = $this->getResponse('redirect');
		$rep->action  = 'credit~creditBo_listeCredits';
		$rep->params = $tParams;
        
        return $rep;        
    }

	/**
    * Suppression d'une actualité donnée
	* 
	* Recoit l'id de la actualité en paramètre
	* Une fois ls credit supprimée, redirige vers la page de liste des actualités
    */
    function supprimeCredit() {

		//Récupération des paramètres
		$creditId = $this->intParam('credit_id',0, FALSE);
		if ($creditId == 0) {
			throw new Exception('Invalid parameter credit_id');
		}

		//Suppression
		jClasses::inc('creditSrv');
		creditSrv::supprimeCredit($creditId);
		
		//Redirection
		$rep = $this->getResponse('redirect');
		$rep->action  = 'credit~creditBo_listeCredits';
        
        return $rep;
    }
	
	/**
    * Charge la liste de rubprique pour la catégorie d'annonce en cours
	* 
	* Recoit l'id de la actualité en paramètre
	* Une fois ls credit supprimée, redirige vers la page de liste des actualités
    */
	function showCredit(){
		global $gJConfig;
        $rep = $this->getResponse('json');
		jClasses::inc('credit~creditSrv');
		$idPackId = $this->intParam('idPackId', 0, true);
		
		$toCredit = creditSrv::getAllCredit($idPackId);
		if(sizeof($toCredit)>0)
		{
			$tCredit = array();
			foreach($toCredit as $oCredit)
			{
				$oCredit->credit_codePIN = htmlentities($oCredit->credit_codePIN);
				$oCredit->credit_password = htmlentities($oCredit->credit_password);
				array_push($tCredit, $oCredit);
			}
			$result = array('toCredit' => $tCredit);
		}
		else
			$result = array('toCredit' => 0);

		$rep->datas = $result;
		return $rep;	
	}
	
	/**
    * Affichage le détail d'une actualité en mode edition 
	* Recoit l'id de l'actualité en paramètre
    */
    function generationCredits() {
		//Préparation de la réponse
		global $gJConfig;

        $rep = $this->getResponse('htmlBo');
		$rep->addJSLink($gJConfig->urlengine['basePath'] . 'design/back/js/credits.js');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/back/css/nosyEdit.css');
		
		//Chargement du menu 
		$rep->menusActifs = array(HtmlBoResponse::MENU_CREDIT, HtmlBoResponse::MENU_CREDIT_LISTE);
		
		//Template à utiliser
		$rep->bodyTpl = 'credit~generationBo';

		//Récupération des paramètres
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}		
		if ($this->intParam('credit_id')) {
			$this->credit_id = $this->intParam('credit_id');
		}else{
			$this->credit_id = 0;
		}
		if ($this->param('errorMessage')) {
			$this->errorMessage = $this->param('errorMessage');
		}else{
			$this->errorMessage = '';
		}

		//$tParams = array('zone'=> $this->getParam('zone','credit~listeCreditBo.zone'));

		//Chargement des données
		jClasses::inc('credit~creditSrv');
		
		if ($this->credit_id != 0) {
			try {
				$credit = creditSrv::chargeCredit($this->credit_id);
				
			} catch(Exception $oJException) {
				throw new JException ($oJException->getLocaleKey()) ;
			}				
		}else{
			$credit = creditSrv::getDaoCredit();
			$credit->credit_statut = USER_STATUT_ON;			
		}

		$tParams = array('credit_id'=> $this->credit_id,'errorMessage'=>$this->errorMessage, 'page'=> $this->page);

		//forfait
		jClasses::inc('forfait~forfaitSrv');
		$listeForfait = forfaitSrv::chargeAllForfait();
							
		$rep->body->assign('tParams', $tParams);
		$rep->body->assign("listeForfait", $listeForfait);		
		$rep->body->assign('credit', $credit);													
		$rep->body->assign("credit_id", $this->credit_id);		
		$rep->body->assign("page", $this->page);		

        return $rep;
    }
	
	/**
    * Charge la liste de crédit générés
	* 
	* Recoit l'id du forfait en paramètre
	* Recoit l'isPlus: le type de crédit
    */
	function generateCredits(){
		global $gJConfig;
        $rep = $this->getResponse('json');

		jClasses::inc('commun~tools');	
		jClasses::inc('credit~creditSrv');
		jClasses::inc('forfait~forfaitSrv');

		$idForfait 	= $this->intParam('idForfait', 0, true);
		$isPlus 	= $this->intParam('isPlus', 0, true);
		$nbCode 	= $this->intParam('nbCode', 10, true);
		
		$tCredit 	= array();

		//Génération du codePIN
		//$case   = 1; //0 = miniscule, 1 = majuscule, 2 = les 2
		//$type   = 1; //0 = numérique, 1 = alphabétique, 2= alphanumérique 
		//$taille = 8; //nombre de caractère
		
		//Le forfait encours
		$forfait = forfaitSrv::getForfait($idForfait);

		for($i = 0; $i<$nbCode ; $i++){
		
			$credit = creditSrv::getDaoCredit();
		
			$codePIN  = tools::genereCode( 1, 1, 8 );
			$password = tools::genereCode( 1, 0, 14 );
		
			$credit->id 			= 0;
			$credit->abonnementId 	= 0;
			$credit->forfaitId	 	= $idForfait;
			$credit->isPlus			= $isPlus;
			$credit->codePIN		= $codePIN;
			$credit->password		= $password;
			$credit->dateUse		= NULL;
		
			$id 		= creditSrv::sauvegardeCredit($credit);

			$credit->id 		= $id;
			
			if($isPlus == 1){
				$credit->montant 	= number_format($forfait->forfait_prixPlus, 2, ',', '`');
			}else{
				$credit->montant 	= number_format($forfait->forfait_prix, 2, ',', '`');
			}	
		
			array_push($tCredit, $credit);
		}
		
		$result = array('toCredit' => $tCredit);

		$rep->datas = $result;
		return $rep;	
	}
}
?>
