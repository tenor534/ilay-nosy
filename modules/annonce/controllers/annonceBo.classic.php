<?php
/**
* @package ilay-nosy
* @subpackage annonce
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Contrôleur BO pour les annonces
* @package ilay-nosy
* @subpackage annonce
* @todo : définir les différentes actions du contrôleur
*/
require_once (LIB_PATH.'fpdf/fpdf.php');

class annonceBoCtrl extends jController {

	//Toutes les actions de ce contrôleur nécessite une authentification via le plugin jAuth
	public $pluginParams = array('*'=>array('auth.required'=>true));
	

	function updateAnnonce()
	{
		global $gJConfig;
        $rep = $this->getResponse('json');
		jClasses::inc('annonce~annonceSrv');

		$idAnnonce = $this->intParam('idAnnonce', 0, true);
		$publier = $this->intParam('publier', -1, true);
		annonceSrv::updateAnnonce($idAnnonce, $publier);

		return $rep;	
	}
	function updateAnnonceHome()
	{
		global $gJConfig;
        $rep = $this->getResponse('json');
		jClasses::inc('annonce~annonceSrv');

		$idAnnonce = $this->intParam('idAnnonce', 0, true);
		$publier = $this->intParam('publier', -1, true);
		annonceSrv::updateAnnonceHome($idAnnonce, $publier);

		return $rep;	
	}
	function updateAnnonceUne()
	{
		global $gJConfig;
        $rep = $this->getResponse('json');
		jClasses::inc('annonce~annonceSrv');

		$idAnnonce = $this->intParam('idAnnonce', 0, true);
		$publier = $this->intParam('publier', -1, true);
		annonceSrv::updateAnnonceUne($idAnnonce, $publier);

		return $rep;	
	}

	/**
    * Affiche la liste des annonces
	* Recoit en paramètre le type de l'actualité : standard ou évènement, 
    */
    function listeAnnonces() {
		global $gJConfig;

        $rep = $this->getResponse('htmlBo');

		$rep->addJSLink($gJConfig->urlengine['basePath'] . 'design/back/js/annonceListe.js');

		jClasses::inc('annonce~annonceSrv');

		//Param
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}
		if ($this->intParam('aid')) {
			$this->aid = $this->intParam('aid');
		}else{
			$this->aid = 0;
		}

		$rep->menusActifs = array(HtmlBoResponse::MENU_ANNONCE, HtmlBoResponse::MENU_ANNONCE_LISTE);
		$rep->bodyTpl = 'annonce~annonceBo';

		//Param
		$tParams = array('page'=> $this->page, 'aid'=> $this->aid);

		$rep->body->assignZone("listeAnnonceBo", "annonce~listeAnnonceBo", $tParams);

