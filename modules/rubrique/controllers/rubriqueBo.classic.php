<?php
/**
* @package ilay-nosy
* @subpackage rubrique
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Contr�leur BO pour les rubriques
* @package ilay-nosy
* @subpackage rubrique
* @todo : d�finir les diff�rentes actions du contr�leur
*/
require_once (LIB_PATH.'fpdf/fpdf.php');

class rubriqueBoCtrl extends jController {

	//Toutes les actions de ce contr�leur n�cessite une authentification via le plugin jAuth
	public $pluginParams = array('*'=>array('auth.required'=>true));
	
	/**
    * Affiche la liste des rubriques
	* Recoit en param�tre le type de l'actualit� : standard ou �v�nement, 
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
    * Affichage le d�tail d'une actualit� en mode edition 
	* Recoit l'id de l'actualit� en param�tre
    */
    function editionRubrique() {
		//Pr�paration de la r�ponse
		global $gJConfig;

        $rep = $this->getResponse('htmlBo');
		$rep->addJSLink($gJConfig->urlengine['basePath'] . 'design/back/js/rubriques.js');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/back/css/nosyEdit.css');
		
		//Chargement du menu 
		$rep->menusActifs = array(HtmlBoResponse::MENU_ANNONCE, HtmlBoResponse::MENU_ANNONCE_RUBRIQUE);
		
		//Template � utiliser
		$rep->bodyTpl = 'rubrique~rubriqueBo';

		//R�cup�ration des param�tres
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

		//Chargement des donn�es
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
    * Enregistrement des donn�es d'une actualit�
	* 
	* Utilis� en cr�ation et modification seulement 
	* Recoit en param�tre l'ensemble des donn�es du formulaire d'�dition d'une actualit�
	* Une fois ls rubrique sauvegard�e, redirige vers la page de liste des actualit�s
    */
    function sauvegardeRubrique() {
		//Pr�paration de la r�ponse
		global $gJConfig;

		//R�cup�ration des param�tres
		$rubrique = jMagicLoader::arrayToObject($this->request->params, 'rubrique');

		//R�cup�ration des param�tres
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
		if(!$rubrique->id){ //Cr�ation d'une nouvelle rubrique	
		
			//on charge le p�re
			$parent = rubriqueSrv::getRubrique($rubrique->parentId);	
		
			//On charge le + grand des fr�res
			$frere = rubriqueSrv::getRubriqueFrere($parent->rubrique_id);	
		
			if(!sizeof($frere)){ //Il n'a pas de fr�re
				//echo "Il n'a pas de frere";
				if($parent->rubrique_level==0){
					$sortCode = "001";
				}else{
					$sortCode = $parent->rubrique_sortCode . ":001";
				}
				echo "sortCode : $sortCode <br><br>";
		
			}else{ //il a au moins 1 fr�re, on cr�� l'entr�e comme �tant la derni�re de sa famille
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
			
		}else{ // Edition d'une page donn�e
		
			 $originalRubrique = rubriqueSrv::getRubrique($rubrique->id);
			
			//Le parent n'a pas �t� mis � jour
			if($rubrique->parentId == $originalRubrique->rubrique_parentId || $rubrique->parentId==0){
				//rien
			}else{
				//Le parent a �t� mis � jour il faut mettre � jour le level,le sortcode,l'alias et le path de toutes les pages impact�es
				
				//On d�termine les nouveaux sortCode et level pour la page modifi�e
				$newParent = rubriqueSrv::getRubrique($rubrique->parentId);			
		
				//On charge le + grand des fr�res
				$frere = rubriqueSrv::getRubriqueFrere($newParent->rubrique_id);	
		
				if(!sizeof($frere)){ //Il n'a pas de fr�re
				//	echo "Il n'a pas de frere";
					$sortCode = $newParent->rubrique_sortCode . ":001";
					echo "sortCode : $sortCode <br><br>";
		
				}else{ //il a au moins 1 fr�re, on cr�� l'entr�e comme �tant la derni�re de sa famille
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
				
				// On met � jour la page modifi�e
				$rubrique->sortCode = $sortCode;
				//$rubrique->rubrique_path = $newParent->rubrique_path.$rubrique->rubrique_id."/";
				
				$orginalSortCodeLength 	= strlen($originalRubrique->rubrique_sortCode);
				$orginalSortCodeRoot 	= substr($originalRubrique->rubrique_sortCode, 0, strlen($originalRubrique->rubrique_sortCode) - 3);
				$orginalSortCodeEnd 	= intval(substr($originalRubrique->rubrique_sortCode, strlen($originalRubrique->rubrique_sortCode) - 3,3));
		
				//echo($originalRubrique->rubrique_alias);
		
				//On met � jour tous les enfants de la page modifi�e
				rubriqueSrv::updateAllRubriqueChildren($rubrique, $newParent, $originalRubrique, $orginalSortCodeLength );
		
							
				//On met � jour tous les pages et leurs enfants dont l'ordre a �t� MAJ du fait du d�placement de la page modifi�e.
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

		//Param�tres
		$tParams = array('page'=> $this->page);

		//Redirection		
		$rep = $this->getResponse('redirect');
		$rep->action  = 'rubrique~rubriqueBo_listeRubriques';
		$rep->params = $tParams;
		
        return $rep;        
    }

	/**
    * Suppression d'une actualit� donn�e
	* 
	* Recoit l'id de la actualit� en param�tre
	* Une fois ls rubrique supprim�e, redirige vers la page de liste des actualit�s
    */
    function supprimeRubrique() {

		//R�cup�ration des param�tres
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
    * Charge la liste de rubprique pour la cat�gorie d'annonce en cours
	* 
	* Recoit l'id de la actualit� en param�tre
	* Une fois ls rubrique supprim�e, redirige vers la page de liste des actualit�s
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
