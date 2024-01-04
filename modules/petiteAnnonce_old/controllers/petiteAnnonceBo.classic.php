<?php
/**
* @package ilay-nosy
* @subpackage petiteAnnonce
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Contrôleur BO pour les petiteAnnonces
* @package ilay-nosy
* @subpackage petiteAnnonce
* @todo : définir les différentes actions du contrôleur
*/
require_once (LIB_PATH.'fpdf/fpdf.php');

class petiteAnnonceBoCtrl extends jController {

	//Toutes les actions de ce contrôleur nécessite une authentification via le plugin jAuth
	public $pluginParams = array('*'=>array('auth.required'=>true));
	

	function updatePetiteAnnonce()
	{
		global $gJConfig;
        $rep = $this->getResponse('json');
		jClasses::inc('petiteAnnonce~petiteAnnonceSrv');

		$idPetiteAnnonce = $this->intParam('idPetiteAnnonce', 0, true);
		$publier = $this->intParam('publier', -1, true);
		petiteAnnonceSrv::updatePetiteAnnonce($idPetiteAnnonce, $publier);

		return $rep;	
	}
	function updatePetiteAnnonceHome()
	{
		global $gJConfig;
        $rep = $this->getResponse('json');
		jClasses::inc('petiteAnnonce~petiteAnnonceSrv');

		$idPetiteAnnonce = $this->intParam('idPetiteAnnonce', 0, true);
		$publier = $this->intParam('publier', -1, true);
		petiteAnnonceSrv::updatePetiteAnnonceHome($idPetiteAnnonce, $publier);

		return $rep;	
	}
	function updatePetiteAnnonceUne()
	{
		global $gJConfig;
        $rep = $this->getResponse('json');
		jClasses::inc('petiteAnnonce~petiteAnnonceSrv');

		$idPetiteAnnonce = $this->intParam('idPetiteAnnonce', 0, true);
		$publier = $this->intParam('publier', -1, true);
		petiteAnnonceSrv::updatePetiteAnnonceUne($idPetiteAnnonce, $publier);

		return $rep;	
	}

	/**
    * Affiche la liste des petiteAnnonces
	* Recoit en paramètre le type de l'actualité : standard ou évènement, 
    */
    function listePetiteAnnonces() {
		global $gJConfig;

        $rep = $this->getResponse('htmlBo');

		$rep->addJSLink($gJConfig->urlengine['basePath'] . 'design/back/js/petiteAnnonces.js');

		jClasses::inc('petiteAnnonce~petiteAnnonceSrv');

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

		$rep->menusActifs = array(HtmlBoResponse::MENU_PETITE_ANNONCE, HtmlBoResponse::MENU_PETITE_ANNONCE_LISTE);
		$rep->bodyTpl = 'petiteAnnonce~petiteAnnonceBo';

		//Param
		$tParams = array('page'=> $this->page, 'aid'=> $this->aid);

		$rep->body->assignZone("listePetiteAnnonceBo", "petiteAnnonce~listePetiteAnnonceBo", $tParams);

        return $rep;
    }

	/**
    * Affichage le détail d'une actualité en mode edition 
	* Recoit l'id de l'actualité en paramètre
    */
    function editionPetiteAnnonce() {
		//Préparation de la réponse
		global $gJConfig;

		//Chargement des données
		jClasses::inc('utilisateur~utilisateurSrv');
		jClasses::inc('categorieAn~categorieAnSrv');
		jClasses::inc('petiteAnnonce~petiteAnnonceSrv');

        $rep = $this->getResponse('htmlBo');
		$rep->addJSLink($gJConfig->urlengine['basePath'] . 'design/back/js/petiteAnnonces.js');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/back/css/nosyEdit.css');
		//$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceDetail.css');
		//$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceDiv.css');
		
		//Chargement du menu 
		$rep->menusActifs = array(HtmlBoResponse::MENU_PETITE_ANNONCE, HtmlBoResponse::MENU_PETITE_ANNONCE_LISTE);
		
		//Template à utiliser
		$rep->bodyTpl = 'petiteAnnonce~petiteAnnonceBo';

		//Récupération des paramètres
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}		
		if ($this->intParam('petiteAnnonce_id')) {
			$this->petiteAnnonce_id = $this->intParam('petiteAnnonce_id');
		}else{
			$this->petiteAnnonce_id = 0;
		}
		if ($this->param('errorMessage')) {
			$this->errorMessage = $this->param('errorMessage');
		}else{
			$this->errorMessage = '';
		}

		//$tParams = array('zone'=> $this->getParam('zone','petiteAnnonce~listePetiteAnnonceBo.zone'));

		//Chargement des données
		jClasses::inc('petiteAnnonce~petiteAnnonceSrv');
		
