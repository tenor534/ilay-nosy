<?php
/**
* @package ilay-nosy
* @subpackage categorieAct
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Contr�leur BO pour les categorieActs
* @package ilay-nosy
* @subpackage categorieAct
* @todo : d�finir les diff�rentes actions du contr�leur
*/
require_once (LIB_PATH.'fpdf/fpdf.php');

class categorieActBoCtrl extends jController {

	//Toutes les actions de ce contr�leur n�cessite une authentification via le plugin jAuth
	public $pluginParams = array('*'=>array('auth.required'=>true));
	
	/**
    * Affiche la liste des categorieActs
	* Recoit en param�tre le type de l'actualit� : standard ou �v�nement, 
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
    * Affichage le d�tail d'une actualit� en mode edition 
	* Recoit l'id de l'actualit� en param�tre
    */
    function editionCategorieAct() {
		//Pr�paration de la r�ponse
		global $gJConfig;

        $rep = $this->getResponse('htmlBo');
		$rep->addJSLink($gJConfig->urlengine['basePath'].'design/back/js/categorieActs.js');
		
		//Chargement du menu 
		$rep->menusActifs = array(HtmlBoResponse::MENU_PARAMETRE, HtmlBoResponse::MENU_PARAMETRE_CAT_ACTUALITE);
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/back/css/nosyEdit.css');
		
		//Template � utiliser
		$rep->bodyTpl = 'categorieAct~categorieActBo';

		//R�cup�ration des param�tres
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

		//Chargement des donn�es
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
    * Enregistrement des donn�es d'une actualit�
	* 
	* Utilis� en cr�ation et modification seulement 
	* Recoit en param�tre l'ensemble des donn�es du formulaire d'�dition d'une actualit�
	* Une fois ls categorieAct sauvegard�e, redirige vers la page de liste des actualit�s
    */
    function sauvegardeCategorieAct() {
		//Pr�paration de la r�ponse
		global $gJConfig;

		//R�cup�ration des param�tres
		$categorieAct = jMagicLoader::arrayToObject($this->request->params, 'categorieAct');

		//R�cup�ration des param�tres
		if ($this->request->params['page']) {
			$this->page = $this->request->params['page'];			
		}else{
			$this->page = 1;
		}	

		//Enregistrement
		jClasses::inc('commun~tools');	

		jClasses::inc('categorieActSrv');
		categorieActSrv::sauvegardeCategorieAct($categorieAct);

		//Param�tres
		$tParams = array('page'=> $this->page);

		//Redirection		
		$rep = $this->getResponse('redirect');
		$rep->action  = 'categorieAct~categorieActBo_listeCategorieActs';
		$rep->params = $tParams;
        
        return $rep;        
    }

	/**
    * Suppression d'une actualit� donn�e
	* 
	* Recoit l'id de la actualit� en param�tre
	* Une fois ls categorieAct supprim�e, redirige vers la page de liste des actualit�s
    */
    function supprimeCategorieAct() {

		//R�cup�ration des param�tres
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
