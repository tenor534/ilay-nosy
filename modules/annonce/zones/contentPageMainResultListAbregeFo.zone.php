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
class contentPageMainResultListAbregeFoZone extends jZone {
	  
 
	/**
	* Nom du template HTML
	*/
    protected $_tplname='annonce~contentPageMainResultListAbregeFo.zone';

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
	* Nb de pagination par défaut de la liste
	*/
	public $nbPagination = 5;


	/**
	* Page a afficher
	*/
	public $page = 1;

	/**
	* Catégorie
	*/
	public $cid = 0;

	/**
	* Rubrique
	*/
	public $rid = 0;

	/**
	* Mot clé
	*/
	public $mot = "";

	/**
	* Rubrique ou Catégorie
	*/
	public $crid = 0;

	/**
	* Parution
	*/
	public $parution = 0;

	/**
	* Province
	*/
	public $province = 0;
	
	/**
	* Localité
	*/
	public $localite = 0;

	/**
	* Prix
	*/
	public $prix1 = 0;
	public $prix2 = 0;
	/**
	* Affichage
	*/
	public $affichage = 0;

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


		//Session utilisateur
		//$idUtilisateurId = $_SESSION['SESSION_MEMBRE_ID'];
		if (isset($_SESSION['SESSION_MEMBRE_ID'])) {
			$idUtilisateurId = $_SESSION['SESSION_MEMBRE_ID'];
		}else{
			$idUtilisateurId = 0;		
		}


		//Récupération des paramètres de pagination
		if ($this->getParam('sortField')) {
			$this->sortField = $this->getParam('sortField');
		}
		if ($this->getParam('sortDirection')) {
			$this->sortDirection = $this->getParam('sortDirection');
		}
		if ($this->getParam('page')) {
			$this->page = $this->getParam('page');			
		}
		if ($this->getParam('nbPagination')) {
			$this->nbPagination = $this->getParam('nbPagination');			
		}
		
		
		//Récupération des paramètres de recherche
		$zCid = "";
		if ($this->getParam('cid')) {
			$this->cid = $this->getParam('cid');
			$tCid 	= categorieAnSrv::chargeCategorieAn($this->cid);
			$zCid = $tCid->categorieAn_libelle;
		}	
		$zRid = "";
		if ($this->getParam('rid')) {
			$this->rid = $this->getParam('rid');
			$tRid 	= rubriqueSrv::getRubrique($this->rid);
			$zRid = $tRid->rubrique_libelle;
		}	
		$zMot = "";
		if ($this->getParam('mot')) {
			$this->mot = $this->getParam('mot');
			$zMot = $this->mot;
		}	
		$zCrid = "";
		if ($this->getParam('crid')) {
			$this->crid = $this->getParam('crid');
			
			$type  = substr($this->crid,0,1);
			$value = substr($this->crid,1,strlen($this->crid)-1);
		
			if($type == "c"){
				$tCid 	= categorieAnSrv::chargeCategorieAn($value);
				$zCrid = $tCid->categorieAn_libelle;
			}elseif($type == "r"){
				$tRid 	= rubriqueSrv::getRubrique($value);
				$zCrid = $tRid->rubrique_libelle;
			}								
		}	
		$zParution = "";
		if ($this->getParam('parution')) {
			$this->parution = $this->getParam('parution');

			switch($this->parution){
				case 1: //1jour
					$zParution .=	"1 jour";
					break;
				case 2: //2jour
					$zParution .=	"2 jours";
					break;
				case 3: //3jour
					$zParution .=	"3 jours";
					break;
				case 4: //1semaine
					$zParution .=	"1 semaine";
					break;
				case 5: //2semaines
					$zParution .=	"2 semaines";
					break;
				case 6: //1mois
					$zParution .=	"1 mois";
					break;
				case 7: //2 mois
					$zParution .=	"2 mois";
					break;							
			}			
		}	
		$zLocalite = "";
		if ($this->getParam('localite')) {
			$this->localite = $this->getParam('localite');
			$tLocalite 	= annonceSrv::getLocalite($this->localite);
			$zLocalite = $tLocalite->localite_code . ' ' . $tLocalite->localite_libelle;
		}	
		$zProvince = "";
		if ($this->getParam('province')) {
			$this->province = $this->getParam('province');
			$tProvince 	= annonceSrv::getProvince($this->province);
			$zProvince = $tProvince->province_libelle;
		}	
		$zPrix1 = "";
		if ($this->getParam('prix1')) {
			$this->prix1 = $this->getParam('prix1');
			$zPrix1 = $this->prix1;
		}	
		$zPrix2 = "";
		if ($this->getParam('prix2')) {
			$this->prix2 = $this->getParam('prix2');
			$zPrix2 = $this->prix2;
		}	

