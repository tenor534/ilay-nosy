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
class contentPageMainOfficielListFoZone extends jZone {
 
	/**
	* Nom du template HTML
	*/
    protected $_tplname='officiel~contentPageMainOfficielListFo.zone';

	protected $_useCache = false;

	/**
	* Tri par défaut de la liste
	*/
	public $sortField = 'officiel_titre';

	/**
	* Ordre de tri par défaut de la liste
	*/
	public $sortDirection = 'ASC';

	/**
	* Page a afficher
	*/
	public $page = 1;

	/**
	* Page a afficher
	*/
	public $aid = 0;

	/**
	* Chargement des données pour affichage
	*/
	protected function _prepareTpl(){

		//Session utilisateur
		$idUtilisateurId = $_SESSION['SESSION_MEMBRE_ID'];

		//Récupération des paramètres
		if ($this->getParam('sortField')) {
			$this->sortField = $this->getParam('sortField');
		}
		if ($this->getParam('sortDirection')) {
			$this->sortDirection = $this->getParam('sortDirection');
		}
		if ($this->getParam('page')) {
			$this->page = $this->getParam('page');
		}
		if ($this->getParam('aid')) {
			$this->aid = $this->getParam('aid');
		}	

		$tParams = array('zone'=> $this->getParam('zone','officiel~contentPageMainOfficielListFo'), 'aid' => $this->aid);
	
		//Chargement des données
		jClasses::inc('abonnement~abonnementSrv');
		jClasses::inc('forfait~forfaitSrv');
		jClasses::inc('officiel~officielSrv');
		jClasses::inc('photoOff~photoOffSrv');
		jClasses::inc('commun~tools');
		
		if ($this->page > 1){
			$iDebutListe = ($this->page-1) * ANNONCE_PAGINATION_NBITEMPARPAGE ; 
		}else{
			$iDebutListe = 0 ;
		}
		
		$tResult = array('iNbEnreg'=>0, 'listeOfficiel'=>array());

		$tResult = officielSrv::chargeListeOfficielFo($idUtilisateurId, $this->aid, $this->sortField, $this->sortDirection,$iDebutListe);	
		//print_r( $tResult);
	
		$nbPage = ceil($tResult['iNbEnreg'] / ANNONCE_PAGINATION_NBITEMPARPAGE) ;		
		
		$toOfficiel = array();		
		foreach($tResult['listeOfficiel'] as $zKey => $oOfficiel){
		
			switch( $oOfficiel->officiel_offreId ){
				case 1 : 
					$oOfficiel->officiel_offre = "Offre particuli&egrave;re";
					break;
				case 2 : 
					$oOfficiel->officiel_offre = "Offre professionnelle";
					break;
				case 3 : 
					$oOfficiel->officiel_offre = "Offre commerciale";
					break;
				default:	
					$oOfficiel->officiel_offre = "Offre de candidat";
					break;
			}

			//Abonnemnet en cours
			$toAbonnement 	= abonnementSrv::chargeAbonnement($this->aid);
			$toForfait 		= forfaitSrv::chargeForfait($toAbonnement->abonnement_forfaitId);

			if($toForfait->forfait_packId == PACK_EMPLOIS){
				switch( $oOfficiel->officiel_etat ){
					case 1 : 
						$oOfficiel->officiel_etat = "Tr&egrave;s urgent";
						break;
					case 2 : 
						$oOfficiel->officiel_etat = "Urgent";
						break;
					case 3 : 
						$oOfficiel->officiel_etat = "D&egrave;s que possible";
						break;
					default:	
						$oOfficiel->officiel_etat = "S/O";
						break;
				}		
			}else{				
				switch( $oOfficiel->officiel_etat ){
					case 1 : 
						$oOfficiel->officiel_etat = "Neuf";
						break;
					case 2 : 
						$oOfficiel->officiel_etat = "Usag&eacute;";
						break;
					case 3 : 
						$oOfficiel->officiel_etat = "Epave";
						break;
					default:	
						$oOfficiel->officiel_etat = "S/O";
						break;
				}		
			}			
			
			$oOfficiel->officiel_supInfo = "";
			$oOfficiel->officiel_annee = ($oOfficiel->officiel_annee)? $oOfficiel->officiel_annee : "N/D";

			$oOfficiel->officiel_reference 		= stripslashes($oOfficiel->officiel_reference);
			$oOfficiel->officiel_titre 			= stripslashes($oOfficiel->officiel_titre);
			$oOfficiel->officiel_prixInfo			= stripslashes($oOfficiel->officiel_prixInfo);
			$oOfficiel->officiel_resume 			= stripslashes($oOfficiel->officiel_resume);
			$oOfficiel->officiel_description 		= stripslashes($oOfficiel->officiel_description);
			$oOfficiel->officiel_contactNom 		= stripslashes($oOfficiel->officiel_contactNom);
			$oOfficiel->officiel_contactPrenom	= stripslashes($oOfficiel->officiel_contactPrenom);
			$oOfficiel->officiel_contactEmail 	= stripslashes($oOfficiel->officiel_contactEmail);
			$oOfficiel->officiel_contactAdresse 	= stripslashes($oOfficiel->officiel_contactAdresse);

			$oOfficiel->abonnement_reference 	= stripslashes($oOfficiel->abonnement_reference);
			$oOfficiel->rubrique_libelle 		= stripslashes($oOfficiel->rubrique_libelle);					


			//La parution

			//la première photo
			$toPhoto = photoOffSrv::getAllPhoto($oOfficiel->officiel_id);		
			
			if(sizeof($toPhoto)){
				$oOfficiel->officiel_photo = $toPhoto[0]->photo_photo;
			}else{
				$oOfficiel->officiel_photo = "noPhoto.jpg";
			}

			array_push($toOfficiel, $oOfficiel);		
		}

		$tHead = array(
					 array('sortField'=> "officiel_photo", 'libelle'=> "Photo", 'modifier'=> '', 'align'=> "_left", 'class'=> 'officielHead0')					
					,array('sortField'=> "officiel_titre", 'libelle'=> "Titre", 'modifier'=> '', 'align'=> "_left", 'class'=> 'officielHead1')					
					,array('sortField'=> "officiel_prix", 'libelle'=> "Prix", 'modifier'=> '', 'align'=> "_left", 'class'=> 'officielHead2')					
					,array('sortField'=> "officiel_annee", 'libelle'=> "Ann&eacute;e ou Type", 'modifier'=> '', 'align'=> "_left", 'class'=> 'officielHead3')					
					,array('sortField'=> "officiel_publier", 'libelle'=> "Publier", 'modifier'=> '', 'align'=> "_center", 'class'=> 'officielHead4')					
					,array('sortField'=> "officiel_dateDebut", 'libelle'=> "Parution", 'modifier'=> '', 'align'=> "_center", 'class'=> 'officielHead5')									
					);	
					
		//print_r ($oNavBar->tiPages) ;
		//Liste des abonnement pour l'utilisateur en cours
		$listeAbonnement = abonnementSrv::chargeListAbonnementAllByUserFo2($idUtilisateurId, 1);		

		//Affichage
		$this->_tpl->assign('i', 0);
		$this->_tpl->assign('nbPage', $nbPage);
		$this->_tpl->assign('toOfficiel', $toOfficiel);
		$this->_tpl->assign('listeAbonnement', $listeAbonnement);
		$this->_tpl->assign('tHead', $tHead);
		
		$this->_tpl->assign('page', $this->page);
		$this->_tpl->assign('aid', $this->aid);
		$this->_tpl->assign('tParams', $tParams);
		$this->_tpl->assign('sortField', $this->sortField);
		$this->_tpl->assign('sortDirection', $this->sortDirection);
		
		$this->_tpl->assign('iDebutEnreg', $iDebutListe+1);
		$this->_tpl->assign('iFinEnreg', $iDebutListe + ANNONCE_PAGINATION_NBITEMPARPAGE);
		$this->_tpl->assign('iNbEnreg', $tResult['iNbEnreg']);
	}
}
?>