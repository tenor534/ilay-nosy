<?php
/**
* @package ilay-nosy
* @subpackage officiel
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Zone affichant la liste des officiels
*
* @package ilay-nosy
* @subpackage officiel
*/
class listeOfficielBoZone extends jZone {
 
	/**
	* Nom du template HTML
	*/
	protected $_tplname='officiel~listeOfficielBo.zone';

	/**
	* Tri par défaut de la liste
	*/
	public $sortField = 'categorieOff_libelle, officiel_datePublication';

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
		jClasses::inc('categorieOff~categorieOffSrv');
		jClasses::inc('officiel~officielSrv');
		jClasses::inc('photoOff~photoOffSrv');
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

		$tParams = array('zone'=> $this->getParam('zone','officiel~listeOfficielBo'));
		
		
		if ($this->page > 1){
			$iDebutListe = ($this->page-1) * PAGINATION_NBITEMPARPAGE ; 
		}else{
			$iDebutListe = 0 ;
		}
		
		$tResult = array('iNbEnreg'=>0, 'listeOfficiel'=>array());

		$tResult = officielSrv::chargeListeOfficiel(0, $this->sortField, $this->sortDirection, $iDebutListe, $iListAll=0, PAGINATION_NBITEMPARPAGE);
	
		$nbPage = ceil($tResult['iNbEnreg'] / PAGINATION_NBITEMPARPAGE) ;		
		
		$toOfficiel = array();		
		foreach($tResult['listeOfficiel'] as $zKey => $oOfficiel){

			$oOfficiel->officiel_reference 	= stripslashes($oOfficiel->officiel_reference);
			$oOfficiel->officiel_titre 		= stripslashes($oOfficiel->officiel_titre);
			$oOfficiel->officiel_resume 		= stripslashes($oOfficiel->officiel_resume);
			$oOfficiel->officiel_texte 		= stripslashes($oOfficiel->officiel_texte);			
			$oOfficiel->officiel_photo 		= stripslashes($oOfficiel->officiel_photo);
			$oOfficiel->officiel_source 		= stripslashes($oOfficiel->officiel_source);
			$oOfficiel->officiel_fichier 		= stripslashes($oOfficiel->officiel_fichier);

			$oOfficiel->categorieOff_libelle 	= stripslashes($oOfficiel->categorieOff_libelle);
			$oOfficiel->categorieOff_code 		= stripslashes($oOfficiel->categorieOff_code);

			$dt = strtotime($oOfficiel->officiel_datePublication);			
			//echo "<br>".time()." - $dt = " . floor((time() - $dt) / 60 / 60 /24);
			$oOfficiel->officiel_parution 		=  floor((time() - $dt) / 60 / 60 /24);

			//La parution

			//la première photo
			$toPhoto = photoOffSrv::getAllPhoto($oOfficiel->officiel_id);		
			
			if(sizeof($toPhoto)){
				//$oOfficiel->officiel_photo = $toPhoto[0]->photo_photo;
			}else{
				//$oOfficiel->officiel_photo = "noPhoto.jpg";
			}

			array_push($toOfficiel, $oOfficiel);		
		}

		$tHead = array(
					 array('sortField'=> "categorieOff_libelle", 'libelle'=> "Cat&eacute;g.", 'modifier'=> '', 'align'=> "_left")					
					,array('sortField'=> "officiel_photo", 'libelle'=> "Photo", 'modifier'=> '', 'align'=> "_left")					
					,array('sortField'=> "officiel_titre", 'libelle'=> "Titre", 'modifier'=> '', 'align'=> "_left")					
					,array('sortField'=> "officiel_publier", 'libelle'=> "Pub", 'modifier'=> '', 'align'=> "_center")					
					,array('sortField'=> "officiel_publierHome", 'libelle'=> "Pub H", 'modifier'=> '', 'align'=> "_center")					
					,array('sortField'=> "officiel_laUne", 'libelle'=> "Une", 'modifier'=> '', 'align'=> "_center")					
					,array('sortField'=> "officiel_dateCreation", 'libelle'=> "Cr&eacute;. le", 'modifier'=> '', 'align'=> "_center")									
					,array('sortField'=> "officiel_dateModification", 'libelle'=> "Mod. le", 'modifier'=> '', 'align'=> "_center")									
					,array('sortField'=> "officiel_datePublication", 'libelle'=> "Pub. le", 'modifier'=> '', 'align'=> "_center")									
					);	
					
		//Affichage
		$this->_tpl->assign('i', 0);
		$this->_tpl->assign('nbPage', $nbPage);
		$this->_tpl->assign('toOfficiel', $toOfficiel);
		$this->_tpl->assign('tHead', $tHead);
		
		$this->_tpl->assign('page', $this->page);
		$this->_tpl->assign('tParams', $tParams);
		$this->_tpl->assign('sortField', $this->sortField);
		$this->_tpl->assign('sortDirection', $this->sortDirection);
	}
}
?>
