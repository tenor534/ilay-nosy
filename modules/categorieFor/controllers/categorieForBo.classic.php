<?php
/**
* @package ilay-nosy
* @subpackage categorieFor
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Contr�leur BO pour les categorieFors
* @package ilay-nosy
* @subpackage categorieFor
* @todo : d�finir les diff�rentes actions du contr�leur
*/
require_once (LIB_PATH.'fpdf/fpdf.php');

class categorieForBoCtrl extends jController {

	//Toutes les actions de ce contr�leur n�cessite une authentification via le plugin jAuth
	public $pluginParams = array('*'=>array('auth.required'=>true));
	
	/**
    * Affiche la liste des categorieFors
	* Recoit en param�tre le type de l'actualit� : standard ou �v�nement, 
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
    * Affichage le d�tail d'une actualit� en mode edition 
	* Recoit l'id de l'actualit� en param�tre
    */
    function editionCategorieFor() {
		//Pr�paration de la r�ponse
		global $gJConfig;

        $rep = $this->getResponse('htmlBo');
		$rep->addJSLink($gJConfig->urlengine['basePath'].'design/back/js/categorieFors.js');
		
		//Chargement du menu 
		$rep->menusActifs = array(HtmlBoResponse::MENU_PARAMETRE, HtmlBoResponse::MENU_PARAMETRE_CAT_FORUM);
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/back/css/nosyEdit.css');
		
		//Template � utiliser
		$rep->bodyTpl = 'categorieFor~categorieForBo';

		//R�cup�ration des param�tres
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

		//Chargement des donn�es
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
    * Enregistrement des donn�es d'une actualit�
	* 
	* Utilis� en cr�ation et modification seulement 
	* Recoit en param�tre l'ensemble des donn�es du formulaire d'�dition d'une actualit�
	* Une fois ls categorieFor sauvegard�e, redirige vers la page de liste des actualit�s
    */
    function sauvegardeCategorieFor() {
		//Pr�paration de la r�ponse
		global $gJConfig;

		//R�cup�ration des param�tres
		$categorieFor = jMagicLoader::arrayToObject($this->request->params, 'categorieFor');

		//R�cup�ration des param�tres
		if ($this->request->params['page']) {
			$this->page = $this->request->params['page'];			
		}else{
			$this->page = 1;
		}	

		//Enregistrement
		jClasses::inc('commun~tools');	

		jClasses::inc('categorieForSrv');
		categorieForSrv::sauvegardeCategorieFor($categorieFor);

		//Param�tres
		$tParams = array('page'=> $this->page);

		//Redirection		
		$rep = $this->getResponse('redirect');
		$rep->action  = 'categorieFor~categorieForBo_listeCategorieFors';
		$rep->params = $tParams;
        
        return $rep;        
    }

	/**
    * Suppression d'une actualit� donn�e
	* 
	* Recoit l'id de la actualit� en param�tre
	* Une fois ls categorieFor supprim�e, redirige vers la page de liste des actualit�s
    */
    function supprimeCategorieFor() {

		//R�cup�ration des param�tres
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
