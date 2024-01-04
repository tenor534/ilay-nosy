<?php
/**
* @package ilay-nosy
* @subpackage rubrique
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Contrôleur BO pour les rubriques
* @package ilay-nosy
* @subpackage rubrique
* @todo : définir les différentes actions du contrôleur
*/
require_once (LIB_PATH.'fpdf/fpdf.php');

class rubriqueBoCtrl extends jController {

	//Toutes les actions de ce contrôleur nécessite une authentification via le plugin jAuth
	public $pluginParams = array('*'=>array('auth.required'=>true));
	
	/**
    * Affiche la liste des rubriques
	* Recoit en paramètre le type de l'actualité : standard ou évènement, 
    */
    function listeRubriques() {
		jClasses::inc('rubrique~rubriqueSrv');

        $rep = $this->getResponse('htmlBo');

		//Param
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}

		$rep->menusActifs = array(HtmlBoResponse::MENU_ANNONCE, HtmlBoResponse::MENU_ANNONCE_RUBRIQUE);
		$rep->bodyTpl = 'rubrique~rubriqueBo';

		//Param
		$tParams = array('page'=> $this->page);

		$rep->body->assignZone("listeRubriqueBo", "rubrique~listeRubriqueBo", $tParams);

        return $rep;
    }

	/**
    * Affichage le détail d'une actualité en mode edition 
	* Recoit l'id de l'actualité en paramètre
    */
    function editionRubrique() {
		//Préparation de la réponse
		global $gJConfig;

        $rep = $this->getResponse('htmlBo');
		$rep->addJSLink($gJConfig->urlengine['basePath'] . 'design/back/js/rubriques.js');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/back/css/nosyEdit.css');
		
		//Chargement du menu 
		$rep->menusActifs = array(HtmlBoResponse::MENU_ANNONCE, HtmlBoResponse::MENU_ANNONCE_RUBRIQUE);
		
		//Template à utiliser
		$rep->bodyTpl = 'rubrique~rubriqueBo';

		//Récupération des paramètres
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}		
		if ($this->intParam('rubrique_id')) {
			$this->rubrique_id = $this->intParam('rubrique_id');
		}else{
			$this->rubrique_id = 0;
		}
		if ($this->param('errorMessage')) {
			$this->errorMessage = $this->param('errorMessage');
		}else{
			$this->errorMessage = '';
		}

		//$tParams = array('zone'=> $this->getParam('zone','rubrique~listeRubriqueBo.zone'));

		//Chargement des données
		jClasses::inc('rubrique~rubriqueSrv');
		
		if ($this->rubrique_id != 0) {
			try {
				$rubrique = rubriqueSrv::chargeRubrique($this->rubrique_id);
				
			} catch(Exception $oJException) {
				throw new JException ($oJException->getLocaleKey()) ;
			}				
		}else{
			$rubrique = rubriqueSrv::getDaoRubrique();
			$rubrique->rubrique_statut = USER_STATUT_ON;			
		}

		$tParams = array('rubrique_id'=> $this->rubrique_id,'errorMessage'=>$this->errorMessage, 'page'=> $this->page);

		//categorieAn
		jClasses::inc('categorieAn~categorieAnSrv');
		$listeCategorieAn = categorieAnSrv::chargeAllcategorieAn();
		//Rubrique parent
		jClasses::inc('rubrique~rubriqueSrv');
		//$listeRubrique = rubriqueSrv::chargeAllRubrique();
		$listeRubrique = rubriqueSrv::chargeAllRubriqueWithout($rubrique->rubrique_id);
							
		$rep->body->assign('tParams', $tParams);
		$rep->body->assign("listeCategorieAn", $listeCategorieAn);		
		$rep->body->assign("listeRubrique", $listeRubrique);		
		$rep->body->assign('rubrique', $rubrique);													
		$rep->body->assign("rubrique_id", $this->rubrique_id);		
		$rep->body->assign("page", $this->page);		

        return $rep;
    }
	
	
	/**
    * Enregistrement des données d'une actualité
	* 
	* Utilisé en création et modification seulement 
	* Recoit en paramètre l'ensemble des données du formulaire d'édition d'une actualité
	* Une fois ls rubrique sauvegardée, redirige vers la page de liste des actualités
    */
    function sauvegardeRubrique() {
		//Préparation de la réponse
		global $gJConfig;

		//Récupération des paramètres
		$rubrique = jMagicLoader::arrayToObject($this->request->params, 'rubrique');

		//Récupération des paramètres
		if ($this->request->params['page']) {
			$this->page = $this->request->params['page'];			
		}else{
			$this->page = 1;
		}	

		//Classes
		jClasses::inc('commun~tools');	
		jClasses::inc('rubriqueSrv');

		//Save
		if(!$rubrique->id){			
			$rubrique->level 	= 0;
			$rubrique->path 	= "";
		}	


		//Calcul du sortCode
		if(!$rubrique->id){ //Création d'une nouvelle rubrique	
		
			//on charge le père
			$parent = rubriqueSrv::getRubrique($rubrique->parentId);	
		
			//On charge le + grand des frères
			$frere = rubriqueSrv::getRubriqueFrere($parent->rubrique_id);	
		
			if(!sizeof($frere)){ //Il n'a pas de frère
				//echo "Il n'a pas de frere";
				if($parent->rubrique_level==0){
					$sortCode = "001";
				}else{
					$sortCode = $parent->rubrique_sortCode . ":001";
				}
				echo "sortCode : $sortCode <br><br>";
		
			}else{ //il a au moins 1 frère, on créé l'entrée comme étant la dernière de sa famille
				$rootSortCode = $parent->rubrique_sortCode;
				if($rootSortCode!=""){
					$rootSortCode.=":";
				}
				$frereSortCode = substr($frere[0]->rubrique_sortCode, strlen($frere[0]->rubrique_sortCode) - 3, 3);
				$sortCode = intval($frereSortCode) + 1;
				$sortCode = str_pad($sortCode, 3, "0", STR_PAD_LEFT);
				$sortCode = $rootSortCode.$sortCode;
				echo "sortCode : $sortCode <br><br>";
			}	
			$rubrique->sortCode = $sortCode;
		
			//Maj du path
			/*$originalRubrique = $rubrique;
			$rubrique->rubrique_siteId=$siteId;
			$rubrique->rubrique_path = $parent->rubrique_path.$rubriqueId."/";
			$rubrique->update($originalRubrique);*/
			
		}else{ // Edition d'une page donnée
		
			 $originalRubrique = rubriqueSrv::getRubrique($rubrique->id);
			
			//Le parent n'a pas été mis à jour
			if($rubrique->parentId == $originalRubrique->rubrique_parentId || $rubrique->parentId==0){
				//rien
			}else{
				//Le parent a été mis à jour il faut mettre à jour le level,le sortcode,l'alias et le path de toutes les pages impactées
				
				//On détermine les nouveaux sortCode et level pour la page modifiée
				$newParent = rubriqueSrv::getRubrique($rubrique->parentId);			
		
				//On charge le + grand des frères
				$frere = rubriqueSrv::getRubriqueFrere($newParent->rubrique_id);	
		
				if(!sizeof($frere)){ //Il n'a pas de frère
				//	echo "Il n'a pas de frere";
					$sortCode = $newParent->rubrique_sortCode . ":001";
					echo "sortCode : $sortCode <br><br>";
		
				}else{ //il a au moins 1 frère, on créé l'entrée comme étant la dernière de sa famille
					$rootSortCode = $newParent->rubrique_sortCode;
					if($rootSortCode!=""){
						$rootSortCode.=":";
					}
					$frereSortCode = substr($frere[0]->rubrique_sortCode, strlen($frere[0]->rubrique_sortCode) - 3, 3);
					$sortCode = intval($frereSortCode) + 1;
					$sortCode = str_pad($sortCode, 3, "0", STR_PAD_LEFT);
					$sortCode = $rootSortCode.$sortCode;
					echo "sortCode : $sortCode <br><br>";
				}
				
				// On met à jour la page modifiée
				$rubrique->sortCode = $sortCode;
				//$rubrique->rubrique_path = $newParent->rubrique_path.$rubrique->rubrique_id."/";
				
				$orginalSortCodeLength 	= strlen($originalRubrique->rubrique_sortCode);
				$orginalSortCodeRoot 	= substr($originalRubrique->rubrique_sortCode, 0, strlen($originalRubrique->rubrique_sortCode) - 3);
				$orginalSortCodeEnd 	= intval(substr($originalRubrique->rubrique_sortCode, strlen($originalRubrique->rubrique_sortCode) - 3,3));
		
				//echo($originalRubrique->rubrique_alias);
		
				//On met à jour tous les enfants de la page modifiée
				rubriqueSrv::updateAllRubriqueChildren($rubrique, $newParent, $originalRubrique, $orginalSortCodeLength );
		
							
				//On met à jour tous les pages et leurs enfants dont l'ordre a été MAJ du fait du déplacement de la page modifiée.
				rubriqueSrv::updateAllRubriqueAffected($orginalSortCodeRoot, $orginalSortCodeLength, $orginalSortCodeEnd );
			}
		}	

		$id = rubriqueSrv::sauvegardeRubrique($rubrique);

		//Charge le parent pour le path et le level
		$rubrique = rubriqueSrv::getRubrique($id);
		
		$rubrique->id = $rubrique->rubrique_id;
		
		if($rubrique->rubrique_parentId){
			$rubriqueParent = rubriqueSrv::getRubrique($rubrique->rubrique_parentId);

			$rubrique->level 	= $rubriqueParent->rubrique_level + 1;
			$rubrique->path 	= $rubriqueParent->rubrique_path . $rubrique->rubrique_id."/";
		}else{
			$rubrique->level 	= 1;
			
			$rubrique->path 	= "/".$rubrique->rubrique_id."/";
		}			
		rubriqueSrv::sauvegardeRubrique($rubrique);

		//Paramètres
		$tParams = array('page'=> $this->page);

		//Redirection		
		$rep = $this->getResponse('redirect');
		$rep->action  = 'rubrique~rubriqueBo_listeRubriques';
		$rep->params = $tParams;
		
        return $rep;        
    }

	/**
    * Suppression d'une actualité donnée
	* 
	* Recoit l'id de la actualité en paramètre
	* Une fois ls rubrique supprimée, redirige vers la page de liste des actualités
    */
    function supprimeRubrique() {

		//Récupération des paramètres
		$rubriqueId = $this->intParam('rubrique_id',0, FALSE);
		if ($rubriqueId == 0) {
			throw new Exception('Invalid parameter rubrique_id');
		}

		//Suppression
		jClasses::inc('rubriqueSrv');
		rubriqueSrv::supprimeRubrique($rubriqueId);		

		//rubriqueSrv::updateSortCodeOnSuppression();		
		
		
		//Redirection
		$rep = $this->getResponse('redirect');
		$rep->action  = 'rubrique~rubriqueBo_listeRubriques';
        
        return $rep;
    }
	
	/**
    * Charge la liste de rubprique pour la catégorie d'annonce en cours
	* 
	* Recoit l'id de la actualité en paramètre
	* Une fois ls rubrique supprimée, redirige vers la page de liste des actualités
    */
	function showRubrique(){
		global $gJConfig;
        $rep = $this->getResponse('json');
		jClasses::inc('rubrique~rubriqueSrv');
		$idCategorieAnId = $this->intParam('idCategorieAnId', 0, true);
		
		$toRubrique = rubriqueSrv::getAllRubrique($idCategorieAnId);
		if(sizeof($toRubrique)>0)
		{
			$tRubrique = array();
			foreach($toRubrique as $oRubrique)
			{
				$oRubrique->rubrique_libelle = htmlentities($oRubrique->rubrique_libelle);
				array_push($tRubrique, $oRubrique);
			}
			$result = array('toRubrique' => $tRubrique);
		}
		else
			$result = array('toRubrique' => 0);

		$rep->datas = $result;
		return $rep;	
	}
	
	
}
?>
