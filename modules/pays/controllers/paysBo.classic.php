<?php
/**
* @package ilay-nosy
* @subpackage pays
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Contr�leur BO pour les payss
* @package ilay-nosy
* @subpackage pays
* @todo : d�finir les diff�rentes actions du contr�leur
*/
require_once (LIB_PATH.'fpdf/fpdf.php');

class paysBoCtrl extends jController {

	//Toutes les actions de ce contr�leur n�cessite une authentification via le plugin jAuth
	public $pluginParams = array('*'=>array('auth.required'=>true));
	
	/**
    * Affiche la liste des payss
	* Recoit en param�tre le type de l'actualit� : standard ou �v�nement, 
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
    * Affichage le d�tail d'une actualit� en mode edition 
	* Recoit l'id de l'actualit� en param�tre
    */
    function editionPays() {
		//Pr�paration de la r�ponse
		global $gJConfig;

        $rep = $this->getResponse('htmlBo');
		$rep->addJSLink($gJConfig->urlengine['basePath'].'design/back/js/payss.js');
		
		//Chargement du menu 
		$rep->menusActifs = array(HtmlBoResponse::MENU_PARAMETRE, HtmlBoResponse::MENU_PARAMETRE_PAYS);
		
		//Template � utiliser
		$rep->bodyTpl = 'pays~paysBo';

		//R�cup�ration des param�tres
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

		//Chargement des donn�es
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
    * Enregistrement des donn�es d'une actualit�
	* 
	* Utilis� en cr�ation et modification seulement 
	* Recoit en param�tre l'ensemble des donn�es du formulaire d'�dition d'une actualit�
	* Une fois ls pays sauvegard�e, redirige vers la page de liste des actualit�s
    */
    function sauvegardePays() {
		//Pr�paration de la r�ponse
		global $gJConfig;

		//R�cup�ration des param�tres
		$pays = jMagicLoader::arrayToObject($this->request->params, 'pays');

		//Enregistrement
		jClasses::inc('commun~tools');	

		//R�cup�ration des param�tres
		if ($this->request->params['page']) {
			$this->page = $this->request->params['page'];			
		}else{
			$this->page = 1;
		}	

		jClasses::inc('paysSrv');
		paysSrv::sauvegardePays($pays);

		//Param�tres
		$tParams = array('page'=> $this->page);
		
		//Redirection		
		$rep = $this->getResponse('redirect');
		$rep->action  = 'pays~paysBo_listePayss';
		$rep->params = $tParams;
        
        return $rep;        
    }

	/**
    * Suppression d'une actualit� donn�e
	* 
	* Recoit l'id de la actualit� en param�tre
	* Une fois ls pays supprim�e, redirige vers la page de liste des actualit�s
    */
    function supprimePays() {

		//R�cup�ration des param�tres
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
