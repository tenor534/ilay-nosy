<?php
/**
* @package ilay-nosy
* @subpackage forum
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Contrôleur BO pour les forums
* @package ilay-nosy
* @subpackage forum
* @todo : définir les différentes actions du contrôleur
*/
require_once (LIB_PATH.'fpdf/fpdf.php');

class forumBoCtrl extends jController {

	//Toutes les actions de ce contrôleur nécessite une authentification via le plugin jAuth
	public $pluginParams = array('*'=>array('auth.required'=>true));
	
	/**
    * Affiche la liste des forums
	* Recoit en paramètre le type de l'actualité : standard ou évènement, 
    */
    function listeForums() {
		jClasses::inc('forum~forumSrv');

        $rep = $this->getResponse('htmlBo');

		//Param
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}

		$rep->menusActifs = array(HtmlBoResponse::MENU_FORUM, HtmlBoResponse::MENU_FORUM_LISTE);
		$rep->bodyTpl = 'forum~forumBo';

		//Param
		$tParams = array('page'=> $this->page);

		$rep->body->assignZone("listeForumBo", "forum~listeForumBo", $tParams);

        return $rep;
    }

	/**
    * Affichage le détail d'une actualité en mode edition 
	* Recoit l'id de l'actualité en paramètre
    */
    function editionForum() {
		//Préparation de la réponse
		global $gJConfig;

        $rep = $this->getResponse('htmlBo');
		$rep->addJSLink($gJConfig->urlengine['basePath'] . 'design/back/js/forums.js');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/back/css/nosyEdit.css');
		
		//Chargement du menu 
		$rep->menusActifs = array(HtmlBoResponse::MENU_FORUM, HtmlBoResponse::MENU_FORUM_LISTE);
		
		//Template à utiliser
		$rep->bodyTpl = 'forum~forumBo';

		//Récupération des paramètres
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}		
		if ($this->intParam('forum_id')) {
			$this->forum_id = $this->intParam('forum_id');
		}else{
			$this->forum_id = 0;
		}
		if ($this->param('errorMessage')) {
			$this->errorMessage = $this->param('errorMessage');
		}else{
			$this->errorMessage = '';
		}

		//$tParams = array('zone'=> $this->getParam('zone','forum~listeForumBo.zone'));

		//Chargement des données
		jClasses::inc('forum~forumSrv');
		
		if ($this->forum_id != 0) {
			try {
				$forum = forumSrv::chargeForum($this->forum_id);
				
			} catch(Exception $oJException) {
				throw new JException ($oJException->getLocaleKey()) ;
			}				
		}else{
			$forum = forumSrv::getDaoForum();
			$forum->forum_statut = USER_STATUT_ON;			
		}

		$tParams = array('forum_id'=> $this->forum_id,'errorMessage'=>$this->errorMessage, 'page'=> $this->page);

		//categorieFor
		jClasses::inc('categorieFor~categorieForSrv');
		$listeCategorieFor = categorieForSrv::chargeAllcategorieFor();
		//Forum parent
		jClasses::inc('forum~forumSrv');
		//$listeForum = forumSrv::chargeAllForum();
		$listeForum = forumSrv::chargeAllForumWithout($forum->forum_id);
							
		$rep->body->assign('tParams', $tParams);
		$rep->body->assign("listeCategorieFor", $listeCategorieFor);		
		$rep->body->assign("listeForum", $listeForum);		
		$rep->body->assign('forum', $forum);													
		$rep->body->assign("forum_id", $this->forum_id);		
		$rep->body->assign("page", $this->page);		

        return $rep;
    }
	
	
	/**
    * Enregistrement des données d'une actualité
	* 
	* Utilisé en création et modification seulement 
	* Recoit en paramètre l'ensemble des données du formulaire d'édition d'une actualité
	* Une fois ls forum sauvegardée, redirige vers la page de liste des actualités
    */
    function sauvegardeForum() {
		//Préparation de la réponse
		global $gJConfig;

		//Récupération des paramètres
		$forum = jMagicLoader::arrayToObject($this->request->params, 'forum');

		//Récupération des paramètres
		if ($this->request->params['page']) {
			$this->page = $this->request->params['page'];			
		}else{
			$this->page = 1;
		}	

		//Classes
		jClasses::inc('commun~tools');	
		jClasses::inc('forumSrv');

		//Save
		if(!$forum->id){			
			$forum->level 	= 0;
			$forum->path 	= "";
		}	


		//Calcul du sortCode
		if(!$forum->id){ //Création d'une nouvelle forum	
		
			//on charge le père
			$parent = forumSrv::getForum($forum->parentId);	
		
			//On charge le + grand des frères
			$frere = forumSrv::getForumFrere($parent->forum_id);	
		
			if(!sizeof($frere)){ //Il n'a pas de frère
				//echo "Il n'a pas de frere";
				if($parent->forum_level==0){
					$sortCode = "001";
				}else{
					$sortCode = $parent->forum_sortCode . ":001";
				}
				echo "sortCode : $sortCode <br><br>";
		
			}else{ //il a au moins 1 frère, on créé l'entrée comme étant la dernière de sa famille
				$rootSortCode = $parent->forum_sortCode;
				if($rootSortCode!=""){
					$rootSortCode.=":";
				}
				$frereSortCode = substr($frere[0]->forum_sortCode, strlen($frere[0]->forum_sortCode) - 3, 3);
				$sortCode = intval($frereSortCode) + 1;
				$sortCode = str_pad($sortCode, 3, "0", STR_PAD_LEFT);
				$sortCode = $rootSortCode.$sortCode;
				echo "sortCode : $sortCode <br><br>";
			}	
			$forum->sortCode = $sortCode;
		
			//Maj du path
			/*$originalForum = $forum;
			$forum->forum_siteId=$siteId;
			$forum->forum_path = $parent->forum_path.$forumId."/";
			$forum->update($originalForum);*/
			
		}else{ // Edition d'une page donnée
		
			 $originalForum = forumSrv::getForum($forum->id);
			
			//Le parent n'a pas été mis à jour
			if($forum->parentId == $originalForum->forum_parentId || $forum->parentId==0){
				//rien
			}else{
				//Le parent a été mis à jour il faut mettre à jour le level,le sortcode,l'alias et le path de toutes les pages impactées
				
				//On détermine les nouveaux sortCode et level pour la page modifiée
				$newParent = forumSrv::getForum($forum->parentId);			
		
				//On charge le + grand des frères
				$frere = forumSrv::getForumFrere($newParent->forum_id);	
		
				if(!sizeof($frere)){ //Il n'a pas de frère
				//	echo "Il n'a pas de frere";
					$sortCode = $newParent->forum_sortCode . ":001";
					echo "sortCode : $sortCode <br><br>";
		
				}else{ //il a au moins 1 frère, on créé l'entrée comme étant la dernière de sa famille
					$rootSortCode = $newParent->forum_sortCode;
					if($rootSortCode!=""){
						$rootSortCode.=":";
					}
					$frereSortCode = substr($frere[0]->forum_sortCode, strlen($frere[0]->forum_sortCode) - 3, 3);
					$sortCode = intval($frereSortCode) + 1;
					$sortCode = str_pad($sortCode, 3, "0", STR_PAD_LEFT);
					$sortCode = $rootSortCode.$sortCode;
					echo "sortCode : $sortCode <br><br>";
				}
				
				// On met à jour la page modifiée
				$forum->sortCode = $sortCode;
				//$forum->forum_path = $newParent->forum_path.$forum->forum_id."/";
				
				$orginalSortCodeLength 	= strlen($originalForum->forum_sortCode);
				$orginalSortCodeRoot 	= substr($originalForum->forum_sortCode, 0, strlen($originalForum->forum_sortCode) - 3);
				$orginalSortCodeEnd 	= intval(substr($originalForum->forum_sortCode, strlen($originalForum->forum_sortCode) - 3,3));
		
				//echo($originalForum->forum_alias);
		
				//On met à jour tous les enfants de la page modifiée
				forumSrv::updateAllForumChildren($forum, $newParent, $originalForum, $orginalSortCodeLength );
		
							
				//On met à jour tous les pages et leurs enfants dont l'ordre a été MAJ du fait du déplacement de la page modifiée.
				forumSrv::updateAllForumAffected($orginalSortCodeRoot, $orginalSortCodeLength, $orginalSortCodeEnd );
			}
		}	

		$id = forumSrv::sauvegardeForum($forum);

		//Charge le parent pour le path et le level
		$forum = forumSrv::getForum($id);
		
		$forum->id = $forum->forum_id;
		
		if($forum->forum_parentId){
			$forumParent = forumSrv::getForum($forum->forum_parentId);

			$forum->level 	= $forumParent->forum_level + 1;
			$forum->path 	= $forumParent->forum_path . $forum->forum_id."/";
		}else{
			$forum->level 	= 1;
			
			$forum->path 	= "/".$forum->forum_id."/";
		}			
		forumSrv::sauvegardeForum($forum);

		//Paramètres
		$tParams = array('page'=> $this->page);

		//Redirection		
		$rep = $this->getResponse('redirect');
		$rep->action  = 'forum~forumBo_listeForums';
		$rep->params = $tParams;
		
        return $rep;        
    }

	/**
    * Suppression d'une actualité donnée
	* 
	* Recoit l'id de la actualité en paramètre
	* Une fois ls forum supprimée, redirige vers la page de liste des actualités
    */
    function supprimeForum() {

		//Récupération des paramètres
		$forumId = $this->intParam('forum_id',0, FALSE);
		if ($forumId == 0) {
			throw new Exception('Invalid parameter forum_id');
		}

		//Suppression
		jClasses::inc('forumSrv');
		forumSrv::supprimeForum($forumId);		

		//forumSrv::updateSortCodeOnSuppression();		
		
		
		//Redirection
		$rep = $this->getResponse('redirect');
		$rep->action  = 'forum~forumBo_listeForums';
        
        return $rep;
    }
	
	/**
    * Charge la liste de rubprique pour la catégorie d'annonce en cours
	* 
	* Recoit l'id de la actualité en paramètre
	* Une fois ls forum supprimée, redirige vers la page de liste des actualités
    */
	function showForum(){
		global $gJConfig;
        $rep = $this->getResponse('json');
		jClasses::inc('forum~forumSrv');
		$idCategorieForId = $this->intParam('idCategorieForId', 0, true);
		
		$toForum = forumSrv::getAllForum($idCategorieForId);
		if(sizeof($toForum)>0)
		{
			$tForum = array();
			foreach($toForum as $oForum)
			{
				$oForum->forum_libelle = htmlentities($oForum->forum_libelle);
				array_push($tForum, $oForum);
			}
			$result = array('toForum' => $tForum);
		}
		else
			$result = array('toForum' => 0);

		$rep->datas = $result;
		return $rep;	
	}
	
	
}
?>
