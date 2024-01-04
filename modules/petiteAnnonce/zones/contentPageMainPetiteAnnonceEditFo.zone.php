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
* Zone affichant les petiteAnnonces en cours dans l'espace membre pour un utilisateur connecté FO
*
* @package ilay-nosy
* @subpackage membre
*/
class contentPageMainPetiteAnnonceEditFoZone extends jZone {
 
	/**
	* Nom du template HTML
	*/
    protected $_tplname='petiteAnnonce~contentPageMainPetiteAnnonceEditFo.zone';

	protected $_useCache = false;

	/**
	* Tri par défaut de la liste
	*/
	public $sortField = 'petiteAnnonce_titre';

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
	public $cid = 0;

	/**
	* PetiteAnnonce a afficher
	*/
	public $anid = 0;

	/**
	* Caracteristique a afficher
	*/
	public $caracteristique = "";

	/**
	* Chargement des données pour affichage
	*/
	protected function _prepareTpl(){

		//Session utilisateur
		$idUtilisateurId = isset($_SESSION['SESSION_MEMBRE_ID'])? $_SESSION['SESSION_MEMBRE_ID'] : 0;

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
			$this->cid = $this->getParam('aid');
		}	
		if ($this->getParam('anid')) {
			$this->anid = $this->getParam('anid');
		}	
		if ($this->getParam('caracteristique')) {
			$this->caracteristique = $this->getParam('caracteristique');
		}

		//Chargement des données
		jClasses::inc('utilisateur~utilisateurSrv');
		jClasses::inc('categorieAn~categorieAnSrv');
		jClasses::inc('petiteAnnonce~petiteAnnonceSrv');
		
		if ($this->anid != 0) {
			try {
				$petiteAnnonce = petiteAnnonceSrv::chargePetiteAnnonce($this->anid);
				
			} catch(Exception $oJException) {
				throw new JException ($oJException->getLocaleKey()) ;
			}				
		}else{
		
			$petiteAnnonce = petiteAnnonceSrv::getDaoPetiteAnnonce();

			$petiteAnnonce->petiteAnnonce_id 			= 0;			
			$petiteAnnonce->petiteAnnonce_categorieAnId 	= 0;	
			$petiteAnnonce->petiteAnnonce_statut = USER_STATUT_ON;			
		}		

		$petiteAnnonce->petiteAnnonce_prix = ($petiteAnnonce->petiteAnnonce_prix)?floatval($petiteAnnonce->petiteAnnonce_prix) : "";
		
		//categorieAn
		$toCategorieAns	= categorieAnSrv::chargeAllCategorieAn();

		$tParams = array('cid'=> $this->cid,'anid'=> $this->anid, 'page'=> $this->page);

		//Utilisateur en cours
		$utilisateur 	= utilisateurSrv::infosMembre($idUtilisateurId);
		
		$this->_tpl->assign('tParams', $tParams);
		
		$this->_tpl->assign('sortField', $this->sortField);													
		$this->_tpl->assign('sortDirection', $this->sortDirection);													

		$this->_tpl->assign('petiteAnnonce', $petiteAnnonce);													
		$this->_tpl->assign('utilisateur', $utilisateur);													

		$this->_tpl->assign('toCategorieAns', $toCategorieAns);													

		$this->_tpl->assign("anid", $this->anid);		
		$this->_tpl->assign("cid", $this->cid);		
		$this->_tpl->assign("page", $this->page);
			
		$this->_tpl->assign("caracteristique", $this->caracteristique);		
		
	}
}
?>