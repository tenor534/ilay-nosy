<?php
/**
* @package ilay-nosy
* @subpackage accueil
* @author
* @copyright
* @link
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

class actualiteFoCtrl extends jController {
    /**
    *
    */
	//Toutes les actions de ce contrôleur nécessite une authentification via le plugin jAuth
	public $pluginParams = array('updateActualite'=>array('connexion.membre'=>true),

								 'actualiteCategorieList'=>array('connexion.membre'=>false),
								 'actualiteResultList'=>array('connexion.membre'=>false),
								 'actualiteDetail'=>array('connexion.membre'=>false),
	
								 'actualiteList'=>array('connexion.membre'=>false),
								 'actualiteEdit'=>array('connexion.membre'=>true),
								 'sauvegardeActualite'=>array('connexion.membre'=>true),

								 'chargeSelectLocalite'=>array('connexion.membre'=>false),
								 'changePhoto'=>array('connexion.membre'=>true),
								 'removePhoto'=>array('connexion.membre'=>true),
								 'actualiteDelete'=>array('connexion.membre'=>true)
								 );

	function updateActualite()
	{
		global $gJConfig;
        $rep = $this->getResponse('json');
		jClasses::inc('actualite~actualiteSrv');

		$idActualite = $this->intParam('idActualite', 0, true);
		$publier = $this->intParam('publier', -1, true);
		actualiteSrv::updateActualite($idActualite, $publier);

		return $rep;	
	}

	//Affiche la page de liste des rubriques d'actualites
	function actualiteCategorieList()
	{
		global $gJConfig;
        $rep = $this->getResponse('htmlFo');

		//Références liens : js et css
		$rep->addJSLink($gJConfig->urlengine['basePath'] .'design/front/js/actualiteResult.js');			
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyMembre.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyNew.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosySideColumn.css');

		//Template utilisé
		$rep->bodyTpl = 'actualite~actualiteCategorieFo';

		//Param
		$tParams = array();

		//Ajout des zones visibles:
		//Publication
		$rep->body->assignZone('innerPageAdSpace', 'publication~innerPageAdSpaceFo');		
		$rep->body->assignZone('innerPageAdSpaces', 'publication~innerPageAdSpacesFo');		

		$zUrl = jUrl::get('actualite~actualiteFo_actualiteCategorieList');
		$rep->body->assignZone('breadcrumbs', 'commun~breadcrumbsFo', array('zAriane'=>'<a href="'.$zUrl.'">Actualites</a><span>&nbsp;&raquo;&nbsp;</span>Liste des cat&eacute;gories'));		
		$rep->body->assignZone('contentPageMain', 'actualite~contentPageMainActualiteCategorieListFo', $tParams);	

		//$rep->body->assignZone("loginForm", "accueil~loginFo", array('is_loged'=>0));
        
        return $rep;
	}


	//Affiche la page de liste des résultats de recherche
	function actualiteResultList()
	{
		global $gJConfig;
        $rep = $this->getResponse('htmlFo');

		//Template utilisé
		$rep->bodyTpl = 'actualite~actualiteCategorieFo';

		//Références liens : js et css
		$rep->addJSLink($gJConfig->urlengine['basePath'] .'design/front/js/actualiteResult.js');			
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyMembre.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyNew.css');


		//Param de pagination
		if ($this->param('sortField')) {
			$this->sortField = $this->param('sortField');
		}else{
			$this->sortField = "actualite_titre";
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
				$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyNewListDetail.css');
				$zoneUsed 		= "actualite~contentPageMainResultListDetailFo";
				$nbPagination 	= 5;
				break;
			case "abrege":
				$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyNewListAbrege.css');
				$zoneUsed 		= "actualite~contentPageMainResultListAbregeFo";
				$nbPagination 	= 10;
				break;
			case "photo":
				$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyNewListPhoto.css');
				$zoneUsed 		= "actualite~contentPageMainResultListPhotoFo";
				$nbPagination 	= 9;
				break;
			default:
				$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyNewListDetail.css');
				$zoneUsed 		= "actualite~contentPageMainResultListDetailFo";
				$nbPagination 	= 5;
				break;		
		}

		//Param
		$tParams = array('nbPagination'=> $nbPagination, 'sortField'=> $this->sortField, 'sortDirection'=> $this->sortDirection, 'page'=> $this->page, 'affichage'=> $this->affichage, 'cid'=> $this->cid, 'mot'=> $this->mot, 'parution'=> $this->parution);

		//Ajout des zones visibles:
		//Publication
		$rep->body->assignZone('innerPageAdSpace', 'publication~innerPageAdSpaceFo');		
		$rep->body->assignZone('innerPageAdSpaces', 'publication~innerPageAdSpacesFo');		

		$zUrl = jUrl::get('actualite~actualiteFo_actualiteCategorieList');
		$rep->body->assignZone('breadcrumbs', 'commun~breadcrumbsFo', array('zAriane'=>'<a href="'.$zUrl.'">Actualites</a><span>&nbsp;&raquo;&nbsp;</span>R&eacute;sultats de la recherche'));		
		$rep->body->assignZone('contentPageMain', $zoneUsed, $tParams);	

		//$rep->body->assignZone("loginForm", "accueil~loginFo", array('is_loged'=>0));
        
        return $rep;
	}

	//Affiche la page de liste des résultats de recherche
	function actualiteDetail()
	{
		global $gJConfig;
        $rep = $this->getResponse('htmlFo');

		//Template utilisé
		$rep->bodyTpl = 'actualite~actualiteDetailFo';

		//Références liens : js et css
		$rep->addJSLink($gJConfig->urlengine['basePath'] .'design/front/js/actualiteResult.js');			
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyMembre.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyNew.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyNewDetail.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosySideColumn.css');

		//Param de pagination
		if ($this->param('sortField')) {
			$this->sortField = $this->param('sortField');
		}else{
			$this->sortField = "actualite_titre";
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

		//Param de l'actualite
		if ($this->intParam('acid')) {
			$this->acid = $this->intParam('acid');
		}else{
			$this->acid = 0;
		}	

		//Param
		$tParams = array('sortField'=> $this->sortField, 'sortDirection'=> $this->sortDirection, 'page'=> $this->page, 'affichage'=> $this->affichage, 'acid'=> $this->acid, 'cid'=> $this->cid, 'mot'=> $this->mot, 'parution'=> $this->parution);

		//Ajout des zones visibles:
		//Publication
		$rep->body->assignZone('innerPageAdSpace', 'publication~innerPageAdSpaceFo');		
		$rep->body->assignZone('innerPageAdSpaces', 'publication~innerPageAdSpacesFo');		
		$rep->body->assignZone('innerPageAdContacts', 'actualite~innerPageAdContactsFo', array('acid'=> $this->acid));		

		$zUrl = jUrl::get('actualite~actualiteFo_actualiteCategorieList');
		$rep->body->assignZone('breadcrumbs', 'commun~breadcrumbsFo', array('zAriane'=>'<a href="'.$zUrl.'">Actualites</a><span>&nbsp;&raquo;&nbsp;</span>R&eacute;sultats de la recherche'));		
		$rep->body->assignZone('contentPageMain', 'actualite~contentPageMainResultDetailFo', $tParams);	

		//$rep->body->assignZone("loginForm", "accueil~loginFo", array('is_loged'=>0));
        
        return $rep;
	}

	//Affiche la page de liste des actualites membre	
	function actualiteList()
	{
		global $gJConfig;
        $rep = $this->getResponse('htmlFo');

		//Références liens : js et css
		$rep->addJSLink($gJConfig->urlengine['basePath'] .'design/front/js/actualite.js');			
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyMembre.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyNew.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyNewListAbrege.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyNewDetail.css');

		
		//Template utilisé
		$rep->bodyTpl = 'actualite~actualiteTableFo';

		//Param
		if ($this->param('sortField')) {
			$this->sortField = $this->param('sortField');
		}else{
			$this->sortField = "actualite_titre";
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

		//Actualite
		$rep->body->assignZone('innerPageActualiteVehicule', 'actualite~innerPageActualiteFo', array('cat'=>1));		
		$rep->body->assignZone('innerPageActualiteImmobilier', 'actualite~innerPageActualiteFo', array('cat'=>2));		
		$rep->body->assignZone('innerPageActualiteEmploi', 'actualite~innerPageActualiteFo', array('cat'=>3));		
		$rep->body->assignZone('innerPageActualiteAutres', 'actualite~innerPageActualiteFo', array('cat'=>4));		

		/*$zUrl = jUrl::get('membre~membreFo_tableBord');*/
		$rep->body->assignZone('breadcrumbs', 'commun~breadcrumbsFo', array('zAriane'=>'Les actualit&eacute;s internationales'));		
		$rep->body->assignZone('contentPageMain', 'actualite~contentPageMainActualiteListFo', $tParams);	

		$rep->body->assign('zMemberWrap', 'member_actualite');	
		
		//$rep->body->assignZone("loginForm", "accueil~loginFo", array('is_loged'=>0));
        
        return $rep;
	}


	//Affiche la page d'édition d'un actualite membre	
	function actualiteEdit()
	{
		global $gJConfig;
        $rep = $this->getResponse('htmlFo');

		//Références liens : js et css
		$rep->addJSLink($gJConfig->urlengine['basePath'] .'design/front/js/actualite.js');			
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyMembre.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyNew.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyNewDetail.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosySideColumn.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyNewDiv.css');
		
		//Template utilisé
		$rep->bodyTpl = 'actualite~actualiteTableFo';

		//Paramètres


		$this->sortField 		= $this->param('sortField');
		$this->sortDirection 	= $this->param('sortDirection');

		$this->page	= $this->intParam('page', 1);
		$this->aid 	= $this->intParam('aid', 0);
		$this->acid = $this->intParam('acid', 0);

		//Ajout des zones visibles:
		//Publication
		$rep->body->assignZone('innerPageAdSpace', 'publication~innerPageAdSpaceFo');		
		$rep->body->assignZone('innerPageAdSpaces', 'publication~innerPageAdSpacesFo');		

		$zUrl1 = jUrl::get('membre~membreFo_membreTableBord');
		$zUrl2 = jUrl::get('actualite~actualiteFo_actualiteList', array('aid'=>$this->aid));
		$rep->body->assignZone('breadcrumbs', 'commun~breadcrumbsFo', array('zAriane'=>'<a href="'.$zUrl1.'">Espace Membre</a><span>&nbsp;&raquo;&nbsp;</span><a href="'.$zUrl2.'">Vos actualite</a><span>&nbsp;&raquo;&nbsp;</span>Edition d\'une actualite'));		
		$rep->body->assignZone('contentPageMain', 'actualite~contentPageMainActualiteEditFo', array('sortField'=>$this->sortField, 'sortDirection'=>$this->sortDirection, 'page'=>$this->page, 'aid'=>$this->aid, 'acid'=>$this->acid));	

		$rep->body->assign('zMemberWrap', 'member_actualite');	
		
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
    function sauvegardeActualite() {
		//Préparation de la réponse
		global $gJConfig;

		//JSON		
		$rep = $this->getResponse('json');

		//Classes
		jClasses::inc('commun~tools');	
		jClasses::inc('credit~creditSrv');	
		jClasses::inc('abonnement~abonnementSrv');	
		jClasses::inc('forfait~forfaitSrv');	
		jClasses::inc('actualite~actualiteSrv');
		jClasses::inc('photo~photoActSrv');
				
		$result 	= array();
		$iReturn 	= true;

		//Récupération des paramètres		

		$is_new = $this->param('actualite_id', 0, true);
		
		if($is_new){
			$this->request_utf8_decode();
		}

		$actualite = jMagicLoader::arrayToObject($this->request->params, 'actualite');

		//Save		
		$actualite->publier 			= $this->param('actualite_publier', 0, true);
		$actualite->publierHome		= $this->param('actualite_publierHome', 0, true);
		
		if($actualite->id){		
		
			$actualite->dateModification 	= date("Y-m-d");
			
		}else{
		
			//Revois le forfait
			$abonnement = abonnementSrv::getAbonnement($actualite->abonnementId);		
			$toActualites = actualiteSrv::chargeListActualiteAllFo();
			$forfait 	= forfaitSrv::getForfait($abonnement->abonnement_forfaitId);
			$nbDuree	= $forfait->forfait_dureeParution / 30;
			$incActualite	= sizeof($toActualites) + 1;
			
			//Champs automatiques
			$actualite->reference 		= "an".str_pad($incActualite, 10, "0", STR_PAD_LEFT);		
			$actualite->dateCreation 		= date("Y-m-d");
			$actualite->dateModification 	= NULL;
			$actualite->dateDebut			= date("Y-m-d");
			$actualite->dateFin			= date("Y-m-d", strtotime('+'. $nbDuree .' month'));
			$actualite->visite 			= 0;
			$actualite->dateVisite 		= NULL;
			$actualite->photo 			= "";
			$actualite->origine 			= "";

			$actualite->prix				= $actualite->prix;
			$actualite->laUne				= 0;
		}

		//print_r($actualite);
		$id = actualiteSrv::sauvegardeActualite($actualite);

		//Traitement des photos
		if(!$actualite->id){
			$nbPhoto 	= $forfait->forfait_nbPhoto;
			$nbPhotoAdd = $forfait->forfait_nbPhotoAdd;
			
			//Photo
			for($i=0; $i<$nbPhoto; $i++){
				//Object photo
				$photo = photoActSrv::getDaoPhoto();				
				$photo->id		= 0;
				$photo->actualiteId	= $id;
				
				//Répertoire d'upload sur le serveur
				$zPathMedia = ANNONCE_PATH_MEDIAS."images/";		
				//Répertoire de resize sur le serveur
				$zPathResize = ANNONCE_PATH_RESIZE."images/";				
			
				//upload du fichier
				$zNomFichier 	= tools::uploadFile ("actualite_photo".$i, $zPathMedia) ;
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
					
					$idPhoto = photoActSrv::sauvegardePhoto($photo);
				}	
			}
			//PhotoAdd
			for($i=0; $i<$nbPhotoAdd; $i++){
				//Object photo
				$photo = photoActSrv::getDaoPhoto();				
				$photo->id		= 0;
				$photo->actualiteId	= $id;
				
				//Répertoire d'upload sur le serveur
				$zPathMedia = ANNONCE_PATH_MEDIAS."images/";		
				//Répertoire de resize sur le serveur
				$zPathResize = ANNONCE_PATH_RESIZE."images/";				
			
				//upload du fichier
				$zNomFichier 	= tools::uploadFile ("actualite_photoAdd".$i, $zPathMedia) ;
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
					
					$idPhoto = photoActSrv::sauvegardePhoto($photo);
				}	
			}
		}


		//Paramètres
		$result = array("statut"=>$id);
		
		$rep->datas = $result;		
		//die();
		
		return $rep;
    }
	

	//Supprime un actualite et le redirige vers la page de liste des actualite d'un membre	
	function actualiteDelete()
	{
		global $gJConfig;
		$rep = $this->getResponse('redirect');
		$rep->action  = 'actualite~actualiteFo_actualiteList';

		//Paramètres
		$actualiteId 	= $this->intParam('aid', 0);

		//Suppression
		jClasses::inc('actualiteSrv');
		actualiteSrv::supprimeActualite($actualiteId);

		//$rep->params = $tParams;
        
        return $rep;
	}
	
	
	function chargeSelectLocalite(){
		global $gJConfig;
        $rep = $this->getResponse('json');
		jClasses::inc('actualite~actualiteSrv');
		$idProvince = $this->intParam('idProvince', 0, true);
		
		$toLocalite = actualiteSrv::getAllLocalite($idProvince);
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
		jClasses::inc('photo~photoActSrv');

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
		$iReturn = photoActSrv::sauvegardePhoto($photo);

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
		jClasses::inc('photo~photoActSrv');

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
		$iReturn = photoActSrv::sauvegardePhoto($photo);

		//Paramètres
		$response['imgSrc'] = $zNomFichier;
		
		$rep->datas = $response;
		return $rep;
    }

}
?>
