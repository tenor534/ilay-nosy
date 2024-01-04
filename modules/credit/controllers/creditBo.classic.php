<?php
/**
* @package ilay-nosy
* @subpackage credit
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Contr�leur BO pour les credits
* @package ilay-nosy
* @subpackage credit
* @todo : d�finir les diff�rentes actions du contr�leur
*/
require_once (LIB_PATH.'fpdf/fpdf.php');

class creditBoCtrl extends jController {

	//Toutes les actions de ce contr�leur n�cessite une authentification via le plugin jAuth
	public $pluginParams = array('*'=>array('auth.required'=>true));
	
	/**
    * Affiche la liste des credits
	* Recoit en param�tre le type de l'actualit� : standard ou �v�nement, 
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
    * Affichage le d�tail d'une actualit� en mode edition 
	* Recoit l'id de l'actualit� en param�tre
    */
    function editionCredit() {
		//Pr�paration de la r�ponse
		global $gJConfig;

        $rep = $this->getResponse('htmlBo');
		$rep->addJSLink($gJConfig->urlengine['basePath'] . 'design/back/js/credits.js');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/back/css/nosyEdit.css');
		
		//Chargement du menu 
		$rep->menusActifs = array(HtmlBoResponse::MENU_CREDIT, HtmlBoResponse::MENU_CREDIT_LISTE);
		
		//Template � utiliser
		$rep->bodyTpl = 'credit~creditBo';

		//R�cup�ration des param�tres
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

		//Chargement des donn�es
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
    * Enregistrement des donn�es d'une actualit�
	* 
	* Utilis� en cr�ation et modification seulement 
	* Recoit en param�tre l'ensemble des donn�es du formulaire d'�dition d'une actualit�
	* Une fois ls credit sauvegard�e, redirige vers la page de liste des actualit�s
    */
    function sauvegardeCredit() {
		//Pr�paration de la r�ponse
		global $gJConfig;

		//R�cup�ration des param�tres
		$credit = jMagicLoader::arrayToObject($this->request->params, 'credit');

		//R�cup�ration des param�tres
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

		//Param�tres
		$tParams = array('page'=> $this->page);

		//Redirection		
		$rep = $this->getResponse('redirect');
		$rep->action  = 'credit~creditBo_listeCredits';
		$rep->params = $tParams;
        
        return $rep;        
    }

	/**
    * Suppression d'une actualit� donn�e
	* 
	* Recoit l'id de la actualit� en param�tre
	* Une fois ls credit supprim�e, redirige vers la page de liste des actualit�s
    */
    function supprimeCredit() {

		//R�cup�ration des param�tres
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
    * Charge la liste de rubprique pour la cat�gorie d'annonce en cours
	* 
	* Recoit l'id de la actualit� en param�tre
	* Une fois ls credit supprim�e, redirige vers la page de liste des actualit�s
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
    * Affichage le d�tail d'une actualit� en mode edition 
	* Recoit l'id de l'actualit� en param�tre
    */
    function generationCredits() {
		//Pr�paration de la r�ponse
		global $gJConfig;

        $rep = $this->getResponse('htmlBo');
		$rep->addJSLink($gJConfig->urlengine['basePath'] . 'design/back/js/credits.js');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/back/css/nosyEdit.css');
		
		//Chargement du menu 
		$rep->menusActifs = array(HtmlBoResponse::MENU_CREDIT, HtmlBoResponse::MENU_CREDIT_LISTE);
		
		//Template � utiliser
		$rep->bodyTpl = 'credit~generationBo';

		//R�cup�ration des param�tres
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

		//Chargement des donn�es
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
    * Charge la liste de cr�dit g�n�r�s
	* 
	* Recoit l'id du forfait en param�tre
	* Recoit l'isPlus: le type de cr�dit
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

		//G�n�ration du codePIN
		//$case   = 1; //0 = miniscule, 1 = majuscule, 2 = les 2
		//$type   = 1; //0 = num�rique, 1 = alphab�tique, 2= alphanum�rique 
		//$taille = 8; //nombre de caract�re
		
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
