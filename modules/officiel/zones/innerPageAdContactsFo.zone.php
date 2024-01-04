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
* Zone affichant les officiels en cours dans l'espace membre pour un utilisateur connecté FO
*
* @package ilay-nosy
* @subpackage membre
*/	  
class innerPageAdContactsFoZone extends jZone {
	  
 
	/**
	* Nom du template HTML
	*/
    protected $_tplname='officiel~innerPageAdContactsFo.zone';

	protected $_useCache = false;

	/**
	* Officiel
	*/
	public $acid = 0;

	/**
	* Is_user_connected
	*/
	public $is_user_connected = 0;

	/**
	* Is_abonnement_valid
	*/
	public $is_abonnement_valid = 0;
	
	/**
	* Is_officielur_abonne
	*/
	public $is_officielur_abonne = 0;

	/**
	* Chargement des données pour affichage
	* Pour voir les ccordonnées des officielurs, il faut etre connecté et etre a la fois abonnées d'un forfait visiteur mini.
	*/
	protected function _prepareTpl(){

		//Chargement des données
		jClasses::inc('abonnement~abonnementSrv');
		jClasses::inc('officiel~officielSrv');
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
		
		//Récupération des paramètres de l'officiel
		if ($this->getParam('acid')) {
			$this->acid = $this->getParam('acid');			
		}		

		if ($this->acid != 0) {
			try {
				$officiel = officielSrv::chargeOfficiel($this->acid);
				
			} catch(Exception $oJException) {
				throw new JException ($oJException->getLocaleKey()) ;
			}				
		}else{
			$officiel = officielSrv::getDaoOfficiel();

			$officiel->officiel_id 			= 0;			
			$officiel->officiel_rubriqueId 	= 0;			

			$officiel->officiel_statut = USER_STATUT_ON;			
		}

		//////////////////////////////////////////////////////////////////////////////////////
		$this->laid = $officiel->officiel_localiteId;
		//////////////////////////////////////////////////////////////////////////////////////
		if($this->laid){
			$localite 	= officielSrv::getLocalite($this->laid);
			$this->paid = $localite->localite_provinceId;
		}	
		if($this->paid){
			$province 	= officielSrv::getProvince($this->paid);
		}	

		//Abonnemnet de l'officiel en cours
		$toAbonnement 	= abonnementSrv::chargeAbonnement($officiel->officiel_abonnementId);
		
		if($toAbonnement->abonnement_statut == ABONNEMENT_STATUT_ON){
			$this->is_officielur_abonne = 1;
		}	


		$tParams = array('acid'=> $this->acid);

		//Affichage
		$this->_tpl->assign('tParams', $tParams);		
		$this->_tpl->assign('officiel', $officiel);										

		$this->_tpl->assign('province', $province);													
		$this->_tpl->assign('localite', $localite);													

		$this->_tpl->assign("acid", $this->acid);		

		$this->_tpl->assign("is_user_connected", $this->is_user_connected);		
		$this->_tpl->assign("is_abonnement_valid", $this->is_abonnement_valid);		
		$this->_tpl->assign("is_officielur_abonne", $this->is_officielur_abonne);		
	}
}
?>