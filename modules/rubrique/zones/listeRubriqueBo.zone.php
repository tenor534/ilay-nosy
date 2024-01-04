<?php
/**
* @package ilay-nosy
* @subpackage rubrique
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Zone affichant la liste des rubriques
*
* @package ilay-nosy
* @subpackage rubrique
*/
class listeRubriqueBoZone extends jZone {
 
	/**
	* Nom du template HTML
	*/
	protected $_tplname='rubrique~listeRubriqueBo.zone';

	/**
	* Tri par défaut de la liste
	*/
	public $sortField = 'rubrique_sortCode';

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

		$tParams = array('zone'=> $this->getParam('zone','rubrique~listeRubriqueBo'));
		
		//Chargement des données
		jClasses::inc('rubrique~rubriqueSrv');
		jClasses::inc('commun~tools');
		
		if ($this->page > 1){
			$iDebutListe = ($this->page-1) * RUBRIQUE_PAGINATION_NBITEMPARPAGE ; 
		}else{
			$iDebutListe = 0 ;
		}
		
		$tResult = array('iNbEnreg'=>0, 'listeRubrique'=>array());

		$tResult = rubriqueSrv::chargeListeRubrique($this->sortField, $this->sortDirection,$iDebutListe);	
	
		$nbPage = ceil($tResult['iNbEnreg'] / RUBRIQUE_PAGINATION_NBITEMPARPAGE) ;		
		
		$toRubrique = array();		
		foreach($tResult['listeRubrique'] as $zKey => $oRubrique){
		
			$oRubrique->rubrique_level 		= stripslashes($oRubrique->rubrique_level);
			$oRubrique->rubrique_path 		= stripslashes($oRubrique->rubrique_path);
			$oRubrique->rubrique_libelle 	= stripslashes($oRubrique->rubrique_libelle);
			$oRubrique->rubrique_code 		= stripslashes($oRubrique->rubrique_code);
			
			$oRubrique->categorieAn_code	= stripslashes($oRubrique->categorieAn_code);

			array_push($toRubrique, $oRubrique);
		}		

		$tHead = array(
					 array('sortField'=> "categorieAn_code", 'libelle'=> "Cat&eacute;gorie", 'modifier'=> '', 'align'=> "_left")					
					,array('sortField'=> "rubrique_level", 'libelle'=> "Level", 'modifier'=> '', 'align'=> "_left")					
					,array('sortField'=> "rubrique_sortCode", 'libelle'=> "SortCode", 'modifier'=> '', 'align'=> "_center")					
					,array('sortField'=> "rubrique_path", 'libelle'=> "Path", 'modifier'=> '', 'align'=> "_left")					
					,array('sortField'=> "rubrique_libelle", 'libelle'=> "Libelle", 'modifier'=> '', 'align'=> "_left")					
					);	
		//print_r ($oNavBar->tiPages) ;
		//Affichage
		$this->_tpl->assign('i', 0);
		$this->_tpl->assign('nbPage', $nbPage);
		$this->_tpl->assign('toRubrique', $toRubrique);
		$this->_tpl->assign('tHead', $tHead);
		
		$this->_tpl->assign('page', $this->page);
		$this->_tpl->assign('tParams', $tParams);
		$this->_tpl->assign('sortField', $this->sortField);
		$this->_tpl->assign('sortDirection', $this->sortDirection);
	}
}
?>
