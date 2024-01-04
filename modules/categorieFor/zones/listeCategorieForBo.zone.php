<?php
/**
* @package ilay-nosy
* @subpackage categorieFor
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Zone affichant la liste des categorieFors
*
* @package ilay-nosy
* @subpackage categorieFor
*/
class listeCategorieForBoZone extends jZone {
 
	/**
	* Nom du template HTML
	*/
	protected $_tplname='categorieFor~listeCategorieForBo.zone';

	/**
	* Tri par défaut de la liste
	*/
	public $sortField = 'categorieFor_libelle';

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

		$tParams = array('zone'=> $this->getParam('zone','categorieFor~listeCategorieForBo'));
		
		//Chargement des données
		jClasses::inc('categorieFor~categorieForSrv');
		jClasses::inc('commun~tools');
		
		if ($this->page > 1){
			$iDebutListe = ($this->page-1) * PAGINATION_NBITEMPARPAGE ; 
		}else{
			$iDebutListe = 0 ;
		}
		
		$tResult = array('iNbEnreg'=>0, 'listeCategorieFor'=>array());

		$tResult = categorieForSrv::chargeListeCategorieFor($this->sortField, $this->sortDirection,$iDebutListe);	
	
		$nbPage = ceil($tResult['iNbEnreg'] / PAGINATION_NBITEMPARPAGE) ;		

		$tHead = array(array('sortField'=> "categorieFor_libelle", 'libelle'=> "Libellé", 'modifier'=> '', 'align'=> "_left")
				,array('sortField'=> "categorieFor_code", 'libelle'=> "Code", 'modifier'=> '', 'align'=> "_center")
		);
		//print_r ($oNavBar->tiPages) ;
		//Affichage
		$this->_tpl->assign('i', 0);
		$this->_tpl->assign('nbPage', $nbPage);
		$this->_tpl->assign('toCategorieFor', $tResult['listeCategorieFor']);
		$this->_tpl->assign('tHead', $tHead);
		
		$this->_tpl->assign('page', $this->page);
		$this->_tpl->assign('tParams', $tParams);
		$this->_tpl->assign('sortField', $this->sortField);
		$this->_tpl->assign('sortDirection', $this->sortDirection);
	}
}
?>
