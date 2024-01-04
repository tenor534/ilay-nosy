<?php
/**
* @package ilay-nosy
* @subpackage categorieAn
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Zone affichant la liste des categorieAns
*
* @package ilay-nosy
* @subpackage categorieAn
*/
class listeCategorieAnBoZone extends jZone {
 
	/**
	* Nom du template HTML
	*/
	protected $_tplname='categorieAn~listeCategorieAnBo.zone';

	/**
	* Tri par défaut de la liste
	*/
	public $sortField = 'categorieAn_libelle';

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

		$tParams = array('zone'=> $this->getParam('zone','categorieAn~listeCategorieAnBo'));
		
		//Chargement des données
		jClasses::inc('categorieAn~categorieAnSrv');
		jClasses::inc('commun~tools');
		
		if ($this->page > 1){
			$iDebutListe = ($this->page-1) * PAGINATION_NBITEMPARPAGE ; 
		}else{
			$iDebutListe = 0 ;
		}
		
		$tResult = array('iNbEnreg'=>0, 'listeCategorieAn'=>array());

		$tResult = categorieAnSrv::chargeListeCategorieAn($this->sortField, $this->sortDirection,$iDebutListe);	
	
		$nbPage = ceil($tResult['iNbEnreg'] / PAGINATION_NBITEMPARPAGE) ;		

		$tHead = array(array('sortField'=> "categorieAn_libelle", 'libelle'=> "Libellé", 'modifier'=> '', 'align'=> "_left")
				,array('sortField'=> "categorieAn_code", 'libelle'=> "Code", 'modifier'=> '', 'align'=> "_center")
		);
		//print_r ($oNavBar->tiPages) ;
		//Affichage
		$this->_tpl->assign('i', 0);
		$this->_tpl->assign('nbPage', $nbPage);
		$this->_tpl->assign('toCategorieAn', $tResult['listeCategorieAn']);
		$this->_tpl->assign('tHead', $tHead);
		
		$this->_tpl->assign('page', $this->page);
		$this->_tpl->assign('tParams', $tParams);
		$this->_tpl->assign('sortField', $this->sortField);
		$this->_tpl->assign('sortDirection', $this->sortDirection);
	}
}
?>