		//Récupération des paramètres d'affichage
		$zAffichage = "";
		if ($this->getParam('affichage')) {
			$this->affichage = $this->getParam('affichage');
			$zAffichage = $this->affichage;
		}

		$tParams = array('zone'=> $this->getParam('zone','annonce~contentPageMainResultListAbregeFo'), 'nbPagination'=> $this->nbPagination, 'affichage'=> $this->affichage, 'cid'=> $this->cid, 'rid'=> $this->rid, 'mot'=> $this->mot, 'crid'=> $this->crid, 'parution'=> $this->parution, 'province'=> $this->province, 'localite'=> $this->localite, 'prix1'=> $this->prix1, 'prix2'=> $this->prix2);
	
		
		if ($this->page > 1){
			$iDebutListe = ($this->page-1) * $this->nbPagination; 
		}else{
			$iDebutListe = 0 ;
		}
		
		$tResult = array('iNbEnreg'=>0, 'listeAnnonce'=>array());

		$tResult = annonceSrv::chargeListeAnnonceRechercheFo($this->cid, $this->rid, $this->mot, $this->crid, $this->parution, $this->province, $this->localite, $this->prix1, $this->prix2, $this->sortField, $this->sortDirection, $iDebutListe, 0, $this->nbPagination);
		//print_r( $tResult);	
	
		$nbPage = ceil($tResult['iNbEnreg'] / $this->nbPagination) ;		
		
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
					 array('sortField'=> "annonce_photo", 'libelle'=> "Photo", 'modifier'=> '', 'align'=> "_left", 'class'=> 'annonceHead0')					
					,array('sortField'=> "annonce_titre", 'libelle'=> "Titre", 'modifier'=> '', 'align'=> "_left", 'class'=> 'annonceHead1')					
					,array('sortField'=> "annonce_prix", 'libelle'=> "Prix", 'modifier'=> '', 'align'=> "_left", 'class'=> 'annonceHead2')					
					,array('sortField'=> "annonce_annee", 'libelle'=> "Ann&eacute;e ou Type", 'modifier'=> '', 'align'=> "_left", 'class'=> 'annonceHead3')					
					//,array('sortField'=> "annonce_publier", 'libelle'=> "Publier", 'modifier'=> '', 'align'=> "_center", 'class'=> 'annonceHead4')					
					,array('sortField'=> "annonce_dateDebut", 'libelle'=> "Parution", 'modifier'=> '', 'align'=> "_center", 'class'=> 'annonceHead5')									
					);	
					
		//print_r ($oNavBar->tiPages) ;
		//Liste des abonnement pour l'utilisateur en cours
		$listeAbonnement = abonnementSrv::chargeListAbonnementAllByUserFo2($idUtilisateurId);		

		//Affichage
		$this->_tpl->assign('i', 0);
		$this->_tpl->assign('nbPage', $nbPage);
		$this->_tpl->assign('toAnnonce', $toAnnonce);
		$this->_tpl->assign('listeAbonnement', $listeAbonnement);
		$this->_tpl->assign('tHead', $tHead);		
		
		$this->_tpl->assign('tParams', $tParams);
		$this->_tpl->assign('sortField', $this->sortField);
		$this->_tpl->assign('sortDirection', $this->sortDirection);
		$this->_tpl->assign('page', $this->page);

		$this->_tpl->assign('nbPagination', $this->nbPagination);
		$this->_tpl->assign('cid', $this->cid);
		$this->_tpl->assign('rid', $this->rid);
		$this->_tpl->assign('mot', $this->mot);
		$this->_tpl->assign('crid', $this->crid);
		$this->_tpl->assign('parution', $this->parution);
		$this->_tpl->assign('localite', $this->localite);
		$this->_tpl->assign('province', $this->province);
		$this->_tpl->assign('affichage', $this->affichage);
		$this->_tpl->assign('prix1', $this->prix1);
		$this->_tpl->assign('prix2', $this->prix2);
		
		$this->_tpl->assign('iDebutEnreg', $iDebutListe+1);
		$this->_tpl->assign('iFinEnreg', $iDebutListe + $this->nbPagination);
		$this->_tpl->assign('iNbEnreg', $tResult['iNbEnreg']);
		
		//Récap critères
		$this->_tpl->assign('zCid', $zCid);		
		$this->_tpl->assign('zRid', $zRid);
		$this->_tpl->assign('zMot', $zMot);
		$this->_tpl->assign('zCrid', $zCrid);
		$this->_tpl->assign('zParution', $zParution);
		$this->_tpl->assign('zLocalite', $zLocalite);
		$this->_tpl->assign('zProvince', $zProvince);
		$this->_tpl->assign('zPrix1', $zPrix1);
		$this->_tpl->assign('zPrix2', $zPrix2);
		$this->_tpl->assign('zAffichage', $zAffichage);
	}
}
?>