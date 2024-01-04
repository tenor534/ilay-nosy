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
class contentPageMainPetiteAnnonceListFoZone extends jZone {
 
	/**
	* Nom du template HTML
	*/
    protected $_tplname='petiteAnnonce~contentPageMainPetiteAnnonceListFo.zone';

	protected $_useCache = false;

	/**
	* Tri par défaut de la liste
	*/
	public $sortField = 'petiteAnnonce_titre';

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
	public $cid = 0;

	/**
	* Chargement des données pour affichage
	*/
	protected function _prepareTpl(){

		//Session utilisateur
		if(isset($_SESSION['SESSION_MEMBRE_ID'])){
			$idUtilisateurId = $_SESSION['SESSION_MEMBRE_ID'];
		}	

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
		if ($this->getParam('cid')) {
			$this->cid = $this->getParam('cid');
		}	

		$tParams = array('zone'=> $this->getParam('zone','petiteAnnonce~contentPageMainPetiteAnnonceListFo'), 'cid' => $this->cid);
	
		//Chargement des données
		//jClasses::inc('abonnement~abonnementSrv');
		//jClasses::inc('forfait~forfaitSrv');
		jClasses::inc('categorieAn~categorieAnSrv');
		jClasses::inc('petiteAnnonce~petiteAnnonceSrv');
		//jClasses::inc('photo~photoSrv');
		jClasses::inc('commun~tools');
		
		if ($this->page > 1){
			$iDebutListe = ($this->page-1) * ANNONCE_PAGINATION_NBITEMPARPAGE ; 
		}else{
			$iDebutListe = 0 ;
		}
		
		$tResult = array('iNbEnreg'=>0, 'listeAnnonce'=>array());

		$tResult = petiteAnnonceSrv::chargeListePetiteAnnonceRechercheFo($this->cid, "", 0, 0, $this->sortField, $this->sortDirection, $iDebutListe, $iListAll=0, ANNONCE_PAGINATION_NBITEMPARPAGE);
		//print_r( $tResult);
	
		$nbPage = ceil($tResult['iNbEnreg'] / ANNONCE_PAGINATION_NBITEMPARPAGE) ;		
		
		$toPetiteAnnonce = array();		
		foreach($tResult['listePetiteAnnonce'] as $zKey => $oAnnonce){

			$oAnnonce->petiteAnnonce_supInfo = "";
			
			$oAnnonce->petiteAnnonce_reference 			= stripslashes($oAnnonce->petiteAnnonce_reference);
			$oAnnonce->petiteAnnonce_prixInfo 			= stripslashes($oAnnonce->petiteAnnonce_prixInfo);			
			$oAnnonce->petiteAnnonce_description 		= nl2br(stripslashes($oAnnonce->petiteAnnonce_description));
			$oAnnonce->petiteAnnonce_contact 			= stripslashes($oAnnonce->petiteAnnonce_contact);
			$oAnnonce->petiteAnnonce_dateCreation 		= stripslashes($oAnnonce->petiteAnnonce_dateCreation);
			$oAnnonce->petiteAnnonce_dateModification	= stripslashes($oAnnonce->petiteAnnonce_dateModification);

			$oAnnonce->categorieAn_libelle 				= stripslashes($oAnnonce->categorieAn_libelle);					

			array_push($toPetiteAnnonce, $oAnnonce);		
		}

		$tHead = array(
					 array('sortField'=> "petiteAnnonce_reference", 'libelle'=> "R&eacute;f&eacute;rence", 'modifier'=> '', 'align'=> "_left", 'class'=> 'annonceHead0')					
					,array('sortField'=> "petiteAnnonce_description", 'libelle'=> "Description", 'modifier'=> '', 'align'=> "_left", 'class'=> 'annonceHead1')					
					,array('sortField'=> "petiteAnnonce_prix", 'libelle'=> "Prix", 'modifier'=> '', 'align'=> "_left", 'class'=> 'annonceHead2')					
					,array('sortField'=> "petiteAnnonce_contact", 'libelle'=> "Contact", 'modifier'=> '', 'align'=> "_left", 'class'=> 'annonceHead3')					
					,array('sortField'=> "petiteAnnonce_dateCreation", 'libelle'=> "Parution", 'modifier'=> '', 'align'=> "_center", 'class'=> 'annonceHead5')									
					);	
					
		//print_r ($oNavBar->tiPages) ;
		//Liste des abonnement pour l'utilisateur en cours
		$listeCategorieAn = categorieAnSrv::chargeAllCategorieAn();		

		//Affichage
		$this->_tpl->assign('i', 0);
		$this->_tpl->assign('nbPage', $nbPage);
		$this->_tpl->assign('toPetiteAnnonce', $toPetiteAnnonce);
		$this->_tpl->assign('listeCategorieAn', $listeCategorieAn);
		$this->_tpl->assign('tHead', $tHead);
		
		$this->_tpl->assign('page', $this->page);
		$this->_tpl->assign('cid', $this->cid);
		$this->_tpl->assign('tParams', $tParams);
		$this->_tpl->assign('sortField', $this->sortField);
		$this->_tpl->assign('sortDirection', $this->sortDirection);
		
		$this->_tpl->assign('iDebutEnreg', $iDebutListe+1);
		$this->_tpl->assign('iFinEnreg', $iDebutListe + ANNONCE_PAGINATION_NBITEMPARPAGE);
		$this->_tpl->assign('iNbEnreg', $tResult['iNbEnreg']);
	}
}
?>