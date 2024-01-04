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
class contentPageMainActualiteEditFoZone extends jZone {
 
	/**
	* Nom du template HTML
	*/
    protected $_tplname='actualite~contentPageMainActualiteEditFo.zone';

	protected $_useCache = false;

	/**
	* Tri par défaut de la liste
	*/
	public $sortField = 'actualite_titre';

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
	* Actualite a afficher
	*/
	public $acid = 0;

	/**
	* Province a afficher
	*/
	public $pid = 0;

	/**
	* Localite a afficher
	*/
	public $lid = 0;

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
		if ($this->getParam('acid')) {
			$this->acid = $this->getParam('acid');
		}	

		//Chargement des données
		jClasses::inc('utilisateur~utilisateurSrv');
		jClasses::inc('forfait~forfaitSrv');
		jClasses::inc('abonnement~abonnementSrv');
		jClasses::inc('categorieAct~categorieActSrv');
		jClasses::inc('rubrique~rubriqueSrv');
		jClasses::inc('actualite~actualiteSrv');
		jClasses::inc('photoAct~photoActSrv');
		
		if ($this->acid != 0) {
			try {
				$actualite = actualiteSrv::chargeActualite($this->acid);
				
			} catch(Exception $oJException) {
				throw new JException ($oJException->getLocaleKey()) ;
			}				
		}else{
			$actualite = actualiteSrv::getDaoActualite();

			$actualite->actualite_id 			= 0;			
			$actualite->actualite_abonnementId 	= $this->aid;			
			$actualite->actualite_rubriqueId 	= 0;			

			$actualite->actualite_statut = USER_STATUT_ON;			
		}

		$this->raid = $actualite->actualite_rubriqueId;
		if($this->raid){
			$rubrique 	= rubriqueSrv::getRubrique($this->raid);
			$this->caid = $rubrique->rubrique_categorieActId;
		}else{
			$this->caid = 0;
		}
		
		$actualite->actualite_prix = ($actualite->actualite_prix)?floatval($actualite->actualite_prix) : "";
		$actualite->actualite_annee = ($actualite->actualite_annee)? $actualite->actualite_annee : "";		

		//////////////////////////////////////////////////////////////////////////////////////
		$this->lid = $actualite->actualite_localiteId;
		//////////////////////////////////////////////////////////////////////////////////////
		if($this->lid){
			$localite 	= actualiteSrv::getLocalite($this->lid);
			$this->pid = $localite->localite_provinceId;
		}else{
			$this->pid = 0;
		}	
		
		$tParams = array('aid'=> $this->aid,'acid'=> $this->acid, 'page'=> $this->page);

		//Utilisateur en cours
		$utilisateur 	= utilisateurSrv::infosMembre($idUtilisateurId);
		//Abonnemnet en cours
		$toAbonnement 	= abonnementSrv::chargeAbonnement($this->aid);
		//Forfait en cours
		$toForfait 		= forfaitSrv::chargeForfait($toAbonnement->abonnement_forfaitId);
		//Photos en cours
		$toPhotos 		= photoActSrv::getAllPhoto($this->acid);		
		
		//CategorieAct :  selon le pack
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

		$toCategorieActs	= categorieActSrv::chargeAllCategorieActIn($inCategorie);		
		
		//Rubriques
		$toRubriques	= rubriqueSrv::getAllRubrique($this->caid);

		//Provinces
		$toProvinces	= actualiteSrv::chargeListProvinceAllFo();
		//Localite par province
		$toLocalites	= actualiteSrv::getAllLocalite($this->pid);
		
		//En mode modification
		if ($this->acid != 0){
			//la première photo
			if(sizeof($toPhotos)){
				$actualite->actualite_photo = $toPhotos[0]->photo_photo;
			}else{
				$actualite->actualite_photo = "noPhoto.jpg";
			}
			
			//Calcule le nombre de photo possible pour l'actualite selon le forfait choisi
			$nbPhotos 		= $toForfait->forfait_nbPhoto + $toForfait->forfait_nbPhotoAdd;
			$nbPhotoToAdd 	= $nbPhotos - sizeof($toPhotos);
			
			if($nbPhotoToAdd > 0){
				for($i=0; $i<$nbPhotoToAdd; $i++){				
					$photo = photoActSrv::getDaoPhoto();				
					$photo->id		= 0;
					$photo->actualiteId	= $this->acid;
					$photo->photo 	= "noPhoto.jpg";
					$idPhoto = photoActSrv::sauvegardePhoto($photo);
				}					
				//Photos en cours
				$toPhotos 		= photoActSrv::getAllPhoto($this->acid);					
			}						
		}	

		//Pagination interne : Actualite précedente, Actualite suivante
		$tResult = actualiteSrv::chargeListeActualiteFo($idUtilisateurId, $this->aid, $this->sortField, $this->sortDirection,0, 1);	
		//echo $tResult['iNbEnreg'];
		$iFirst 	= 0;
		$iBack 		= 0;		
		$iCurrent 	= 0;
		$iNext 		= 0;
		$iLast 		= 0;
		$toActualite 	= $tResult['listeActualite'];				
		$nbList 	= $tResult['iNbEnreg']; 
		for($i=0; $i<$nbList; $i++){
			//Début de liste
			if($i == 0){
				$iFirst = $toActualite[$i]->actualite_id;
			}

			//Current
			if($toActualite[$i]->actualite_id == $this->acid){				
				
				$iBack 		= isset($toActualite[$i-1]->actualite_id)?$toActualite[$i-1]->actualite_id:0;			
				$iCurrent 	= $toActualite[$i]->actualite_id;			
				$iNext 		= isset($toActualite[$i+1]->actualite_id)?$toActualite[$i+1]->actualite_id:0;			
			}

			//Fin de liste
			if($i == ($nbList - 1)){
				$iLast = $toActualite[$i]->actualite_id;
			}			
		}		
		$iFirst 	= ($iFirst == $this->acid)?0:$iFirst;
		$iBack 		= ($iBack == $this->acid)?0:$iBack;
		$iNext 		= ($iNext == $this->acid)?0:$iNext;
		$iLast 		= ($iLast == $this->acid)?0:$iLast;
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
		
		$this->_tpl->assign('actualite', $actualite);													
		$this->_tpl->assign('utilisateur', $utilisateur);													
		$this->_tpl->assign('toPhotos', $toPhotos);													

		$this->_tpl->assign('toCategorieActs', $toCategorieActs);													
		$this->_tpl->assign('toRubriques', $toRubriques);													

		$this->_tpl->assign('toProvinces', $toProvinces);													
		$this->_tpl->assign('toLocalites', $toLocalites);													

		$this->_tpl->assign("acid", $this->acid);		
		$this->_tpl->assign("aid", $this->aid);		
		$this->_tpl->assign("page", $this->page);

		$this->_tpl->assign("caid", $this->caid);		
		$this->_tpl->assign("raid", $this->raid);		

		$this->_tpl->assign("pid", $this->pid);		
		$this->_tpl->assign("lid", $this->lid);		
	}
}
?>