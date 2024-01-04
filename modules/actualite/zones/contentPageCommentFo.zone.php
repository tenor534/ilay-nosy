<?php
/**
* @package ilay-nosy
* @subpackage actualite
* @version  1
* @author DWORD Consulting SARL
*/

/**
* JSON
*/
//require_once (LIB_PATH.'json/JSON.php');

/**
* Zone affichant le bloc actualite de droite en FO, toutes actualités confondues
*
* @package ilay-nosy
* @subpackage actualite
*/
class contentPageCommentFoZone extends jZone {
 
    protected $_tplname='actualite~contentPageCommentFo.zone';
	protected $_useCache = false;

	/**
	* Tri par défaut de la liste
	*/
	public $sortField = 'commentAct_dateCreation';

	/**
	* Ordre de tri par défaut de la liste
	*/
	public $sortDirection = 'ASC';

	/**
	* Id de l'actualité en cours
	*/
	public $acid = 0;

	/**
	* Id de l'utilisateur en cours
	*/
	public $uid = 0;

	/**
	* Chargement des données pour affichage
	*/
	protected function _prepareTpl(){

		
		//Chargement des données
		jClasses::inc('utilisateur~utilisateurSrv');
		jClasses::inc('commentAct~commentActSrv');
		jClasses::inc('commun~tools');

		//Liste des actualités à la une 
		$toUtilisateur  		= array(); 
		$toCommentaires  		= array(); 
		
		//Session utilisateur
		if (isset($_SESSION['SESSION_MEMBRE_ID'])) {
			$this->uid = $_SESSION['SESSION_MEMBRE_ID'];
			
			$toUtilisateur = utilisateurSrv::chargeUtilisateur($this->uid);			
			$loginBit = split("@", $toUtilisateur->utilisateur_email);
			$toUtilisateur->utilisateur_login = $loginBit[0];
			if(!strlen($toUtilisateur->utilisateur_photo)){
				$toUtilisateur->utilisateur_photo = "noPhoto.jpg";
			}			
			//Nb Post per user
			$toUtilisateur->utilisateur_nbComment	=  commentActSrv::countCommentActPerUser($toUtilisateur->utilisateur_id);		
			
		}else{
			$this->uid = 0;		
		}

		//Récupération des paramètres de pagination
		if ($this->getParam('acid')) {
			$this->acid = $this->getParam('acid');
		}
		
		//COMMENTAIRES
		$toResults  		= commentActSrv::getAllCommentAct($this->acid);		
		
		foreach ($toResults as $oResults){
			//Commentaire
			$oResults->commentAct_texte 		= nl2br(stripslashes($oResults->commentAct_texte));			
			
			//Utilisateur
			$toUserTmp = utilisateurSrv::chargeUtilisateur($oResults->commentAct_utilisateurId);			
			//Manage login
			$loginBit = split("@", $toUserTmp->utilisateur_email);
			
			$oResults->commentAct_userNom 			= $toUserTmp->utilisateur_nom;
			$oResults->commentAct_userPrenom 		= $toUserTmp->utilisateur_prenom;
			$oResults->commentAct_userLogin 		= $loginBit[0];
			$oResults->commentAct_userPhoto 		= $toUserTmp->utilisateur_photo;
			$oResults->commentAct_userDateCreation 	= $toUserTmp->utilisateur_dateCreation;
			
			//Nb Post per user
			$oResults->commentAct_userNbPost 		=  commentActSrv::countCommentActPerUser($oResults->commentAct_utilisateurId);		

			//la première photo
			if(sizeof($toUserTmp->utilisateur_photo)){
				$oResults->commentAct_userPhoto = $toUserTmp->utilisateur_photo;
			}else{
				$oResults->commentAct_userPhoto = "noPhoto.jpg";
			}			

			array_push( $toCommentaires, $oResults);
		}
		
		$this->_tpl->assign('acid', $this->acid);
		$this->_tpl->assign('toUtilisateur', $toUtilisateur);
		$this->_tpl->assign('toCommentaires', $toCommentaires);
	}
}
?>