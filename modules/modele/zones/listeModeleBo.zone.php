<?php
/**
* @marqueage ilay-nosy
* @submarqueage modele
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Zone affichant la liste des modeles
*
* @marqueage ilay-nosy
* @submarqueage modele
*/
class listeModeleBoZone extends jZone {
 
	/**
	* Nom du template HTML
	*/
	protected $_tplname='modele~listeModeleBo.zone';

	/**
	* Tri par défaut de la liste
	*/
	public $sortField = 'marque_code, modele_libelle';

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

		$tParams = array('zone'=> $this->getParam('zone','modele~listeModeleBo'));
		
		//Chargement des données
		jClasses::inc('modele~modeleSrv');
		jClasses::inc('commun~tools');
		
		if ($this->page > 1){
			$iDebutListe = ($this->page-1) * PAGINATION_NBITEMPARPAGE ; 
		}else{
			$iDebutListe = 0 ;
		}
		
		$tResult = array('iNbEnreg'=>0, 'listeModele'=>array());

		$tResult = modeleSrv::chargeListeModele($this->sortField, $this->sortDirection,$iDebutListe);	
	
		$nbPage = ceil($tResult['iNbEnreg'] / PAGINATION_NBITEMPARPAGE) ;		
		
		$toModele = array();		
		foreach($tResult['listeModele'] as $zKey => $oModele){
		
			$oModele->modele_libelle 	= stripslashes($oModele->modele_libelle);

			$oModele->marque_code 		= stripslashes($oModele->marque_code);

			array_push($toModele, $oModele);
		}		

		$tHead = array(
					 array('sortField'=> "marque_code", 'libelle'=> "Marque", 'modifier'=> '', 'align'=> "_left")					
					,array('sortField'=> "modele_libelle", 'libelle'=> "Modele", 'modifier'=> '', 'align'=> "_left")					
					,array('sortField'=> "modele_code", 'libelle'=> "Code", 'modifier'=> '', 'align'=> "_left")					
					);	
		//print_r ($oNavBar->tiPages) ;
		//Affichage
		$this->_tpl->assign('i', 0);
		$this->_tpl->assign('nbPage', $nbPage);
		$this->_tpl->assign('toModele', $toModele);
		$this->_tpl->assign('tHead', $tHead);
		
		$this->_tpl->assign('page', $this->page);
		$this->_tpl->assign('tParams', $tParams);
		$this->_tpl->assign('sortField', $this->sortField);
		$this->_tpl->assign('sortDirection', $this->sortDirection);
	}
}
?>
