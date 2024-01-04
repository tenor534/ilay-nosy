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
class contentPageMainVehiculeEditFoZone extends jZone {
 
	/**
	* Nom du template HTML
	*/
    protected $_tplname='vehicule~contentPageMainVehiculeEditFo.zone';

	protected $_useCache = false;

	/**
	* Annonce a afficher
	*/
	public $anid = 0;

	/**
	* Chargement des données pour affichage
	*/
	protected function _prepareTpl(){

		//Session utilisateur
		$idUtilisateurId = $_SESSION['SESSION_MEMBRE_ID'];

		//Récupération des paramètres
		if ($this->getParam('anid')) {
			$this->anid = $this->getParam('anid');
		}	

		//Chargement des données
		jClasses::inc('vehicule~vehiculeSrv');
		jClasses::inc('marque~marqueSrv');
		jClasses::inc('modele~modeleSrv');
		
		if ($this->anid != 0) {
			try {
				$vehicule = vehiculeSrv::chargeVehicule($this->anid);
				
			} catch(Exception $oJException) {
				//throw new JException ($oJException->getLocaleKey()) ;
			}				
		}else{
			$vehicule = vehiculeSrv::getDaoVehicule();

			$vehicule->vehicule_id 			= 0;			
			$vehicule->vehicule_annonceId 	= 0;
		}

		$vehicule->vehicule_tailleMoteur = ($vehicule->vehicule_tailleMoteur)?floatval($vehicule->vehicule_tailleMoteur) : "";
		$vehicule->vehicule_kilometrage  = ($vehicule->vehicule_kilometrage)?floatval($vehicule->vehicule_kilometrage) : "";
		
		//Marques
		$toMarques 		= marqueSrv::chargeAllMarque();		
		
		//Modele
		$toModeles = array();
		if($vehicule->vehicule_marqueId){		
			$toModeles = modeleSrv::getAllModele($vehicule->vehicule_marqueId);		
		}	

		
		$tParams = array('anid'=> $this->anid);

		$this->_tpl->assign('tParams', $tParams);													
		$this->_tpl->assign('vehicule', $vehicule);													
		$this->_tpl->assign('toMarques', $toMarques);													
		$this->_tpl->assign('toModeles', $toModeles);													
	}
}
?>