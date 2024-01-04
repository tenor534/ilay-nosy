<?php
/**
* @package agidis
* @subpackage commun
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Contrôleur BO pour les actions communes à l'ensemble du back office
* @package agidis
* @subpackage commun
*/
class CommunFoCtrl extends jController {

	public $pluginParams = array('getZone'=>array('connexion.membre'=>false),
								 'navigationSites'=>array('connexion.membre'=>false),
								 'deconnexion'=>array('connexion.membre'=>true));
	
	/**
	*	Affiche un formulaire de login, tout profil confondu
	*/
	function login(){
		global $gJConfig;
        $rep = $this->getResponse('htmlFo');

		//Références liens : js et css
		$rep->addJSLink($gJConfig->urlengine['basePath'] .'design/front/js/login.js');					
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyHome.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyLogin.css');		
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceDetail.css');
		
		//Template utilisé
		$rep->bodyTpl = 'commun~communLoginFo';

		//Ajout des zones visibles:
		//Actualite
		$rep->body->assignZone('homePageNew', 'actualite~homePageNewFo');		
		$rep->body->assignZone('innerPageNew', 'actualite~innerPageNewFo');	

		//Culture
		$rep->body->assignZone('homePageCulture', 'culture~homePageCultureFo');		

		//Forum
		$rep->body->assignZone('homePageForum', 'forum~homePageForumFo');		

		//Annonce
		$rep->body->assignZone('homePageAnnonceRencontre', 'annonce~homePageAnnonceFo');		
		$rep->body->assignZone('innerPageAnnonceVehicule', 'annonce~innerPageAnnonceFo', array('cat'=>1));		
		$rep->body->assignZone('innerPageAnnonceImmobilier', 'annonce~innerPageAnnonceFo', array('cat'=>2));		
		$rep->body->assignZone('innerPageAnnonceEmploi', 'annonce~innerPageAnnonceFo', array('cat'=>3));		
		$rep->body->assignZone('innerPageAnnonceAutres', 'annonce~innerPageAnnonceFo', array('cat'=>4));		
		//Petites annonces
		$rep->body->assignZone('innerPagePetiteAnnonce', 'petiteAnnonce~innerPagePetiteAnnonceFo');		

		//Pratique
		$rep->body->assignZone('innerPagePratique', 'pratique~innerPagePratiqueFo');		

		//Projet
		$rep->body->assignZone('innerPageProjet', 'projet~innerPageProjetFo');		

		//Publication
		$rep->body->assignZone('leftPageHowTop', 'publication~leftPageHowTopFo');		
		$rep->body->assignZone('leftPageAdsTop', 'publication~leftPageAdsTopFo');		
		$rep->body->assignZone('leftPageAds', 'publication~leftPageAdsFo');		
		$rep->body->assignZone('innerPageAdSpace', 'publication~innerPageAdSpaceFo');		
		$rep->body->assignZone('innerPageAdSpaces', 'publication~innerPageAdSpacesFo');		

		//Commun
		$rep->body->assignZone('breadcrumbs', 'commun~breadcrumbsFo', array('zAriane'=>'Ouverture d\' une session Ilay NOSY'));		
		$rep->body->assignZone('contentPageMainLogin', 'commun~contentPageMainLoginFo');	
		//$rep->body->assignZone("loginForm", "accueil~loginFo", array('is_loged'=>0));
        
        return $rep;
	}


 
	/**
	*	Affiche un formulaire d'inscription , tout profil confondu
	*/
	function register(){
		global $gJConfig;
        $rep = $this->getResponse('htmlFo');

		//Références liens : js et css
		$rep->addJSLink($gJConfig->urlengine['basePath'] .'design/front/js/register.js');					
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyHome.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyRegister.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceDetail.css');
		
		
		//Template utilisé
		$rep->bodyTpl = 'commun~communRegisterFo';

		//Ajout des zones visibles:
		//Actualite
		$rep->body->assignZone('homePageNew', 'actualite~homePageNewFo');		
		$rep->body->assignZone('innerPageNew', 'actualite~innerPageNewFo');	

		//Culture
		$rep->body->assignZone('homePageCulture', 'culture~homePageCultureFo');		

		//Forum
		$rep->body->assignZone('homePageForum', 'forum~homePageForumFo');		

		//Annonce
		$rep->body->assignZone('homePageAnnonceRencontre', 'annonce~homePageAnnonceFo');		
		$rep->body->assignZone('innerPageAnnonceVehicule', 'annonce~innerPageAnnonceFo', array('cat'=>1));		
		$rep->body->assignZone('innerPageAnnonceImmobilier', 'annonce~innerPageAnnonceFo', array('cat'=>2));		
		$rep->body->assignZone('innerPageAnnonceEmploi', 'annonce~innerPageAnnonceFo', array('cat'=>3));		
		$rep->body->assignZone('innerPageAnnonceAutres', 'annonce~innerPageAnnonceFo', array('cat'=>4));		
		//Petites annonces
		$rep->body->assignZone('innerPagePetiteAnnonce', 'petiteAnnonce~innerPagePetiteAnnonceFo');		

		//Pratique
		$rep->body->assignZone('innerPagePratique', 'pratique~innerPagePratiqueFo');		

		//Projet
		$rep->body->assignZone('innerPageProjet', 'projet~innerPageProjetFo');		

		//Publication
		$rep->body->assignZone('leftPageHowTop', 'publication~leftPageHowTopFo');		
		$rep->body->assignZone('leftPageAdsTop', 'publication~leftPageAdsTopFo');		
		$rep->body->assignZone('leftPageAds', 'publication~leftPageAdsFo');		
		$rep->body->assignZone('innerPageAdSpace', 'publication~innerPageAdSpaceFo');		
		$rep->body->assignZone('innerPageAdSpaces', 'publication~innerPageAdSpacesFo');		

		//Commun
		$rep->body->assignZone('breadcrumbs', 'commun~breadcrumbsFo', array('zAriane'=>'Création d\' une session Ilay NOSY '));		
		$rep->body->assignZone('contentPageMainRegister', 'commun~contentPageMainRegisterFo');	
		//$rep->body->assignZone("loginForm", "accueil~loginFo", array('is_loged'=>0));
   
        return $rep;
	}

