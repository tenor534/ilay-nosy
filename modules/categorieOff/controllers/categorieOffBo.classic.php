<?php
/**
* @package ilay-nosy
* @subpackage categorieOff
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Contr�leur BO pour les categorieOffs
* @package ilay-nosy
* @subpackage categorieOff
* @todo : d�finir les diff�rentes actions du contr�leur
*/
require_once (LIB_PATH.'fpdf/fpdf.php');

class categorieOffBoCtrl extends jController {

	//Toutes les actions de ce contr�leur n�cessite une authentification via le plugin jAuth
	public $pluginParams = array('*'=>array('auth.required'=>true));
	
	/**
    * Affiche la liste des categorieOffs
	* Recoit en param�tre le type de l'actualit� : standard ou �v�nement, 
    */
    function listeCategorieOffs() {
		jClasses::inc('categorieOff~categorieOffSrv');

        $rep = $this->getResponse('htmlBo');

		//Param
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}

		$rep->menusActifs = array(HtmlBoResponse::MENU_PARAMETRE, HtmlBoResponse::MENU_PARAMETRE_CAT_OFFICIEL);
		$rep->bodyTpl = 'categorieOff~categorieOffBo';

		//Param
		$tParams = array('page'=> $this->page);

		$rep->body->assignZone("listeCategorieOffBo", "categorieOff~listeCategorieOffBo", $tParams);

        return $rep;
    }

	/**
    * Affichage le d�tail d'une actualit� en mode edition 
	* Recoit l'id de l'actualit� en param�tre
    */
    function editionCategorieOff() {
		//Pr�paration de la r�ponse
		global $gJConfig;

        $rep = $this->getResponse('htmlBo');
		$rep->addJSLink($gJConfig->urlengine['basePath'].'design/back/js/categorieOffs.js');
		
		//Chargement du menu 
		$rep->menusActifs = array(HtmlBoResponse::MENU_PARAMETRE, HtmlBoResponse::MENU_PARAMETRE_CAT_OFFICIEL);
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/back/css/nosyEdit.css');
		
		//Template � utiliser
		$rep->bodyTpl = 'categorieOff~categorieOffBo';

		//R�cup�ration des param�tres
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}		
		if ($this->intParam('categorieOff_id')) {
			$this->categorieOff_id = $this->intParam('categorieOff_id');
		}else{
			$this->categorieOff_id = 0;
		}
		if ($this->param('errorMessage')) {
			$this->errorMessage = $this->param('errorMessage');
		}else{
			$this->errorMessage = '';
		}

		//$tParams = array('zone'=> $this->getParam('zone','categorieOff~listeCategorieOffBo.zone'));

		//Chargement des donn�es
		jClasses::inc('categorieOff~categorieOffSrv');
		
		if ($this->categorieOff_id != 0) {
			try {
				$categorieOff = categorieOffSrv::chargeCategorieOff($this->categorieOff_id);
				
			} catch(Exception $oJException) {
				throw new JException ($oJException->getLocaleKey()) ;
			}				
		}else{
			$categorieOff = categorieOffSrv::getDaoCategorieOff();
		}

		$tParams = array('categorieOff_id'=> $this->categorieOff_id, 'errorMessage'=>$this->errorMessage);
							
		$rep->body->assign('tParams', $tParams);
		$rep->body->assign('categorieOff', $categorieOff);													
		$rep->body->assign("categorieOff_id", $this->categorieOff_id);		
		$rep->body->assign("page", $this->page);		

        return $rep;
    }
	
	
	/**
    * Enregistrement des donn�es d'une actualit�
	* 
	* Utilis� en cr�ation et modification seulement 
	* Recoit en param�tre l'ensemble des donn�es du formulaire d'�dition d'une actualit�
	* Une fois ls categorieOff sauvegard�e, redirige vers la page de liste des actualit�s
    */
    function sauvegardeCategorieOff() {
		//Pr�paration de la r�ponse
		global $gJConfig;

		//R�cup�ration des param�tres
		$categorieOff = jMagicLoader::arrayToObject($this->request->params, 'categorieOff');

		//R�cup�ration des param�tres
		if ($this->request->params['page']) {
			$this->page = $this->request->params['page'];			
		}else{
			$this->page = 1;
		}	

		//Enregistrement
		jClasses::inc('commun~tools');	

		jClasses::inc('categorieOffSrv');
		categorieOffSrv::sauvegardeCategorieOff($categorieOff);

		//Param�tres
		$tParams = array('page'=> $this->page);

		//Redirection		
		$rep = $this->getResponse('redirect');
		$rep->action  = 'categorieOff~categorieOffBo_listeCategorieOffs';
		$rep->params = $tParams;
        
        return $rep;        
    }

	/**
    * Suppression d'une actualit� donn�e
	* 
	* Recoit l'id de la actualit� en param�tre
	* Une fois ls categorieOff supprim�e, redirige vers la page de liste des actualit�s
    */
    function supprimeCategorieOff() {

		//R�cup�ration des param�tres
		$categorieOffId = $this->intParam('categorieOff_id',0, FALSE);
		if ($categorieOffId == 0) {
			throw new Exception('Invalid parameter categorieOff_id');
		}

		//Suppression
		jClasses::inc('categorieOffSrv');
		categorieOffSrv::supprimeCategorieOff($categorieOffId);
		
		//Redirection
		$rep = $this->getResponse('redirect');
		$rep->action  = 'categorieOff~categorieOffBo_listeCategorieOffs';
        
        return $rep;
    }
}
?>
