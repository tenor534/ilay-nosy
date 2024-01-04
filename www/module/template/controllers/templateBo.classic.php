<?php
/**
* @package @projectName@
* @subpackage @moduleName@
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Contrôleur BO pour les @moduleAbsName@s
* @package @projectName@
* @subpackage @moduleName@
* @todo : définir les différentes actions du contrôleur
*/
require_once (LIB_PATH.'fpdf/fpdf.php');

class @moduleName@BoCtrl extends jController {

	//Toutes les actions de ce contrôleur nécessite une authentification via le plugin jAuth
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
    * Affichage le détail d'une entité @nameTable@ en mode edition 
	* Recoit l'id de l'entité en paramètre
    */
    function edition@ModuleName@() {
		//Préparation de la réponse
		global $gJConfig;

        $rep = $this->getResponse('htmlBo');
		$rep->addJSLink($gJConfig->urlengine['basePath'].'design/back/js/@moduleName@s.js');
		
		//Chargement du menu 
		$rep->menusActifs = array(@constResponseMenu@);
		
		//Template à utiliser
		$rep->bodyTpl = '@moduleName@~@moduleName@Bo';

		//Récupération des paramètres
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

		//Chargement des données
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
    * Enregistrement des données d'une entité @moduleAbsName@
	* 
	* Utilisé en création et modification seulement 
	* Recoit en paramètre l'ensemble des données du formulaire d'édition d'une @moduleAbsName@
	* Une fois une entité @moduleAbsName@ sauvegardée, redirige vers la page de liste des @moduleAbsName@s
    */
    function sauvegarde@ModuleName@() {
		//Préparation de la réponse
		global $gJConfig;

		//Récupération des paramètres
		$@nameTable@ = jMagicLoader::arrayToObject($this->request->params, '@nameTable@');

		//Récupération des paramètres
		if ($this->request->params['page']) {
			$this->page = $this->request->params['page'];			
		}else{
			$this->page = 1;
		}	

		//Enregistrement
		jClasses::inc('commun~tools');	

		jClasses::inc('@moduleName@Srv');
		@moduleName@Srv::sauvegarde@ModuleName@($@nameTable@);

		//Paramètres
		$tParams = array('page'=> $this->page);

		//Redirection		
		$rep = $this->getResponse('redirect');
		$rep->action  = '@moduleName@~@moduleName@Bo_liste@ModuleName@s';
		$rep->params = $tParams;
        
        return $rep;        
    }

	/**
    * Suppression d'une entité @nameTable@ donnée
	* 
	* Recoit l'id de l'entité en paramètre
	* Une fois ls societe supprimée, redirige vers la page de liste des @moduleAbsName@s
    */
    function supprime@ModuleName@() {

		//Récupération des paramètres
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
