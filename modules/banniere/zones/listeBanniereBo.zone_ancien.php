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
	public $sortField = 'categorieAct_libelle, banniere_datePublication';

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

			$oBanniere->banniere_reference 	= stripslashes($oBanniere->banniere_reference);
			$oBanniere->banniere_titre 		= stripslashes($oBanniere->banniere_titre);
			$oBanniere->banniere_resume 		= stripslashes($oBanniere->banniere_resume);
			$oBanniere->banniere_texte 		= stripslashes($oBanniere->banniere_texte);			
			$oBanniere->banniere_photo 		= stripslashes($oBanniere->banniere_photo);
			$oBanniere->banniere_source 		= stripslashes($oBanniere->banniere_source);
			$oBanniere->banniere_fichier 		= stripslashes($oBanniere->banniere_fichier);

			$oBanniere->categorieAct_libelle 	= stripslashes($oBanniere->categorieAct_libelle);
			$oBanniere->categorieAct_code 		= stripslashes($oBanniere->categorieAct_code);

			$dt = strtotime($oBanniere->banniere_datePublication);			
			//echo "<br>".time()." - $dt = " . floor((time() - $dt) / 60 / 60 /24);
			$oBanniere->banniere_parution 		=  floor((time() - $dt) / 60 / 60 /24);

			//La parution

			//la première photo
			$toPhoto = photoActSrv::getAllPhoto($oBanniere->banniere_id);		
			
			if(sizeof($toPhoto)){
				//$oBanniere->banniere_photo = $toPhoto[0]->photo_photo;
			}else{
				//$oBanniere->banniere_photo = "noPhoto.jpg";
			}

			array_push($toBanniere, $oBanniere);		
		}

		$tHead = array(
					 array('sortField'=> "categorieAct_libelle", 'libelle'=> "Cat&eacute;g.", 'modifier'=> '', 'align'=> "_left")					
					,array('sortField'=> "banniere_photo", 'libelle'=> "Photo", 'modifier'=> '', 'align'=> "_left")					
					,array('sortField'=> "banniere_titre", 'libelle'=> "Titre", 'modifier'=> '', 'align'=> "_left")					
					,array('sortField'=> "banniere_publier", 'libelle'=> "Pub", 'modifier'=> '', 'align'=> "_center")					
					,array('sortField'=> "banniere_publierHome", 'libelle'=> "Pub H", 'modifier'=> '', 'align'=> "_center")					
					,array('sortField'=> "banniere_laUne", 'libelle'=> "Une", 'modifier'=> '', 'align'=> "_center")					
					,array('sortField'=> "banniere_dateCreation", 'libelle'=> "Cr&eacute;. le", 'modifier'=> '', 'align'=> "_center")									
					,array('sortField'=> "banniere_dateModification", 'libelle'=> "Mod. le", 'modifier'=> '', 'align'=> "_center")									
					,array('sortField'=> "banniere_datePublication", 'libelle'=> "Pub. le", 'modifier'=> '', 'align'=> "_center")									
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
