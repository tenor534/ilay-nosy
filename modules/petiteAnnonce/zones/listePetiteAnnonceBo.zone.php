<?php
/**
* @package ilay-nosy
* @subpackage petiteAnnonce
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Zone affichant la liste des petiteAnnonces
*
* @package ilay-nosy
* @subpackage petiteAnnonce
*/
class listePetiteAnnonceBoZone extends jZone {
 
	/**
	* Nom du template HTML
	*/
	protected $_tplname='petiteAnnonce~listePetiteAnnonceBo.zone';

	/**
	* Tri par défaut de la liste
	*/
	public $sortField = 'petiteAnnonce_dateCreation';

	/**
	* Ordre de tri par défaut de la liste
	*/
	public $sortDirection = 'DESC';

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
		jClasses::inc('petiteAnnonce~petiteAnnonceSrv');
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

		$tParams = array('zone'=> $this->getParam('zone','petiteAnnonce~listePetiteAnnonceBo'));
		
		
		if ($this->page > 1){
			$iDebutListe = ($this->page-1) * PAGINATION_NBITEMPARPAGE ; 
		}else{
			$iDebutListe = 0 ;
		}
		
		$tResult = array('iNbEnreg'=>0, 'listePetiteAnnonce'=>array());

		$tResult = petiteAnnonceSrv::chargeListePetiteAnnonceRechercheBo(0, "", 0, 0, $this->sortField, $this->sortDirection, $iDebutListe, $iListAll=0, PAGINATION_NBITEMPARPAGE);
	
		$nbPage = ceil($tResult['iNbEnreg'] / PAGINATION_NBITEMPARPAGE) ;		
		
		$toPetiteAnnonce = array();		
		foreach($tResult['listePetiteAnnonce'] as $zKey => $oPetiteAnnonce){
			
			$oPetiteAnnonce->petiteAnnonce_reference 		= stripslashes($oPetiteAnnonce->petiteAnnonce_reference);
			$oPetiteAnnonce->petiteAnnonce_prixInfo			= stripslashes($oPetiteAnnonce->petiteAnnonce_prixInfo);
			$oPetiteAnnonce->petiteAnnonce_description 		= stripslashes($oPetiteAnnonce->petiteAnnonce_description);
			$oPetiteAnnonce->petiteAnnonce_contact	 		= stripslashes($oPetiteAnnonce->petiteAnnonce_contact);

			$oPetiteAnnonce->categorieAn_libelle 			= stripslashes($oPetiteAnnonce->categorieAn_libelle);					
			
			array_push($toPetiteAnnonce, $oPetiteAnnonce);		
		}

		$tHead = array(
					 array('sortField'=> "categorieAn_libelle", 'libelle'=> "Cat&eacute;g.", 'modifier'=> '', 'align'=> "_left")					
					,array('sortField'=> "petiteAnnonce_reference", 'libelle'=> "R&eacute;f&eacute;rence", 'modifier'=> '', 'align'=> "_left")					
					,array('sortField'=> "petiteAnnonce_prix", 'libelle'=> "Prix", 'modifier'=> '', 'align'=> "_left")					
					,array('sortField'=> "petiteAnnonce_description", 'libelle'=> "Description", 'modifier'=> '', 'align'=> "_left")					
					,array('sortField'=> "petiteAnnonce_contact", 'libelle'=> "Contact", 'modifier'=> '', 'align'=> "_left")					
					,array('sortField'=> "petiteAnnonce_publier", 'libelle'=> "Pub", 'modifier'=> '', 'align'=> "_center")					
					,array('sortField'=> "petiteAnnonce_affichage", 'libelle'=> "Aff.", 'modifier'=> '', 'align'=> "_center")					
					,array('sortField'=> "petiteAnnonce_dateCreation", 'libelle'=> "Date", 'modifier'=> '', 'align'=> "_center")									
					);	
					
		//Affichage
		$this->_tpl->assign('i', 0);
		$this->_tpl->assign('nbPage', $nbPage);
		$this->_tpl->assign('toPetiteAnnonce', $toPetiteAnnonce);
		$this->_tpl->assign('tHead', $tHead);
		
		$this->_tpl->assign('page', $this->page);
		$this->_tpl->assign('tParams', $tParams);
		$this->_tpl->assign('sortField', $this->sortField);
		$this->_tpl->assign('sortDirection', $this->sortDirection);
	}
}
?>
