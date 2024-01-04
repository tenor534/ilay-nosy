<?php
/**
* @package ilay-nosy
* @subpackage actualite
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Zone affichant la liste des actualites
*
* @package ilay-nosy
* @subpackage actualite
*/
class listeActualiteBoZone extends jZone {
 
	/**
	* Nom du template HTML
	*/
	protected $_tplname='actualite~listeActualiteBo.zone';

	/**
	* Tri par défaut de la liste
	*/
	public $sortField = 'categorieAct_libelle, actualite_datePublication';

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
		jClasses::inc('actualite~actualiteSrv');
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

		$tParams = array('zone'=> $this->getParam('zone','actualite~listeActualiteBo'));
		
		
		if ($this->page > 1){
			$iDebutListe = ($this->page-1) * PAGINATION_NBITEMPARPAGE ; 
		}else{
			$iDebutListe = 0 ;
		}
		
		$tResult = array('iNbEnreg'=>0, 'listeActualite'=>array());

		$tResult = actualiteSrv::chargeListeActualite(0, $this->sortField, $this->sortDirection, $iDebutListe, $iListAll=0, PAGINATION_NBITEMPARPAGE);
	
		$nbPage = ceil($tResult['iNbEnreg'] / PAGINATION_NBITEMPARPAGE) ;		
		
		$toActualite = array();		
		foreach($tResult['listeActualite'] as $zKey => $oActualite){

			$oActualite->actualite_reference 	= stripslashes($oActualite->actualite_reference);
			$oActualite->actualite_titre 		= stripslashes($oActualite->actualite_titre);
			$oActualite->actualite_resume 		= stripslashes($oActualite->actualite_resume);
			$oActualite->actualite_texte 		= stripslashes($oActualite->actualite_texte);			
			$oActualite->actualite_photo 		= stripslashes($oActualite->actualite_photo);
			$oActualite->actualite_source 		= stripslashes($oActualite->actualite_source);
			$oActualite->actualite_fichier 		= stripslashes($oActualite->actualite_fichier);

			$oActualite->categorieAct_libelle 	= stripslashes($oActualite->categorieAct_libelle);
			$oActualite->categorieAct_code 		= stripslashes($oActualite->categorieAct_code);

			$dt = strtotime($oActualite->actualite_datePublication);			
			//echo "<br>".time()." - $dt = " . floor((time() - $dt) / 60 / 60 /24);
			$oActualite->actualite_parution 		=  floor((time() - $dt) / 60 / 60 /24);

			//La parution

			//la première photo
			$toPhoto = photoActSrv::getAllPhoto($oActualite->actualite_id);		
			
			if(sizeof($toPhoto)){
				//$oActualite->actualite_photo = $toPhoto[0]->photo_photo;
			}else{
				//$oActualite->actualite_photo = "noPhoto.jpg";
			}

			array_push($toActualite, $oActualite);		
		}

		$tHead = array(
					 array('sortField'=> "categorieAct_libelle", 'libelle'=> "Cat&eacute;g.", 'modifier'=> '', 'align'=> "_left")					
					,array('sortField'=> "actualite_photo", 'libelle'=> "Photo", 'modifier'=> '', 'align'=> "_left")					
					,array('sortField'=> "actualite_titre", 'libelle'=> "Titre", 'modifier'=> '', 'align'=> "_left")					
					,array('sortField'=> "actualite_publier", 'libelle'=> "Pub", 'modifier'=> '', 'align'=> "_center")					
					,array('sortField'=> "actualite_publierHome", 'libelle'=> "Pub H", 'modifier'=> '', 'align'=> "_center")					
					,array('sortField'=> "actualite_laUne", 'libelle'=> "Une", 'modifier'=> '', 'align'=> "_center")					
					,array('sortField'=> "actualite_dateCreation", 'libelle'=> "Cr&eacute;. le", 'modifier'=> '', 'align'=> "_center")									
					,array('sortField'=> "actualite_dateModification", 'libelle'=> "Mod. le", 'modifier'=> '', 'align'=> "_center")									
					,array('sortField'=> "actualite_datePublication", 'libelle'=> "Pub. le", 'modifier'=> '', 'align'=> "_center")									
					);	
					
		//Affichage
		$this->_tpl->assign('i', 0);
		$this->_tpl->assign('nbPage', $nbPage);
		$this->_tpl->assign('toActualite', $toActualite);
		$this->_tpl->assign('tHead', $tHead);
		
		$this->_tpl->assign('page', $this->page);
		$this->_tpl->assign('tParams', $tParams);
		$this->_tpl->assign('sortField', $this->sortField);
		$this->_tpl->assign('sortDirection', $this->sortDirection);
	}
}
?>
