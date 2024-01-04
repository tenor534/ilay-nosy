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
* Zone affichant les forums en cours dans l'espace membre pour un utilisateur connecté FO
*
* @package ilay-nosy
* @subpackage membre
*/    
class contentPageMainForumSujetListFoZone extends jZone {	  
 
	/**
	* Nom du template HTML
	*/
    protected $_tplname='forum~contentPageMainForumSujetListFo.zone';

	protected $_useCache = false;

	/**
	* Tri par défaut de la liste
	*/
	public $sortField = 'sujet_datePublication';

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
	* Forum
	*/
	public $fid = 0;

	/**
	* Mot clé
	*/
	public $mot = "";

	/**
	* Parution
	*/
	public $parution = 0;

	/**
	* Précision
	*/
	public $precision = 0;

	/**
	* Chargement des données pour affichage
	*/
	protected function _prepareTpl(){

		//Chargement des données
		jClasses::inc('categorieFor~categorieForSrv');
		jClasses::inc('forum~forumSrv');
		jClasses::inc('sujet~sujetSrv');
		jClasses::inc('commentFor~commentForSrv');		
		jClasses::inc('utilisateur~utilisateurSrv');		
		jClasses::inc('commun~tools');

		//Session utilisateur
		//$idUtilisateurId = $_SESSION['SESSION_MEMBRE_ID'];
		$toUtilisateur = array();
		if (isset($_SESSION['SESSION_MEMBRE_ID'])) {
			$idUtilisateurId = $_SESSION['SESSION_MEMBRE_ID'];
			
			$toUtilisateur = utilisateurSrv::chargeUtilisateur($idUtilisateurId);			
			$loginBit = split("@", $toUtilisateur->utilisateur_email);
			$toUtilisateur->utilisateur_login = $loginBit[0];
			if(!strlen($toUtilisateur->utilisateur_photo)){
				$toUtilisateur->utilisateur_photo = "noPhoto.jpg";
			}			
			//Nb Post per user
			$toUtilisateur->utilisateur_nbComment	=  commentForSrv::countCommentForPerUser($toUtilisateur->utilisateur_id);		
			
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
		$zFid = "";
		if ($this->getParam('fid')) {
			$this->fid = $this->getParam('fid');
			$tFid 	= forumSrv::chargeForum($this->fid);
			$zFid = $tFid->forum_libelle;
			
			//Catégorie
			$tCid 	= categorieForSrv::chargeCategorieFor($tFid->forum_categorieForId);
			$zCid = $tCid->categorieFor_libelle;
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
		$zPrecision = "";
		if ($this->getParam('precision')) {
			$this->precision = $this->getParam('precision');
			
			switch($this->precision){
				case 1: //Dans les sujets
					$zPrecision .=	"Dans les sujets";
					break;
				case 2: //Dans les messages
					$zPrecision .=	"Dans les messages";
					break;
				case 3: //Parmis les auteurs
					$zPrecision .=	"Parmis les auteurs";
					break;
			}			
		}

		$tParams = array('zone'=> $this->getParam('zone','forum~contentPageMainForumSujetListFo'), 'nbPagination'=> $this->nbPagination, 'precision'=> $this->precision, 'fid'=> $this->fid, 'mot'=> $this->mot, 'parution'=> $this->parution);
	
		
		if ($this->page > 1){
			$iDebutListe = ($this->page-1) * $this->nbPagination; 
		}else{
			$iDebutListe = 0 ;
		}
		
		$tResult = array('iNbEnreg'=>0, 'listeForum'=>array());

		$tResult = sujetSrv::chargeListeSujetRechercheFo($this->fid, $this->mot, $this->parution, $this->precision,$this->sortField, $this->sortDirection, $iDebutListe, 0, $this->nbPagination);
		//print_r( $tResult);
	
		$nbPage = ceil($tResult['iNbEnreg'] / $this->nbPagination);
		
		$toSujet = array();
		foreach($tResult['listeSujet'] as $zKey => $oSujet){
			
			$oSujet->sujet_reference 	= stripslashes($oSujet->sujet_reference);
			$oSujet->sujet_titre 		= stripslashes($oSujet->sujet_titre);
			
			//Nombre de réponse
			$toCommentFors = commentForSrv::getAllCommentFor($oSujet->sujet_id);			
			$oSujet->sujet_nbReponse = sizeof($toCommentFors);

			//Auteur
			$loginBit = split("@", $oSujet->utilisateur_email);
			$oSujet->sujet_auteur = $loginBit[0];

			//Nombre de réponse
			$toCommentFors = commentForSrv::getAllCommentFor($oSujet->sujet_id, "DESC");			
			
			//Last Comment
			if(sizeof($toCommentFors)){			
				$oSujet->sujet_commentlastId   = $toCommentFors[0]->commentFor_sujetId;
				$oSujet->sujet_commentlastDate = $toCommentFors[0]->commentFor_dateCreation;
				$loginBit = split("@", $toCommentFors[0]->utilisateur_email);

				$oSujet->sujet_commentlastUser = $loginBit[0];
			}else{
				$oSujet->sujet_commentlastId   = 0;
				$oSujet->sujet_commentlastDate = "";
				$oSujet->sujet_commentlastUser = "";
			}			

			array_push($toSujet, $oSujet);		
		}

		/*$tHead = array(
					 array('sortField'=> "sujet_photo", 'libelle'=> "Photo", 'modifier'=> '', 'align'=> "_left", 'class'=> 'annonceHead0')					
					,array('sortField'=> "categorieAct_libelle", 'libelle'=> "Cat&eacute;gorie", 'modifier'=> '', 'align'=> "_left", 'class'=> 'annonceHead1')					
					,array('sortField'=> "sujet_titre", 'libelle'=> "Titre", 'modifier'=> '', 'align'=> "_left", 'class'=> 'annonceHead1')					
					//,array('sortField'=> "sujet_resume", 'libelle'=> "R&eacute;sum&eacute;", 'modifier'=> '', 'align'=> "_left", 'class'=> 'annonceHead2')					
					,array('sortField'=> "sujet_datePublication", 'libelle'=> "Parution", 'modifier'=> '', 'align'=> "_center", 'class'=> 'annonceHead5')									
					);	*/
					
		//Affichage
		$this->_tpl->assign('i', 0);
		$this->_tpl->assign('nbPage', $nbPage);
		$this->_tpl->assign('toSujet', $toSujet);
		$this->_tpl->assign('toUtilisateur', $toUtilisateur);		
		//$this->_tpl->assign('tHead', $tHead);		
		
		$this->_tpl->assign('tParams', $tParams);
		$this->_tpl->assign('sortField', $this->sortField);
		$this->_tpl->assign('sortDirection', $this->sortDirection);
		$this->_tpl->assign('page', $this->page);

		$this->_tpl->assign('nbPagination', $this->nbPagination);
		$this->_tpl->assign('fid', $this->fid);
		$this->_tpl->assign('mot', $this->mot);
		$this->_tpl->assign('parution', $this->parution);
		$this->_tpl->assign('precision', $this->precision);
		
		$this->_tpl->assign('iDebutEnreg', $iDebutListe+1);
		$this->_tpl->assign('iFinEnreg', $iDebutListe + $this->nbPagination);
		$this->_tpl->assign('iNbEnreg', $tResult['iNbEnreg']);
		
		//Récap critères
		$this->_tpl->assign('zCid', $zCid);		
		$this->_tpl->assign('zFid', $zFid);		
		$this->_tpl->assign('zMot', $zMot);
		$this->_tpl->assign('zParution', $zParution);
		$this->_tpl->assign('zPrecision', $zPrecision);
	}
}
?>