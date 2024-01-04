<?php
/**
* @package ilay-nosy
* @subpackage accueil
* @author
* @copyright
* @link
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

class cultureFoCtrl extends jController {
    /**
    *
    */
	//Toutes les actions de ce contrôleur nécessite une authentification via le plugin jAuth
	public $pluginParams = array('updateCulture'=>array('connexion.membre'=>true),

								 'cultureCategorieList'=>array('connexion.membre'=>false),
								 'cultureResultList'=>array('connexion.membre'=>false),
								 'cultureDetail'=>array('connexion.membre'=>false),
	
								 'cultureList'=>array('connexion.membre'=>false),
								 'cultureEdit'=>array('connexion.membre'=>true),
								 'sauvegardeCulture'=>array('connexion.membre'=>true),

								 'chargeSelectLocalite'=>array('connexion.membre'=>false),
								 'changePhoto'=>array('connexion.membre'=>true),
								 'removePhoto'=>array('connexion.membre'=>true),
								 'cultureDelete'=>array('connexion.membre'=>true)
								 );

	function updateCulture()
	{
		global $gJConfig;
        $rep = $this->getResponse('json');
		jClasses::inc('culture~cultureSrv');

		$idCulture = $this->intParam('idCulture', 0, true);
		$publier = $this->intParam('publier', -1, true);
		cultureSrv::updateCulture($idCulture, $publier);

		return $rep;	
	}

	//Affiche la page de liste des rubriques d'cultures
	function cultureCategorieList()
	{
		global $gJConfig;
        $rep = $this->getResponse('htmlFo');

		//Références liens : js et css
		$rep->addJSLink($gJConfig->urlengine['basePath'] .'design/front/js/cultureResult.js');			
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyMembre.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounce.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosySideColumn.css');

		//Template utilisé
		$rep->bodyTpl = 'culture~cultureCategorieFo';

		//Param
		$tParams = array();

		//Ajout des zones visibles:
		//Publication
		$rep->body->assignZone('innerPageAdSpace', 'publication~innerPageAdSpaceFo');		
		$rep->body->assignZone('innerPageAdSpaces', 'publication~innerPageAdSpacesFo');		

		$zUrl = jUrl::get('culture~cultureFo_cultureCategorieList');
		$rep->body->assignZone('breadcrumbs', 'commun~breadcrumbsFo', array('zAriane'=>'<a href="'.$zUrl.'">Cultures</a><span>&nbsp;&raquo;&nbsp;</span>Liste des cat&eacute;gories'));		
		$rep->body->assignZone('contentPageMain', 'culture~contentPageMainCultureCategorieListFo', $tParams);	

		//$rep->body->assignZone("loginForm", "accueil~loginFo", array('is_loged'=>0));
        
        return $rep;
	}


	//Affiche la page de liste des résultats de recherche
	function cultureResultList()
	{
		global $gJConfig;
        $rep = $this->getResponse('htmlFo');

		//Template utilisé
		$rep->bodyTpl = 'culture~cultureCategorieFo';

		//Références liens : js et css
		$rep->addJSLink($gJConfig->urlengine['basePath'] .'design/front/js/cultureResult.js');			
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyMembre.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounce.css');


		//Param de pagination
		if ($this->param('sortField')) {
			$this->sortField = $this->param('sortField');
		}else{
			$this->sortField = "culture_titre";
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


		$zoneUsed 		= "";
		$nbPagination 	= 10;
		switch ($this->affichage){
			case "detail":
				$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceListDetail.css');
				$zoneUsed 		= "culture~contentPageMainResultListDetailFo";
				$nbPagination 	= 5;
				break;
			case "abrege":
				$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceListAbrege.css');
				$zoneUsed 		= "culture~contentPageMainResultListAbregeFo";
				$nbPagination 	= 10;
				break;
			case "photo":
				$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceListPhoto.css');
				$zoneUsed 		= "culture~contentPageMainResultListPhotoFo";
				$nbPagination 	= 9;
				break;
			default:
				$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceListDetail.css');
				$zoneUsed 		= "culture~contentPageMainResultListDetailFo";
				$nbPagination 	= 5;
				break;		
		}

		//Param
		$tParams = array('nbPagination'=> $nbPagination, 'sortField'=> $this->sortField, 'sortDirection'=> $this->sortDirection, 'page'=> $this->page, 'affichage'=> $this->affichage, 'cid'=> $this->cid, 'rid'=> $this->rid, 'mot'=> $this->mot, 'crid'=> $this->crid, 'parution'=> $this->parution, 'province'=> $this->province, 'localite'=> $this->localite);

		//Ajout des zones visibles:
		//Publication
		$rep->body->assignZone('innerPageAdSpace', 'publication~innerPageAdSpaceFo');		
		$rep->body->assignZone('innerPageAdSpaces', 'publication~innerPageAdSpacesFo');		

		$zUrl = jUrl::get('culture~cultureFo_cultureCategorieList');
		$rep->body->assignZone('breadcrumbs', 'commun~breadcrumbsFo', array('zAriane'=>'<a href="'.$zUrl.'">Cultures</a><span>&nbsp;&raquo;&nbsp;</span>R&eacute;sultats de la recherche'));		
		$rep->body->assignZone('contentPageMain', $zoneUsed, $tParams);	

		//$rep->body->assignZone("loginForm", "accueil~loginFo", array('is_loged'=>0));
        
        return $rep;
	}

	//Affiche la page de liste des résultats de recherche
	function cultureDetail()
	{
		global $gJConfig;
        $rep = $this->getResponse('htmlFo');

		//Template utilisé
		$rep->bodyTpl = 'culture~cultureDetailFo';

		//Références liens : js et css
		$rep->addJSLink($gJConfig->urlengine['basePath'] .'design/front/js/cultureResult.js');			
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyMembre.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounce.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceDetail.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosySideColumn.css');

		//Param de pagination
		if ($this->param('sortField')) {
			$this->sortField = $this->param('sortField');
		}else{
			$this->sortField = "culture_titre";
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

		//Param de l'culture
		if ($this->intParam('anid')) {
			$this->anid = $this->intParam('anid');
		}else{
			$this->anid = 0;
		}	

		//Param
		$tParams = array('sortField'=> $this->sortField, 'sortDirection'=> $this->sortDirection, 'page'=> $this->page, 'affichage'=> $this->affichage, 'anid'=> $this->anid, 'cid'=> $this->cid, 'rid'=> $this->rid, 'mot'=> $this->mot, 'crid'=> $this->crid, 'parution'=> $this->parution, 'province'=> $this->province, 'localite'=> $this->localite);

		//Ajout des zones visibles:
		//Publication
		$rep->body->assignZone('innerPageAdSpace', 'publication~innerPageAdSpaceFo');		
		$rep->body->assignZone('innerPageAdSpaces', 'publication~innerPageAdSpacesFo');		
		$rep->body->assignZone('innerPageAdContacts', 'culture~innerPageAdContactsFo', array('anid'=> $this->anid));		

		$zUrl = jUrl::get('culture~cultureFo_cultureCategorieList');
		$rep->body->assignZone('breadcrumbs', 'commun~breadcrumbsFo', array('zAriane'=>'<a href="'.$zUrl.'">Cultures</a><span>&nbsp;&raquo;&nbsp;</span>R&eacute;sultats de la recherche'));		
		$rep->body->assignZone('contentPageMain', 'culture~contentPageMainResultDetailFo', $tParams);	

		//$rep->body->assignZone("loginForm", "accueil~loginFo", array('is_loged'=>0));
        
        return $rep;
	}

	//Affiche la page de liste des cultures membre	
	function cultureList()
	{
		global $gJConfig;
        $rep = $this->getResponse('htmlFo');

		//Références liens : js et css
		$rep->addJSLink($gJConfig->urlengine['basePath'] .'design/front/js/culture.js');			
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyMembre.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounce.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceListAbrege.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceDetail.css');

		
		//Template utilisé
		$rep->bodyTpl = 'culture~cultureTableFo';

		//Param
		if ($this->param('sortField')) {
			$this->sortField = $this->param('sortField');
		}else{
			$this->sortField = "culture_titre";
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

		//Annonce
		$rep->body->assignZone('innerPageAnnonceVehicule', 'annonce~innerPageAnnonceFo', array('cat'=>1));		
		$rep->body->assignZone('innerPageAnnonceImmobilier', 'annonce~innerPageAnnonceFo', array('cat'=>2));		
		$rep->body->assignZone('innerPageAnnonceEmploi', 'annonce~innerPageAnnonceFo', array('cat'=>3));		
		$rep->body->assignZone('innerPageAnnonceAutres', 'annonce~innerPageAnnonceFo', array('cat'=>4));		

		/*$zUrl = jUrl::get('membre~membreFo_tableBord');*/
		$rep->body->assignZone('breadcrumbs', 'commun~breadcrumbsFo', array('zAriane'=>'Cultures malgaches'));		
		$rep->body->assignZone('contentPageMain', 'culture~contentPageMainCultureListFo', $tParams);	

		$rep->body->assign('zMemberWrap', 'member_culture');	
		
		//$rep->body->assignZone("loginForm", "accueil~loginFo", array('is_loged'=>0));
        
        return $rep;
	}


	//Affiche la page d'édition d'un culture membre	
	function cultureEdit()
	{
		global $gJConfig;
        $rep = $this->getResponse('htmlFo');

		//Références liens : js et css
		$rep->addJSLink($gJConfig->urlengine['basePath'] .'design/front/js/culture.js');			
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyMembre.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounce.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceDetail.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosySideColumn.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceDiv.css');
		
		//Template utilisé
		$rep->bodyTpl = 'culture~cultureTableFo';

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

		$zUrl1 = jUrl::get('membre~membreFo_membreTableBord');
		$zUrl2 = jUrl::get('culture~cultureFo_cultureList', array('aid'=>$this->aid));
		$rep->body->assignZone('breadcrumbs', 'commun~breadcrumbsFo', array('zAriane'=>'<a href="'.$zUrl1.'">Espace Membre</a><span>&nbsp;&raquo;&nbsp;</span><a href="'.$zUrl2.'">Vos culture</a><span>&nbsp;&raquo;&nbsp;</span>Edition d\'une culture'));		
		$rep->body->assignZone('contentPageMain', 'culture~contentPageMainCultureEditFo', array('sortField'=>$this->sortField, 'sortDirection'=>$this->sortDirection, 'page'=>$this->page, 'aid'=>$this->aid, 'anid'=>$this->anid));	

		$rep->body->assign('zMemberWrap', 'member_culture');	
		
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
    function sauvegardeCulture() {
		//Préparation de la réponse
		global $gJConfig;

		//JSON		
		$rep = $this->getResponse('json');

		//Classes
		jClasses::inc('commun~tools');	
		jClasses::inc('credit~creditSrv');	
		jClasses::inc('abonnement~abonnementSrv');	
		jClasses::inc('forfait~forfaitSrv');	
		jClasses::inc('culture~cultureSrv');
		jClasses::inc('photo~photoSrv');
				
		$result 	= array();
		$iReturn 	= true;

		//Récupération des paramètres		

		$is_new = $this->param('culture_id', 0, true);
		
		if($is_new){
			$this->request_utf8_decode();
		}

		$culture = jMagicLoader::arrayToObject($this->request->params, 'culture');

		//Save		
		$culture->publier 			= $this->param('culture_publier', 0, true);
		$culture->publierHome		= $this->param('culture_publierHome', 0, true);
		
		if($culture->id){		
		
			$culture->dateModification 	= date("Y-m-d");
			
		}else{
		
			//Revois le forfait
			$abonnement = abonnementSrv::getAbonnement($culture->abonnementId);		
			$toCultures = cultureSrv::chargeListCultureAllFo();
			$forfait 	= forfaitSrv::getForfait($abonnement->abonnement_forfaitId);
			$nbDuree	= $forfait->forfait_dureeParution / 30;
			$incCulture	= sizeof($toCultures) + 1;
			
			//Champs automatiques
			$culture->reference 		= "an".str_pad($incCulture, 10, "0", STR_PAD_LEFT);		
			$culture->dateCreation 		= date("Y-m-d");
			$culture->dateModification 	= NULL;
			$culture->dateDebut			= date("Y-m-d");
			$culture->dateFin			= date("Y-m-d", strtotime('+'. $nbDuree .' month'));
			$culture->visite 			= 0;
			$culture->dateVisite 		= NULL;
			$culture->photo 			= "";
			$culture->origine 			= "";

			$culture->prix				= $culture->prix;
			$culture->laUne				= 0;
		}

		//print_r($culture);
		$id = cultureSrv::sauvegardeCulture($culture);

		//Traitement des photos
		if(!$culture->id){
			$nbPhoto 	= $forfait->forfait_nbPhoto;
			$nbPhotoAdd = $forfait->forfait_nbPhotoAdd;
			
			//Photo
			for($i=0; $i<$nbPhoto; $i++){
				//Object photo
				$photo = photoSrv::getDaoPhoto();				
				$photo->id		= 0;
				$photo->cultureId	= $id;
				
				//Répertoire d'upload sur le serveur
				$zPathMedia = ANNONCE_PATH_MEDIAS."images/";		
				//Répertoire de resize sur le serveur
				$zPathResize = ANNONCE_PATH_RESIZE."images/";				
			
				//upload du fichier
				$zNomFichier 	= tools::uploadFile ("culture_photo".$i, $zPathMedia) ;
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
					
					$idPhoto = photoSrv::sauvegardePhoto($photo);
				}	
			}
			//PhotoAdd
			for($i=0; $i<$nbPhotoAdd; $i++){
				//Object photo
				$photo = photoSrv::getDaoPhoto();				
				$photo->id		= 0;
				$photo->cultureId	= $id;
				
				//Répertoire d'upload sur le serveur
				$zPathMedia = ANNONCE_PATH_MEDIAS."images/";		
				//Répertoire de resize sur le serveur
				$zPathResize = ANNONCE_PATH_RESIZE."images/";				
			
				//upload du fichier
				$zNomFichier 	= tools::uploadFile ("culture_photoAdd".$i, $zPathMedia) ;
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
	

	//Supprime un culture et le redirige vers la page de liste des culture d'un membre	
	function cultureDelete()
	{
		global $gJConfig;
		$rep = $this->getResponse('redirect');
		$rep->action  = 'culture~cultureFo_cultureList';

		//Paramètres
		$cultureId 	= $this->intParam('aid', 0);

		//Suppression
		jClasses::inc('cultureSrv');
		cultureSrv::supprimeCulture($cultureId);

		//$rep->params = $tParams;
        
        return $rep;
	}
	
	
	function chargeSelectLocalite(){
		global $gJConfig;
        $rep = $this->getResponse('json');
		jClasses::inc('culture~cultureSrv');
		$idProvince = $this->intParam('idProvince', 0, true);
		
		$toLocalite = cultureSrv::getAllLocalite($idProvince);
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
