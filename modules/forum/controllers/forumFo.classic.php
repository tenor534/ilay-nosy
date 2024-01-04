<?php
/**
* @package ilay-nosy
* @subpackage accueil
* @author
* @copyright
* @link
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

class forumFoCtrl extends jController {
    /**
    *
    */
	//Toutes les actions de ce contrôleur nécessite une authentification via le plugin jAuth
	public $pluginParams = array('updateForum'=>array('connexion.membre'=>true),

								 'forumCategorieList'=>array('connexion.membre'=>false),
								 'forumResultList'=>array('connexion.membre'=>false),
								 'forumDetail'=>array('connexion.membre'=>false),
	
								 'forumList'=>array('connexion.membre'=>false),
								 'forumEdit'=>array('connexion.membre'=>true),
								 'sauvegardeForum'=>array('connexion.membre'=>true),

								 'chargeSelectLocalite'=>array('connexion.membre'=>false),
								 'changePhoto'=>array('connexion.membre'=>true),
								 'removePhoto'=>array('connexion.membre'=>true),
								 'forumDelete'=>array('connexion.membre'=>true)
								 );

	function updateForum()
	{
		global $gJConfig;
        $rep = $this->getResponse('json');
		jClasses::inc('forum~forumSrv');

		$idForum = $this->intParam('idForum', 0, true);
		$publier = $this->intParam('publier', -1, true);
		forumSrv::updateForum($idForum, $publier);

		return $rep;	
	}

	//Affiche la page de liste des forums d'forums
	function forumCategorieList()
	{
		global $gJConfig;
        $rep = $this->getResponse('htmlFo');

		//Références liens : js et css
		$rep->addJSLink($gJConfig->urlengine['basePath'] .'design/front/js/forumResult.js');			
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyMembre.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyForum.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyForumDetail.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosySideColumn.css');

		//Template utilisé
		$rep->bodyTpl = 'forum~forumCategorieFo';

		//Param
		$tParams = array();

		//Ajout des zones visibles:
		//Actualite
		$rep->body->assignZone('innerPageNew', 'actualite~innerPageNewFo');	

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

		$zUrl = jUrl::get('forum~forumFo_forumCategorieList');
		$rep->body->assignZone('breadcrumbs', 'commun~breadcrumbsFo', array('zAriane'=>'<a href="'.$zUrl.'">Forums</a><span>&nbsp;&raquo;&nbsp;</span>Liste des cat&eacute;gories'));		
		$rep->body->assignZone('contentPageMain', 'forum~contentPageMainForumCategorieListFo', $tParams);	

		//$rep->body->assignZone("loginForm", "accueil~loginFo", array('is_loged'=>0));
        
        return $rep;
	}


	//Affiche la page de liste des résultats de recherche
	function forumSujetList()
	{
		global $gJConfig;
        $rep = $this->getResponse('htmlFo');

		//Template utilisé
		$rep->bodyTpl = 'forum~forumCategorieFo';

		//Références liens : js et css
		$rep->addJSLink($gJConfig->urlengine['basePath'] .'design/front/js/forumSujet.js');			
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyMembre.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyForum.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyForumDetail.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosySideColumn.css');


		//Param de pagination
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}

		//Id du forum
		if ($this->intParam('fid')) {
			$this->fid = $this->intParam('fid');
		}else{
			$this->fid = 0;
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
		if ($this->intParam('precision')) {
			$this->precision = $this->intParam('precision');
		}else{
			$this->precision = 0;
		}	
		
		//Pagination
		$nbPagination 	= 5000;
		
		//Param
		$tParams = array('nbPagination'=> $nbPagination, 'page'=> $this->page, 'precision'=> $this->precision, 'cid'=> $this->cid, 'fid'=> $this->fid, 'mot'=> $this->mot, 'parution'=> $this->parution);

		//Ajout des zones visibles:
		//Actualite
		$rep->body->assignZone('innerPageNew', 'actualite~innerPageNewFo');	

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

		$zUrl = jUrl::get('forum~forumFo_forumCategorieList');
		$rep->body->assignZone('breadcrumbs', 'commun~breadcrumbsFo', array('zAriane'=>'<a href="'.$zUrl.'">Forums</a><span>&nbsp;&raquo;&nbsp;</span>Les sujets'));		
		$rep->body->assignZone('contentPageMain', 'forum~contentPageMainForumSujetListFo', $tParams);	

		//$rep->body->assignZone("loginForm", "accueil~loginFo", array('is_loged'=>0));
        
        return $rep;
	}



	//Ajoute un sujet pour le forum
	function forumAddSujet()
	{
		global $gJConfig;
		$rep = $this->getResponse('json');

		//Classes
		jClasses::inc('sujet~sujetSrv');

		//Récupération des paramètres
		$this->request_utf8_decode();
		$sujet = jMagicLoader::arrayToObject($this->request->params, 'sujet');

		//Sujet présents
		$toSujets = sujetSrv::chargeListSujetAllFo();
		$incSujet	= sizeof($toSujets) + 1;


		$sujet->id 					= 0;
		$sujet->reference 			= "s".str_pad($incSujet, 10, "0", STR_PAD_LEFT);			
		$sujet->dateCreation 		= date("y-m-d");
		$sujet->dateModification 	= NULL;
		$sujet->datePublication 	= date("y-m-d H:i:s");
		
		$sujet->vue	 				= 0;
		$sujet->publier 			= 1;
		
		$id = sujetSrv::sauvegardeSujet($sujet);
		
		$sujet->id 		  = $id;
		$sujet->dateCreation = "Aujourd'hui";
		
		$sujet->titre = utf8_encode($sujet->titre);
		//$sujet->titre = nl2br($sujet->titre);

		$result = array('id' => $id, 'sujet' => $sujet);

		$rep->datas = $result;
		return $rep;	
	}

	//Affiche la page de liste des résultats de recherche
	function forumMessageList()
	{
		global $gJConfig;
        $rep = $this->getResponse('htmlFo');

		//Template utilisé
		$rep->bodyTpl = 'forum~forumDetailFo';

		//Références liens : js et css
		$rep->addJSLink($gJConfig->urlengine['basePath'] .'design/front/js/forumComment.js');			
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyMembre.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyForum.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyForumDetail.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosySideColumn.css');


		//Param de pagination
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}

		//Id du forum
		if ($this->intParam('fid')) {
			$this->fid = $this->intParam('fid');
		}else{
			$this->fid = 0;
		}			

		//Id du sujet
		if ($this->intParam('sid')) {
			$this->sid = $this->intParam('sid');
		}else{
			$this->sid = 0;
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
		if ($this->intParam('precision')) {
			$this->precision = $this->intParam('precision');
		}else{
			$this->precision = 0;
		}	
		
		//Param
		$tParams = array('page'=> $this->page, 'precision'=> $this->precision, 'fid'=> $this->fid, 'sid'=> $this->sid, 'cid'=> $this->cid, 'mot'=> $this->mot, 'parution'=> $this->parution);

		//Ajout des zones visibles:
		//Actualite
		$rep->body->assignZone('innerPageNew', 'actualite~innerPageNewFo');	

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

		$zUrl = jUrl::get('forum~forumFo_forumCategorieList');
		$zUrl2 = jUrl::get('forum~forumFo_forumSujetList', array('fid'=>$this->fid));
		
		jClasses::inc('categorieFor~categorieForSrv');
		jClasses::inc('forum~forumSrv');
		$toForum 		= forumSrv::chargeForum($this->fid);
		$toCategorie	= categorieForSrv::chargeCategorieFor($toForum->forum_categorieForId);		
		
		$rep->body->assignZone('breadcrumbs', 'commun~breadcrumbsFo', array('zAriane'=>'<a href="'.$zUrl.'">Forums</a><span>&nbsp;&raquo;&nbsp;</span><a href="'.$zUrl2.'">'.$toCategorie->categorieFor_libelle." &asymp; ".$toForum->forum_libelle.'</a><span>&nbsp;&raquo;&nbsp;</span>R&eacute;sultats de la recherche'));		
		$rep->body->assignZone('contentPageMain', 'forum~contentPageMainForumMessageListFo', $tParams);	

		//$rep->body->assignZone("loginForm", "accueil~loginFo", array('is_loged'=>0));
        
        return $rep;
	}

	//Ajoute un commentaire pour l' actualite
	function forumAddComment()
	{
		global $gJConfig;
		$rep = $this->getResponse('json');

		//Classes
		jClasses::inc('commentFor~commentForSrv');

		//Récupération des paramètres
		$this->request_utf8_decode();
		$commentFor = jMagicLoader::arrayToObject($this->request->params, 'comment');

		$commentFor->id 			= 0;
		$commentFor->dateCreation 	= date("y-m-d H:i:s");
		$commentFor->publier 		= 1;
		
		$id = commentForSrv::sauvegardeCommentFor($commentFor);
		
		$commentFor->id 		  = $id;
		$commentFor->dateCreation = "Aujourd'hui";
		
		$commentFor->texte = utf8_encode($commentFor->texte);
		$commentFor->texte 		  = nl2br($commentFor->texte);

		$result = array('id' => $id, 'commentFor' => $commentFor);

		$rep->datas = $result;
		return $rep;	
	}
}
?>
