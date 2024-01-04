<?php
/**
* @package ilay-nosy
* @subpackage annonce
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Zone affichant la liste des annonces
*
* @package ilay-nosy
* @subpackage annonce
*/
class listeAnnonceBoZone extends jZone {
 
	/**
	* Nom du template HTML
	*/
	protected $_tplname='annonce~listeAnnonceBo.zone';

	/**
	* Tri par défaut de la liste
	*/
	public $sortField = 'categorieAn_libelle, annonce_titre';

	/**
	* Ordre de tri par défaut de la liste
	*/
	public $sortDirection = 'ASC';

	/**
	* Page a afficher
	*/
	public $page = 1;

	/**
	* Chargement des données pour affichage
	*/
	protected function _prepareTpl(){

		//Chargement des données
		jClasses::inc('categorieAn~categorieAnSrv');
		jClasses::inc('rubrique~rubriqueSrv');
		jClasses::inc('pack~packSrv');
		jClasses::inc('abonnement~abonnementSrv');
		jClasses::inc('forfait~forfaitSrv');
		jClasses::inc('annonce~annonceSrv');
		jClasses::inc('photo~photoSrv');
		jClasses::inc('commun~tools');


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

		$tParams = array('zone'=> $this->getParam('zone','annonce~listeAnnonceBo'));
		
		
		if ($this->page > 1){
			$iDebutListe = ($this->page-1) * PAGINATION_NBITEMPARPAGE ; 
		}else{
			$iDebutListe = 0 ;
		}
		
		$tResult = array('iNbEnreg'=>0, 'listeAnnonce'=>array());

		$tResult = annonceSrv::chargeListeAnnonceRechercheBo(0, 0, "", 0, 0, 0, 0, 0, 0, $this->sortField, $this->sortDirection, $iDebutListe, $iListAll=0, PAGINATION_NBITEMPARPAGE);
	
		$nbPage = ceil($tResult['iNbEnreg'] / PAGINATION_NBITEMPARPAGE) ;		
		
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
			$toAbonnement 	= abonnementSrv::chargeAbonnement($oAnnonce->annonce_abonnementId);
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

			$oAnnonce->rubrique_libelle 		= stripslashes($oAnnonce->rubrique_libelle);					
			
			
			$dt = strtotime($oAnnonce->annonce_dateDebut);			
			//echo "<br>".time()." - $dt = " . floor((time() - $dt) / 60 / 60 /24);
			$oAnnonce->annonce_parution 		=  floor((time() - $dt) / 60 / 60 /24);

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
					 array('sortField'=> "categorieAn_libelle", 'libelle'=> "Cat&eacute;g.", 'modifier'=> '', 'align'=> "_left")					
					,array('sortField'=> "annonce_photo", 'libelle'=> "Photo", 'modifier'=> '', 'align'=> "_left")					
					,array('sortField'=> "annonce_titre", 'libelle'=> "Titre", 'modifier'=> '', 'align'=> "_left")					
					,array('sortField'=> "annonce_prix", 'libelle'=> "Prix", 'modifier'=> '', 'align'=> "_left")					
					,array('sortField'=> "annonce_annee", 'libelle'=> "An. / Type", 'modifier'=> '', 'align'=> "_left")					
					,array('sortField'=> "annonce_publier", 'libelle'=> "Pub", 'modifier'=> '', 'align'=> "_center")					
					,array('sortField'=> "annonce_publierHome", 'libelle'=> "Pub H", 'modifier'=> '', 'align'=> "_center")					
					,array('sortField'=> "annonce_laUne", 'libelle'=> "Une", 'modifier'=> '', 'align'=> "_center")					
					,array('sortField'=> "annonce_dateDebut", 'libelle'=> "Parution", 'modifier'=> '', 'align'=> "_center")									
					);	
					
		//Affichage
		$this->_tpl->assign('i', 0);
		$this->_tpl->assign('nbPage', $nbPage);
		$this->_tpl->assign('toAnnonce', $toAnnonce);
		$this->_tpl->assign('tHead', $tHead);
		
		$this->_tpl->assign('page', $this->page);
		$this->_tpl->assign('tParams', $tParams);
		$this->_tpl->assign('sortField', $this->sortField);
		$this->_tpl->assign('sortDirection', $this->sortDirection);
	}
}
?>