        return $rep;
    }

	/**
    * Affichage le détail d'une actualité en mode edition 
	* Recoit l'id de l'actualité en paramètre
    */
    function editionAnnonce() {
		//Préparation de la réponse
		global $gJConfig;

		//Chargement des données
		jClasses::inc('utilisateur~utilisateurSrv');
		jClasses::inc('forfait~forfaitSrv');
		jClasses::inc('abonnement~abonnementSrv');
		jClasses::inc('categorieAn~categorieAnSrv');
		jClasses::inc('rubrique~rubriqueSrv');
		jClasses::inc('annonce~annonceSrv');
		jClasses::inc('photo~photoSrv');

        $rep = $this->getResponse('htmlBo');
		$rep->addJSLink($gJConfig->urlengine['basePath'] . 'design/back/js/annonces.js');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/back/css/nosyEdit.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceDetail.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceDiv.css');
		
		//Chargement du menu 
		$rep->menusActifs = array(HtmlBoResponse::MENU_ANNONCE, HtmlBoResponse::MENU_ANNONCE_LISTE);
		
		//Template à utiliser
		$rep->bodyTpl = 'annonce~annonceBo';

		//Récupération des paramètres
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}		
		if ($this->intParam('annonce_id')) {
			$this->annonce_id = $this->intParam('annonce_id');
		}else{
			$this->annonce_id = 0;
		}
		if ($this->param('errorMessage')) {
			$this->errorMessage = $this->param('errorMessage');
		}else{
			$this->errorMessage = '';
		}

		//$tParams = array('zone'=> $this->getParam('zone','annonce~listeAnnonceBo.zone'));

		//Chargement des données
		jClasses::inc('annonce~annonceSrv');
		
		if ($this->annonce_id != 0) {
			try {
				$annonce = annonceSrv::chargeAnnonce($this->annonce_id);
				
			} catch(Exception $oJException) {
				throw new JException ($oJException->getLocaleKey()) ;
			}				
		}else{
			$annonce = annonceSrv::getDaoAnnonce();
			
			$annonce->annonce_id 			= 0;			
			$annonce->annonce_abonnementId 	= 0;			
			$annonce->annonce_rubriqueId 	= 0;	
			$annonce->annonce_statut = USER_STATUT_ON;			
		}

		//Annonce
		$this->anid = $this->annonce_id;	
		
		//Rubrique
		$this->raid = $annonce->annonce_rubriqueId;
		
		//Catégorie
		if($this->raid){
			$rubrique 	= rubriqueSrv::getRubrique($this->raid);
			$this->caid = $rubrique->rubrique_categorieAnId;
		}else{
			$this->caid = 0;
		}
		
		$annonce->annonce_prix = ($annonce->annonce_prix)?floatval($annonce->annonce_prix) : "";
		$annonce->annonce_annee = ($annonce->annonce_annee)? $annonce->annonce_annee : "";		

		//Loclite/////////////////////////////////////////////////////////////////////////////////////
		$this->lid = $annonce->annonce_localiteId;
		//Province////////////////////////////////////////////////////////////////////////////////////
		if($this->lid){
			$localite 	= annonceSrv::getLocalite($this->lid);
			$this->pid = $localite->localite_provinceId;
		}else{
			$this->pid = 0;
		}	
		
		//Abonnemnet en cours
		$toAbonnement 	= abonnementSrv::chargeAbonnement($annonce->annonce_abonnementId);
		//Utilisateur en cours
		$utilisateur 	= utilisateurSrv::infosMembre($toAbonnement->abonnement_utilisateurId);
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

		$tParams = array('annonce_id'=> $this->annonce_id,'errorMessage'=>$this->errorMessage, 'page'=> $this->page);

		$rep->body->assign('tParams', $tParams);
		$rep->body->assign('annonce', $annonce);													
		$rep->body->assign("annonce_id", $this->annonce_id);		
		$rep->body->assign("page", $this->page);		

		$rep->body->assign("toAbonnement", $toAbonnement);		
		$rep->body->assign("toForfait", $toForfait);		
		
		$rep->body->assign('utilisateur', $utilisateur);													
		$rep->body->assign('toPhotos', $toPhotos);													

		$rep->body->assign('toCategorieAns', $toCategorieAns);													
		$rep->body->assign('toRubriques', $toRubriques);													

		$rep->body->assign('toProvinces', $toProvinces);													
		$rep->body->assign('toLocalites', $toLocalites);													

		$rep->body->assign('caid', $this->caid);													
		$rep->body->assign('raid', $this->raid);													
		$rep->body->assign('pid', $this->pid);													
		$rep->body->assign('lid', $this->lid);													

        return $rep;
    }
	
	
	/**
    * Enregistrement des données d'une actualité
	* 
	* Utilisé en création et modification seulement 
	* Recoit en paramètre l'ensemble des données du formulaire d'édition d'une actualité
	* Une fois ls annonce sauvegardée, redirige vers la page de liste des actualités
    */
    function sauvegardeAnnonce() {
		//Préparation de la réponse
		global $gJConfig;

		//Enregistrement
		jClasses::inc('commun~tools');	
		jClasses::inc('annonceSrv');

		//Récupération des paramètres
		$annonce = jMagicLoader::arrayToObject($this->request->params, 'annonce');

		//Récupération des paramètres
		if ($this->request->params['page']) {
			$this->page = $this->request->params['page'];			
		}else{
			$this->page = 1;
		}	

		//Save		
		$annonce->publier 			= $this->param('annonce_publier', 0, true);
		$annonce->publierHome		= $this->param('annonce_publierHome', 0, true);
		$annonce->laUne				= $this->param('annonce_laUne', 0, true);

		if($annonce->id){				
			$annonce->dateModification 	= date("Y-m-d");
		}	

		annonceSrv::sauvegardeAnnonce($annonce);
		//Paramètres
		$tParams = array('page'=> $this->page);

		//Redirection		
		$rep = $this->getResponse('redirect');
		$rep->action  = 'annonce~annonceBo_listeAnnonces';
		$rep->params = $tParams;
        
        return $rep;        
    }

	/**
    * Suppression d'une actualité donnée
	* 
	* Recoit l'id de la actualité en paramètre
	* Une fois ls annonce supprimée, redirige vers la page de liste des actualités
    */
    function supprimeAnnonce() {

		//Récupération des paramètres
		$annonceId = $this->intParam('annonce_id',0, FALSE);
		if ($annonceId == 0) {
			throw new Exception('Invalid parameter annonce_id');
		}

		//Suppression
		jClasses::inc('annonceSrv');
		annonceSrv::supprimeAnnonce($annonceId);
		
		//Redirection
		$rep = $this->getResponse('redirect');
		$rep->action  = 'annonce~annonceBo_listeAnnonces';
        
        return $rep;
    }

	/**
    * Test l'unicité du login en base
	* 
	* Recoit le login
	* Une fois ls annonce supprimée, redirige vers la page de liste des annonces
    */
    function unicityLogin() {
		global $gJConfig;
		
		$rep=$this->getResponse('json');
		
		$result=array();
		
		//Récupération des paramètres
		$annonce_login = $this->param('annonce_login','', true);
		if ($annonce_login == '') {
			throw new Exception('Invalid parameter annonce_login');
		}

		//Suppression
		jClasses::inc('annonceSrv');
		$result['foundUser'] = annonceSrv::unicityAnnonceLogin($annonce_login);		
		$rep->datas=$result;
		
		return $rep;
    }

	/**
    * Test l'unicité de l'email en base
	* 
	* Recoit le mail
    */
    function unicityEmail() {
		global $gJConfig;
		
		$rep=$this->getResponse('json');
		
		$result=array();
		
		//Récupération des paramètres
		$annonce_email = $this->param('annonce_email','', true);
		if ($annonce_email == '') {
			throw new Exception('Invalid parameter annonce_email');
		}

		//Suppression
		jClasses::inc('annonceSrv');
		$result['foundUser'] = annonceSrv::unicityAnnonceEmail($annonce_email);		
		$rep->datas=$result;
		
		return $rep;
    }
}
?>
