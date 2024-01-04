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
class contentPageMainVehiculeViewFoZone extends jZone {
 
	/**
	* Nom du template HTML
	*/
    protected $_tplname='vehicule~contentPageMainVehiculeViewFo.zone';

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
		if(isset($_SESSION['SESSION_MEMBRE_ID'])){
			$idUtilisateurId = $_SESSION['SESSION_MEMBRE_ID'];
		}	

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

		$vehicule->vehicule_tailleMoteur 	= ($vehicule->vehicule_tailleMoteur)?floatval($vehicule->vehicule_tailleMoteur) : "S/O";
		$vehicule->vehicule_kilometrage  	= ($vehicule->vehicule_kilometrage)?floatval($vehicule->vehicule_kilometrage) : "S/O";
		
		$vehicule->vehicule_origine  		= strlen($vehicule->vehicule_origine)?($vehicule->vehicule_origine) : "N/D";
		$vehicule->vehicule_version  		= strlen($vehicule->vehicule_version)?($vehicule->vehicule_version) : "N/D";


		$vehicule->vehicule_nbCylindre 		= strlen($vehicule->vehicule_nbCylindre)?($vehicule->vehicule_nbCylindre) : "S/O";
		$vehicule->vehicule_nbPorte 		= strlen($vehicule->vehicule_nbPorte)?($vehicule->vehicule_nbPorte) : "S/O";
		$vehicule->vehicule_nbPassager 		= strlen($vehicule->vehicule_nbPassager)?($vehicule->vehicule_nbPassager) : "S/O";
		$vehicule->vehicule_kilometrage 	= strlen($vehicule->vehicule_kilometrage)?($vehicule->vehicule_kilometrage) : "0";


		//Spécificité du véhicule		
		if($vehicule->vehicule_marqueId){
			$toMarque 					 		= marqueSrv::chargeMarque($vehicule->vehicule_marqueId);
			$vehicule->vehicule_marque  		= $toMarque->marque_libelle;
		}else{
			$vehicule->vehicule_marque  		= "N/D";
		}			
		if($vehicule->vehicule_modeleId){
			$toModele 					 		= modeleSrv::chargeModele($vehicule->vehicule_modeleId);
			$vehicule->vehicule_modele  		= $toModele->modele_libelle;
		}else{
			$vehicule->vehicule_modele  		= "N/D";
		}

		switch($vehicule->vehicule_type){				
			case "1" :
				$vehicule->vehicule_type = "Berline : citadine";
				break;
			case "2" :
				$vehicule->vehicule_type = "Berline : moyenne";
				break;
			case "3" :
				$vehicule->vehicule_type = "Berline : grande";
				break;
			case "4" :
				$vehicule->vehicule_type = "Break";
				break;
			case "5" :
				$vehicule->vehicule_type = "Monospace";
				break;
			case "6" :
				$vehicule->vehicule_type = "Coup&eacute; &amp; Cabriolet";
				break;
			case "7" :
				$vehicule->vehicule_type = "SUV, 4x4 &amp; Crossovers";
				break;
			case "8" :
				$vehicule->vehicule_type = "Voiture sans permis";
				break;
			case "9" :
				$vehicule->vehicule_type = "V&eacute;hicule ancien";
				break;
			case "10" :
				$vehicule->vehicule_type = "V&eacute;hicule utilitaire";
				break;
			case "11" :
				$vehicule->vehicule_type = "V&eacute;hicule poid lourd";
				break;
			default:
				$vehicule->vehicule_type = "S/O";
				break;				
		}							
		
		switch($vehicule->vehicule_transmission){
			case "1" :
				$vehicule->vehicule_transmission = "Automatique";
				break;
			case "2" :
				$vehicule->vehicule_transmission = "M&eacute;canique";
				break;
			case "3" :
				$vehicule->vehicule_transmission = "Semi-automatique";
				break;
			default:
				$vehicule->vehicule_transmission = "S/O";
				break;				
		}							
		switch($vehicule->vehicule_motricite){
			case "1" :
				$vehicule->vehicule_motricite = "Roues motrices avant";
				break;
			case "2" :
				$vehicule->vehicule_motricite = "Roues motrices arri&egrave;re";
				break;
			case "3" :
				$vehicule->vehicule_motricite = "4 roues motrices";
				break;
			default:
				$vehicule->vehicule_motricite = "S/O";
				break;				
		}							
		switch($vehicule->vehicule_carburant){
			case "1" :
				$vehicule->vehicule_carburant = "Essence";
				break;
			case "2" :
				$vehicule->vehicule_carburant = "Diesel";
				break;
			case "3" :
				$vehicule->vehicule_carburant = "Bicarburation essence / gpl";
				break;
			case "4" :
				$vehicule->vehicule_carburant = "Hybrides / Electrique";
				break;
			case "5" :
				$vehicule->vehicule_carburant = "Autres énergies alternatives";
				break;
			default:
				$vehicule->vehicule_carburant = "S/O";
				break;				
		}							
		switch($vehicule->vehicule_airClimatise){
			case "1" :
				$vehicule->vehicule_airClimatise = "OUI";
				break;
			case "2" :
				$vehicule->vehicule_airClimatise = "NON";
				break;
			default:
				$vehicule->vehicule_airClimatise = "S/O";
				break;				
		}							
		
		switch($vehicule->vehicule_premiereMain){
			case "1" :
				$vehicule->vehicule_premiereMain = "OUI";
				break;
			case "2" :
				$vehicule->vehicule_premiereMain = "NON";
				break;
			default:
				$vehicule->vehicule_premiereMain = "";
				break;				
		}							

		$tParams = array('anid'=> $this->anid);

		$this->_tpl->assign('tParams', $tParams);													
		$this->_tpl->assign('vehicule', $vehicule);													
	}
}
?>