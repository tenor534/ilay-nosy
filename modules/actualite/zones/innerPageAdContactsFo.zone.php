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
* Zone affichant les actualites en cours dans l'espace membre pour un utilisateur connecté FO
*
* @package ilay-nosy
* @subpackage membre
*/	  
class innerPageAdContactsFoZone extends jZone {
	  
 
	/**
	* Nom du template HTML
	*/
    protected $_tplname='actualite~innerPageAdContactsFo.zone';

	protected $_useCache = false;

	/**
	* Actualite
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
	* Is_actualiteur_abonne
	*/
	public $is_actualiteur_abonne = 0;

	/**
	* Chargement des données pour affichage
	* Pour voir les ccordonnées des actualiteurs, il faut etre connecté et etre a la fois abonnées d'un forfait visiteur mini.
	*/
	protected function _prepareTpl(){

		//Chargement des données
		jClasses::inc('abonnement~abonnementSrv');
		jClasses::inc('actualite~actualiteSrv');
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
		
		//Récupération des paramètres de l'actualite
		if ($this->getParam('acid')) {
			$this->acid = $this->getParam('acid');			
		}		

		if ($this->acid != 0) {
			try {
				$actualite = actualiteSrv::chargeActualite($this->acid);
				
			} catch(Exception $oJException) {
				throw new JException ($oJException->getLocaleKey()) ;
			}				
		}else{
			$actualite = actualiteSrv::getDaoActualite();

			$actualite->actualite_id 			= 0;			
			$actualite->actualite_rubriqueId 	= 0;			

			$actualite->actualite_statut = USER_STATUT_ON;			
		}

		//////////////////////////////////////////////////////////////////////////////////////
		$this->laid = $actualite->actualite_localiteId;
		//////////////////////////////////////////////////////////////////////////////////////
		if($this->laid){
			$localite 	= actualiteSrv::getLocalite($this->laid);
			$this->paid = $localite->localite_provinceId;
		}	
		if($this->paid){
			$province 	= actualiteSrv::getProvince($this->paid);
		}	

		//Abonnemnet de l'actualite en cours
		$toAbonnement 	= abonnementSrv::chargeAbonnement($actualite->actualite_abonnementId);
		
		if($toAbonnement->abonnement_statut == ABONNEMENT_STATUT_ON){
			$this->is_actualiteur_abonne = 1;
		}	


		$tParams = array('acid'=> $this->acid);

		//Affichage
		$this->_tpl->assign('tParams', $tParams);		
		$this->_tpl->assign('actualite', $actualite);										

		$this->_tpl->assign('province', $province);													
		$this->_tpl->assign('localite', $localite);													

		$this->_tpl->assign("acid", $this->acid);		

		$this->_tpl->assign("is_user_connected", $this->is_user_connected);		
		$this->_tpl->assign("is_abonnement_valid", $this->is_abonnement_valid);		
		$this->_tpl->assign("is_actualiteur_abonne", $this->is_actualiteur_abonne);		
	}
}
?>