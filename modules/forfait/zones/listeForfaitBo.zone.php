<?php
/**
* @package ilay-nosy
* @subpackage forfait
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Zone affichant la liste des forfaits
*
* @package ilay-nosy
* @subpackage forfait
*/
class listeForfaitBoZone extends jZone {
 
	/**
	* Nom du template HTML
	*/
	protected $_tplname='forfait~listeForfaitBo.zone';

	/**
	* Tri par défaut de la liste
	*/
	public $sortField = 'pack_code, forfait_libelle';

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

		$tParams = array('zone'=> $this->getParam('zone','forfait~listeForfaitBo'));
		
		//Chargement des données
		jClasses::inc('forfait~forfaitSrv');
		jClasses::inc('commun~tools');
		
		if ($this->page > 1){
			$iDebutListe = ($this->page-1) * PAGINATION_NBITEMPARPAGE ; 
		}else{
			$iDebutListe = 0 ;
		}
		
		$tResult = array('iNbEnreg'=>0, 'listeForfait'=>array());

		$tResult = forfaitSrv::chargeListeForfait($this->sortField, $this->sortDirection,$iDebutListe);	
	
		$nbPage = ceil($tResult['iNbEnreg'] / PAGINATION_NBITEMPARPAGE) ;		
		
		$toForfait = array();		
		foreach($tResult['listeForfait'] as $zKey => $oForfait){
		
			$oForfait->forfait_libelle 	= stripslashes($oForfait->forfait_libelle);

			$oForfait->pack_code 		= stripslashes($oForfait->pack_code);

			array_push($toForfait, $oForfait);
		}		

		$tHead = array(
					 array('sortField'=> "pack_code", 'libelle'=> "Pack", 'modifier'=> '', 'align'=> "_left")					
					,array('sortField'=> "forfait_libelle", 'libelle'=> "Forfait", 'modifier'=> '', 'align'=> "_left")					
					);	
		//print_r ($oNavBar->tiPages) ;
		//Affichage
		$this->_tpl->assign('i', 0);
		$this->_tpl->assign('nbPage', $nbPage);
		$this->_tpl->assign('toForfait', $toForfait);
		$this->_tpl->assign('tHead', $tHead);
		
		$this->_tpl->assign('page', $this->page);
		$this->_tpl->assign('tParams', $tParams);
		$this->_tpl->assign('sortField', $this->sortField);
		$this->_tpl->assign('sortDirection', $this->sortDirection);
	}
}
?>
