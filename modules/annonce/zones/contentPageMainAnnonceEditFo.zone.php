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
* Zone affichant les annonces en cours dans l'espace membre pour un utilisateur connecté FO
*
* @package ilay-nosy
* @subpackage membre
*/
class contentPageMainAnnonceEditFoZone extends jZone {
 
	/**
	* Nom du template HTML
	*/
    protected $_tplname='annonce~contentPageMainAnnonceEditFo.zone';

	protected $_useCache = false;

	/**
	* Tri par défaut de la liste
	*/
	public $sortField = 'annonce_titre';

	/**
	* Ordre de tri par défaut de la liste
	*/
	public $sortDirection = 'ASC';

	/**
	* Page a afficher
	*/
	public $page = 1;

	/**
	* Abonnement a afficher
	*/
	public $aid = 0;

	/**
	* Annonce a afficher
	*/
	public $anid = 0;

	/**
	* Province a afficher
	*/
	public $pid = 0;

	/**
	* Localite a afficher
	*/
	public $lid = 0;

	/**
	* Caracteristique a afficher
	*/
	public $caracteristique = "";

	/**
	* Chargement des données pour affichage
	*/
	protected function _prepareTpl(){

		//Session utilisateur
		$idUtilisateurId = $_SESSION['SESSION_MEMBRE_ID'];

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
		if ($this->getParam('aid')) {
			$this->aid = $this->getParam('aid');
		}	
		if ($this->getParam('anid')) {
			$this->anid = $this->getParam('anid');
		}	
		if ($this->getParam('caracteristique')) {
			$this->caracteristique = $this->getParam('caracteristique');
		}

		//Chargement des données
		jClasses::inc('utilisateur~utilisateurSrv');
		jClasses::inc('forfait~forfaitSrv');
		jClasses::inc('abonnement~abonnementSrv');
		jClasses::inc('categorieAn~categorieAnSrv');
		jClasses::inc('rubrique~rubriqueSrv');
		jClasses::inc('annonce~annonceSrv');
		jClasses::inc('photo~photoSrv');
		
		if ($this->anid != 0) {
			try {
				$annonce = annonceSrv::chargeAnnonce($this->anid);
				
			} catch(Exception $oJException) {
				throw new JException ($oJException->getLocaleKey()) ;
			}				
		}else{
			$annonce = annonceSrv::getDaoAnnonce();

			$annonce->annonce_id 			= 0;			
			$annonce->annonce_abonnementId 	= $this->aid;			
			$annonce->annonce_rubriqueId 	= 0;			

			$annonce->annonce_statut = USER_STATUT_ON;			
		}

		$this->raid = $annonce->annonce_rubriqueId;
		if($this->raid){
			$rubrique 	= rubriqueSrv::getRubrique($this->raid);
			$this->caid = $rubrique->rubrique_categorieAnId;
		}else{
			$this->caid = 0;
		}
		
		$annonce->annonce_prix = ($annonce->annonce_prix)?floatval($annonce->annonce_prix) : "";
		$annonce->annonce_annee = ($annonce->annonce_annee)? $annonce->annonce_annee : "";		

		//////////////////////////////////////////////////////////////////////////////////////
		$this->lid = $annonce->annonce_localiteId;
		//////////////////////////////////////////////////////////////////////////////////////
		if($this->lid){
			$localite 	= annonceSrv::getLocalite($this->lid);
			$this->pid = $localite->localite_provinceId;
		}else{
			$this->pid = 0;
		}	
		
		$tParams = array('aid'=> $this->aid,'anid'=> $this->anid, 'page'=> $this->page);

		//Utilisateur en cours
		$utilisateur 	= utilisateurSrv::infosMembre($idUtilisateurId);
		//Abonnemnet en cours
		$toAbonnement 	= abonnementSrv::chargeAbonnement($this->aid);
		//Forfait en cours
		$toForfait 		= forfaitSrv::chargeForfait($toAbonnement->abonnement_forfaitId);
		//Photos en cours
		$toPhotos 		= photoSrv::getAllPhoto($this->anid);		
		
		//CategorieAn :  selon le pack
		$inCategorie = "";
		switch($toForfait->forfait_packId){
			case PACK_VEHICULES:
				$inCategorie = CATEGORIE_VEHICULES;
				break;
			case PACK_IMMOBILIERS:
				$inCategorie = CATEGORIE_IMMOBILIERS;
				break;
			case PACK_EMPLOIS:
				$inCategorie = CATEGORIE_EMPLOIS;
				break;
			default:
				$inCategorie = CATEGORIE_ANNONCES;
				break;
		}	

		$toCategorieAns	= categorieAnSrv::chargeAllCategorieAnIn($inCategorie);		
		
		//Rubriques
		$toRubriques	= rubriqueSrv::getAllRubrique($this->caid);

		//Provinces
		$toProvinces	= annonceSrv::chargeListProvinceAllFo();
		//Localite par province
		$toLocalites	= annonceSrv::getAllLocalite($this->pid);
		
		//En mode modification
		if ($this->anid != 0){
			//la première photo
			if(sizeof($toPhotos)){
				$annonce->annonce_photo = $toPhotos[0]->photo_photo;
			}else{
				$annonce->annonce_photo = "noPhoto.jpg";
			}
			
			//Calcule le nombre de photo possible pour l'annonce selon le forfait choisi
			$nbPhotos 		= $toForfait->forfait_nbPhoto + $toForfait->forfait_nbPhotoAdd;
			$nbPhotoToAdd 	= $nbPhotos - sizeof($toPhotos);
			
			if($nbPhotoToAdd > 0){
				for($i=0; $i<$nbPhotoToAdd; $i++){				
					$photo = photoSrv::getDaoPhoto();				
					$photo->id		= 0;
					$photo->annonceId	= $this->anid;
					$photo->photo 	= "noPhoto.jpg";
					$idPhoto = photoSrv::sauvegardePhoto($photo);
				}					
				//Photos en cours
				$toPhotos 		= photoSrv::getAllPhoto($this->anid);					
			}						
		}	

		//Pagination interne : Annonce précedente, Annonce suivante
		$tResult = annonceSrv::chargeListeAnnonceFo($idUtilisateurId, $this->aid, $this->sortField, $this->sortDirection,0, 1);	
		//echo $tResult['iNbEnreg'];
		$iFirst 	= 0;
		$iBack 		= 0;		
		$iCurrent 	= 0;
		$iNext 		= 0;
		$iLast 		= 0;
		$toAnnonce 	= $tResult['listeAnnonce'];				
		$nbList 	= $tResult['iNbEnreg']; 
		$nbList 	= sizeof($toAnnonce);
		
		for($i=0; $i<$nbList; $i++){
			//Début de liste
			if($i == 0){
				$iFirst = $toAnnonce[$i]->annonce_id;
			}

			//Current
			if($toAnnonce[$i]->annonce_id == $this->anid){				
				
				$iBack 		= isset($toAnnonce[$i-1]->annonce_id)?$toAnnonce[$i-1]->annonce_id:0;			
				$iCurrent 	= $toAnnonce[$i]->annonce_id;			
				$iNext 		= isset($toAnnonce[$i+1]->annonce_id)?$toAnnonce[$i+1]->annonce_id:0;			
			}

			//Fin de liste
			if($i == ($nbList - 1)){
				$iLast = $toAnnonce[$i]->annonce_id;
			}			
		}		
		$iFirst 	= ($iFirst == $this->anid)?0:$iFirst;
		$iBack 		= ($iBack == $this->anid)?0:$iBack;
		$iNext 		= ($iNext == $this->anid)?0:$iNext;
		$iLast 		= ($iLast == $this->anid)?0:$iLast;
		//Fin pagination
				
		
		$this->_tpl->assign('tParams', $tParams);
		
		$this->_tpl->assign('iFirst', $iFirst);													
		$this->_tpl->assign('iBack', $iBack);													
		$this->_tpl->assign('iCurrent', $iCurrent);													
		$this->_tpl->assign('iNext', $iNext);													
		$this->_tpl->assign('iLast', $iLast);													
		$this->_tpl->assign('sortField', $this->sortField);													
		$this->_tpl->assign('sortDirection', $this->sortDirection);													

		$this->_tpl->assign("toAbonnement", $toAbonnement);		
		$this->_tpl->assign("toForfait", $toForfait);		
		
		$this->_tpl->assign('annonce', $annonce);													
		$this->_tpl->assign('utilisateur', $utilisateur);													
		$this->_tpl->assign('toPhotos', $toPhotos);													

		$this->_tpl->assign('toCategorieAns', $toCategorieAns);													
		$this->_tpl->assign('toRubriques', $toRubriques);													

		$this->_tpl->assign('toProvinces', $toProvinces);													
		$this->_tpl->assign('toLocalites', $toLocalites);													

		$this->_tpl->assign("anid", $this->anid);		
		$this->_tpl->assign("aid", $this->aid);		
		$this->_tpl->assign("page", $this->page);

		$this->_tpl->assign("caid", $this->caid);		
		$this->_tpl->assign("raid", $this->raid);		

		$this->_tpl->assign("pid", $this->pid);		
		$this->_tpl->assign("lid", $this->lid);	
			
		$this->_tpl->assign("caracteristique", $this->caracteristique);		
		
	}
}
?>