<?php
/**
* @marqueage ilay-nosy
* @submarqueage modele
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Contrôleur BO pour les modeles
* @marqueage ilay-nosy
* @submarqueage modele
* @todo : définir les différentes actions du contrôleur
*/
require_once (LIB_PATH.'fpdf/fpdf.php');

class modeleBoCtrl extends jController {

	//Toutes les actions de ce contrôleur nécessite une authentification via le plugin jAuth
	public $pluginParams = array('*'=>array('auth.required'=>true));
	
	/**
    * Affiche la liste des modeles
	* Recoit en paramètre le type de l'actualité : standard ou évènement, 
    */
    function listeModeles() {
		jClasses::inc('modele~modeleSrv');

        $rep = $this->getResponse('htmlBo');

		//Param
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}

		$rep->menusActifs = array(HtmlBoResponse::MENU_PARAMETRE, HtmlBoResponse::MENU_PARAMETRE_MODELE);
		$rep->bodyTpl = 'modele~modeleBo';

		//Param
		$tParams = array('page'=> $this->page);

		$rep->body->assignZone("listeModeleBo", "modele~listeModeleBo", $tParams);

        return $rep;
    }

	/**
    * Affichage le détail d'une actualité en mode edition 
	* Recoit l'id de l'actualité en paramètre
    */
    function editionModele() {
		//Préparation de la réponse
		global $gJConfig;

        $rep = $this->getResponse('htmlBo');
		$rep->addJSLink($gJConfig->urlengine['basePath'] . 'design/back/js/modeles.js');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/back/css/nosyEdit.css');
		
		//Chargement du menu 
		$rep->menusActifs = array(HtmlBoResponse::MENU_PARAMETRE, HtmlBoResponse::MENU_PARAMETRE_MODELE);
		
		//Template à utiliser
		$rep->bodyTpl = 'modele~modeleBo';

		//Récupération des paramètres
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}		
		if ($this->intParam('modele_id')) {
			$this->modele_id = $this->intParam('modele_id');
		}else{
			$this->modele_id = 0;
		}
		if ($this->param('errorMessage')) {
			$this->errorMessage = $this->param('errorMessage');
		}else{
			$this->errorMessage = '';
		}

		//$tParams = array('zone'=> $this->getParam('zone','modele~listeModeleBo.zone'));

		//Chargement des données
		jClasses::inc('modele~modeleSrv');
		
		if ($this->modele_id != 0) {
			try {
				$modele = modeleSrv::chargeModele($this->modele_id);
				
			} catch(Exception $oJException) {
				throw new JException ($oJException->getLocaleKey()) ;
			}				
		}else{
			$modele = modeleSrv::getDaoModele();
			$modele->modele_statut = USER_STATUT_ON;			
		}

		$tParams = array('modele_id'=> $this->modele_id,'errorMessage'=>$this->errorMessage, 'page'=> $this->page);

		//categorieAn
		jClasses::inc('marque~marqueSrv');
		$listeMarque = marqueSrv::chargeAllmarque();
							
		$rep->body->assign('tParams', $tParams);
		$rep->body->assign("listeMarque", $listeMarque);		
		$rep->body->assign('modele', $modele);													
		$rep->body->assign("modele_id", $this->modele_id);		
		$rep->body->assign("page", $this->page);		

        return $rep;
    }
	
	
	/**
    * Enregistrement des données d'une actualité
	* 
	* Utilisé en création et modification seulement 
	* Recoit en paramètre l'ensemble des données du formulaire d'édition d'une actualité
	* Une fois ls modele sauvegardée, redirige vers la page de liste des actualités
    */
    function sauvegardeModele() {
		//Préparation de la réponse
		global $gJConfig;

		//Récupération des paramètres
		$modele = jMagicLoader::arrayToObject($this->request->params, 'modele');

		//Récupération des paramètres
		if ($this->request->params['page']) {
			$this->page = $this->request->params['page'];			
		}else{
			$this->page = 1;
		}	

		//Classes
		jClasses::inc('commun~tools');	
		jClasses::inc('modeleSrv');

		//Save
		$id = modeleSrv::sauvegardeModele($modele);

		//Paramètres
		$tParams = array('page'=> $this->page);

		//Redirection		
		$rep = $this->getResponse('redirect');
		$rep->action  = 'modele~modeleBo_listeModeles';
		$rep->params = $tParams;
        
        return $rep;        
    }

	/**
    * Suppression d'une actualité donnée
	* 
	* Recoit l'id de la actualité en paramètre
	* Une fois ls modele supprimée, redirige vers la page de liste des actualités
    */
    function supprimeModele() {

		//Récupération des paramètres
		$modeleId = $this->intParam('modele_id',0, FALSE);
		if ($modeleId == 0) {
			throw new Exception('Invalid parameter modele_id');
		}

		//Suppression
		jClasses::inc('modeleSrv');
		modeleSrv::supprimeModele($modeleId);
		
		//Redirection
		$rep = $this->getResponse('redirect');
		$rep->action  = 'modele~modeleBo_listeModeles';
        
        return $rep;
    }
	
	/**
    * Charge la liste de rubprique pour la catégorie d'annonce en cours
	* 
	* Recoit l'id de la actualité en paramètre
	* Une fois ls modele supprimée, redirige vers la page de liste des actualités
    */
	function showModele(){
		global $gJConfig;
        $rep = $this->getResponse('json');
		jClasses::inc('modele~modeleSrv');
		$idMarqueId = $this->intParam('idMarqueId', 0, true);
		
		$toModele = modeleSrv::getAllModele($idMarqueId);
		if(sizeof($toModele)>0)
		{
			$tModele = array();
			foreach($toModele as $oModele)
			{
				$oModele->modele_libelle = htmlentities($oModele->modele_libelle);
				$oModele->modele_code = htmlentities($oModele->modele_code);
				array_push($tModele, $oModele);
			}
			$result = array('toModele' => $tModele);
		}
		else
			$result = array('toModele' => 0);

		$rep->datas = $result;
		return $rep;	
	}
	
	
}
?>
