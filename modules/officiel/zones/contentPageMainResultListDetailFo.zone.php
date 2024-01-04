<?php
/**
* @package ilay-nosy
* @subpackage membre
* @version  1
* @author DWORD Consulting SARL
*/

/**
* JSON
*/
//require_once (LIB_PATH.'json/JSON.php');


/**
* Zone affichant les officiels en cours dans l'espace membre pour un utilisateur connecté FO
*
* @package ilay-nosy
* @subpackage membre
*/
class contentPageMainResultListDetailFoZone extends jZone {
	  
 
	/**
	* Nom du template HTML
	*/
    protected $_tplname='officiel~contentPageMainResultListDetailFo.zone';

	protected $_useCache = false;

	/**
	* Tri par défaut de la liste
	*/
	public $sortField = 'categorieOff_libelle ASC, officiel_datePublication';

	/**
	* Ordre de tri par défaut de la liste
	*/
	public $sortDirection = 'DESC';

	/**
	* Nb de pagination par défaut de la liste
	*/
	public $nbPagination = 5;


	/**
	* Page a afficher
	*/
	public $page = 1;

	/**
	* Catégorie
	*/
	public $cid = 0;

	/**
	* Mot clé
	*/
	public $mot = "";

	/**
	* Parution
	*/
	public $parution = 0;

	/**
	* Affichage
	*/
	public $affichage = 0;

