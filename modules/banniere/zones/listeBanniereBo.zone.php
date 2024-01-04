<?php
/**
* @package ilay-nosy
* @subpackage banniere
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Zone affichant la liste des bannieres
*
* @package ilay-nosy
* @subpackage banniere
*/
class listeBanniereBoZone extends jZone {
 
	/**
	* Nom du template HTML
	*/
	protected $_tplname='banniere~listeBanniereBo.zone';

	/**
	* Tri par défaut de la liste
	*/
	public $sortField = 'banniere_dateDebutPub';

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

		//Chargement des données
		jClasses::inc('categorieAct~categorieActSrv');
		jClasses::inc('banniere~banniereSrv');
		jClasses::inc('photoAct~photoActSrv');
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

		$tParams = array('zone'=> $this->getParam('zone','banniere~listeBanniereBo'));
		
		
		if ($this->page > 1){
			$iDebutListe = ($this->page-1) * PAGINATION_NBITEMPARPAGE ; 
		}else{
			$iDebutListe = 0 ;
		}
		
		$tResult = array('iNbEnreg'=>0, 'listeBanniere'=>array());

		$tResult = banniereSrv::chargeListeBanniere(0, $this->sortField, $this->sortDirection, $iDebutListe, $iListAll=0, PAGINATION_NBITEMPARPAGE);
	
		$nbPage = ceil($tResult['iNbEnreg'] / PAGINATION_NBITEMPARPAGE) ;		
		
		$toBanniere = array();		
		foreach($tResult['listeBanniere'] as $zKey => $oBanniere){

			$oBanniere->banniere_nom 		= stripslashes($oBanniere->banniere_nom);
			$oBanniere->banniere_logo 		= stripslashes($oBanniere->banniere_logo);
			$oBanniere->banniere_banniere 	= stripslashes($oBanniere->banniere_banniere);
			$oBanniere->banniere_url 		= stripslashes($oBanniere->banniere_url);			

			$dt = strtotime($oBanniere->banniere_dateDebutPub);			
			//echo "<br>".time()." - $dt = " . floor((time() - $dt) / 60 / 60 /24);
			$oBanniere->banniere_parution 		=  floor((time() - $dt) / 60 / 60 /24);

			array_push($toBanniere, $oBanniere);		
		}

		$tHead = array(		

					 array('sortField'=> "banniere_nom", 'libelle'=> "Nom", 'modifier'=> '', 'align'=> "_left")	
					,array('sortField'=> "banniere_typeZone", 'libelle'=> "Zone", 'modifier'=> '', 'align'=> "_left")	

					,array('sortField'=> "banniere_dateCreation", 'libelle'=> "Cr&eacute;. le", 'modifier'=> '', 'align'=> "_center")									
					,array('sortField'=> "banniere_dateDebutPub", 'libelle'=> "Pub.Deb", 'modifier'=> '', 'align'=> "_center")									
					,array('sortField'=> "banniere_dateFinPub", 'libelle'=> "Pub.Fin", 'modifier'=> '', 'align'=> "_center")									
					,array('sortField'=> "banniere_publierInternal", 'libelle'=> "Page int.", 'modifier'=> '', 'align'=> "_center")					
					,array('sortField'=> "banniere_publierHome", 'libelle'=> "Page acc.", 'modifier'=> '', 'align'=> "_center")					
					
					,array('sortField'=> "banniere_click", 'libelle'=> "NB Click", 'modifier'=> '', 'align'=> "_center")					
					,array('sortField'=> "banniere_vue", 'libelle'=> "NB Vue", 'modifier'=> '', 'align'=> "_center")					

					);	
					
		//Affichage
		$this->_tpl->assign('i', 0);
		$this->_tpl->assign('nbPage', $nbPage);
		$this->_tpl->assign('toBanniere', $toBanniere);
		$this->_tpl->assign('tHead', $tHead);
		
		$this->_tpl->assign('page', $this->page);
		$this->_tpl->assign('tParams', $tParams);
		$this->_tpl->assign('sortField', $this->sortField);
		$this->_tpl->assign('sortDirection', $this->sortDirection);
	}
}
?>
