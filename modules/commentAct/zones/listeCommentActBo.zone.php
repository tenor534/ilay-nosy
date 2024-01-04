<?php
/**
* @package ilay-nosy
* @subpackage utilisateur
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Zone affichant la liste des utilisateurs
*
* @package ilay-nosy
* @subpackage utilisateur
*/
class listeUtilisateurBoZone extends jZone {
 
	/**
	* Nom du template HTML
	*/
	protected $_tplname='utilisateur~listeUtilisateurBo.zone';

	/**
	* Tri par défaut de la liste
	*/
	public $sortField = 'utilisateur_nom';

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

		$tParams = array('zone'=> $this->getParam('zone','utilisateur~listeUtilisateurBo'));
		
		//Chargement des données
		jClasses::inc('utilisateur~utilisateurSrv');
		jClasses::inc('commun~tools');
		
		if ($this->page > 1){
			$iDebutListe = ($this->page-1) * PAGINATION_NBITEMPARPAGE ; 
		}else{
			$iDebutListe = 0 ;
		}
		
		$tResult = array('iNbEnreg'=>0, 'listeUtilisateur'=>array());

		$tResult = utilisateurSrv::chargeListeUtilisateur($this->sortField, $this->sortDirection,$iDebutListe);	
	
		$nbPage = ceil($tResult['iNbEnreg'] / PAGINATION_NBITEMPARPAGE) ;		
		
		$toUtilisateur = array();		
		foreach($tResult['listeUtilisateur'] as $zKey => $oUtilisateur){
		
			switch( $oUtilisateur->utilisateur_civilite ){
				case 1 : 
					$oUtilisateur->utilisateur_titre = "Monsieur";
					break;
				case 2 : 
					$oUtilisateur->utilisateur_titre = "Madame";
					break;
				case 3 : 
					$oUtilisateur->utilisateur_titre = "Mademoiselle";
					break;
				default:	
					$oUtilisateur->utilisateur_titre = "Monsieur";
					break;
			}

			switch( $oUtilisateur->utilisateur_statut ){
				case 0 : 
					$oUtilisateur->utilisateur_etat = "Supprim&eacute;";
					break;
				case 1 : 
					$oUtilisateur->utilisateur_etat = "Activ&eacute;";
					break;
				case 2 : 
					$oUtilisateur->utilisateur_etat = "Desactiv&eacute;";
					break;
				case 3 : 
					$oUtilisateur->utilisateur_etat = "En attente";
					break;
				default:	
					$oUtilisateur->utilisateur_etat = "Activ&eacute;";
					break;
			}			
			
		
			$oUtilisateur->utilisateur_nom 				= stripslashes($oUtilisateur->utilisateur_nom);
			$oUtilisateur->utilisateur_prenom 			= stripslashes($oUtilisateur->utilisateur_prenom);
			$oUtilisateur->utilisateur_fonction 		= stripslashes($oUtilisateur->utilisateur_fonction);
			$oUtilisateur->utilisateur_dateNaissance 	= stripslashes($oUtilisateur->utilisateur_dateNaissance);
			
			$oUtilisateur->utilisateur_adresse 			= stripslashes($oUtilisateur->utilisateur_adresse);
			$oUtilisateur->utilisateur_cp 				= stripslashes($oUtilisateur->utilisateur_cp);
			$oUtilisateur->utilisateur_ville 			= stripslashes($oUtilisateur->utilisateur_ville);
			
			$oUtilisateur->utilisateur_societe 			= stripslashes($oUtilisateur->utilisateur_societe);
			$oUtilisateur->utilisateur_telephone 		= stripslashes($oUtilisateur->utilisateur_telephone);
			$oUtilisateur->utilisateur_email 			= stripslashes($oUtilisateur->utilisateur_email);
			$oUtilisateur->utilisateur_login 			= stripslashes($oUtilisateur->utilisateur_login);
			$oUtilisateur->utilisateur_password 		= stripslashes($oUtilisateur->utilisateur_password);
			$oUtilisateur->utilisateur_dateCreation 	= stripslashes($oUtilisateur->utilisateur_dateCreation);
			$oUtilisateur->utilisateur_dateModification = stripslashes($oUtilisateur->utilisateur_dateModification);

			$oUtilisateur->utilisateur_reponse 			= stripslashes($oUtilisateur->utilisateur_reponse);
			$oUtilisateur->utilisateur_commentAct 			= stripslashes($oUtilisateur->utilisateur_commentAct);
			$oUtilisateur->utilisateur_url 				= stripslashes($oUtilisateur->utilisateur_url);

			$oUtilisateur->profil_code 					= stripslashes($oUtilisateur->profil_code);
			$oUtilisateur->pays_code 					= stripslashes($oUtilisateur->pays_code);

			array_push($toUtilisateur, $oUtilisateur);
		}		

		$tHead = array(
					 array('sortField'=> "utilisateur_titre", 'libelle'=> "Civilit&eacute;", 'modifier'=> '', 'align'=> "_left")					
					,array('sortField'=> "utilisateur_prenom", 'libelle'=> "Pr&eacute;nom", 'modifier'=> '', 'align'=> "_left")					
					,array('sortField'=> "utilisateur_nom", 'libelle'=> "Nom", 'modifier'=> '', 'align'=> "_left")					
					,array('sortField'=> "utilisateur_email", 'libelle'=> "Email", 'modifier'=> '', 'align'=> "_left")					
					,array('sortField'=> "profil_code", 'libelle'=> "Profil", 'modifier'=> '', 'align'=> "_center")					
					,array('sortField'=> "pays_code", 'libelle'=> "Pays", 'modifier'=> '', 'align'=> "_center")					
					,array('sortField'=> "utilisateur_etat", 'libelle'=> "Statut", 'modifier'=> '', 'align'=> "_center")					
				
					);	
		//print_r ($oNavBar->tiPages) ;
		//Affichage
		$this->_tpl->assign('i', 0);
		$this->_tpl->assign('nbPage', $nbPage);
		$this->_tpl->assign('toUtilisateur', $toUtilisateur);
		$this->_tpl->assign('tHead', $tHead);
		
		$this->_tpl->assign('page', $this->page);
		$this->_tpl->assign('tParams', $tParams);
		$this->_tpl->assign('sortField', $this->sortField);
		$this->_tpl->assign('sortDirection', $this->sortDirection);
	}
}
?>
