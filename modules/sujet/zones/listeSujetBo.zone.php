<?php
/**
* @package ilay-nosy
* @subpackage sujet
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Zone affichant la liste des sujets
*
* @package ilay-nosy
* @subpackage sujet
*/
class listeSujetBoZone extends jZone {
 
	/**
	* Nom du template HTML
	*/
	protected $_tplname='sujet~listeSujetBo.zone';

	/**
	* Tri par défaut de la liste
	*/
	public $sortField = 'forum_libelle, sujet_datePublication';

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
		jClasses::inc('forum~forumSrv');
		jClasses::inc('sujet~sujetSrv');
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

		$tParams = array('zone'=> $this->getParam('zone','sujet~listeSujetBo'));
		
		
		if ($this->page > 1){
			$iDebutListe = ($this->page-1) * PAGINATION_NBITEMPARPAGE ; 
		}else{
			$iDebutListe = 0 ;
		}
		
		$tResult = array('iNbEnreg'=>0, 'listeSujet'=>array());

		$tResult = sujetSrv::chargeListeSujet(0, $this->sortField, $this->sortDirection, $iDebutListe, $iListAll=0, PAGINATION_NBITEMPARPAGE);
	
		$nbPage = ceil($tResult['iNbEnreg'] / PAGINATION_NBITEMPARPAGE) ;		
		
		$toSujet = array();		
		foreach($tResult['listeSujet'] as $zKey => $oSujet){

			$oSujet->sujet_reference 	= stripslashes($oSujet->sujet_reference);
			$oSujet->sujet_titre 		= stripslashes($oSujet->sujet_titre);
			$oSujet->sujet_resume 		= stripslashes($oSujet->sujet_resume);
			$oSujet->sujet_texte 		= stripslashes($oSujet->sujet_texte);			
			$oSujet->sujet_photo 		= stripslashes($oSujet->sujet_photo);
			$oSujet->sujet_source 		= stripslashes($oSujet->sujet_source);
			$oSujet->sujet_fichier 		= stripslashes($oSujet->sujet_fichier);

			$oSujet->forum_libelle 	= stripslashes($oSujet->forum_libelle);
			$oSujet->forum_code 		= stripslashes($oSujet->forum_code);

			$dt = strtotime($oSujet->sujet_datePublication);			
			//echo "<br>".time()." - $dt = " . floor((time() - $dt) / 60 / 60 /24);
			$oSujet->sujet_parution 		=  floor((time() - $dt) / 60 / 60 /24);

			//La parution

			//la première photo
			$toPhoto = photoActSrv::getAllPhoto($oSujet->sujet_id);		
			
			if(sizeof($toPhoto)){
				$oSujet->sujet_photo = $toPhoto[0]->photo_photo;
			}else{
				$oSujet->sujet_photo = "noPhoto.jpg";
			}

			array_push($toSujet, $oSujet);		
		}

		$tHead = array(
					 array('sortField'=> "forum_libelle", 'libelle'=> "Cat&eacute;g.", 'modifier'=> '', 'align'=> "_left")					
					,array('sortField'=> "sujet_photo", 'libelle'=> "Photo", 'modifier'=> '', 'align'=> "_left")					
					,array('sortField'=> "sujet_titre", 'libelle'=> "Titre", 'modifier'=> '', 'align'=> "_left")					
					,array('sortField'=> "sujet_publier", 'libelle'=> "Pub", 'modifier'=> '', 'align'=> "_center")					
					,array('sortField'=> "sujet_publierHome", 'libelle'=> "Pub H", 'modifier'=> '', 'align'=> "_center")					
					,array('sortField'=> "sujet_laUne", 'libelle'=> "Une", 'modifier'=> '', 'align'=> "_center")					
					,array('sortField'=> "sujet_dateCreation", 'libelle'=> "Cr&eacute;. le", 'modifier'=> '', 'align'=> "_center")									
					,array('sortField'=> "sujet_dateModification", 'libelle'=> "Mod. le", 'modifier'=> '', 'align'=> "_center")									
					,array('sortField'=> "sujet_datePublication", 'libelle'=> "Pub. le", 'modifier'=> '', 'align'=> "_center")									
					);	
					
		//Affichage
		$this->_tpl->assign('i', 0);
		$this->_tpl->assign('nbPage', $nbPage);
		$this->_tpl->assign('toSujet', $toSujet);
		$this->_tpl->assign('tHead', $tHead);
		
		$this->_tpl->assign('page', $this->page);
		$this->_tpl->assign('tParams', $tParams);
		$this->_tpl->assign('sortField', $this->sortField);
		$this->_tpl->assign('sortDirection', $this->sortDirection);
	}
}
?>
