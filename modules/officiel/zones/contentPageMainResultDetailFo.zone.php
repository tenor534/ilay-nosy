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
class contentPageMainResultDetailFoZone extends jZone {
	  
 
	/**
	* Nom du template HTML
	*/
    protected $_tplname='officiel~contentPageMainResultDetailFo.zone';

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
	* Officiel
	*/
	public $acid = 0;

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
		
		
		//Récupération des paramètres de l'officiel
		if ($this->getParam('acid')) {
			$this->acid = $this->getParam('acid');
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

	
		if ($this->acid != 0) {
			try {
				//Update Visit
				officielSrv::incOfficielVisite($this->acid, 1);			
				$officiel = officielSrv::chargeOfficiel($this->acid);
				
			} catch(Exception $oJException) {
				throw new JException ($oJException->getLocaleKey()) ;
			}				
		}else{
			$officiel = officielSrv::getDaoOfficiel();

			$officiel->officiel_id 			= 0;			

			$officiel->officiel_statut = USER_STATUT_ON;			
		}

		//Catégorie
		$categorieOff	= categorieOffSrv::chargeCategorieOff($officiel->officiel_categorieOffId);
		
		//Photos en cours
		$toPhotoAs 		= photoOffSrv::getAllPhoto($this->acid);		

		$tParams = array('affichage'=> $this->affichage, 'acid'=> $this->acid, 'cid'=> $this->cid, 'mot'=> $this->mot, 'parution'=> $this->parution, 'page'=> $this->page);

		//En mode modification
		if ($this->acid != 0){
			//la première photo
			$toPhotos = array();
			$i = 0;
			if(sizeof($toPhotoAs)){
				//$officiel->officiel_photo = $toPhotos[0]->photo_photo;
				foreach($toPhotoAs AS $toPhoto){
					if($toPhoto->photo_photo != "noPhoto.jpg"){
						$toPhotos[$i] = $toPhoto;	
						$i++;
					}else{
					}
				}
			}else{
				//$officiel->officiel_photo = "noPhoto.jpg";
				$toPhotos = array();	
			}			
		}	

		//Parution
		$officiel->officiel_datePublication = tools::formatToLongDateTime($officiel->officiel_datePublication, "-", 'fr', 'abrege');
		$dt = strtotime($officiel->officiel_datePublication);			
		//echo "<br>".time()." - $dt = " . floor((time() - $dt) / 60 / 60 /24);
		$officiel->officiel_parution 		=  floor((time() - $dt) / 60 / 60 /24);
		$officiel->officiel_resume = nl2br($officiel->officiel_resume);
		$officiel->officiel_texte  = nl2br($officiel->officiel_texte);

		//COMMENTAIRES
		$toComments  		= commentOffSrv::getAllCommentOff($officiel->officiel_id);		
		$officiel->officiel_nbComment = sizeof($toComments);

		//Pagination interne : Officiel précedente, Officiel suivante		
		$tResult = officielSrv::chargeListeOfficielRechercheFo($this->cid, $this->mot, $this->parution, $this->sortField, $this->sortDirection, 0, 1, $this->nbPagination);		

		//echo $tResult['iNbEnreg'];
		$iFirst 	= 0;
		$iBack 		= 0;		
		$iCurrent 	= 0;
		$iNext 		= 0;
		$iLast 		= 0;
		$toOfficiel 	= $tResult['listeOfficiel'];				
		$nbList 	= $tResult['iNbEnreg']; 
		for($i=0; $i<$nbList; $i++){
			//Début de liste
			if($i == 0){
				$iFirst = $toOfficiel[$i]->officiel_id;
			}

			//Current
			if($toOfficiel[$i]->officiel_id == $this->acid){				
				
				$iBack 		= isset($toOfficiel[$i-1]->officiel_id)?$toOfficiel[$i-1]->officiel_id:0;			
				$iCurrent 	= $toOfficiel[$i]->officiel_id;			
				$iNext 		= isset($toOfficiel[$i+1]->officiel_id)?$toOfficiel[$i+1]->officiel_id:0;			
			}

			//Fin de liste
			if($i == ($nbList - 1)){
				$iLast = $toOfficiel[$i]->officiel_id;
			}			
		}		
		$iFirst 	= ($iFirst == $this->acid)?0:$iFirst;
		$iBack 		= ($iBack == $this->acid)?0:$iBack;
		$iNext 		= ($iNext == $this->acid)?0:$iNext;
		$iLast 		= ($iLast == $this->acid)?0:$iLast;
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

		$this->_tpl->assign('officiel', $officiel);													
		$this->_tpl->assign('toPhotos', $toPhotos);													

		$this->_tpl->assign('categorieOff', $categorieOff);													

		$this->_tpl->assign("acid", $this->acid);		

		$this->_tpl->assign('sortField', $this->sortField);
		$this->_tpl->assign('sortDirection', $this->sortDirection);
		$this->_tpl->assign('page', $this->page);
		$this->_tpl->assign('nbPagination', $this->nbPagination);
		
		$this->_tpl->assign('cid', $this->cid);
		$this->_tpl->assign('mot', $this->mot);
		$this->_tpl->assign('parution', $this->parution);
		$this->_tpl->assign('affichage', $this->affichage);

		//Récap critères
		$this->_tpl->assign('zCid', $zCid);		
		$this->_tpl->assign('zMot', $zMot);
		$this->_tpl->assign('zParution', $zParution);
		$this->_tpl->assign('zAffichage', $zAffichage);

		$this->_tpl->assign('iNbEnreg', $nbList);
	}
}
?>