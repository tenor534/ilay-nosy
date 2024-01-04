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
class contentPageMainActualiteListFoZone extends jZone {
 
	/**
	* Nom du template HTML
	*/
    protected $_tplname='actualite~contentPageMainActualiteListFo.zone';

	protected $_useCache = false;

	/**
	* Tri par défaut de la liste
	*/
	public $sortField = 'actualite_titre';

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

		$tParams = array('zone'=> $this->getParam('zone','actualite~contentPageMainActualiteListFo'), 'aid' => $this->aid);
	
		//Chargement des données
		jClasses::inc('abonnement~abonnementSrv');
		jClasses::inc('forfait~forfaitSrv');
		jClasses::inc('actualite~actualiteSrv');
		jClasses::inc('photoAct~photoActSrv');
		jClasses::inc('commun~tools');
		
		if ($this->page > 1){
			$iDebutListe = ($this->page-1) * ANNONCE_PAGINATION_NBITEMPARPAGE ; 
		}else{
			$iDebutListe = 0 ;
		}
		
		$tResult = array('iNbEnreg'=>0, 'listeActualite'=>array());

		$tResult = actualiteSrv::chargeListeActualiteFo($idUtilisateurId, $this->aid, $this->sortField, $this->sortDirection,$iDebutListe);	
		//print_r( $tResult);
	
		$nbPage = ceil($tResult['iNbEnreg'] / ANNONCE_PAGINATION_NBITEMPARPAGE) ;		
		
		$toActualite = array();		
		foreach($tResult['listeActualite'] as $zKey => $oActualite){
		
			switch( $oActualite->actualite_offreId ){
				case 1 : 
					$oActualite->actualite_offre = "Offre particuli&egrave;re";
					break;
				case 2 : 
					$oActualite->actualite_offre = "Offre professionnelle";
					break;
				case 3 : 
					$oActualite->actualite_offre = "Offre commerciale";
					break;
				default:	
					$oActualite->actualite_offre = "Offre de candidat";
					break;
			}

			//Abonnemnet en cours
			$toAbonnement 	= abonnementSrv::chargeAbonnement($this->aid);
			$toForfait 		= forfaitSrv::chargeForfait($toAbonnement->abonnement_forfaitId);

			if($toForfait->forfait_packId == PACK_EMPLOIS){
				switch( $oActualite->actualite_etat ){
					case 1 : 
						$oActualite->actualite_etat = "Tr&egrave;s urgent";
						break;
					case 2 : 
						$oActualite->actualite_etat = "Urgent";
						break;
					case 3 : 
						$oActualite->actualite_etat = "D&egrave;s que possible";
						break;
					default:	
						$oActualite->actualite_etat = "S/O";
						break;
				}		
			}else{				
				switch( $oActualite->actualite_etat ){
					case 1 : 
						$oActualite->actualite_etat = "Neuf";
						break;
					case 2 : 
						$oActualite->actualite_etat = "Usag&eacute;";
						break;
					case 3 : 
						$oActualite->actualite_etat = "Epave";
						break;
					default:	
						$oActualite->actualite_etat = "S/O";
						break;
				}		
			}			
			
			$oActualite->actualite_supInfo = "";
			$oActualite->actualite_annee = ($oActualite->actualite_annee)? $oActualite->actualite_annee : "N/D";

			$oActualite->actualite_reference 		= stripslashes($oActualite->actualite_reference);
			$oActualite->actualite_titre 			= stripslashes($oActualite->actualite_titre);
			$oActualite->actualite_prixInfo			= stripslashes($oActualite->actualite_prixInfo);
			$oActualite->actualite_resume 			= stripslashes($oActualite->actualite_resume);
			$oActualite->actualite_description 		= stripslashes($oActualite->actualite_description);
			$oActualite->actualite_contactNom 		= stripslashes($oActualite->actualite_contactNom);
			$oActualite->actualite_contactPrenom	= stripslashes($oActualite->actualite_contactPrenom);
			$oActualite->actualite_contactEmail 	= stripslashes($oActualite->actualite_contactEmail);
			$oActualite->actualite_contactAdresse 	= stripslashes($oActualite->actualite_contactAdresse);

			$oActualite->abonnement_reference 	= stripslashes($oActualite->abonnement_reference);
			$oActualite->rubrique_libelle 		= stripslashes($oActualite->rubrique_libelle);					


			//La parution

			//la première photo
			$toPhoto = photoActSrv::getAllPhoto($oActualite->actualite_id);		
			
			if(sizeof($toPhoto)){
				$oActualite->actualite_photo = $toPhoto[0]->photo_photo;
			}else{
				$oActualite->actualite_photo = "noPhoto.jpg";
			}

			array_push($toActualite, $oActualite);		
		}

		$tHead = array(
					 array('sortField'=> "actualite_photo", 'libelle'=> "Photo", 'modifier'=> '', 'align'=> "_left", 'class'=> 'actualiteHead0')					
					,array('sortField'=> "actualite_titre", 'libelle'=> "Titre", 'modifier'=> '', 'align'=> "_left", 'class'=> 'actualiteHead1')					
					,array('sortField'=> "actualite_prix", 'libelle'=> "Prix", 'modifier'=> '', 'align'=> "_left", 'class'=> 'actualiteHead2')					
					,array('sortField'=> "actualite_annee", 'libelle'=> "Ann&eacute;e ou Type", 'modifier'=> '', 'align'=> "_left", 'class'=> 'actualiteHead3')					
					,array('sortField'=> "actualite_publier", 'libelle'=> "Publier", 'modifier'=> '', 'align'=> "_center", 'class'=> 'actualiteHead4')					
					,array('sortField'=> "actualite_dateDebut", 'libelle'=> "Parution", 'modifier'=> '', 'align'=> "_center", 'class'=> 'actualiteHead5')									
					);	
					
		//print_r ($oNavBar->tiPages) ;
		//Liste des abonnement pour l'utilisateur en cours
		$listeAbonnement = abonnementSrv::chargeListAbonnementAllByUserFo2($idUtilisateurId, 1);		

		//Affichage
		$this->_tpl->assign('i', 0);
		$this->_tpl->assign('nbPage', $nbPage);
		$this->_tpl->assign('toActualite', $toActualite);
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