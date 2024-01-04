<?php
/**
* @package ilay-nosy
* @subpackage membre
* @version  1
* @author DWORD Consulting SARL
*/

/**
* JSON
*/
//require_once (LIB_PATH.'json/JSON.php');


/**
* Zone affichant les forums en cours dans l'espace membre pour un utilisateur connecté FO
*
* @package ilay-nosy
* @subpackage membre
*/
class contentPageMainForumCategorieListFoZone extends jZone {
 
	/**
	* Nom du template HTML
	*/
    protected $_tplname='forum~contentPageMainForumCategorieListFo.zone';

	protected $_useCache = false;

	/**
	* Chargement des données pour affichage
	*/
	protected function _prepareTpl(){

		//Session utilisateur
		//$idUtilisateurId = $_SESSION['SESSION_MEMBRE_ID'];
		if (isset($_SESSION['SESSION_MEMBRE_ID'])) {
			$idUtilisateurId = $_SESSION['SESSION_MEMBRE_ID'];
		}else{
			$idUtilisateurId = 0;
		}

		//Récupération des paramètres
		$tParams = array('zone'=> $this->getParam('zone','forum~contentPageMainForumListFo'));
	
		//Chargement des données
		jClasses::inc('categorieFor~categorieForSrv');
		jClasses::inc('forum~forumSrv');		
		jClasses::inc('sujet~sujetSrv');
		jClasses::inc('commentFor~commentForSrv');
		jClasses::inc('commun~tools');
		
		//Catégories
		$toCategorieFors = array();
		$toResults = categorieForSrv::chargeAllCategorieFor();
		foreach ($toResults as $oCategorieFors){		
			$oCategorieFors->categorieFor_libelle = strtoupper($oCategorieFors->categorieFor_libelle);		
			array_push( $toCategorieFors, $oCategorieFors );
		}
		
		//Forums
		$toForums  = array(); 
		$toResults = forumSrv::chargeAllForum();
		

		foreach ($toResults as $oForums){
			
			//Nombre de sujets
			$toSujets = sujetSrv::getAllSujet($oForums->forum_id);
			$oForums->forum_nbSujet = sizeof($toSujets);
			
			//Nombre de réponse
			$toCommentFors = commentForSrv::getAllCommentForByForum($oForums->forum_id, "DESC");			
			$oForums->forum_nbReponse = sizeof($toCommentFors);
			
			//Last Comment
			if(sizeof($toCommentFors)){			
				$oForums->forum_commentlastId = $toCommentFors[0]->commentFor_sujetId;
				$oForums->forum_commentlastDate = $toCommentFors[0]->commentFor_dateCreation;
				$loginBit = split("@", $toCommentFors[0]->utilisateur_email);

				$oForums->forum_commentlastUser = $loginBit[0];
			}else{
				$oForums->forum_commentlastId 	= 0;
				$oForums->forum_commentlastDate = "";
				$oForums->forum_commentlastUser = "";
			}	
			
			array_push( $toForums, $oForums );
			
		}		
		
		$this->_tpl->assign('toForums', $toForums);
		$this->_tpl->assign('toCategorieFors', $toCategorieFors);
	}
}
?>