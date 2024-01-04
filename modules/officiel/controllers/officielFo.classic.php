<?php
/**
* @package ilay-nosy
* @subpackage accueil
* @author
* @copyright
* @link
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

class officielFoCtrl extends jController {
    /**
    *
    */
	//Toutes les actions de ce contrôleur nécessite une authentification via le plugin jAuth
	public $pluginParams = array('updateOfficiel'=>array('connexion.membre'=>true),

								 'officielCategorieList'=>array('connexion.membre'=>false),
								 'officielResultList'=>array('connexion.membre'=>false),
								 'officielDetail'=>array('connexion.membre'=>false),
	
								 'officielList'=>array('connexion.membre'=>true),
								 'officielEdit'=>array('connexion.membre'=>true),
								 'sauvegardeOfficiel'=>array('connexion.membre'=>true),

								 'chargeSelectLocalite'=>array('connexion.membre'=>false),
								 'changePhoto'=>array('connexion.membre'=>true),
								 'removePhoto'=>array('connexion.membre'=>true),
								 'officielDelete'=>array('connexion.membre'=>true)
								 );

	function updateOfficiel()
	{
		global $gJConfig;
        $rep = $this->getResponse('json');
		jClasses::inc('officiel~officielSrv');

		$idOfficiel = $this->intParam('idOfficiel', 0, true);
		$publier = $this->intParam('publier', -1, true);
		officielSrv::updateOfficiel($idOfficiel, $publier);

		return $rep;	
	}


	//Affiche la page de liste des rubriques d'officiels
	function officielCategorieList()
	{
		global $gJConfig;
        $rep = $this->getResponse('htmlFo');

		//Références liens : js et css
		$rep->addJSLink($gJConfig->urlengine['basePath'] .'design/front/js/officielResult.js');			
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyMembre.css');
		//$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyNew.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyOfficiel.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosySideColumn.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyOfficielDetail.css');

		//Template utilisé
		$rep->bodyTpl = 'officiel~officielCategorieFo';

		//Param
		$tParams = array();

		//Ajout des zones visibles:
		
		//Officiel
		$rep->body->assignZone('innerPageNew', 'officiel~innerPageNewFo');	
		
		//Publication
		$rep->body->assignZone('innerPageAdSpace', 'publication~innerPageAdSpaceFo');		
		$rep->body->assignZone('innerPageAdSpaces', 'publication~innerPageAdSpacesFo');		
		
		//Annonces
		$rep->body->assignZone('innerPageAnnonceVehicule', 'annonce~innerPageAnnonceFo', array('cat'=>1));		
		$rep->body->assignZone('innerPageAnnonceImmobilier', 'annonce~innerPageAnnonceFo', array('cat'=>2));		
		$rep->body->assignZone('innerPageAnnonceEmploi', 'annonce~innerPageAnnonceFo', array('cat'=>3));		
		$rep->body->assignZone('innerPageAnnonceAutres', 'annonce~innerPageAnnonceFo', array('cat'=>4));		
		//Petites annonces
		$rep->body->assignZone('innerPagePetiteAnnonce', 'petiteAnnonce~innerPagePetiteAnnonceFo');		

		$zUrl = jUrl::get('officiel~officielFo_officielCategorieList');
		$rep->body->assignZone('breadcrumbs', 'commun~breadcrumbsFo', array('zAriane'=>'<a href="'.$zUrl.'">Officiels</a><span>&nbsp;&raquo;&nbsp;</span>Liste des cat&eacute;gories'));		
		$rep->body->assignZone('contentPageMain', 'officiel~contentPageMainNewCategorieListFo', $tParams);	

		//$rep->body->assignZone("loginForm", "accueil~loginFo", array('is_loged'=>0));
        
        return $rep;
	}


	//Affiche la page de liste des résultats de recherche
	function officielResultList()
	{
		global $gJConfig;
        $rep = $this->getResponse('htmlFo');

		//Template utilisé
		$rep->bodyTpl = 'officiel~officielCategorieFo';

		//Références liens : js et css
		$rep->addJSLink($gJConfig->urlengine['basePath'] .'design/front/js/officielResult.js');			
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyMembre.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyOfficielDetail.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyOfficiel.css');


		//Param de pagination
		if ($this->param('sortField')) {
			$this->sortField = $this->param('sortField');
		}else{
			$this->sortField = "officiel_titre";
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
		if ($this->intParam('parution')) {
			$this->parution = $this->intParam('parution');
		}else{
			$this->parution = 0;
		}	

		$zoneUsed 		= "";
		$nbPagination 	= 10;
		switch ($this->affichage){
			case "detail":
				$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceListDetail.css');
				$zoneUsed 		= "officiel~contentPageMainResultListDetailFo";
				$nbPagination 	= 5;
				break;
			case "abrege":
				$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceListAbrege.css');
				$zoneUsed 		= "officiel~contentPageMainResultListAbregeFo";
				$nbPagination 	= 10;
				break;
			case "photo":
				$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceListPhoto.css');
				$zoneUsed 		= "officiel~contentPageMainResultListPhotoFo";
				$nbPagination 	= 9;
				break;
			default:
				$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceListDetail.css');
				$zoneUsed 		= "officiel~contentPageMainResultListDetailFo";
				$nbPagination 	= 5;
				break;		
		}

		//Param
		$tParams = array('nbPagination'=> $nbPagination, 'sortField'=> $this->sortField, 'sortDirection'=> $this->sortDirection, 'page'=> $this->page, 'affichage'=> $this->affichage, 'cid'=> $this->cid, 'mot'=> $this->mot, 'parution'=> $this->parution);

		//Ajout des zones visibles:
		//Officiel
		$rep->body->assignZone('innerPageNew', 'officiel~innerPageNewFo');	

		//Publication
		$rep->body->assignZone('innerPageAdSpace', 'publication~innerPageAdSpaceFo');		
		$rep->body->assignZone('innerPageAdSpaces', 'publication~innerPageAdSpacesFo');		

		//Annonces
		$rep->body->assignZone('innerPageAnnonceVehicule', 'annonce~innerPageAnnonceFo', array('cat'=>1));		
		$rep->body->assignZone('innerPageAnnonceImmobilier', 'annonce~innerPageAnnonceFo', array('cat'=>2));		
		$rep->body->assignZone('innerPageAnnonceEmploi', 'annonce~innerPageAnnonceFo', array('cat'=>3));		
		$rep->body->assignZone('innerPageAnnonceAutres', 'annonce~innerPageAnnonceFo', array('cat'=>4));		
		//Petites annonces
		$rep->body->assignZone('innerPagePetiteAnnonce', 'petiteAnnonce~innerPagePetiteAnnonceFo');		

		$zUrl = jUrl::get('officiel~officielFo_officielCategorieList');
		$rep->body->assignZone('breadcrumbs', 'commun~breadcrumbsFo', array('zAriane'=>'<a href="'.$zUrl.'">Officiels</a><span>&nbsp;&raquo;&nbsp;</span>R&eacute;sultats de la recherche'));		
		$rep->body->assignZone('contentPageMain', $zoneUsed, $tParams);	

		//$rep->body->assignZone("loginForm", "accueil~loginFo", array('is_loged'=>0));
        
        return $rep;
	}

	//Affiche la page de liste des résultats de recherche
	function officielDetail()
	{
		global $gJConfig;
        $rep = $this->getResponse('htmlFo');

		//Template utilisé
		$rep->bodyTpl = 'officiel~officielDetailFo';

		//Références liens : js et css
		$rep->addJSLink($gJConfig->urlengine['basePath'] .'design/front/js/officielResult.js');			
		$rep->addJSLink($gJConfig->urlengine['basePath'] .'design/front/js/offComment.js');			
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyMembre.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyOffForum.css');
		//$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyNew.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyOfficielDetail.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosySideColumn.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyOfficiel.css');

		//Adding today 06-09-2013	
		//$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyActualiteDetail.css');

		//Param de pagination
		if ($this->param('sortField')) {
			$this->sortField = $this->param('sortField');
		}else{
			$this->sortField = "officiel_titre";
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

		//Param de template
		if ($this->param('tplStatic')) {
			$this->tplStatic = $this->param('tplStatic');
		}else{
			$this->tplStatic = "";
		}
		//Param de client
		if ($this->param('offName')) {
			$this->offName = $this->param('offName');
		}else{
			$this->offName = "";
		}
		
		//Param de recherche
		if ($this->intParam('cid')) {
			$this->cid = $this->intParam('cid');
		}else{
			$this->cid = 0;
		}	
		if ($this->param('mot')) {
			$this->mot = $this->param('mot');
		}else{
			$this->mot = "";
		}	
		if ($this->intParam('parution')) {
			$this->parution = $this->intParam('parution');
		}else{
			$this->parution = 0;
		}	

		//Param de l'officiel
		if ($this->intParam('acid')) {
			$this->acid = $this->intParam('acid');
		}else{
			$this->acid = 0;
		}	

		//Param
		$tParams = array('sortField'=> $this->sortField, 'sortDirection'=> $this->sortDirection, 'page'=> $this->page, 'affichage'=> $this->affichage, 'acid'=> $this->acid, 'cid'=> $this->cid, 'mot'=> $this->mot, 'parution'=> $this->parution, 'tplStatic'=> $this->tplStatic, 'offName'=> $this->offName);

		//Ajout des zones visibles:
		//Officiel
		$rep->body->assignZone('innerPageNew', 'officiel~innerPageNewFo');	

		//Publication
		$rep->body->assignZone('innerPageAdSpace', 'publication~innerPageAdSpaceFo');		
		$rep->body->assignZone('innerPageAdSpaces', 'publication~innerPageAdSpacesFo');		

		//Annonces
		$rep->body->assignZone('innerPageAnnonceVehicule', 'annonce~innerPageAnnonceFo', array('cat'=>1));		
		$rep->body->assignZone('innerPageAnnonceImmobilier', 'annonce~innerPageAnnonceFo', array('cat'=>2));		
		$rep->body->assignZone('innerPageAnnonceEmploi', 'annonce~innerPageAnnonceFo', array('cat'=>3));		
		$rep->body->assignZone('innerPageAnnonceAutres', 'annonce~innerPageAnnonceFo', array('cat'=>4));		
		//Petites annonces
		$rep->body->assignZone('innerPagePetiteAnnonce', 'petiteAnnonce~innerPagePetiteAnnonceFo');		

		
		if ($this->tplStatic) {
			$rep->body->assignZone('breadcrumbs', 'commun~breadcrumbsFo', array('zAriane'=>'Page officielle<span>&nbsp;&raquo;&nbsp;</span>Ev&egrave;nement'));		

			$rep->body->assignZone('contentPageMain', 'officiel~contentPageMainOfficielFo', $tParams);	
			$rep->body->assign('offName', $this->offName);	
		}else{
			$zUrl = jUrl::get('officiel~officielFo_officielCategorieList');
			$rep->body->assignZone('breadcrumbs', 'commun~breadcrumbsFo', array('zAriane'=>'<a href="'.$zUrl.'">Page officielle</a><span>&nbsp;&raquo;&nbsp;</span>R&eacute;sultats de la recherche'));		
			$rep->body->assignZone('contentPageMain', 'officiel~contentPageMainResultDetailFo', $tParams);	
		}		
		
		$rep->body->assignZone('contentPageComment', 'officiel~contentPageCommentFo', $tParams);	

		//$rep->body->assignZone("loginForm", "accueil~loginFo", array('is_loged'=>0));
        
        return $rep;
	}


	//Ajoute un commentaire pour l' officiel
	function officielAddComment()
	{
		global $gJConfig;
		$rep = $this->getResponse('json');

		//Classes
		jClasses::inc('commentOff~commentOffSrv');

		//Récupération des paramètres
		$this->request_utf8_decode();
		$commentOff = jMagicLoader::arrayToObject($this->request->params, 'comment');

		$commentOff->id 			= 0;
		$commentOff->dateCreation 	= date("y-m-d H:i:s");
		$commentOff->publier 		= 1;
		
		$id = commentOffSrv::sauvegardeCommentOff($commentOff);
		
		$commentOff->id 		  = $id;
		$commentOff->dateCreation = "Aujourd'hui";
		
		$commentOff->texte = utf8_encode($commentOff->texte);
		$commentOff->texte 		  = nl2br($commentOff->texte);

		$result = array('id' => $id, 'commentOff' => $commentOff);

		$rep->datas = $result;
		return $rep;	
	}

}
?>
