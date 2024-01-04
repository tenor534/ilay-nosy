<?php
/**
* @marqueage ilay-nosy
* @submarqueage marque
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Contr�leur BO pour les marques
* @marqueage ilay-nosy
* @submarqueage marque
* @todo : d�finir les diff�rentes actions du contr�leur
*/
require_once (LIB_PATH.'fpdf/fpdf.php');

class marqueBoCtrl extends jController {

	//Toutes les actions de ce contr�leur n�cessite une authentification via le plugin jAuth
	public $pluginParams = array('*'=>array('auth.required'=>true));
	
	/**
    * Affiche la liste des marques
	* Recoit en param�tre le type de l'actualit� : standard ou �v�nement, 
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
    * Affichage le d�tail d'une actualit� en mode edition 
	* Recoit l'id de l'actualit� en param�tre
    */
    function editionMarque() {
		//Pr�paration de la r�ponse
		global $gJConfig;

        $rep = $this->getResponse('htmlBo');
		$rep->addJSLink($gJConfig->urlengine['basePath'].'design/back/js/marques.js');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/back/css/nosyEdit.css');
	
		//Chargement du menu 
		$rep->menusActifs = array(HtmlBoResponse::MENU_PARAMETRE, HtmlBoResponse::MENU_PARAMETRE_MARQUE);
		
		//Template � utiliser
		$rep->bodyTpl = 'marque~marqueBo';

		//R�cup�ration des param�tres
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

		//Chargement des donn�es
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
    * Enregistrement des donn�es d'une actualit�
	* 
	* Utilis� en cr�ation et modification seulement 
	* Recoit en param�tre l'ensemble des donn�es du formulaire d'�dition d'une actualit�
	* Une fois ls marque sauvegard�e, redirige vers la page de liste des actualit�s
    */
    function sauvegardeMarque() {
		//Pr�paration de la r�ponse
		global $gJConfig;

		//R�cup�ration des param�tres
		$marque = jMagicLoader::arrayToObject($this->request->params, 'marque');

		//R�cup�ration des param�tres
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
		
		//Param�tres
		$tParams = array('page'=> $this->page);

		//Redirection		
		$rep = $this->getResponse('redirect');
		$rep->action  = 'marque~marqueBo_listeMarques';
		$rep->params = $tParams;
        
        return $rep;        
    }

	/**
    * Suppression d'une actualit� donn�e
	* 
	* Recoit l'id de la actualit� en param�tre
	* Une fois ls marque supprim�e, redirige vers la page de liste des actualit�s
    */
    function supprimeMarque() {

		//R�cup�ration des param�tres
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
