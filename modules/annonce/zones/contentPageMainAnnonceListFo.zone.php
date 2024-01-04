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
class contentPageMainAnnonceListFoZone extends jZone {
 
	/**
	* Nom du template HTML
	*/
    protected $_tplname='annonce~contentPageMainAnnonceListFo.zone';

	protected $_useCache = false;

	/**
	* Tri par défaut de la liste
	*/
	public $sortField = 'annonce_titre';

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

		$tParams = array('zone'=> $this->getParam('zone','annonce~contentPageMainAnnonceListFo'), 'aid' => $this->aid);
	
		//Chargement des données
		jClasses::inc('abonnement~abonnementSrv');
		jClasses::inc('forfait~forfaitSrv');
		jClasses::inc('annonce~annonceSrv');
		jClasses::inc('photo~photoSrv');
		jClasses::inc('commun~tools');
		
		if ($this->page > 1){
			$iDebutListe = ($this->page-1) * ANNONCE_PAGINATION_NBITEMPARPAGE ; 
		}else{
			$iDebutListe = 0 ;
		}
		
		$tResult = array('iNbEnreg'=>0, 'listeAnnonce'=>array());

		$tResult = annonceSrv::chargeListeAnnonceFo($idUtilisateurId, $this->aid, $this->sortField, $this->sortDirection,$iDebutListe);	
		//print_r( $tResult);
	
		$nbPage = ceil($tResult['iNbEnreg'] / ANNONCE_PAGINATION_NBITEMPARPAGE) ;		
		
		$toAnnonce = array();		
		foreach($tResult['listeAnnonce'] as $zKey => $oAnnonce){
		
			switch( $oAnnonce->annonce_offreId ){
				case 1 : 
					$oAnnonce->annonce_offre = "Offre particuli&egrave;re";
					break;
				case 2 : 
					$oAnnonce->annonce_offre = "Offre professionnelle";
					break;
				case 3 : 
					$oAnnonce->annonce_offre = "Offre commerciale";
					break;
				default:	
					$oAnnonce->annonce_offre = "Offre de candidat";
					break;
			}

			//Abonnemnet en cours
			$toAbonnement 	= abonnementSrv::chargeAbonnement($this->aid);
			$toForfait 		= forfaitSrv::chargeForfait($toAbonnement->abonnement_forfaitId);

			if($toForfait->forfait_packId == PACK_EMPLOIS){
				switch( $oAnnonce->annonce_etat ){
					case 1 : 
						$oAnnonce->annonce_etat = "Tr&egrave;s urgent";
						break;
					case 2 : 
						$oAnnonce->annonce_etat = "Urgent";
						break;
					case 3 : 
						$oAnnonce->annonce_etat = "D&egrave;s que possible";
						break;
					default:	
						$oAnnonce->annonce_etat = "S/O";
						break;
				}		
			}else{				
				switch( $oAnnonce->annonce_etat ){
					case 1 : 
						$oAnnonce->annonce_etat = "Neuf";
						break;
					case 2 : 
						$oAnnonce->annonce_etat = "Usag&eacute;";
						break;
					case 3 : 
						$oAnnonce->annonce_etat = "Epave";
						break;
					default:	
						$oAnnonce->annonce_etat = "S/O";
						break;
				}		
			}			
			
			$oAnnonce->annonce_supInfo = "";
			$oAnnonce->annonce_annee = ($oAnnonce->annonce_annee)? $oAnnonce->annonce_annee : "N/D";

			$oAnnonce->annonce_reference 		= stripslashes($oAnnonce->annonce_reference);
			$oAnnonce->annonce_titre 			= stripslashes($oAnnonce->annonce_titre);
			$oAnnonce->annonce_prixInfo			= stripslashes($oAnnonce->annonce_prixInfo);
			$oAnnonce->annonce_resume 			= stripslashes($oAnnonce->annonce_resume);
			$oAnnonce->annonce_description 		= stripslashes($oAnnonce->annonce_description);
			$oAnnonce->annonce_contactNom 		= stripslashes($oAnnonce->annonce_contactNom);
			$oAnnonce->annonce_contactPrenom	= stripslashes($oAnnonce->annonce_contactPrenom);
			$oAnnonce->annonce_contactEmail 	= stripslashes($oAnnonce->annonce_contactEmail);
			$oAnnonce->annonce_contactAdresse 	= stripslashes($oAnnonce->annonce_contactAdresse);

			$oAnnonce->abonnement_reference 	= stripslashes($oAnnonce->abonnement_reference);
			$oAnnonce->rubrique_libelle 		= stripslashes($oAnnonce->rubrique_libelle);					


			//La parution

			//la première photo
			$toPhoto = photoSrv::getAllPhoto($oAnnonce->annonce_id);		
			
			if(sizeof($toPhoto)){
				$oAnnonce->annonce_photo = $toPhoto[0]->photo_photo;
			}else{
				$oAnnonce->annonce_photo = "noPhoto.jpg";
			}

			array_push($toAnnonce, $oAnnonce);		
		}

		$tHead = array(
					 array('sortField'=> "annonce_photo", 'libelle'=> "Photo", 'modifier'=> '', 'align'=> "_left", 'class'=> 'annonceHead0')					
					,array('sortField'=> "annonce_titre", 'libelle'=> "Titre", 'modifier'=> '', 'align'=> "_left", 'class'=> 'annonceHead1')					
					,array('sortField'=> "annonce_prix", 'libelle'=> "Prix", 'modifier'=> '', 'align'=> "_left", 'class'=> 'annonceHead2')					
					,array('sortField'=> "annonce_annee", 'libelle'=> "Ann&eacute;e ou Type", 'modifier'=> '', 'align'=> "_left", 'class'=> 'annonceHead3')					
					,array('sortField'=> "annonce_publier", 'libelle'=> "Publier", 'modifier'=> '', 'align'=> "_center", 'class'=> 'annonceHead4')					
					,array('sortField'=> "annonce_dateDebut", 'libelle'=> "Parution", 'modifier'=> '', 'align'=> "_center", 'class'=> 'annonceHead5')									
					);	
					
		//print_r ($oNavBar->tiPages) ;
		//Liste des abonnement pour l'utilisateur en cours
		$listeAbonnement = abonnementSrv::chargeListAbonnementAllByUserFo2($idUtilisateurId, 1);		

		//Affichage
		$this->_tpl->assign('i', 0);
		$this->_tpl->assign('nbPage', $nbPage);
		$this->_tpl->assign('toAnnonce', $toAnnonce);
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