	/**
	* Chargement des données pour affichage
	*/
	protected function _prepareTpl(){

		//Chargement des données
		jClasses::inc('categorieOff~categorieOffSrv');
		jClasses::inc('officiel~officielSrv');
		jClasses::inc('photoOff~photoOffSrv');
		jClasses::inc('commentOff~commentOffSrv');		
		jClasses::inc('commun~tools');

		//Session utilisateur
		//$idUtilisateurId = $_SESSION['SESSION_MEMBRE_ID'];
		if (isset($_SESSION['SESSION_MEMBRE_ID'])) {
			$idUtilisateurId = $_SESSION['SESSION_MEMBRE_ID'];
		}else{
			$idUtilisateurId = 0;
		}

		//Récupération des paramètres de pagination
		if ($this->getParam('sortField')) {
			$this->sortField = $this->getParam('sortField');
		}
		if ($this->getParam('sortDirection')) {
			$this->sortDirection = $this->getParam('sortDirection');
		}
		if ($this->getParam('page')) {
			$this->page = $this->getParam('page');			
		}
		if ($this->getParam('nbPagination')) {
			$this->nbPagination = $this->getParam('nbPagination');			
		}
		
		
		//Récupération des paramètres de recherche
		$zCid = "";
		if ($this->getParam('cid')) {
			$this->cid = $this->getParam('cid');
			$tCid 	= categorieOffSrv::chargeCategorieOff($this->cid);
			$zCid = $tCid->categorieOff_libelle;
		}	
		$zMot = "";
		if ($this->getParam('mot')) {
			$this->mot = $this->getParam('mot');
			$zMot = $this->mot;
		}	
		$zParution = "";
		if ($this->getParam('parution')) {
			$this->parution = $this->getParam('parution');

			switch($this->parution){
				case 1: //1jour
					$zParution .=	"1 jour";
					break;
				case 2: //2jour
					$zParution .=	"2 jours";
					break;
				case 3: //3jour
					$zParution .=	"3 jours";
					break;
				case 4: //1semaine
					$zParution .=	"1 semaine";
					break;
				case 5: //2semaines
					$zParution .=	"2 semaines";
					break;
				case 6: //1mois
					$zParution .=	"1 mois";
					break;
				case 7: //2 mois
					$zParution .=	"2 mois";
					break;							
			}			
		}	

		//Récupération des paramètres d'affichage
		$zAffichage = "";
		if ($this->getParam('affichage')) {
			$this->affichage = $this->getParam('affichage');
			$zAffichage = $this->affichage;
		}

		$tParams = array('zone'=> $this->getParam('zone','officiel~contentPageMainResultListDetailFo'), 'nbPagination'=> $this->nbPagination, 'affichage'=> $this->affichage, 'cid'=> $this->cid, 'mot'=> $this->mot, 'parution'=> $this->parution);
	
		
		if ($this->page > 1){
			$iDebutListe = ($this->page-1) * $this->nbPagination; 
		}else{
			$iDebutListe = 0 ;
		}
		
		$tResult = array('iNbEnreg'=>0, 'listeOfficiel'=>array());

		$tResult = officielSrv::chargeListeOfficielRechercheFo($this->cid, $this->mot, $this->parution, $this->sortField, $this->sortDirection, $iDebutListe, 0, $this->nbPagination);
		//print_r( $tResult);	
	
		$nbPage = ceil($tResult['iNbEnreg'] / $this->nbPagination) ;		
		
		$toOfficiel = array();		
		foreach($tResult['listeOfficiel'] as $zKey => $oOfficiel){
			
			$oOfficiel->officiel_reference 	= stripslashes($oOfficiel->officiel_reference);
			$oOfficiel->officiel_titre 		= stripslashes($oOfficiel->officiel_titre);
			$oOfficiel->officiel_resume 		= nl2br(stripslashes($oOfficiel->officiel_resume));
			$oOfficiel->officiel_texte 		= nl2br(stripslashes($oOfficiel->officiel_texte));			
			$oOfficiel->officiel_photo 		= stripslashes($oOfficiel->officiel_photo);

			$oOfficiel->officiel_source 		= stripslashes($oOfficiel->officiel_source);
			$oOfficiel->officiel_fichier 		= stripslashes($oOfficiel->officiel_fichier);

			$oOfficiel->categorieOff_libelle 	= stripslashes($oOfficiel->categorieOff_libelle);
			$oOfficiel->categorieOff_code 		= stripslashes($oOfficiel->categorieOff_code);

			//la première photo
			$toPhoto = photoOffSrv::getAllPhoto($oOfficiel->officiel_id);		
			
			if(sizeof($toPhoto)){
				//$oOfficiel->officiel_photo = $toPhoto[0]->photo_photo;
			}else{
				//$oOfficiel->officiel_photo = "noPhoto.jpg";
			}

			$oOfficiel->officiel_datePublication = tools::formatToLongDateTime($oOfficiel->officiel_datePublication, "-", 'fr', 'abrege');

			//COMMENTAIRES
			$toComments  		= commentOffSrv::getAllCommentOff($oOfficiel->officiel_id);		
			$oOfficiel->officiel_nbComment = sizeof($toComments);

			//PHOTOS
			$toPhotos  		= photoOffSrv::getAllPhotoOff($oOfficiel->officiel_id);		
			$oOfficiel->officiel_nbPhoto = sizeof($toPhotos) + 1;

			array_push($toOfficiel, $oOfficiel);		
		}

		$tHead = array(
					 array('sortField'=> "officiel_photo", 'libelle'=> "Photo", 'modifier'=> '', 'align'=> "_left", 'class'=> 'annonceHead0')					
					,array('sortField'=> "categorieOff_libelle", 'libelle'=> "Cat&eacute;gorie", 'modifier'=> '', 'align'=> "_left", 'class'=> 'annonceHead1')					
					,array('sortField'=> "officiel_titre", 'libelle'=> "Titre", 'modifier'=> '', 'align'=> "_left", 'class'=> 'annonceHead1')					
					//,array('sortField'=> "officiel_resume", 'libelle'=> "R&eacute;sum&eacute;", 'modifier'=> '', 'align'=> "_left", 'class'=> 'annonceHead2')					
					,array('sortField'=> "officiel_datePublication", 'libelle'=> "Parution", 'modifier'=> '', 'align'=> "_center", 'class'=> 'annonceHead5')									
					);	
					
		//Affichage
		$this->_tpl->assign('i', 0);
		$this->_tpl->assign('nbPage', $nbPage);
		$this->_tpl->assign('toOfficiel', $toOfficiel);
		$this->_tpl->assign('tHead', $tHead);		
		
		$this->_tpl->assign('tParams', $tParams);
		$this->_tpl->assign('sortField', $this->sortField);
		$this->_tpl->assign('sortDirection', $this->sortDirection);
		$this->_tpl->assign('page', $this->page);

		$this->_tpl->assign('nbPagination', $this->nbPagination);
		$this->_tpl->assign('cid', $this->cid);
		$this->_tpl->assign('mot', $this->mot);
		$this->_tpl->assign('parution', $this->parution);
		$this->_tpl->assign('affichage', $this->affichage);
		
		$this->_tpl->assign('iDebutEnreg', $iDebutListe+1);
		$this->_tpl->assign('iFinEnreg', $iDebutListe + $this->nbPagination);
		$this->_tpl->assign('iNbEnreg', $tResult['iNbEnreg']);
		
		//Récap critères
		$this->_tpl->assign('zCid', $zCid);		
		$this->_tpl->assign('zMot', $zMot);
		$this->_tpl->assign('zParution', $zParution);
		$this->_tpl->assign('zAffichage', $zAffichage);
	}
}
?>