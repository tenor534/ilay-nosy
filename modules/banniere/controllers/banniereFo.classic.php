<?php
/**
* @package ilay-nosy
* @subpackage accueil
* @author
* @copyright
* @link
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

class banniereFoCtrl extends jController {
    /**
    *
    */
	//Toutes les actions de ce contrôleur nécessite une authentification via le plugin jAuth
	public $pluginParams = array('updateBanniere'=>array('connexion.membre'=>true),

								 'banniereCategorieList'=>array('connexion.membre'=>false),
								 'banniereResultList'=>array('connexion.membre'=>false),
								 'banniereDetail'=>array('connexion.membre'=>false),
	
								 'banniereList'=>array('connexion.membre'=>true),
								 'banniereEdit'=>array('connexion.membre'=>true),
								 'sauvegardeBanniere'=>array('connexion.membre'=>true),

								 'chargeSelectLocalite'=>array('connexion.membre'=>false),
								 'changePhoto'=>array('connexion.membre'=>true),
								 'removePhoto'=>array('connexion.membre'=>true),
								 'banniereDelete'=>array('connexion.membre'=>true)
								 );

	function updateBanniere()
	{
		global $gJConfig;
        $rep = $this->getResponse('json');
		jClasses::inc('banniere~banniereSrv');

		$idBanniere = $this->intParam('idBanniere', 0, true);
		$publier = $this->intParam('publier', -1, true);
		banniereSrv::updateBanniere($idBanniere, $publier);

		return $rep;	
	}


	//Affiche la page de liste des rubriques d'bannieres
	function banniereCategorieList()
	{
		global $gJConfig;
        $rep = $this->getResponse('htmlFo');

		//Références liens : js et css
		$rep->addJSLink($gJConfig->urlengine['basePath'] .'design/front/js/banniereResult.js');			
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyMembre.css');
		//$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyNew.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyBanniere.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosySideColumn.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyBanniereDetail.css');

		//Template utilisé
		$rep->bodyTpl = 'banniere~banniereCategorieFo';

		//Param
		$tParams = array();

		//Ajout des zones visibles:
		
		//Banniere
		$rep->body->assignZone('innerPageNew', 'banniere~innerPageNewFo');	
		
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

		$zUrl = jUrl::get('banniere~banniereFo_banniereCategorieList');
		$rep->body->assignZone('breadcrumbs', 'commun~breadcrumbsFo', array('zAriane'=>'<a href="'.$zUrl.'">Bannieres</a><span>&nbsp;&raquo;&nbsp;</span>Liste des cat&eacute;gories'));		
		$rep->body->assignZone('contentPageMain', 'banniere~contentPageMainNewCategorieListFo', $tParams);	

		//$rep->body->assignZone("loginForm", "accueil~loginFo", array('is_loged'=>0));
        
        return $rep;
	}


	//Affiche la page de liste des résultats de recherche
	function banniereResultList()
	{
		global $gJConfig;
        $rep = $this->getResponse('htmlFo');

		//Template utilisé
		$rep->bodyTpl = 'banniere~banniereCategorieFo';

		//Références liens : js et css
		$rep->addJSLink($gJConfig->urlengine['basePath'] .'design/front/js/banniereResult.js');			
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyMembre.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyBanniereDetail.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyBanniere.css');


		//Param de pagination
		if ($this->param('sortField')) {
			$this->sortField = $this->param('sortField');
		}else{
			$this->sortField = "banniere_titre";
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
				$zoneUsed 		= "banniere~contentPageMainResultListDetailFo";
				$nbPagination 	= 5;
				break;
			case "abrege":
				$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceListAbrege.css');
				$zoneUsed 		= "banniere~contentPageMainResultListAbregeFo";
				$nbPagination 	= 10;
				break;
			case "photo":
				$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceListPhoto.css');
				$zoneUsed 		= "banniere~contentPageMainResultListPhotoFo";
				$nbPagination 	= 9;
				break;
			default:
				$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceListDetail.css');
				$zoneUsed 		= "banniere~contentPageMainResultListDetailFo";
				$nbPagination 	= 5;
				break;		
		}

		//Param
		$tParams = array('nbPagination'=> $nbPagination, 'sortField'=> $this->sortField, 'sortDirection'=> $this->sortDirection, 'page'=> $this->page, 'affichage'=> $this->affichage, 'cid'=> $this->cid, 'mot'=> $this->mot, 'parution'=> $this->parution);

		//Ajout des zones visibles:
		//Banniere
		$rep->body->assignZone('innerPageNew', 'banniere~innerPageNewFo');	

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

		$zUrl = jUrl::get('banniere~banniereFo_banniereCategorieList');
		$rep->body->assignZone('breadcrumbs', 'commun~breadcrumbsFo', array('zAriane'=>'<a href="'.$zUrl.'">Bannieres</a><span>&nbsp;&raquo;&nbsp;</span>R&eacute;sultats de la recherche'));		
		$rep->body->assignZone('contentPageMain', $zoneUsed, $tParams);	

		//$rep->body->assignZone("loginForm", "accueil~loginFo", array('is_loged'=>0));
        
        return $rep;
	}

	//Affiche la page de liste des résultats de recherche
	function banniereDetail()
	{
		global $gJConfig;
        $rep = $this->getResponse('htmlFo');

		//Template utilisé
		$rep->bodyTpl = 'banniere~banniereDetailFo';

		//Références liens : js et css
		$rep->addJSLink($gJConfig->urlengine['basePath'] .'design/front/js/banniereResult.js');			
		$rep->addJSLink($gJConfig->urlengine['basePath'] .'design/front/js/actComment.js');			
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyMembre.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyActForum.css');
		//$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyNew.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyBanniereDetail.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosySideColumn.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyBanniere.css');

		//Param de pagination
		if ($this->param('sortField')) {
			$this->sortField = $this->param('sortField');
		}else{
			$this->sortField = "banniere_titre";
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
		}	
		if ($this->intParam('parution')) {
			$this->parution = $this->intParam('parution');
		}else{
			$this->parution = 0;
		}	

		//Param de l'banniere
		if ($this->intParam('acid')) {
			$this->acid = $this->intParam('acid');
		}else{
			$this->acid = 0;
		}	

		//Param
		$tParams = array('sortField'=> $this->sortField, 'sortDirection'=> $this->sortDirection, 'page'=> $this->page, 'affichage'=> $this->affichage, 'acid'=> $this->acid, 'cid'=> $this->cid, 'mot'=> $this->mot, 'parution'=> $this->parution);

		//Ajout des zones visibles:
		//Banniere
		$rep->body->assignZone('innerPageNew', 'banniere~innerPageNewFo');	

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

		$zUrl = jUrl::get('banniere~banniereFo_banniereCategorieList');
		$rep->body->assignZone('breadcrumbs', 'commun~breadcrumbsFo', array('zAriane'=>'<a href="'.$zUrl.'">Bannieres</a><span>&nbsp;&raquo;&nbsp;</span>R&eacute;sultats de la recherche'));		
		$rep->body->assignZone('contentPageMain', 'banniere~contentPageMainResultDetailFo', $tParams);	
		$rep->body->assignZone('contentPageComment', 'banniere~contentPageCommentFo', $tParams);	

		//$rep->body->assignZone("loginForm", "accueil~loginFo", array('is_loged'=>0));
        
        return $rep;
	}


	//Ajoute un commentaire pour l' banniere
	function banniereAddComment()
	{
		global $gJConfig;
		$rep = $this->getResponse('json');

		//Classes
		jClasses::inc('commentAct~commentActSrv');

		//Récupération des paramètres
		$this->request_utf8_decode();
		$commentAct = jMagicLoader::arrayToObject($this->request->params, 'comment');

		$commentAct->id 			= 0;
		$commentAct->dateCreation 	= date("y-m-d H:i:s");
		$commentAct->publier 		= 1;
		
		$id = commentActSrv::sauvegardeCommentAct($commentAct);
		
		$commentAct->id 		  = $id;
		$commentAct->dateCreation = "Aujourd'hui";
		
		$commentAct->texte = utf8_encode($commentAct->texte);
		$commentAct->texte 		  = nl2br($commentAct->texte);

		$result = array('id' => $id, 'commentAct' => $commentAct);

		$rep->datas = $result;
		return $rep;	
	}

}
?>