		if ($this->petiteAnnonce_id != 0) {
			try {
				$petiteAnnonce = petiteAnnonceSrv::chargePetiteAnnonce($this->petiteAnnonce_id);
				
			} catch(Exception $oJException) {
				throw new JException ($oJException->getLocaleKey()) ;
			}				
		}else{
			$petiteAnnonce = petiteAnnonceSrv::getDaoPetiteAnnonce();
			
			$petiteAnnonce->petiteAnnonce_id 			= 0;			
			$petiteAnnonce->petiteAnnonce_categorieAnId 	= 0;	
			$petiteAnnonce->petiteAnnonce_statut = USER_STATUT_ON;			
		}

		//PetiteAnnonce
		$this->anid = $this->petiteAnnonce_id;
		
		//Catégorie
		$this->caid = $petiteAnnonce->petiteAnnonce_categorieAnId;
		
		$petiteAnnonce->petiteAnnonce_prix = ($petiteAnnonce->petiteAnnonce_prix)?floatval($petiteAnnonce->petiteAnnonce_prix) : "";
		
		//categorieAn
		$toCategorieAns	= categorieAnSrv::chargeAllCategorieAn();

		$tParams = array('petiteAnnonce_id'=> $this->petiteAnnonce_id,'errorMessage'=>$this->errorMessage, 'page'=> $this->page);

		$rep->body->assign('tParams', $tParams);
		$rep->body->assign('petiteAnnonce', $petiteAnnonce);													
		$rep->body->assign("petiteAnnonce_id", $this->petiteAnnonce_id);		
		$rep->body->assign("page", $this->page);		

		//$rep->body->assign('utilisateur', $utilisateur);													

		$rep->body->assign('toCategorieAns', $toCategorieAns);													

		$rep->body->assign('caid', $this->caid);													

        return $rep;
    }	
	
	/**
    * Enregistrement des données d'une actualité
	* 
	* Utilisé en création et modification seulement 
	* Recoit en paramètre l'ensemble des données du formulaire d'édition d'une actualité
	* Une fois ls petiteAnnonce sauvegardée, redirige vers la page de liste des actualités
    */
    function sauvegardePetiteAnnonce() {
		//Préparation de la réponse
		global $gJConfig;

		//Enregistrement
		jClasses::inc('commun~tools');	
		jClasses::inc('petiteAnnonceSrv');

		//Récupération des paramètres
		$petiteAnnonce = jMagicLoader::arrayToObject($this->request->params, 'petiteAnnonce');

		//Récupération des paramètres
		if ($this->request->params['page']) {
			$this->page = $this->request->params['page'];			
		}else{
			$this->page = 1;
		}	

		//Save		
		$petiteAnnonce->publier 			= $this->param('petiteAnnonce_publier', 0, true);
		$petiteAnnonce->publierHome			= $this->param('petiteAnnonce_publierHome', 0, true);
		$petiteAnnonce->laUne				= $this->param('petiteAnnonce_laUne', 0, true);

		if($petiteAnnonce->id){				
			$petiteAnnonce->dateModification 	= date("Y-m-d H:i:s");
		}else{
			$petiteAnnonce->dateCreation	 	= date("Y-m-d H:i:s");
			
			$idMaxAnnonce 	= petiteAnnonceSrv::chargeMaxIdPetiteAnnonceFo();
			$incAnnonce		= $idMaxAnnonce + 1;
			
			//Champs automatiques
			$petiteAnnonce->reference 		= "ptAn".str_pad($incAnnonce, 10, "0", STR_PAD_LEFT);			
		}	

		petiteAnnonceSrv::sauvegardePetiteAnnonce($petiteAnnonce);
		//Paramètres
		$tParams = array('page'=> $this->page);

		//Redirection		
		$rep = $this->getResponse('redirect');
		$rep->action  = 'petiteAnnonce~petiteAnnonceBo_listePetiteAnnonces';
		$rep->params = $tParams;
        
        return $rep;        
    }

	/**
    * Suppression d'une actualité donnée
	* 
	* Recoit l'id de la actualité en paramètre
	* Une fois ls petiteAnnonce supprimée, redirige vers la page de liste des actualités
    */
    function supprimePetiteAnnonce() {

		//Récupération des paramètres
		$petiteAnnonceId = $this->intParam('petiteAnnonce_id',0, FALSE);
		if ($petiteAnnonceId == 0) {
			throw new Exception('Invalid parameter petiteAnnonce_id');
		}

		//Suppression
		jClasses::inc('petiteAnnonceSrv');
		petiteAnnonceSrv::supprimePetiteAnnonce($petiteAnnonceId);
		
		//Redirection
		$rep = $this->getResponse('redirect');
		$rep->action  = 'petiteAnnonce~petiteAnnonceBo_listePetiteAnnonces';
        
        return $rep;
    }
}
?>
