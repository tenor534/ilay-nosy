<?php
/**
* @package ilay-nosy
* @subpackage categorieOff
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Zone affichant la liste des categorieOffs
*
* @package ilay-nosy
* @subpackage categorieOff
*/
class listeCategorieOffBoZone extends jZone {
 
	/**
	* Nom du template HTML
	*/
	protected $_tplname='categorieOff~listeCategorieOffBo.zone';

	/**
	* Tri par d�faut de la liste
	*/
	public $sortField = 'categorieOff_libelle';

	/**
	* Ordre de tri par d�faut de la liste
	*/
	public $sortDirection = 'ASC';

	/**
	* Page a afficher
	*/
	public $page = 1;

	/**
	* Chargement des donn�es pour affichage
	*/
	protected function _prepareTpl(){

		//R�cup�ration des param�tres
		if ($this->getParam('sortField')) {
			$this->sortField = $this->getParam('sortField');
		}
		if ($this->getParam('sortDirection')) {
			$this->sortDirection = $this->getParam('sortDirection');
		}
		if ($this->getParam('page')) {
			$this->page = $this->getParam('page');
		}

		$tParams = array('zone'=> $this->getParam('zone','categorieOff~listeCategorieOffBo'));
		
		//Chargement des donn�es
		jClasses::inc('categorieOff~categorieOffSrv');
		jClasses::inc('commun~tools');
		
		if ($this->page > 1){
			$iDebutListe = ($this->page-1) * PAGINATION_NBITEMPARPAGE ; 
		}else{
			$iDebutListe = 0 ;
		}
		
		$tResult = array('iNbEnreg'=>0, 'listeCategorieOff'=>array());

		$tResult = categorieOffSrv::chargeListeCategorieOff($this->sortField, $this->sortDirection,$iDebutListe);	
	
		$nbPage = ceil($tResult['iNbEnreg'] / PAGINATION_NBITEMPARPAGE) ;		

		$tHead = array(array('sortField'=> "categorieOff_libelle", 'libelle'=> "Libell�", 'modifier'=> '', 'align'=> "_left")
				,array('sortField'=> "categorieOff_code", 'libelle'=> "Code", 'modifier'=> '', 'align'=> "_center")
		);
		//print_r ($oNavBar->tiPages) ;
		//Affichage
		$this->_tpl->assign('i', 0);
		$this->_tpl->assign('nbPage', $nbPage);
		$this->_tpl->assign('toCategorieOff', $tResult['listeCategorieOff']);
		$this->_tpl->assign('tHead', $tHead);
		
		$this->_tpl->assign('page', $this->page);
		$this->_tpl->assign('tParams', $tParams);
		$this->_tpl->assign('sortField', $this->sortField);
		$this->_tpl->assign('sortDirection', $this->sortDirection);
	}
}
?>
