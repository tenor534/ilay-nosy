<?php
/**
* @package ilay-nosy
* @subpackage profil
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Contr�leur BO pour les profils
* @package ilay-nosy
* @subpackage profil
* @todo : d�finir les diff�rentes actions du contr�leur
*/
require_once (LIB_PATH.'fpdf/fpdf.php');

class profilBoCtrl extends jController {

	//Toutes les actions de ce contr�leur n�cessite une authentification via le plugin jAuth
	public $pluginParams = array('*'=>array('auth.required'=>true));
	
	/**
    * Affiche la liste des profils
	* Recoit en param�tre le type de l'actualit� : standard ou �v�nement, 
    */
    function listeProfils() {
		jClasses::inc('profil~profilSrv');

        $rep = $this->getResponse('htmlBo');

		//Param
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}

		$rep->menusActifs = array(HtmlBoResponse::MENU_COMPTE, HtmlBoResponse::MENU_COMPTE_PROFIL);
		$rep->bodyTpl = 'profil~profilBo';

		//Param
		$tParams = array('page'=> $this->page);

		$rep->body->assignZone("listeProfilBo", "profil~listeProfilBo", $tParams);

        return $rep;
    }

	/**
    * Affichage le d�tail d'une actualit� en mode edition 
	* Recoit l'id de l'actualit� en param�tre
    */
    function editionProfil() {
		//Pr�paration de la r�ponse
		global $gJConfig;

        $rep = $this->getResponse('htmlBo');
		$rep->addJSLink($gJConfig->urlengine['basePath'].'design/back/js/profils.js');
		
		//Chargement du menu 
		$rep->menusActifs = array(HtmlBoResponse::MENU_COMPTE, HtmlBoResponse::MENU_COMPTE_PROFIL);
		
		//Template � utiliser
		$rep->bodyTpl = 'profil~profilBo';

		//R�cup�ration des param�tres
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}		
		if ($this->intParam('profil_id')) {
			$this->profil_id = $this->intParam('profil_id');
		}else{
			$this->profil_id = 0;
		}
		if ($this->param('errorMessage')) {
			$this->errorMessage = $this->param('errorMessage');
		}else{
			$this->errorMessage = '';
		}

		//$tParams = array('zone'=> $this->getParam('zone','profil~listeProfilBo.zone'));

		//Chargement des donn�es
		jClasses::inc('profil~profilSrv');
		
		if ($this->profil_id != 0) {
			try {
				$profil = profilSrv::chargeProfil($this->profil_id);
				
			} catch(Exception $oJException) {
				throw new JException ($oJException->getLocaleKey()) ;
			}				
		}else{
			$profil = profilSrv::getDaoProfil();
		}

		$tParams = array('profil_id'=> $this->profil_id, 'errorMessage'=>$this->errorMessage);
							
		$rep->body->assign('tParams', $tParams);
		$rep->body->assign('profil', $profil);													
		$rep->body->assign("profil_id", $this->profil_id);		
		$rep->body->assign("page", $this->page);		

        return $rep;
    }
	
	
	/**
    * Enregistrement des donn�es d'une actualit�
	* 
	* Utilis� en cr�ation et modification seulement 
	* Recoit en param�tre l'ensemble des donn�es du formulaire d'�dition d'une actualit�
	* Une fois ls profil sauvegard�e, redirige vers la page de liste des actualit�s
    */
    function sauvegardeProfil() {
		//Pr�paration de la r�ponse
		global $gJConfig;

		//R�cup�ration des param�tres
		$profil = jMagicLoader::arrayToObject($this->request->params, 'profil');

		//R�cup�ration des param�tres
		if ($this->request->params['page']) {
			$this->page = $this->request->params['page'];			
		}else{
			$this->page = 1;
		}	

		//Enregistrement
		jClasses::inc('commun~tools');	

		jClasses::inc('profilSrv');
		profilSrv::sauvegardeProfil($profil);

		//Param�tres
		$tParams = array('page'=> $this->page);

		//Redirection		
		$rep = $this->getResponse('redirect');
		$rep->action  = 'profil~profilBo_listeProfils';
		$rep->params = $tParams;
        
        return $rep;        
    }

	/**
    * Suppression d'une actualit� donn�e
	* 
	* Recoit l'id de la actualit� en param�tre
	* Une fois ls profil supprim�e, redirige vers la page de liste des actualit�s
    */
    function supprimeProfil() {

		//R�cup�ration des param�tres
		$profilId = $this->intParam('profil_id',0, FALSE);
		if ($profilId == 0) {
			throw new Exception('Invalid parameter profil_id');
		}

		//Suppression
		jClasses::inc('profilSrv');
		profilSrv::supprimeProfil($profilId);
		
		//Redirection
		$rep = $this->getResponse('redirect');
		$rep->action  = 'profil~profilBo_listeProfils';
        
        return $rep;
    }
}
?>
