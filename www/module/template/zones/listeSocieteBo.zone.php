<?php
/**
* @package ilay-nosy
* @subpackage societe
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Zone affichant la liste des societes
*
* @package ilay-nosy
* @subpackage societe
*/
class listeSocieteBoZone extends jZone {
 
	/**
	* Nom du template HTML
	*/
	protected $_tplname='societe~listeSocieteBo.zone';

	/**
	* Tri par défaut de la liste
	*/
	public $sortField = 'societe_raisonSociale';

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

		$tParams = array('zone'=> $this->getParam('zone','societe~listeSocieteBo'));
		
		//Chargement des données
		jClasses::inc('societe~societeSrv');
		jClasses::inc('commun~tools');
		
		if ($this->page > 1){
			$iDebutListe = ($this->page-1) * PAGINATION_NBITEMPARPAGE ; 
		}else{
			$iDebutListe = 0 ;
		}
		
		$tResult = array('iNbEnreg'=>0, 'listeSociete'=>array());

		$tResult = societeSrv::chargeListeSociete($this->sortField, $this->sortDirection,$iDebutListe);	
	
		$nbPage = ceil($tResult['iNbEnreg'] / PAGINATION_NBITEMPARPAGE) ;		
		
		$toSociete = array();		
		foreach($tResult['listeSociete'] as $zKey => $oSociete){
		
			$oSociete->societe_nom 		= stripslashes ( $oSociete->societe_nom ) ;
			$oSociete->societe_fonction = stripslashes ( $oSociete->societe_fonction ) ;
			$oSociete->societe_email 	= stripslashes ( $oSociete->societe_email ) ;

			array_push($toSociete, $oSociete);
		}		

		$tHead = array(
					 array('sortField'=> "societe_nom", 'libelle'=> "Nom", 'modifier'=> '', 'align'=> "_left")					
					,array('sortField'=> "societe_fonction", 'libelle'=> "Fonction", 'modifier'=> '', 'align'=> "_left")					
					,array('sortField'=> "societe_telephone", 'libelle'=> "T&eacute;l&eacute;phone", 'modifier'=> '', 'align'=> "_center")					
					,array('sortField'=> "societe_email", 'libelle'=> "Email", 'modifier'=> '', 'align'=> "_left")					
				
					);	
		//print_r ($oNavBar->tiPages) ;
		//Affichage
		$this->_tpl->assign('i', 0);
		$this->_tpl->assign('nbPage', $nbPage);
		$this->_tpl->assign('toSociete', $toSociete);
		$this->_tpl->assign('tHead', $tHead);
		
		$this->_tpl->assign('page', $this->page);
		$this->_tpl->assign('tParams', $tParams);
		$this->_tpl->assign('sortField', $this->sortField);
		$this->_tpl->assign('sortDirection', $this->sortDirection);
	}
}
?>
