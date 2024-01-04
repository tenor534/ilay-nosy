<?php
/**
* @package @projectName@
* @subpackage @moduleName@
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Contr�leur BO pour les @moduleAbsName@s
* @package @projectName@
* @subpackage @moduleName@
* @todo : d�finir les diff�rentes actions du contr�leur
*/
require_once (LIB_PATH.'fpdf/fpdf.php');

class @moduleName@BoCtrl extends jController {

	//Toutes les actions de ce contr�leur n�cessite une authentification via le plugin jAuth
	public $pluginParams = array('*'=>array('auth.required'=>true));
	
	/**
    * Affiche la liste des @moduleAbsName@s
    */
    function liste@ModuleName@s() {
		jClasses::inc('@moduleName@~@moduleName@Srv');

        $rep = $this->getResponse('htmlBo');

		//Param
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}

		$rep->menusActifs = array(@constResponseMenu@);
		$rep->bodyTpl = '@moduleName@~@moduleName@Bo';

		//Param
		$tParams = array('page'=> $this->page);

		$rep->body->assignZone("liste@ModuleName@Bo", "@moduleName@~liste@ModuleName@Bo", $tParams);

        return $rep;
    }

	/**
    * Affichage le d�tail d'une entit� @nameTable@ en mode edition 
	* Recoit l'id de l'entit� en param�tre
    */
    function edition@ModuleName@() {
		//Pr�paration de la r�ponse
		global $gJConfig;

        $rep = $this->getResponse('htmlBo');
		$rep->addJSLink($gJConfig->urlengine['basePath'].'design/back/js/@moduleName@s.js');
		
		//Chargement du menu 
		$rep->menusActifs = array(@constResponseMenu@);
		
		//Template � utiliser
		$rep->bodyTpl = '@moduleName@~@moduleName@Bo';

		//R�cup�ration des param�tres
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}		
		if ($this->intParam('@tablePK@')) {
			$this->societe_id = $this->intParam('@tablePK@');
		}else{
			$this->societe_id = 0;
		}
		if ($this->param('errorMessage')) {
			$this->errorMessage = $this->param('errorMessage');
		}else{
			$this->errorMessage = '';
		}

		//$tParams = array('zone'=> $this->getParam('zone','@moduleName@~liste@ModuleName@Bo.zone'));

		//Chargement des donn�es
		jClasses::inc('@moduleName@~@moduleName@Srv');
		
		if ($this->societe_id != 0) {
			try {
				$@nameTable@ = @moduleName@Srv::charge@ModuleName@($this->@tablePK@);
				
			} catch(Exception $oJException) {
				throw new JException ($oJException->getLocaleKey()) ;
			}				
		}else{
			$@nameTable@ = @moduleName@Srv::getDao@ModuleName@();
			$@nameTable@->@nameTable@_statut = USER_STATUT_ON;			
		}

		$tParams = array('@tablePK@'=> $this->@tablePK@,'errorMessage'=>$this->errorMessage, 'page'=> $this->page);


@editionListA@
							
		$rep->body->assign('tParams', $tParams);
		
@editionListB@
		
		$rep->body->assign('@nameTable@', $@nameTable@);													
		$rep->body->assign("@tablePK@", $this->@tablePK@);		
		$rep->body->assign("page", $this->page);		

        return $rep;
    }
	
	
	/**
    * Enregistrement des donn�es d'une entit� @moduleAbsName@
	* 
	* Utilis� en cr�ation et modification seulement 
	* Recoit en param�tre l'ensemble des donn�es du formulaire d'�dition d'une @moduleAbsName@
	* Une fois une entit� @moduleAbsName@ sauvegard�e, redirige vers la page de liste des @moduleAbsName@s
    */
    function sauvegarde@ModuleName@() {
		//Pr�paration de la r�ponse
		global $gJConfig;

		//R�cup�ration des param�tres
		$@nameTable@ = jMagicLoader::arrayToObject($this->request->params, '@nameTable@');

		//R�cup�ration des param�tres
		if ($this->request->params['page']) {
			$this->page = $this->request->params['page'];			
		}else{
			$this->page = 1;
		}	

		//Enregistrement
		jClasses::inc('commun~tools');	

		jClasses::inc('@moduleName@Srv');
		@moduleName@Srv::sauvegarde@ModuleName@($@nameTable@);

		//Param�tres
		$tParams = array('page'=> $this->page);

		//Redirection		
		$rep = $this->getResponse('redirect');
		$rep->action  = '@moduleName@~@moduleName@Bo_liste@ModuleName@s';
		$rep->params = $tParams;
        
        return $rep;        
    }

	/**
    * Suppression d'une entit� @nameTable@ donn�e
	* 
	* Recoit l'id de l'entit� en param�tre
	* Une fois ls societe supprim�e, redirige vers la page de liste des @moduleAbsName@s
    */
    function supprime@ModuleName@() {

		//R�cup�ration des param�tres
		$@nameTable@Id = $this->intParam('@tablePK@',0, FALSE);
		if ($@nameTable@Id == 0) {
			throw new Exception('Invalid parameter @tablePK@');
		}

		//Suppression
		jClasses::inc('@moduleName@Srv');
		@moduleName@Srv::supprime@ModuleName@($@nameTable@Id);
		
		//Redirection
		$rep = $this->getResponse('redirect');
		$rep->action  = '@moduleName@~@moduleName@Bo_liste@ModuleName@s';
        
        return $rep;
    }
}
?>
