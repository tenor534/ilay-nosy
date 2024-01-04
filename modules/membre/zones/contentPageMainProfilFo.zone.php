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
* Zone affichant le formulaire de profil en mode edition dans l'espace membre pour un utilisateur connecté FO
*
* @package ilay-nosy
* @subpackage membre
*/
class contentPageMainProfilFoZone extends jZone {
 
    protected $_tplname='membre~contentPageMainProfilFo.zone';
	protected $_useCache = false;

	/**
	* Chargement des données pour affichage
	*/
	protected function _prepareTpl(){
	
		//Classes		
		jClasses::inc('utilisateur~utilisateurSrv');
		jClasses::inc('pays~paysSrv');

		//Session utilisateur
		$id = $_SESSION['SESSION_MEMBRE_ID'];
		
		//Infos utilisateur
		$toUtilisateur = utilisateurSrv::infosMembre($id);		

		$toUtilisateur->utilisateur_nom 			= stripslashes($toUtilisateur->utilisateur_nom);
		$toUtilisateur->utilisateur_prenom 			= stripslashes($toUtilisateur->utilisateur_prenom);
		$toUtilisateur->utilisateur_fonction 		= stripslashes($toUtilisateur->utilisateur_fonction);
		$toUtilisateur->utilisateur_dateNaissance 	= stripslashes($toUtilisateur->utilisateur_dateNaissance);
		
		$toUtilisateur->utilisateur_adresse 		= stripslashes($toUtilisateur->utilisateur_adresse);
		$toUtilisateur->utilisateur_cp 				= stripslashes($toUtilisateur->utilisateur_cp);
		$toUtilisateur->utilisateur_ville 			= stripslashes($toUtilisateur->utilisateur_ville);
		
		$toUtilisateur->utilisateur_societe 		= stripslashes($toUtilisateur->utilisateur_societe);
		$toUtilisateur->utilisateur_telephone 		= stripslashes($toUtilisateur->utilisateur_telephone);
		$toUtilisateur->utilisateur_email 			= stripslashes($toUtilisateur->utilisateur_email);
		$toUtilisateur->utilisateur_login 			= stripslashes($toUtilisateur->utilisateur_login);
		$toUtilisateur->utilisateur_password 		= stripslashes($toUtilisateur->utilisateur_password);
		$toUtilisateur->utilisateur_dateCreation 	= stripslashes($toUtilisateur->utilisateur_dateCreation);
		$toUtilisateur->utilisateur_dateModification= stripslashes($toUtilisateur->utilisateur_dateModification);

		$toUtilisateur->utilisateur_reponse 		= stripslashes($toUtilisateur->utilisateur_reponse);
		$toUtilisateur->utilisateur_photo 			= stripslashes($toUtilisateur->utilisateur_photo);
		$toUtilisateur->utilisateur_url 			= stripslashes($toUtilisateur->utilisateur_url);

		// liste des pays
		$toPays = paysSrv::chargeListPaysAllFo();		
		
		$this->_tpl->assign('toPays', $toPays);
		$this->_tpl->assign('toUtilisateur', $toUtilisateur);		
	}
}
?>