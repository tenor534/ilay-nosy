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
* Zone affichant les annonces en cours dans l'espace membre pour un utilisateur connecté FO
*
* @package ilay-nosy
* @subpackage membre
*/	  
class innerPageAdContactsFoZone extends jZone {
	  
 
	/**
	* Nom du template HTML
	*/
    protected $_tplname='annonce~innerPageAdContactsFo.zone';

	protected $_useCache = false;

	/**
	* Annonce
	*/
	public $anid = 0;

	/**
	* Is_user_connected
	*/
	public $is_user_connected = 0;

	/**
	* Is_abonnement_valid
	*/
	public $is_abonnement_valid = 0;
	
	/**
	* Is_annonceur_abonne
	*/
	public $is_annonceur_abonne = 0;

	/**
	* Chargement des données pour affichage
	* Pour voir les ccordonnées des annonceurs, il faut etre connecté et etre a la fois abonnées d'un forfait visiteur mini.
	*/
	protected function _prepareTpl(){

		//Chargement des données
		jClasses::inc('abonnement~abonnementSrv');
		jClasses::inc('annonce~annonceSrv');
		jClasses::inc('commun~tools');

		//Session utilisateur
		//Session utilisateur
		//$idUtilisateurId = $_SESSION['SESSION_MEMBRE_ID'];
		if (isset($_SESSION['SESSION_MEMBRE_ID'])) {
			$idUtilisateurId 			= $_SESSION['SESSION_MEMBRE_ID'];
			$this->is_user_connected 	= 1;
			
			//Abonnemnet en cours
			$toAbonnementValid 	= abonnementSrv::chargeAllAbonnementValid($idUtilisateurId);
			
			if(sizeof($toAbonnementValid)){
				$this->is_abonnement_valid 	= 1;
			}			
		}else{
			$idUtilisateurId = 0;		
		}
		
		//Récupération des paramètres de l'annonce
		if ($this->getParam('anid')) {
			$this->anid = $this->getParam('anid');			
		}		

		if ($this->anid != 0) {
			try {
				$annonce = annonceSrv::chargeAnnonce($this->anid);
				
			} catch(Exception $oJException) {
				throw new JException ($oJException->getLocaleKey()) ;
			}				
		}else{
			$annonce = annonceSrv::getDaoAnnonce();

			$annonce->annonce_id 			= 0;			
			$annonce->annonce_rubriqueId 	= 0;			

			$annonce->annonce_statut = USER_STATUT_ON;			
		}

		//////////////////////////////////////////////////////////////////////////////////////
		$this->laid = $annonce->annonce_localiteId;
		//////////////////////////////////////////////////////////////////////////////////////
		if($this->laid){
			$localite 	= annonceSrv::getLocalite($this->laid);
			$this->paid = $localite->localite_provinceId;
		}	
		if($this->paid){
			$province 	= annonceSrv::getProvince($this->paid);
		}	

		//Abonnemnet de l'annonce en cours
		$toAbonnement 	= abonnementSrv::chargeAbonnement($annonce->annonce_abonnementId);
		
		if($toAbonnement->abonnement_statut == ABONNEMENT_STATUT_ON){
			$this->is_annonceur_abonne = 1;
		}	


		$tParams = array('anid'=> $this->anid);

		//Affichage
		$this->_tpl->assign('tParams', $tParams);		
		$this->_tpl->assign('annonce', $annonce);										

		$this->_tpl->assign('province', $province);													
		$this->_tpl->assign('localite', $localite);													

		$this->_tpl->assign("anid", $this->anid);		

		$this->_tpl->assign("is_user_connected", $this->is_user_connected);		
		$this->_tpl->assign("is_abonnement_valid", $this->is_abonnement_valid);		
		$this->_tpl->assign("is_annonceur_abonne", $this->is_annonceur_abonne);		
	}
}
?>