	/**
	 * Connexion à l'espace utilisateur
	 *
	 * Reçoit en paramètre le login et le mot de passe du membre
	 */
	function connexion(){
		$rep = $this->getResponse('json');
		
		$result = array();
		
		//Requier la classe utilisateur
		jClasses::inc('utilisateur~utilisateurSrv');
		$iReturn = utilisateurSrv::connexionMembre($this->Param('email','',true),$this->Param('password','',true));

		$result = array("statut"=>$iReturn);
		
		$rep->datas = $result;
		return $rep;
	}	

	/**
	*	deconnexion d'un membre et re-direction vers l'accueil du site
	*
	*/
	function deconnexion(){
		$rep=$this->getResponse('redirect');
		
		//Désalloue les sessions utilisateurs
		unset($_SESSION['SESSION_MEMBRE_ID']);
		unset($_SESSION['SESSION_MEMBRE_NOM']);
		unset($_SESSION['SESSION_MEMBRE_PRENOM']);
		
		$rep->action='accueil~accueilFo_abord';
		return $rep;
	}


	/**
	* Action générique permettant d'appeller une zone sans passer par un controlleur en particulier
	*
	* Utile pour le recherchement de liste en AJAX (on a donc pas à créer une action pour chaque zone appellable en ajax)
	*/
	function getZone() {
        $rep = $this->getResponse('text');

		$zone = $this->param('zone');
		if (is_null($zone)) {
			throw new Exception('Paramètre zone requis');
		}
		$params = $GLOBALS['gJCoord']->request->params;


		$rep->content = jZone::get($zone, $params);

        return $rep;
	}

	/**
	*	gestion de la navigation entre les sites Portail et Club
	*
	*/
	function navigationSites(){
		$rep=$this->getResponse('redirect');
		$siteId=$this->intParam('site_id',SITE_PORTAIL,TRUE);
		switch($siteId){
			case SITE_PORTAIL:
				unset($_SESSION['SESSION_SITE_ID']);
				$rep->action='accueil~accueilFo_accueil';
				break;
			case SITE_MEMBRE:
				if(isset($_SESSION['SESSION_MEMBRE_ID']))
				$_SESSION['SESSION_SITE_ID']=SITE_MEMBRE;
				$rep->action='accueil~accueilFo_accueilBrand';
				break;
		}
		return $rep;
	}
}
?>