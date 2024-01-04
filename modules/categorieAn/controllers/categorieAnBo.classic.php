<?php
/**
* @package ilay-nosy
* @subpackage categorieAn
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Contr�leur BO pour les categorieAns
* @package ilay-nosy
* @subpackage categorieAn
* @todo : d�finir les diff�rentes actions du contr�leur
*/
require_once (LIB_PATH.'fpdf/fpdf.php');

class categorieAnBoCtrl extends jController {

	//Toutes les actions de ce contr�leur n�cessite une authentification via le plugin jAuth
	public $pluginParams = array('*'=>array('auth.required'=>true));
	
	/**
    * Affiche la liste des categorieAns
	* Recoit en param�tre le type de l'actualit� : standard ou �v�nement, 
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
    * Affichage le d�tail d'une actualit� en mode edition 
	* Recoit l'id de l'actualit� en param�tre
    */
    function editionCategorieAn() {
		//Pr�paration de la r�ponse
		global $gJConfig;

        $rep = $this->getResponse('htmlBo');
		$rep->addJSLink($gJConfig->urlengine['basePath'].'design/back/js/categorieAns.js');
		
		//Chargement du menu 
		$rep->menusActifs = array(HtmlBoResponse::MENU_PARAMETRE, HtmlBoResponse::MENU_PARAMETRE_CAT_ANNONCE);
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/back/css/nosyEdit.css');
		
		//Template � utiliser
		$rep->bodyTpl = 'categorieAn~categorieAnBo';

		//R�cup�ration des param�tres
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

		//Chargement des donn�es
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
    * Enregistrement des donn�es d'une actualit�
	* 
	* Utilis� en cr�ation et modification seulement 
	* Recoit en param�tre l'ensemble des donn�es du formulaire d'�dition d'une actualit�
	* Une fois ls categorieAn sauvegard�e, redirige vers la page de liste des actualit�s
    */
    function sauvegardeCategorieAn() {
		//Pr�paration de la r�ponse
		global $gJConfig;

		//R�cup�ration des param�tres
		$categorieAn = jMagicLoader::arrayToObject($this->request->params, 'categorieAn');

		//R�cup�ration des param�tres
		if ($this->request->params['page']) {
			$this->page = $this->request->params['page'];			
		}else{
			$this->page = 1;
		}	

		//Enregistrement
		jClasses::inc('commun~tools');	

		jClasses::inc('categorieAnSrv');
		categorieAnSrv::sauvegardeCategorieAn($categorieAn);

		//Param�tres
		$tParams = array('page'=> $this->page);

		//Redirection		
		$rep = $this->getResponse('redirect');
		$rep->action  = 'categorieAn~categorieAnBo_listeCategorieAns';
		$rep->params = $tParams;
        
        return $rep;        
    }

	/**
    * Suppression d'une actualit� donn�e
	* 
	* Recoit l'id de la actualit� en param�tre
	* Une fois ls categorieAn supprim�e, redirige vers la page de liste des actualit�s
    */
    function supprimeCategorieAn() {

		//R�cup�ration des param�tres
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
