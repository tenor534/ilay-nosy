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
* Zone affichant les actualites en cours dans l'espace membre pour un utilisateur connecté FO
*
* @package ilay-nosy
* @subpackage membre
*/
class contentPageMainResultListAbregeFoZone extends jZone {
	  
 
	/**
	* Nom du template HTML
	*/
    protected $_tplname='actualite~contentPageMainResultListAbregeFo.zone';

	protected $_useCache = false;

	/**
	* Tri par défaut de la liste
	*/
	public $sortField = 'categorieAct_libelle ASC, actualite_datePublication';

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
		jClasses::inc('categorieAct~categorieActSrv');
		jClasses::inc('actualite~actualiteSrv');
		jClasses::inc('photoAct~photoActSrv');
		jClasses::inc('commentAct~commentActSrv');		
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
			$tCid 	= categorieActSrv::chargeCategorieAct($this->cid);
			$zCid = $tCid->categorieAct_libelle;
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

		$tParams = array('zone'=> $this->getParam('zone','actualite~contentPageMainResultListAbregeFo'), 'nbPagination'=> $this->nbPagination, 'affichage'=> $this->affichage, 'cid'=> $this->cid, 'mot'=> $this->mot, 'parution'=> $this->parution);
	
		
		if ($this->page > 1){
			$iDebutListe = ($this->page-1) * $this->nbPagination; 
		}else{
			$iDebutListe = 0 ;
		}
		
		$tResult = array('iNbEnreg'=>0, 'listeActualite'=>array());

		$tResult = actualiteSrv::chargeListeActualiteRechercheFo($this->cid, $this->mot, $this->parution, $this->sortField, $this->sortDirection, $iDebutListe, 0, $this->nbPagination);
		//print_r( $tResult);	
	
		$nbPage = ceil($tResult['iNbEnreg'] / $this->nbPagination) ;		
		
		$toActualite = array();		
		foreach($tResult['listeActualite'] as $zKey => $oActualite){
			
			$oActualite->actualite_reference 	= stripslashes($oActualite->actualite_reference);
			$oActualite->actualite_titre 		= stripslashes($oActualite->actualite_titre);
			$oActualite->actualite_resume 		= nl2br(stripslashes($oActualite->actualite_resume));
			$oActualite->actualite_texte 		= nl2br(stripslashes($oActualite->actualite_texte));			
			$oActualite->actualite_photo 		= stripslashes($oActualite->actualite_photo);
			$oActualite->actualite_source 		= stripslashes($oActualite->actualite_source);
			$oActualite->actualite_fichier 		= stripslashes($oActualite->actualite_fichier);

			$oActualite->categorieAct_libelle 	= stripslashes($oActualite->categorieAct_libelle);
			$oActualite->categorieAct_code 		= stripslashes($oActualite->categorieAct_code);

			//la première photo
			$toPhoto = photoActSrv::getAllPhoto($oActualite->actualite_id);		
			
			if(sizeof($toPhoto)){
				//$oActualite->actualite_photo = $toPhoto[0]->photo_photo;
			}else{
				//$oActualite->actualite_photo = "noPhoto.jpg";
			}

			$oActualite->actualite_datePublication = tools::formatToLongDateTime($oActualite->actualite_datePublication, "-", 'fr', 'abrege');

			//COMMENTAIRES
			$toComments  		= commentActSrv::getAllCommentAct($oActualite->actualite_id);		
			$oActualite->actualite_nbComment = sizeof($toComments);

			//PHOTOS
			$toPhotos  		= photoActSrv::getAllPhotoAct($oActualite->actualite_id);		
			$oActualite->actualite_nbPhoto = sizeof($toPhotos) + 1;

			array_push($toActualite, $oActualite);		
		}

		$tHead = array(
					 array('sortField'=> "actualite_photo", 'libelle'=> "Photo", 'modifier'=> '', 'align'=> "_left", 'class'=> 'annonceHead0')					
					,array('sortField'=> "categorieAct_libelle", 'libelle'=> "Cat&eacute;gorie", 'modifier'=> '', 'align'=> "_left", 'class'=> 'annonceHead1')					
					,array('sortField'=> "actualite_titre", 'libelle'=> "Titre", 'modifier'=> '', 'align'=> "_left", 'class'=> 'annonceHead1')					
					//,array('sortField'=> "actualite_resume", 'libelle'=> "R&eacute;sum&eacute;", 'modifier'=> '', 'align'=> "_left", 'class'=> 'annonceHead2')					
					,array('sortField'=> "actualite_datePublication", 'libelle'=> "Parution", 'modifier'=> '', 'align'=> "_center", 'class'=> 'annonceHead5')									
					);	
					
		//Affichage
		$this->_tpl->assign('i', 0);
		$this->_tpl->assign('nbPage', $nbPage);
		$this->_tpl->assign('toActualite', $toActualite);
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