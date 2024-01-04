<?php
/**
* @package ilay-nosy
* @subpackage forum
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Zone affichant la liste des forums
*
* @package ilay-nosy
* @subpackage forum
*/
class listeForumBoZone extends jZone {
 
	/**
	* Nom du template HTML
	*/
	protected $_tplname='forum~listeForumBo.zone';

	/**
	* Tri par défaut de la liste
	*/
	public $sortField = 'forum_sortCode';

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

		$tParams = array('zone'=> $this->getParam('zone','forum~listeForumBo'));
		
		//Chargement des données
		jClasses::inc('forum~forumSrv');
		jClasses::inc('commun~tools');
		
		if ($this->page > 1){
			$iDebutListe = ($this->page-1) * RUBRIQUE_PAGINATION_NBITEMPARPAGE ; 
		}else{
			$iDebutListe = 0 ;
		}
		
		$tResult = array('iNbEnreg'=>0, 'listeForum'=>array());

		$tResult = forumSrv::chargeListeForum($this->sortField, $this->sortDirection,$iDebutListe);	
	
		$nbPage = ceil($tResult['iNbEnreg'] / RUBRIQUE_PAGINATION_NBITEMPARPAGE) ;		
		
		$toForum = array();		
		foreach($tResult['listeForum'] as $zKey => $oForum){
		
			$oForum->forum_level 		= stripslashes($oForum->forum_level);
			$oForum->forum_path 		= stripslashes($oForum->forum_path);
			$oForum->forum_libelle 	= stripslashes($oForum->forum_libelle);
			$oForum->forum_description 		= stripslashes($oForum->forum_description);
			
			$oForum->categorieFor_code	= stripslashes($oForum->categorieFor_code);

			array_push($toForum, $oForum);
		}		

		$tHead = array(
					 array('sortField'=> "categorieFor_code", 'libelle'=> "Cat&eacute;gorie", 'modifier'=> '', 'align'=> "_left")					
					,array('sortField'=> "forum_level", 'libelle'=> "Level", 'modifier'=> '', 'align'=> "_left")					
					,array('sortField'=> "forum_sortCode", 'libelle'=> "SortCode", 'modifier'=> '', 'align'=> "_center")					
					,array('sortField'=> "forum_path", 'libelle'=> "Path", 'modifier'=> '', 'align'=> "_left")					
					,array('sortField'=> "forum_libelle", 'libelle'=> "Libelle", 'modifier'=> '', 'align'=> "_left")					
					);	
		//print_r ($oNavBar->tiPages) ;
		//Affichage
		$this->_tpl->assign('i', 0);
		$this->_tpl->assign('nbPage', $nbPage);
		$this->_tpl->assign('toForum', $toForum);
		$this->_tpl->assign('tHead', $tHead);
		
		$this->_tpl->assign('page', $this->page);
		$this->_tpl->assign('tParams', $tParams);
		$this->_tpl->assign('sortField', $this->sortField);
		$this->_tpl->assign('sortDirection', $this->sortDirection);
	}
}
?>
