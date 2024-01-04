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
class contentPageMainImmobilierViewFoZone extends jZone {
 
	/**
	* Nom du template HTML
	*/
    protected $_tplname='immobilier~contentPageMainImmobilierViewFo.zone';

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
		jClasses::inc('immobilier~immobilierSrv');
		
		if ($this->anid != 0) {
			try {
				$immobilier = immobilierSrv::chargeImmobilier($this->anid);
				
			} catch(Exception $oJException) {
				//throw new JException ($oJException->getLocaleKey()) ;
			}				
		}else{
			$immobilier = immobilierSrv::getDaoImmobilier();

			$immobilier->immobilier_id 			= 0;			
			$immobilier->immobilier_annonceId 	= 0;

			//Options supplémentaires		
			$immobilier->immobilier_foyer 			= "S/O";
			$immobilier->immobilier_piscine 		= "S/O";
			$immobilier->immobilier_bergeRive 		= "S/O";
			$immobilier->immobilier_panorama 		= "S/O";
			$immobilier->immobilier_garage 			= "S/O";
			$immobilier->immobilier_ascenceur 		= "S/O";
			$immobilier->immobilier_climatisation 	= "S/O";
			$immobilier->immobilier_thermopompe 	= "S/O";
			$immobilier->immobilier_sousSolAmenage 	= "S/O";
		}

		
		
		$immobilier->immobilier_foyer 			= ( $immobilier->immobilier_foyer == 1 )? "OUI" : "NON";
		$immobilier->immobilier_piscine 		= ( $immobilier->immobilier_piscine == 1 )? "OUI" : "NON";
		$immobilier->immobilier_bergeRive 		= ( $immobilier->immobilier_bergeRive == 1 )? "OUI" : "NON";
		$immobilier->immobilier_panorama 		= ( $immobilier->immobilier_panorama == 1 )? "OUI" : "NON";
		$immobilier->immobilier_garage 			= ( $immobilier->immobilier_garage == 1 )? "OUI" : "NON";
		$immobilier->immobilier_ascenceur 		= ( $immobilier->immobilier_ascenceur == 1 )? "OUI" : "NON";
		$immobilier->immobilier_climatisation 	= ( $immobilier->immobilier_climatisation == 1 )? "OUI" : "NON";
		$immobilier->immobilier_thermopompe 	= ( $immobilier->immobilier_thermopompe == 1 )? "OUI" : "NON";
		$immobilier->immobilier_sousSolAmenage 	= ( $immobilier->immobilier_sousSolAmenage == 1 )? "OUI" : "NON";


		$immobilier->immobilier_salleFamilliale 		= nl2br($immobilier->immobilier_salleFamilliale);
		$immobilier->immobilier_cuisine 				= nl2br($immobilier->immobilier_cuisine);
		$immobilier->immobilier_salleManger 			= nl2br($immobilier->immobilier_salleManger);
		$immobilier->immobilier_salleEau 				= nl2br($immobilier->immobilier_salleEau);
		$immobilier->immobilier_salon 					= nl2br($immobilier->immobilier_salon);
		$immobilier->immobilier_chambrePrincipale 		= nl2br($immobilier->immobilier_chambrePrincipale);
		$immobilier->immobilier_salleBain 				= nl2br($immobilier->immobilier_salleBain);
	

		//$immobilier->immobilier_kilometrage 	= strlen($immobilier->immobilier_kilometrage)?($immobilier->immobilier_kilometrage) : "0";


		//Spécificité du véhicule		
		/*
		if($immobilier->immobilier_marqueId){
			$toMarque 					 		= marqueSrv::chargeMarque($immobilier->immobilier_marqueId);
			$immobilier->immobilier_marque  		= $toMarque->marque_libelle;
		}else{
			$immobilier->immobilier_marque  		= "N/D";
		}*/			

		/*
		switch($immobilier->immobilier_type){				
			case "1" :
				$immobilier->immobilier_type = "Berline : citadine";
				break;
			default:
				$immobilier->immobilier_type = "S/O";
				break;				
		}
		*/							

		$tParams = array('anid'=> $this->anid);

		$this->_tpl->assign('tParams', $tParams);													
		$this->_tpl->assign('immobilier', $immobilier);													
	}
}
?>