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
class contentPageMainResultDetailFoZone extends jZone {
	  
 
	/**
	* Nom du template HTML
	*/
    protected $_tplname='actualite~contentPageMainResultDetailFo.zone';

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
	* Actualite
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
		
		
		//Récupération des paramètres de l'actualite
		if ($this->getParam('acid')) {
			$this->acid = $this->getParam('acid');
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

	
		if ($this->acid != 0) {
			try {
				//Update Visit
				actualiteSrv::incActualiteVisite($this->acid, 1);			
				$actualite = actualiteSrv::chargeActualite($this->acid);
				
			} catch(Exception $oJException) {
				throw new JException ($oJException->getLocaleKey()) ;
			}				
		}else{
			$actualite = actualiteSrv::getDaoActualite();

			$actualite->actualite_id 			= 0;			

			$actualite->actualite_statut = USER_STATUT_ON;			
		}

		//Catégorie
		$categorieAct	= categorieActSrv::chargeCategorieAct($actualite->actualite_categorieActId);
		
		//Photos en cours
		$toPhotoAs 		= photoActSrv::getAllPhoto($this->acid);		

		$tParams = array('affichage'=> $this->affichage, 'acid'=> $this->acid, 'cid'=> $this->cid, 'mot'=> $this->mot, 'parution'=> $this->parution, 'page'=> $this->page);

		//En mode modification
		if ($this->acid != 0){
			//la première photo
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
		}	

		//Parution
		$actualite->actualite_datePublication = tools::formatToLongDateTime($actualite->actualite_datePublication, "-", 'fr', 'abrege');
		$dt = strtotime($actualite->actualite_datePublication);			
		//echo "<br>".time()." - $dt = " . floor((time() - $dt) / 60 / 60 /24);
		$actualite->actualite_parution 		=  floor((time() - $dt) / 60 / 60 /24);
		$actualite->actualite_resume = nl2br($actualite->actualite_resume);
		$actualite->actualite_texte  = nl2br($actualite->actualite_texte);

		//COMMENTAIRES
		$toComments  		= commentActSrv::getAllCommentAct($actualite->actualite_id);		
		$actualite->actualite_nbComment = sizeof($toComments);

		//Pagination interne : Actualite précedente, Actualite suivante		
		$tResult = actualiteSrv::chargeListeActualiteRechercheFo($this->cid, $this->mot, $this->parution, $this->sortField, $this->sortDirection, 0, 1, $this->nbPagination);		

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

		//Affichage
		$this->_tpl->assign('tParams', $tParams);
		
		$this->_tpl->assign('iFirst', $iFirst);													
		$this->_tpl->assign('iBack', $iBack);													
		$this->_tpl->assign('iCurrent', $iCurrent);													
		$this->_tpl->assign('iNext', $iNext);													
		$this->_tpl->assign('iLast', $iLast);													
		$this->_tpl->assign('sortField', $this->sortField);													
		$this->_tpl->assign('sortDirection', $this->sortDirection);													

		$this->_tpl->assign('actualite', $actualite);													
		$this->_tpl->assign('toPhotos', $toPhotos);													

		$this->_tpl->assign('categorieAct', $categorieAct);													

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