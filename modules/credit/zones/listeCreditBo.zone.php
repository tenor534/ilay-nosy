<?php
/**
* @package ilay-nosy
* @subpackage credit
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Zone affichant la liste des credits
*
* @package ilay-nosy
* @subpackage credit
*/
class listeCreditBoZone extends jZone {
 
	/**
	* Nom du template HTML
	*/
	protected $_tplname='credit~listeCreditBo.zone';

	/**
	* Tri par défaut de la liste
	*/
	public $sortField = 'forfait_libelle, credit_id';

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

		$tParams = array('zone'=> $this->getParam('zone','credit~listeCreditBo'));
		
		//Chargement des données
		jClasses::inc('credit~creditSrv');
		jClasses::inc('commun~tools');
		
		if ($this->page > 1){
			$iDebutListe = ($this->page-1) * PAGINATION_NBITEMPARPAGE ; 
		}else{
			$iDebutListe = 0 ;
		}
		
		$tResult = array('iNbEnreg'=>0, 'listeCredit'=>array());

		$tResult = creditSrv::chargeListeCredit($this->sortField, $this->sortDirection,$iDebutListe);	
	
		$nbPage = ceil($tResult['iNbEnreg'] / PAGINATION_NBITEMPARPAGE) ;		
		
		$toCredit = array();		
		foreach($tResult['listeCredit'] as $zKey => $oCredit){
		
			$oCredit->credit_codePIN 	= stripslashes($oCredit->credit_codePIN);
			$oCredit->credit_password 	= stripslashes($oCredit->credit_password);

			$oCredit->forfait_libelle 		= stripslashes($oCredit->forfait_libelle);

			array_push($toCredit, $oCredit);
		}		

		$tHead = array(
					 array('sortField'=> "forfait_libelle", 'libelle'=> "Forfait", 'modifier'=> '', 'align'=> "_left")					
					,array('sortField'=> "credit_codePIN", 'libelle'=> "Code PIN", 'modifier'=> '', 'align'=> "_left")					
					,array('sortField'=> "credit_password", 'libelle'=> "Password", 'modifier'=> '', 'align'=> "_left")					
					,array('sortField'=> "credit_dateUse", 'libelle'=> "Date Util.", 'modifier'=> '', 'align'=> "_left")					
					,array('sortField'=> "credit_isPlus", 'libelle'=> "Plus", 'modifier'=> '', 'align'=> "_left")					
					);	
		//print_r ($oNavBar->tiPages) ;
		//Affichage
		$this->_tpl->assign('i', 0);
		$this->_tpl->assign('nbPage', $nbPage);
		$this->_tpl->assign('toCredit', $toCredit);
		$this->_tpl->assign('tHead', $tHead);
		
		$this->_tpl->assign('page', $this->page);
		$this->_tpl->assign('tParams', $tParams);
		$this->_tpl->assign('sortField', $this->sortField);
		$this->_tpl->assign('sortDirection', $this->sortDirection);
	}
}
?>
