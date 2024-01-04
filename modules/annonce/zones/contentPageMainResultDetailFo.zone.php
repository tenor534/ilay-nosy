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
class contentPageMainResultDetailFoZone extends jZone {
	  
 
	/**
	* Nom du template HTML
	*/
    protected $_tplname='annonce~contentPageMainResultDetailFo.zone';

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
	* Nb de pagination par défaut de la liste
	*/
	public $nbPagination = 5;


	/**
	* Page a afficher
	*/
	public $page = 1;

	/**
	* Annonce
	*/
	public $anid = 0;

	/**
	* Catégorie
	*/
	public $cid = 0;

	/**
	* Rubrique
	*/
	public $rid = 0;

	/**
	* Mot clé
	*/
	public $mot = "";

	/**
	* Rubrique ou Catégorie
	*/
	public $crid = 0;

	/**
	* Parution
	*/
	public $parution = 0;

	/**
	* Province
	*/
	public $province = 0;

	/**
	* Localité
	*/
	public $localite = 0;

	/**
	* Prix
	*/
	public $prix1 = 0;
	public $prix2 = 0;

	/**
	* Affichage
	*/
	public $affichage = 0;

	/**
	* Chargement des données pour affichage
	*/
	protected function _prepareTpl(){

		//Chargement des données
		jClasses::inc('categorieAn~categorieAnSrv');
		jClasses::inc('rubrique~rubriqueSrv');
		jClasses::inc('pack~packSrv');
		jClasses::inc('forfait~forfaitSrv');
		jClasses::inc('abonnement~abonnementSrv');
		jClasses::inc('annonce~annonceSrv');
		jClasses::inc('photo~photoSrv');
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
		
		
		//Récupération des paramètres de l'annonce
		if ($this->getParam('anid')) {
			$this->anid = $this->getParam('anid');
		}	

		//Récupération des paramètres de recherche
		$zCid = "";
		if ($this->getParam('cid')) {
			$this->cid = $this->getParam('cid');
			$tCid 	= categorieAnSrv::chargeCategorieAn($this->cid);
			$zCid = $tCid->categorieAn_libelle;
		}	
		$zRid = "";
		if ($this->getParam('rid')) {
			$this->rid = $this->getParam('rid');
			$tRid 	= rubriqueSrv::getRubrique($this->rid);
			$zRid = $tRid->rubrique_libelle;
		}	
		$zMot = "";
		if ($this->getParam('mot')) {
			$this->mot = $this->getParam('mot');
			$zMot = $this->mot;
		}	
		$zCrid = "";
		if ($this->getParam('crid')) {
			$this->crid = $this->getParam('crid');
			
			$type  = substr($this->crid,0,1);
			$value = substr($this->crid,1,strlen($this->crid)-1);
		
			if($type == "c"){
				$tCid 	= categorieAnSrv::chargeCategorieAn($value);
				$zCrid = $tCid->categorieAn_libelle;
			}elseif($type == "r"){
				$tRid 	= rubriqueSrv::getRubrique($value);
				$zCrid = $tRid->rubrique_libelle;
			}								
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
		$zLocalite = "";
		if ($this->getParam('localite')) {
			$this->localite = $this->getParam('localite');
			$tLocalite 	= annonceSrv::getLocalite($this->localite);
			$zLocalite = $tLocalite->localite_code . ' ' . $tLocalite->localite_libelle;
		}	
		$zProvince = "";
		if ($this->getParam('province')) {
			$this->province = $this->getParam('province');
			$tProvince 	= annonceSrv::getProvince($this->province);
			$zProvince = $tProvince->province_libelle;
		}	
		$zPrix1 = "";
		if ($this->getParam('prix1')) {
			$this->prix1 = $this->getParam('prix1');
			$zPrix1 = $this->prix1;
		}	
		$zPrix2 = "";
		if ($this->getParam('prix2')) {
			$this->prix2 = $this->getParam('prix2');
			$zPrix2 = $this->prix2;
		}	

		//Récupération des paramètres d'affichage
		$zAffichage = "";
		if ($this->getParam('affichage')) {
			$this->affichage = $this->getParam('affichage');
			$zAffichage = $this->affichage;
		}

	
		if ($this->anid != 0) {
			try {
				//Update Visit
				annonceSrv::incAnnonceVisite($this->anid, 1);			
				$annonce = annonceSrv::chargeAnnonce($this->anid);
				
			} catch(Exception $oJException) {
				throw new JException ($oJException->getLocaleKey()) ;
			}				
		}else{
			$annonce = annonceSrv::getDaoAnnonce();

			$annonce->annonce_id 			= 0;			
			$annonce->annonce_rubriqueId 	= 0;			

			$annonce->annonce_statut = USER_STATUT_ON;			
		}

		$this->raid = $annonce->annonce_rubriqueId;
		
		if($this->raid){
			$rubrique 	= rubriqueSrv::getRubrique($this->raid);
		}
			$this->caid = $rubrique->rubrique_categorieAnId;

		if($this->caid){
			$categorieAn 	= categorieAnSrv::chargeCategorieAn($this->caid);
		}

		$annonce->annonce_prix = floatval($annonce->annonce_prix);
		//////////////////////////////////////////////////////////////////////////////////////
		$this->laid = $annonce->annonce_localiteId;
		//////////////////////////////////////////////////////////////////////////////////////
		if($this->laid){
			$localite 	= annonceSrv::getLocalite($this->laid);
			$this->paid = $localite->localite_provinceId;
		}	
		if($this->paid){
			$province 	= annonceSrv::getProvince($this->paid);
		}	

		//Abonnemnet en cours
		$toAbonnement 	= abonnementSrv::chargeAbonnement($annonce->annonce_abonnementId);
		//Forfait en cours
		$toForfait 		= forfaitSrv::chargeForfait($toAbonnement->abonnement_forfaitId);
		
		//Photos en cours
		$toPhotoAs 		= photoSrv::getAllPhoto($this->anid);		

		$tParams = array('affichage'=> $this->affichage, 'anid'=> $this->anid, 'cid'=> $this->cid, 'rid'=> $this->rid, 'mot'=> $this->mot, 'crid'=> $this->crid, 'parution'=> $this->parution, 'localite'=> $this->localite, 'prix1'=> $this->prix1, 'prix2'=> $this->prix2, 'page'=> $this->page);

		$toPhotos = array();
		$i = 0;
		if(sizeof($toPhotoAs)){
			//$actualite->actualite_photo = $toPhotos[0]->photo_photo;
			foreach($toPhotoAs AS $toPhoto){
				if($toPhoto->photo_photo != "noPhoto.jpg"){
					$toPhotos[$i] = $toPhoto;	
					$i++;
				}else{
				}
			}
		}else{
			//$actualite->actualite_photo = "noPhoto.jpg";
			$toPhotos = array();	
		}			

		//En mode modification
		if ($this->anid != 0){
			//la première photo
			if(sizeof($toPhotos)){
				$annonce->annonce_photo = $toPhotos[0]->photo_photo;
			}else{
				$annonce->annonce_photo = "noPhoto.jpg";
			}			
		}	

		//Parution
		$dt = strtotime($annonce->annonce_dateDebut);			
		//echo "<br>".time()." - $dt = " . floor((time() - $dt) / 60 / 60 /24);
		$annonce->annonce_parution 		=  floor((time() - $dt) / 60 / 60 /24);
		$annonce->annonce_description = nl2br($annonce->annonce_description);

		//Pagination interne : Annonce précedente, Annonce suivante		
		$tResult = annonceSrv::chargeListeAnnonceRechercheFo($this->cid, $this->rid, $this->mot, $this->crid, $this->parution, $this->province, $this->localite, $this->prix1, $this->prix2, $this->sortField, $this->sortDirection, 0, 1, $this->nbPagination);		
		
		//echo $tResult['iNbEnreg'];
		$iFirst 	= 0;
		$iBack 		= 0;		
		$iCurrent 	= 0;
		$iNext 		= 0;
		$iLast 		= 0;
		$toAnnonce 	= $tResult['listeAnnonce'];				
		$nbList 	= $tResult['iNbEnreg'];
		
		if (sizeof($toAnnonce))
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

		//Affichage
		$this->_tpl->assign('tParams', $tParams);
		
		$this->_tpl->assign('iFirst', $iFirst);													
		$this->_tpl->assign('iBack', $iBack);													
		$this->_tpl->assign('iCurrent', $iCurrent);													
		$this->_tpl->assign('iNext', $iNext);													
		$this->_tpl->assign('iLast', $iLast);													
		$this->_tpl->assign('sortField', $this->sortField);													
		$this->_tpl->assign('sortDirection', $this->sortDirection);													

		$this->_tpl->assign("toForfait", $toForfait);		
		
		$this->_tpl->assign('annonce', $annonce);													
		$this->_tpl->assign('toPhotos', $toPhotos);													

		$this->_tpl->assign('categorieAn', $categorieAn);													
		$this->_tpl->assign('rubrique', $rubrique);													

		$this->_tpl->assign('zprovince', $province);													
		$this->_tpl->assign('zlocalite', $localite);													

		$this->_tpl->assign("anid", $this->anid);		

		$this->_tpl->assign('sortField', $this->sortField);
		$this->_tpl->assign('sortDirection', $this->sortDirection);
		$this->_tpl->assign('page', $this->page);
		$this->_tpl->assign('nbPagination', $this->nbPagination);
		
		$this->_tpl->assign('cid', $this->cid);
		$this->_tpl->assign('rid', $this->rid);
		$this->_tpl->assign('mot', $this->mot);
		$this->_tpl->assign('crid', $this->crid);
		$this->_tpl->assign('parution', $this->parution);
		$this->_tpl->assign('localite', $this->localite);
		$this->_tpl->assign('province', $this->province);
		$this->_tpl->assign('prix1', $this->prix1);
		$this->_tpl->assign('prix2', $this->prix2);
		$this->_tpl->assign('affichage', $this->affichage);

		//Récap critères
		$this->_tpl->assign('zCid', $zCid);		
		$this->_tpl->assign('zRid', $zRid);
		$this->_tpl->assign('zMot', $zMot);
		$this->_tpl->assign('zCrid', $zCrid);
		$this->_tpl->assign('zParution', $zParution);
		$this->_tpl->assign('zLocalite', $zLocalite);
		$this->_tpl->assign('zProvince', $zProvince);
		$this->_tpl->assign('zPrix1', $zPrix1);
		$this->_tpl->assign('zPrix2', $zPrix2);
		$this->_tpl->assign('zAffichage', $zAffichage);

		$this->_tpl->assign('iNbEnreg', $nbList);
	}
}
?>