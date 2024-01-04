<?php
/**
* @package ilay-nosy
* @subpackage accueil
* @author
* @copyright
* @link
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

class petiteAnnonceFoCtrl extends jController {
    /**
    *
    */
	//Toutes les actions de ce contrôleur nécessite une authentification via le plugin jAuth
	public $pluginParams = array('updatePetiteAnnonce'=>array('connexion.membre'=>true),

								 'petiteAnnonceCategorieList'=>array('connexion.membre'=>false),
								 'petiteAnnonceResultList'=>array('connexion.membre'=>false),
								 'petiteAnnonceDetail'=>array('connexion.membre'=>false),
	
								 'petiteAnnonceList'=>array('connexion.membre'=>false),
								 'petiteAnnonceEdit'=>array('connexion.membre'=>true),
								 'sauvegardePetiteAnnonce'=>array('connexion.membre'=>true),

								 'chargeSelectLocalite'=>array('connexion.membre'=>false),
								 'changePhoto'=>array('connexion.membre'=>true),
								 'removePhoto'=>array('connexion.membre'=>true),
								 'petiteAnnonceDelete'=>array('connexion.membre'=>true)
								 );

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


	//Affiche la page de liste des annonces membre	
	function petiteAnnonceList()
	{
		global $gJConfig;
        $rep = $this->getResponse('htmlFo');

		//Références liens : js et css
		$rep->addJSLink($gJConfig->urlengine['basePath'] .'design/front/js/petiteAnnonce.js');			
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyMembre.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounce.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceListAbrege.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceDetail.css');

		
		//Template utilisé
		$rep->bodyTpl = 'petiteAnnonce~petiteAnnonceTableFo';

		//Param
		if ($this->param('sortField')) {
			$this->sortField = $this->param('sortField');
		}else{
			$this->sortField = "petiteAnnonce_dateCreation";
		}
		if ($this->param('sortDirection')) {
			$this->sortDirection = $this->param('sortDirection');
		}else{
			$this->sortDirection = "DESC";
		}


		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}
		if ($this->intParam('cid')) {
			$this->cid = $this->intParam('cid');
		}else{
			$this->cid = 0;
		}

		//Param
		$tParams = array('sortField'=> $this->sortField, 'sortDirection'=> $this->sortDirection, 'page'=> $this->page, 'cid'=> $this->cid);

		//Ajout des zones visibles:
		//Publication
		$rep->body->assignZone('innerPageAdSpace', 'publication~innerPageAdSpaceFo');		
		$rep->body->assignZone('innerPageAdSpaces', 'publication~innerPageAdSpacesFo');		
		//Annonce
		$rep->body->assignZone('innerPageAnnonceVehicule', 'annonce~innerPageAnnonceFo', array('cat'=>1));		
		$rep->body->assignZone('innerPageAnnonceImmobilier', 'annonce~innerPageAnnonceFo', array('cat'=>2));		
		$rep->body->assignZone('innerPageAnnonceEmploi', 'annonce~innerPageAnnonceFo', array('cat'=>3));		
		$rep->body->assignZone('innerPageAnnonceAutres', 'annonce~innerPageAnnonceFo', array('cat'=>4));		
		//Petites annonces
		$rep->body->assignZone('innerPagePetiteAnnonce', 'petiteAnnonce~innerPagePetiteAnnonceFo');		

		//$zUrl = jUrl::get('membre~membreFo_tableBord');
		$rep->body->assignZone('breadcrumbs', 'commun~breadcrumbsFo', array('zAriane'=>'Petites annonces'));		
		
		$rep->body->assignZone('contentPageMain', 'petiteAnnonce~contentPageMainPetiteAnnonceListFo', $tParams);			

		$rep->body->assign('zMemberWrap', 'member_pratique');	
		
		//$rep->body->assignZone("loginForm", "accueil~loginFo", array('is_loged'=>0));
        
        return $rep;
	}



	//Affiche la page de tarifs
	function petiteAnnonceTarifList()
	{
		global $gJConfig;
        $rep = $this->getResponse('htmlFo');

		//Références liens : js et css
		$rep->addJSLink($gJConfig->urlengine['basePath'] .'design/front/js/petiteAnnonce.js');			
		$rep->addJSLink($gJConfig->urlengine['basePath'] .'design/front/js/petiteAnnonceResult.js');			
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyMembre.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounce.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosySideColumn.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceDetail.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnouncePack.css');

		
		//Template utilisé
		$rep->bodyTpl = 'petiteAnnonce~petiteAnnonceTarifFo';

		//Param
		$tParams = array();

		//Ajout des zones visibles:
		//Publication
		$rep->body->assignZone('innerPageAdSpace', 'publication~innerPageAdSpaceFo');		
		$rep->body->assignZone('innerPageAdSpaces', 'publication~innerPageAdSpacesFo');		
		//PetiteAnnonce
		$rep->body->assignZone('innerPagePetiteAnnonceVehicule', 'petiteAnnonce~innerPagePetiteAnnonceFo', array('cat'=>1));		
		$rep->body->assignZone('innerPagePetiteAnnonceImmobilier', 'petiteAnnonce~innerPagePetiteAnnonceFo', array('cat'=>2));		
		$rep->body->assignZone('innerPagePetiteAnnonceEmploi', 'petiteAnnonce~innerPagePetiteAnnonceFo', array('cat'=>3));		
		$rep->body->assignZone('innerPagePetiteAnnonceAutres', 'petiteAnnonce~innerPagePetiteAnnonceFo', array('cat'=>4));		

		$zUrl = jUrl::get('petiteAnnonce~petiteAnnonceFo_petiteAnnonceCategorieList');
		$rep->body->assignZone('breadcrumbs', 'commun~breadcrumbsFo', array('zAriane'=>'<a href="'.$zUrl.'">PetiteAnnonces</a><span>&nbsp;&raquo;&nbsp;</span>Nos tarifs'));		
		$rep->body->assignZone('contentPageMain', 'petiteAnnonce~contentPageMainPetiteAnnonceTarifListFo', $tParams);	

		//$rep->body->assignZone("loginForm", "accueil~loginFo", array('is_loged'=>0));
        return $rep;
	}


	//Affiche la page de liste des rubriques d'petiteAnnonces
	function petiteAnnonceCategorieList()
	{
		global $gJConfig;
        $rep = $this->getResponse('htmlFo');

		//Références liens : js et css
		$rep->addJSLink($gJConfig->urlengine['basePath'] .'design/front/js/petiteAnnonceResult.js');			
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyMembre.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounce.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosySideColumn.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceDetail.css');

		//Template utilisé
		$rep->bodyTpl = 'petiteAnnonce~petiteAnnonceCategorieFo';

		//Param
		$tParams = array();

		//Ajout des zones visibles:
		//Publication
		$rep->body->assignZone('innerPageAdSpace', 'publication~innerPageAdSpaceFo');		
		$rep->body->assignZone('innerPageAdSpaces', 'publication~innerPageAdSpacesFo');		
		//PetiteAnnonce
		$rep->body->assignZone('innerPagePetiteAnnonceVehicule', 'petiteAnnonce~innerPagePetiteAnnonceFo', array('cat'=>1));		
		$rep->body->assignZone('innerPagePetiteAnnonceImmobilier', 'petiteAnnonce~innerPagePetiteAnnonceFo', array('cat'=>2));		
		$rep->body->assignZone('innerPagePetiteAnnonceEmploi', 'petiteAnnonce~innerPagePetiteAnnonceFo', array('cat'=>3));		
		$rep->body->assignZone('innerPagePetiteAnnonceAutres', 'petiteAnnonce~innerPagePetiteAnnonceFo', array('cat'=>4));		

		$zUrl = jUrl::get('petiteAnnonce~petiteAnnonceFo_petiteAnnonceCategorieList');
		$rep->body->assignZone('breadcrumbs', 'commun~breadcrumbsFo', array('zAriane'=>'<a href="'.$zUrl.'">PetiteAnnonces</a><span>&nbsp;&raquo;&nbsp;</span>Liste des cat&eacute;gories'));		
		$rep->body->assignZone('contentPageMain', 'petiteAnnonce~contentPageMainPetiteAnnonceCategorieListFo', $tParams);	

		//$rep->body->assignZone("loginForm", "accueil~loginFo", array('is_loged'=>0));
        
        return $rep;
	}


	//Affiche la page de liste des résultats de recherche
	function petiteAnnonceResultList()
	{
		global $gJConfig;
        $rep = $this->getResponse('htmlFo');

		//Template utilisé
		$rep->bodyTpl = 'petiteAnnonce~petiteAnnonceCategorieFo';

		//Références liens : js et css
		$rep->addJSLink($gJConfig->urlengine['basePath'] .'design/front/js/petiteAnnonceResult.js');			
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyMembre.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceDetail.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounce.css');


		//Param de pagination
		if ($this->param('sortField')) {
			$this->sortField = $this->param('sortField');
		}else{
			$this->sortField = "petiteAnnonce_titre";
		}
		if ($this->param('sortDirection')) {
			$this->sortDirection = $this->param('sortDirection');
		}else{
			$this->sortDirection = "ASC";
		}
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}

		//Param d'affichage
		if ($this->param('affichage')) {
			$this->affichage = $this->param('affichage');
		}else{
			$this->affichage = "abrege";
		}
		
		//Param de recherche
		if ($this->intParam('cid')) {
			$this->cid = $this->intParam('cid');
		}else{
			$this->cid = 0;
		}	
		if ($this->intParam('rid')) {
			$this->rid = $this->intParam('rid');
		}else{
			$this->rid = 0;
		}	
		if ($this->param('mot')) {
			$this->mot = $this->param('mot');
		}else{
			$this->mot = "";
			
			if ($this->param('searchInput')) {
				$this->mot = $this->param('searchInput');
			}
			if ($this->param('searchInput2')) {
				$this->mot = $this->param('searchInput2');
			}
		}			
		if ($this->param('crid')) {
			$this->crid = $this->param('crid');
		}else{
			$this->crid = 0;
		}	
		if ($this->intParam('parution')) {
			$this->parution = $this->intParam('parution');
		}else{
			$this->parution = 0;
		}	
		if ($this->intParam('localite')) {
			$this->localite = $this->intParam('localite');
		}else{
			$this->localite = 0;
		}	
		if ($this->intParam('province')) {
			$this->province = $this->intParam('province');
		}else{
			$this->province = 0;
		}	

		if ($this->intParam('prix1')) {
			$this->prix1 = $this->intParam('prix1');
		}else{
			$this->prix1 = 0;
		}	
		if ($this->intParam('prix2')) {
			$this->prix2 = $this->intParam('prix2');
		}else{
			$this->prix2 = 0;
		}	



		$zoneUsed 		= "";
		$nbPagination 	= 10;
		switch ($this->affichage){
			case "detail":
				$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceListDetail.css');
				$zoneUsed 		= "petiteAnnonce~contentPageMainResultListDetailFo";
				$nbPagination 	= 5;
				break;
			case "abrege":
				$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceListAbrege.css');
				$zoneUsed 		= "petiteAnnonce~contentPageMainResultListAbregeFo";
				$nbPagination 	= 10;
				break;
			case "photo":
				$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceListPhoto.css');
				$zoneUsed 		= "petiteAnnonce~contentPageMainResultListPhotoFo";
				$nbPagination 	= 9;
				break;
			default:
				$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceListDetail.css');
				$zoneUsed 		= "petiteAnnonce~contentPageMainResultListDetailFo";
				$nbPagination 	= 5;
				break;		
		}

		//Param
		$tParams = array('nbPagination'=> $nbPagination, 'sortField'=> $this->sortField, 'sortDirection'=> $this->sortDirection, 'page'=> $this->page, 'affichage'=> $this->affichage, 'cid'=> $this->cid, 'rid'=> $this->rid, 'mot'=> $this->mot, 'crid'=> $this->crid, 'parution'=> $this->parution, 'province'=> $this->province, 'localite'=> $this->localite, 'prix1'=> $this->prix1, 'prix2'=> $this->prix2);

		//Ajout des zones visibles:
		//Publication
		$rep->body->assignZone('innerPageAdSpace', 'publication~innerPageAdSpaceFo');		
		$rep->body->assignZone('innerPageAdSpaces', 'publication~innerPageAdSpacesFo');		
		//PetiteAnnonce
		$rep->body->assignZone('innerPagePetiteAnnonceVehicule', 'petiteAnnonce~innerPagePetiteAnnonceFo', array('cat'=>1));		
		$rep->body->assignZone('innerPagePetiteAnnonceImmobilier', 'petiteAnnonce~innerPagePetiteAnnonceFo', array('cat'=>2));		
		$rep->body->assignZone('innerPagePetiteAnnonceEmploi', 'petiteAnnonce~innerPagePetiteAnnonceFo', array('cat'=>3));		
		$rep->body->assignZone('innerPagePetiteAnnonceAutres', 'petiteAnnonce~innerPagePetiteAnnonceFo', array('cat'=>4));		

		$zUrl = jUrl::get('petiteAnnonce~petiteAnnonceFo_petiteAnnonceCategorieList');
		$rep->body->assignZone('breadcrumbs', 'commun~breadcrumbsFo', array('zAriane'=>'<a href="'.$zUrl.'">PetiteAnnonces</a><span>&nbsp;&raquo;&nbsp;</span>R&eacute;sultats de la recherche'));		
		$rep->body->assignZone('contentPageMain', $zoneUsed, $tParams);	

		//$rep->body->assignZone("loginForm", "accueil~loginFo", array('is_loged'=>0));
        
        return $rep;
	}

	//Affiche la page de liste des résultats de recherche
	function petiteAnnonceDetail()
	{
		global $gJConfig;
        $rep = $this->getResponse('htmlFo');

		//Template utilisé
		$rep->bodyTpl = 'petiteAnnonce~petiteAnnonceDetailFo';
		

		//Références liens : js et css
		$rep->addJSLink($gJConfig->urlengine['basePath'] .'design/front/js/petiteAnnonceResult.js');			
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyMembre.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounce.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceDetail.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosySideColumn.css');

		//Param de pagination
		if ($this->param('sortField')) {
			$this->sortField = $this->param('sortField');
		}else{
			$this->sortField = "petiteAnnonce_titre";
		}
		if ($this->param('sortDirection')) {
			$this->sortDirection = $this->param('sortDirection');
		}else{
			$this->sortDirection = "ASC";
		}
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}

		//Param d'affichage
		if ($this->param('affichage')) {
			$this->affichage = $this->param('affichage');
		}else{
			$this->affichage = "abrege";
		}
		
		//Param de recherche
		if ($this->intParam('cid')) {
			$this->cid = $this->intParam('cid');
		}else{
			$this->cid = 0;
		}	
		if ($this->intParam('rid')) {
			$this->rid = $this->intParam('rid');
		}else{
			$this->rid = 0;
		}	
		if ($this->param('mot')) {
			$this->mot = $this->param('mot');
		}else{
			$this->mot = "";
		}	
		if ($this->param('crid')) {
			$this->crid = $this->param('crid');
		}else{
			$this->crid = 0;
		}	
		if ($this->intParam('parution')) {
			$this->parution = $this->intParam('parution');
		}else{
			$this->parution = 0;
		}	
		if ($this->intParam('localite')) {
			$this->localite = $this->intParam('localite');
		}else{
			$this->localite = 0;
		}	
		if ($this->intParam('province')) {
			$this->province = $this->intParam('province');
		}else{
			$this->province = 0;
		}	
		if ($this->intParam('prix1')) {
			$this->prix1 = $this->intParam('prix1');
		}else{
			$this->prix1 = 0;
		}	
		if ($this->intParam('prix2')) {
			$this->prix2 = $this->intParam('prix2');
		}else{
			$this->prix2 = 0;
		}	

		//Param de l'petiteAnnonce
		if ($this->intParam('anid')) {
			$this->anid = $this->intParam('anid');
		}else{
			$this->anid = 0;
		}	

		//Ajout des zones visibles:
		//Publication
		$rep->body->assignZone('innerPageAdSpace', 'publication~innerPageAdSpaceFo');		
		$rep->body->assignZone('innerPageAdSpaces', 'publication~innerPageAdSpacesFo');		
		$rep->body->assignZone('innerPageAdContacts', 'petiteAnnonce~innerPageAdContactsFo', array('anid'=> $this->anid));		
		//PetiteAnnonce
		$rep->body->assignZone('innerPagePetiteAnnonceVehicule', 'petiteAnnonce~innerPagePetiteAnnonceFo', array('cat'=>1));		
		$rep->body->assignZone('innerPagePetiteAnnonceImmobilier', 'petiteAnnonce~innerPagePetiteAnnonceFo', array('cat'=>2));		
		$rep->body->assignZone('innerPagePetiteAnnonceEmploi', 'petiteAnnonce~innerPagePetiteAnnonceFo', array('cat'=>3));		
		$rep->body->assignZone('innerPagePetiteAnnonceAutres', 'petiteAnnonce~innerPagePetiteAnnonceFo', array('cat'=>4));		

		$zUrl = jUrl::get('petiteAnnonce~petiteAnnonceFo_petiteAnnonceCategorieList');
		$rep->body->assignZone('breadcrumbs', 'commun~breadcrumbsFo', array('zAriane'=>'<a href="'.$zUrl.'">PetiteAnnonces</a><span>&nbsp;&raquo;&nbsp;</span>R&eacute;sultats de la recherche'));		
		
		//Choix du template à utiliser
		jClasses::inc('petiteAnnonce~petiteAnnonceSrv');
		jClasses::inc('abonnement~abonnementSrv');
		jClasses::inc('forfait~forfaitSrv');

		//PetiteAnnonce en cours
		$toPetiteAnnonce = petiteAnnonceSrv::chargePetiteAnnonce($this->anid);
		//Abonnemnet en cours
		$toAbonnement 	= abonnementSrv::chargeAbonnement($toPetiteAnnonce->petiteAnnonce_abonnementId);
		//Forfait en cours
		$toForfait 		= forfaitSrv::chargeForfait($toAbonnement->abonnement_forfaitId);

		switch($toForfait->forfait_packId){
			case PACK_VEHICULES:
				$strCategorie = 'vehicule~contentPageMainVehiculeViewFo';
				break;
			case PACK_IMMOBILIERS:
				$strCategorie = 'immobilier~contentPageMainImmobilierViewFo';
				break;
			case PACK_EMPLOIS:
				//$strCategorie = 'emploi~contentPageMainEmploiViewFo';
				$strCategorie = '';
				break;
			default:
				//$strCategorie = 'petiteAnnonce~contentPageMainAutreViewFo';
				$strCategorie = '';
				break;
		}	

		//Caracteristiques
		if(strlen($strCategorie)){
			$rep->body->assignZone('contentPageMainCaracteristique', $strCategorie, array('anid'=>$this->anid));			
			$caracteristique = $rep->body->_vars['contentPageMainCaracteristique'];
		}else{
			$caracteristique = "";
		}	

		//Param
		$tParams = array('sortField'=> $this->sortField, 'sortDirection'=> $this->sortDirection, 'page'=> $this->page, 'affichage'=> $this->affichage, 'anid'=> $this->anid, 'cid'=> $this->cid, 'rid'=> $this->rid, 'mot'=> $this->mot, 'crid'=> $this->crid, 'parution'=> $this->parution, 'province'=> $this->province, 'localite'=> $this->localite, 'prix1'=> $this->prix1, 'prix2'=> $this->prix2, 'caracteristique'=> $caracteristique);
				
		$rep->body->assignZone('contentPageMain', 'petiteAnnonce~contentPageMainResultDetailFo', $tParams);	

		//$rep->body->assignZone("loginForm", "accueil~loginFo", array('is_loged'=>0));
        
        return $rep;
	}

	//Affiche la page de liste des petiteAnnonces membre	
	function petiteAnnonceList_()
	{
		global $gJConfig;
        $rep = $this->getResponse('htmlFo');

		//Références liens : js et css
		$rep->addJSLink($gJConfig->urlengine['basePath'] .'design/front/js/petiteAnnonce.js');			
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyMembre.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounce.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceListAbrege.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceDetail.css');

		
		//Template utilisé
		$rep->bodyTpl = 'petiteAnnonce~petiteAnnonceTableFo';

		//Param
		if ($this->param('sortField')) {
			$this->sortField = $this->param('sortField');
		}else{
			$this->sortField = "petiteAnnonce_titre";
		}
		if ($this->param('sortDirection')) {
			$this->sortDirection = $this->param('sortDirection');
		}else{
			$this->sortDirection = "ASC";
		}


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

		//Param
		$tParams = array('sortField'=> $this->sortField, 'sortDirection'=> $this->sortDirection, 'page'=> $this->page, 'aid'=> $this->aid);

		//Ajout des zones visibles:
		//Publication
		$rep->body->assignZone('innerPageAdSpace', 'publication~innerPageAdSpaceFo');		
		$rep->body->assignZone('innerPageAdSpaces', 'publication~innerPageAdSpacesFo');		
		//PetiteAnnonce
		$rep->body->assignZone('innerPagePetiteAnnonceVehicule', 'petiteAnnonce~innerPagePetiteAnnonceFo', array('cat'=>1));		
		$rep->body->assignZone('innerPagePetiteAnnonceImmobilier', 'petiteAnnonce~innerPagePetiteAnnonceFo', array('cat'=>2));		
		$rep->body->assignZone('innerPagePetiteAnnonceEmploi', 'petiteAnnonce~innerPagePetiteAnnonceFo', array('cat'=>3));		
		$rep->body->assignZone('innerPagePetiteAnnonceAutres', 'petiteAnnonce~innerPagePetiteAnnonceFo', array('cat'=>4));		

		$zUrl = jUrl::get('membre~membreFo_tableBord');
		$rep->body->assignZone('breadcrumbs', 'commun~breadcrumbsFo', array('zAriane'=>'<a href="'.$zUrl.'">Espace Membre</a><span>&nbsp;&raquo;&nbsp;</span>Vos petiteAnnonces'));		
		
		$rep->body->assignZone('contentPageMain', 'petiteAnnonce~contentPageMainPetiteAnnonceListFo', $tParams);			

		$rep->body->assign('zMemberWrap', 'member_petiteAnnonce');	
		
		//$rep->body->assignZone("loginForm", "accueil~loginFo", array('is_loged'=>0));
        
        return $rep;
	}


	//Affiche la page d'édition d'un petiteAnnonce membre	
	function petiteAnnonceEdit()
	{
		global $gJConfig;
        $rep = $this->getResponse('htmlFo');

		//Références liens : js et css
		$rep->addJSLink($gJConfig->urlengine['basePath'] .'design/front/js/petiteAnnonce.js');			
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyMembre.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounce.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceDetail.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosySideColumn.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceDiv.css');
		
		//Template utilisé
		$rep->bodyTpl = 'petiteAnnonce~petiteAnnonceTableFo';

		//Paramètres


		$this->sortField 		= $this->param('sortField');
		$this->sortDirection 	= $this->param('sortDirection');

		$this->page	= $this->intParam('page', 1);
		$this->aid 	= $this->intParam('aid', 0);
		$this->anid = $this->intParam('anid', 0);

		//Ajout des zones visibles:
		//Publication
		$rep->body->assignZone('innerPageAdSpace', 'publication~innerPageAdSpaceFo');		
		$rep->body->assignZone('innerPageAdSpaces', 'publication~innerPageAdSpacesFo');		
		//PetiteAnnonce
		$rep->body->assignZone('innerPagePetiteAnnonceVehicule', 'petiteAnnonce~innerPagePetiteAnnonceFo', array('cat'=>1));		
		$rep->body->assignZone('innerPagePetiteAnnonceImmobilier', 'petiteAnnonce~innerPagePetiteAnnonceFo', array('cat'=>2));		
		$rep->body->assignZone('innerPagePetiteAnnonceEmploi', 'petiteAnnonce~innerPagePetiteAnnonceFo', array('cat'=>3));		
		$rep->body->assignZone('innerPagePetiteAnnonceAutres', 'petiteAnnonce~innerPagePetiteAnnonceFo', array('cat'=>4));		

		$zUrl1 = jUrl::get('membre~membreFo_membreTableBord');
		$zUrl2 = jUrl::get('petiteAnnonce~petiteAnnonceFo_petiteAnnonceList', array('aid'=>$this->aid));
		$rep->body->assignZone('breadcrumbs', 'commun~breadcrumbsFo', array('zAriane'=>'<a href="'.$zUrl1.'">Espace Membre</a><span>&nbsp;&raquo;&nbsp;</span><a href="'.$zUrl2.'">Vos petiteAnnonce</a><span>&nbsp;&raquo;&nbsp;</span>Edition d\'une petiteAnnonce'));		

		//Choix du template à utiliser
		jClasses::inc('forfait~forfaitSrv');
		jClasses::inc('abonnement~abonnementSrv');

		//Abonnemnet en cours
		$toAbonnement 	= abonnementSrv::chargeAbonnement($this->aid);
		//Forfait en cours
		$toForfait 		= forfaitSrv::chargeForfait($toAbonnement->abonnement_forfaitId);

		switch($toForfait->forfait_packId){
			case PACK_VEHICULES:
				$strCategorie = 'vehicule~contentPageMainVehiculeEditFo';
				break;
			case PACK_IMMOBILIERS:
				$strCategorie = 'immobilier~contentPageMainImmobilierEditFo';
				break;
			case PACK_EMPLOIS:
				//$strCategorie = 'emploi~contentPageMainEmploiEditFo';
				$strCategorie = "";
				break;
			default:
				$strCategorie = "";
				break;
		}	

		//Caracteristiques
		if(strlen($strCategorie)){
			$rep->body->assignZone('contentPageMainCaracteristique', $strCategorie, array('anid'=>$this->anid));			
			$caracteristique = $rep->body->_vars['contentPageMainCaracteristique'];
		}else{
			$caracteristique = "";
		}	
				
		$rep->body->assignZone('contentPageMain', 'petiteAnnonce~contentPageMainPetiteAnnonceEditFo', array('sortField'=>$this->sortField, 'sortDirection'=>$this->sortDirection, 'page'=>$this->page, 'aid'=>$this->aid, 'anid'=>$this->anid, "caracteristique"=>$caracteristique));	

		$rep->body->assign('zMemberWrap', 'member_petiteAnnonce');	
		
		//$rep->body->assignZone("loginForm", "accueil~loginFo", array('is_loged'=>0));
        
        return $rep;
	}


	/**
    * Enregistrement des données d'un membre utilisateur
	* 
	* Utilisé en création et modification seulement 
	* Recoit en paramètre l'ensemble des données du formulaire d'édition d'un membre
	* Une fois ls utilisateur sauvegardée, redirige vers la page de liste des membres
    */
    function sauvegardePetiteAnnonce() {
		//Préparation de la réponse
		global $gJConfig;

		//JSON		
		$rep = $this->getResponse('json');

		//Classes
		jClasses::inc('commun~tools');	
		jClasses::inc('credit~creditSrv');	
		jClasses::inc('abonnement~abonnementSrv');	
		jClasses::inc('forfait~forfaitSrv');	
		jClasses::inc('petiteAnnonce~petiteAnnonceSrv');
		jClasses::inc('photo~photoSrv');
		jClasses::inc('vehicule~vehiculeSrv');		
		jClasses::inc('immobilier~immobilierSrv');		
				
		$result 	= array();
		$iReturn 	= true;

		//Récupération des paramètres		

		$is_new = $this->param('petiteAnnonce_id', 0, true);
		
		if($is_new){
			$this->request_utf8_decode();
		}

		$petiteAnnonce  = jMagicLoader::arrayToObject($this->request->params, 'petiteAnnonce');

		//Save		
		$petiteAnnonce->publier 			= $this->param('petiteAnnonce_publier', 0, true);
		$petiteAnnonce->publierHome		= $this->param('petiteAnnonce_publierHome', 0, true);
		
		if($petiteAnnonce->id){		
		
			$petiteAnnonce->dateModification 	= date("Y-m-d");
			
		}else{
		
			//Revois le forfait
			$abonnement = abonnementSrv::getAbonnement($petiteAnnonce->abonnementId);		
			$toPetiteAnnonces = petiteAnnonceSrv::chargeListPetiteAnnonceAllFo();
			$forfait 	= forfaitSrv::getForfait($abonnement->abonnement_forfaitId);
			$nbDuree	= $forfait->forfait_dureeParution / 30;
			$incPetiteAnnonce	= sizeof($toPetiteAnnonces) + 1;
			
			//Champs automatiques
			$petiteAnnonce->reference 		= "an".str_pad($incPetiteAnnonce, 10, "0", STR_PAD_LEFT);		
			$petiteAnnonce->dateCreation 		= date("Y-m-d");
			$petiteAnnonce->dateModification 	= NULL;
			$petiteAnnonce->dateDebut			= date("Y-m-d");
			$petiteAnnonce->dateFin			= date("Y-m-d", strtotime('+'. $nbDuree .' month'));
			$petiteAnnonce->visite 			= 0;
			$petiteAnnonce->dateVisite 		= NULL;
			$petiteAnnonce->photo 			= "";
			$petiteAnnonce->origine 			= "";

			$petiteAnnonce->prix				= $petiteAnnonce->prix;
			$petiteAnnonce->laUne				= 0;
		}

		//print_r($petiteAnnonce);
		$id = petiteAnnonceSrv::sauvegardePetiteAnnonce($petiteAnnonce);
		
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$car_ab = abonnementSrv::getAbonnement($petiteAnnonce->abonnementId);		
		$car_fo	= forfaitSrv::getForfait($car_ab->abonnement_forfaitId);

		switch($car_fo->forfait_packId){
			case PACK_VEHICULES:
				$vehicule = jMagicLoader::arrayToObject($this->request->params, 'vehicule');
				$vehicule->petiteAnnonceId = $id;
				vehiculeSrv::sauvegardeVehicule($vehicule);
				break;
			case PACK_IMMOBILIERS:
				$immobilier = jMagicLoader::arrayToObject($this->request->params, 'immobilier');						
				$immobilier->petiteAnnonceId = $id;
				
				$immobilier->dateOccupation			= strlen($immobilier->dateOccupation)?  tools::toDateSQL($immobilier->dateOccupation) : NULL;
				
				immobilierSrv::sauvegardeImmobilier($immobilier);
				break;
			case PACK_EMPLOIS:
				$emploi = jMagicLoader::arrayToObject($this->request->params, 'emploi');
				$emploi->petiteAnnonceId = $id;
				emploiSrv::sauvegardeEmploi($emploi);
				break;
			default:
				break;
		}	

		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

		//Traitement des photos
		if(!$petiteAnnonce->id){
			$nbPhoto 	= $forfait->forfait_nbPhoto;
			$nbPhotoAdd = $forfait->forfait_nbPhotoAdd;
			
			//Photo
			for($i=0; $i<$nbPhoto; $i++){
				//Object photo
				$photo = photoSrv::getDaoPhoto();				
				$photo->id		= 0;
				$photo->petiteAnnonceId	= $id;
				
				//Répertoire d'upload sur le serveur
				$zPathMedia = ANNONCE_PATH_MEDIAS."images/";		
				//Répertoire de resize sur le serveur
				$zPathResize = ANNONCE_PATH_RESIZE."images/";				
			
				//upload du fichier
				$zNomFichier 	= tools::uploadFile ("petiteAnnonce_photo".$i, $zPathMedia) ;
				$photo->photo 	= $zNomFichier;
				
				if($zNomFichier){
			
					$im_color		= "ffffff";
					$im_cropratio	= "";
					$im_quality		= 90;			
			
					//resize fichier en GF MF PF
					//tools::resizeImage($zPath.''.$zNomFichier, $zPath.'resize_164_121/'.$zNomFichier, I_MAX_WIDTH, I_MAX_HEIGTH, 'ratio');
			
					//resize fichier au format detail : 180 x 135
					tools::resizeImage2($zPathMedia.''.$zNomFichier, $zPathResize.'detail/'.$zNomFichier, $zPathResize.'detail/blank.jpg', ANNONCE_DETAIL_WIDTH, ANNONCE_DETAIL_HEIGHT, $im_color, $im_cropratio, $im_quality);
					//resize fichier au format abrege : 98 x 74
					tools::resizeImage2($zPathMedia.''.$zNomFichier, $zPathResize.'abrege/'.$zNomFichier, $zPathResize.'abrege/blank.jpg', ANNONCE_ABREGE_WIDTH, ANNONCE_ABREGE_HEIGHT, $im_color, $im_cropratio, $im_quality);
					//resize fichier au format photo : 180 x 135
					tools::resizeImage2($zPathMedia.''.$zNomFichier, $zPathResize.'photo/'.$zNomFichier, $zPathResize.'photo/blank.jpg', ANNONCE_PHOTO_WIDTH, ANNONCE_PHOTO_HEIGHT, $im_color, $im_cropratio, $im_quality);
					//resize fichier au format popup : 360 x 270
					tools::resizeImage2($zPathMedia.''.$zNomFichier, $zPathResize.'popup/'.$zNomFichier, $zPathResize.'popup/blank.jpg', ANNONCE_POPUP_WIDTH, ANNONCE_POPUP_HEIGHT, $im_color, $im_cropratio, $im_quality);
					//resize fichier au format popup : 191 x 86
					tools::resizeImage2($zPathMedia.''.$zNomFichier, $zPathResize.'front/'.$zNomFichier, $zPathResize.'front/blank.jpg', ANNONCE_FRONT_WIDTH, ANNONCE_FRONT_HEIGHT, $im_color, $im_cropratio, $im_quality);
					//resize fichier au format home : 469 x 313
					tools::resizeImage2($zPathMedia.''.$zNomFichier, $zPathResize.'home/'.$zNomFichier, $zPathResize.'home/blank.jpg', ANNONCE_HOME_WIDTH, ANNONCE_HOME_HEIGHT, $im_color, $im_cropratio, $im_quality);
					//resize fichier au format home : 50 x 70
					tools::resizeImage2($zPathMedia.''.$zNomFichier, $zPathResize.'left/'.$zNomFichier, $zPathResize.'left/blank.jpg', ANNONCE_LEFT_WIDTH, ANNONCE_LEFT_HEIGHT, $im_color, "1:1", $im_quality);
					
					$idPhoto = photoSrv::sauvegardePhoto($photo);
				}	
			}
			//PhotoAdd
			for($i=0; $i<$nbPhotoAdd; $i++){
				//Object photo
				$photo = photoSrv::getDaoPhoto();				
				$photo->id		= 0;
				$photo->petiteAnnonceId	= $id;
				
				//Répertoire d'upload sur le serveur
				$zPathMedia = ANNONCE_PATH_MEDIAS."images/";		
				//Répertoire de resize sur le serveur
				$zPathResize = ANNONCE_PATH_RESIZE."images/";				
			
				//upload du fichier
				$zNomFichier 	= tools::uploadFile ("petiteAnnonce_photoAdd".$i, $zPathMedia) ;
				$photo->photo 	= $zNomFichier;
				
				if($zNomFichier){
			
					$im_color		= "ffffff";
					$im_cropratio	= "";
					$im_quality		= 90;			
			
					//resize fichier en GF MF PF
					//tools::resizeImage($zPath.''.$zNomFichier, $zPath.'resize_164_121/'.$zNomFichier, I_MAX_WIDTH, I_MAX_HEIGTH, 'ratio');
			
					//resize fichier au format detail : 180 x 135
					tools::resizeImage2($zPathMedia.''.$zNomFichier, $zPathResize.'detail/'.$zNomFichier, $zPathResize.'detail/blank.jpg', ANNONCE_DETAIL_WIDTH, ANNONCE_DETAIL_HEIGHT, $im_color, $im_cropratio, $im_quality);
					//resize fichier au format abrege : 98 x 74
					tools::resizeImage2($zPathMedia.''.$zNomFichier, $zPathResize.'abrege/'.$zNomFichier, $zPathResize.'abrege/blank.jpg', ANNONCE_ABREGE_WIDTH, ANNONCE_ABREGE_HEIGHT, $im_color, $im_cropratio, $im_quality);
					//resize fichier au format photo : 180 x 135
					tools::resizeImage2($zPathMedia.''.$zNomFichier, $zPathResize.'photo/'.$zNomFichier, $zPathResize.'photo/blank.jpg', ANNONCE_PHOTO_WIDTH, ANNONCE_PHOTO_HEIGHT, $im_color, $im_cropratio, $im_quality);
					//resize fichier au format popup : 360 x 270
					tools::resizeImage2($zPathMedia.''.$zNomFichier, $zPathResize.'popup/'.$zNomFichier, $zPathResize.'popup/blank.jpg', ANNONCE_POPUP_WIDTH, ANNONCE_POPUP_HEIGHT, $im_color, $im_cropratio, $im_quality);
					//resize fichier au format popup : 191 x 86
					tools::resizeImage2($zPathMedia.''.$zNomFichier, $zPathResize.'front/'.$zNomFichier, $zPathResize.'front/blank.jpg', ANNONCE_FRONT_WIDTH, ANNONCE_FRONT_HEIGHT, $im_color, $im_cropratio, $im_quality);
					//resize fichier au format home : 469 x 313
					tools::resizeImage2($zPathMedia.''.$zNomFichier, $zPathResize.'home/'.$zNomFichier, $zPathResize.'home/blank.jpg', ANNONCE_HOME_WIDTH, ANNONCE_HOME_HEIGHT, $im_color, $im_cropratio, $im_quality);
					//resize fichier au format home : 50 x 70
					tools::resizeImage2($zPathMedia.''.$zNomFichier, $zPathResize.'left/'.$zNomFichier, $zPathResize.'left/blank.jpg', ANNONCE_LEFT_WIDTH, ANNONCE_LEFT_HEIGHT, $im_color, "1:1", $im_quality);
					
					$idPhoto = photoSrv::sauvegardePhoto($photo);
				}	
			}
		}


		//Paramètres
		$result = array("statut"=>$id);
		
		$rep->datas = $result;		
		//die();
		
		return $rep;
    }
	

	//Supprime un petiteAnnonce et le redirige vers la page de liste des petiteAnnonce d'un membre	
	function petiteAnnonceDelete()
	{
		global $gJConfig;
		$rep = $this->getResponse('redirect');
		$rep->action  = 'petiteAnnonce~petiteAnnonceFo_petiteAnnonceList';

		//Paramètres
		$petiteAnnonceId 	= $this->intParam('aid', 0);

		//Suppression
		jClasses::inc('petiteAnnonceSrv');
		petiteAnnonceSrv::supprimePetiteAnnonce($petiteAnnonceId);

		//$rep->params = $tParams;
        
        return $rep;
	}
	
	
	function chargeSelectLocalite(){
		global $gJConfig;
        $rep = $this->getResponse('json');
		jClasses::inc('petiteAnnonce~petiteAnnonceSrv');
		$idProvince = $this->intParam('idProvince', 0, true);
		
		$toLocalite = petiteAnnonceSrv::getAllLocalite($idProvince);
		if(sizeof($toLocalite)>0)
		{
			$tLocalite = array();
			foreach($toLocalite as $oLocalite)
			{
				$oLocalite->localite_libelle = htmlentities($oLocalite->localite_libelle);
				array_push($tLocalite, $oLocalite);
			}
			$result = array('toLocalite' => $tLocalite);
		}
		else
			$result = array('toLocalite' => 0);

		$rep->datas = $result;
		return $rep;	
	}

	/**
    * Supprime la photo de profil d'un membre utilisateur
	* 
	* Utilisé via mode edition popup 
	* Recoit en paramètre l'ensemble des données du formulaire d'édition d'un membre
	* Une fois ls utilisateur sauvegardée, redirige vers la page de liste des membres
    */
    function removePhoto() {
		//Préparation de la réponse
		global $gJConfig;

		//JSON		
		$rep = $this->getResponse('json');

		//Classes
		jClasses::inc('commun~tools');	
		jClasses::inc('photo~photoSrv');

		$response = array('imgSrc'=>'');
		$iReturn 	= true;

		//Récupération des paramètres
		$photo = jMagicLoader::arrayToObject($this->request->params, 'photo');
		
		//Nom du fichier
		$zNomFichier = $photo->photo;
		
		//Répertoire d'upload sur le serveur
		$zPathMedia = ANNONCE_PATH_MEDIAS."images/";		
		//Répertoire de resize sur le serveur
		$zPathResize = ANNONCE_PATH_RESIZE."images/";				

		//Supprime les fichiers
		if(($zNomFichier != "nophoto.jpg")&&($zNomFichier != "noPhoto.jpg")){
			tools::removeFile ($zPathMedia.''.$zNomFichier);
			tools::removeFile ($zPathResize.'detail/'.$zNomFichier);
			tools::removeFile ($zPathResize.'abrege/'.$zNomFichier);
			tools::removeFile ($zPathResize.'photo/'.$zNomFichier);
			tools::removeFile ($zPathResize.'popup/'.$zNomFichier);
			tools::removeFile ($zPathResize.'front/'.$zNomFichier);
			tools::removeFile ($zPathResize.'home/'.$zNomFichier);
			tools::removeFile ($zPathResize.'left/'.$zNomFichier);
		}	

		$photo->photo = "noPhoto.jpg";
		
		//Update
		$iReturn = photoSrv::sauvegardePhoto($photo);

		//Paramètres
		$response['imgSrc'] = "noPhoto.jpg";
		
		$rep->datas = $response;
		return $rep;
    }


	/**
    * Changement de la photo de profil d'un membre utilisateur
	* 
	* Utilisé via mode edition popup 
	* Recoit en paramètre l'ensemble des données du formulaire d'édition d'un membre
	* Une fois ls utilisateur sauvegardée, redirige vers la page de liste des membres
    */
    function changePhoto() {
		//Préparation de la réponse
		global $gJConfig;

		//JSON		
		$rep = $this->getResponse('json');

		//Classes
		jClasses::inc('commun~tools');	
		jClasses::inc('photo~photoSrv');

		$response = array('imgSrc'=>'');
		$iReturn 	= true;

		//Récupération des paramètres
		$photo = jMagicLoader::arrayToObject($this->request->params, 'photo');

		//$utilisateur->id 				= 0;
		
		//Traitement de la photo
		//creation rep upload image sur le serveur
		//$zPath = JELIX_APP_WWW_PATH.'medias/utilisateur/' ;		
		//tools::createDirectory($zPath) ;  	

		//Répertoire d'upload sur le serveur
		$zPathMedia = ANNONCE_PATH_MEDIAS."images/";		
		//Répertoire de resize sur le serveur
		$zPathResize = ANNONCE_PATH_RESIZE."images/";				

		//upload du fichier
		$zNomFichier 		= tools::uploadFile ("user_photo", $zPathMedia) ;
		$photo->photo = $zNomFichier;
		
		if($zNomFichier){

			$im_color		= "ffffff";
			//$im_cropratio	= "1:1";
			$im_cropratio	= "";
			$im_quality		= 90;			

			//resize fichier en GF MF PF
			//tools::resizeImage($zPath.''.$zNomFichier, $zPath.'resize_164_121/'.$zNomFichier, I_MAX_WIDTH, I_MAX_HEIGTH, 'ratio');

			//resize fichier au format detail : 180 x 135
			tools::resizeImage2($zPathMedia.''.$zNomFichier, $zPathResize.'detail/'.$zNomFichier, $zPathResize.'detail/blank.jpg', ANNONCE_DETAIL_WIDTH, ANNONCE_DETAIL_HEIGHT, $im_color, $im_cropratio, $im_quality);
			//resize fichier au format abrege : 98 x 74
			tools::resizeImage2($zPathMedia.''.$zNomFichier, $zPathResize.'abrege/'.$zNomFichier, $zPathResize.'abrege/blank.jpg', ANNONCE_ABREGE_WIDTH, ANNONCE_ABREGE_HEIGHT, $im_color, $im_cropratio, $im_quality);
			//resize fichier au format photo : 180 x 135
			tools::resizeImage2($zPathMedia.''.$zNomFichier, $zPathResize.'photo/'.$zNomFichier, $zPathResize.'photo/blank.jpg', ANNONCE_PHOTO_WIDTH, ANNONCE_PHOTO_HEIGHT, $im_color, $im_cropratio, $im_quality);
			//resize fichier au format popup : 360 x 270
			tools::resizeImage2($zPathMedia.''.$zNomFichier, $zPathResize.'popup/'.$zNomFichier, $zPathResize.'popup/blank.jpg', ANNONCE_POPUP_WIDTH, ANNONCE_POPUP_HEIGHT, $im_color, $im_cropratio, $im_quality);
			//resize fichier au format popup : 360 x 270
			tools::resizeImage2($zPathMedia.''.$zNomFichier, $zPathResize.'front/'.$zNomFichier, $zPathResize.'front/blank.jpg', ANNONCE_FRONT_WIDTH, ANNONCE_FRONT_HEIGHT, $im_color, $im_cropratio, $im_quality);
			//resize fichier au format home : 469 x 313
			tools::resizeImage2($zPathMedia.''.$zNomFichier, $zPathResize.'home/'.$zNomFichier, $zPathResize.'home/blank.jpg', ANNONCE_HOME_WIDTH, ANNONCE_HOME_HEIGHT, $im_color, $im_cropratio, $im_quality);
			//resize fichier au format home : 50 x 70
			tools::resizeImage2($zPathMedia.''.$zNomFichier, $zPathResize.'left/'.$zNomFichier, $zPathResize.'left/blank.jpg', ANNONCE_LEFT_WIDTH, ANNONCE_LEFT_HEIGHT, $im_color, "1:1", $im_quality);
		}	

		//Supprime le fichier source
		tools::removeFile ($zPathMedia.''.$zNomFichier);
			
			
		//print_r($photo);	
		//die();
		//Enregistrement
		$iReturn = photoSrv::sauvegardePhoto($photo);

		//Paramètres
		$response['imgSrc'] = $zNomFichier;
		
		$rep->datas = $response;
		return $rep;
    }

}
?>
