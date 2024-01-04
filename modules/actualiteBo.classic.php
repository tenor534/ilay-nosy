<?php
/**
* @package ilay-nosy
* @subpackage actualite
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Contrôleur BO pour les actualites
* @package ilay-nosy
* @subpackage actualite
* @todo : définir les différentes actions du contrôleur
*/
require_once (LIB_PATH.'fpdf/fpdf.php');

class actualiteBoCtrl extends jController {

	//Toutes les actions de ce contrôleur nécessite une authentification via le plugin jAuth
	public $pluginParams = array('*'=>array('auth.required'=>true));
	

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
	function updateActualiteHome()
	{
		global $gJConfig;
        $rep = $this->getResponse('json');
		jClasses::inc('actualite~actualiteSrv');

		$idActualite = $this->intParam('idActualite', 0, true);
		$publier = $this->intParam('publier', -1, true);
		actualiteSrv::updateActualiteHome($idActualite, $publier);

		return $rep;	
	}
	function updateActualiteUne()
	{
		global $gJConfig;
        $rep = $this->getResponse('json');
		jClasses::inc('actualite~actualiteSrv');

		$idActualite = $this->intParam('idActualite', 0, true);
		$publier = $this->intParam('publier', -1, true);
		actualiteSrv::updateActualiteUne($idActualite, $publier);

		return $rep;	
	}

	/**
    * Affiche la liste des actualites
	* Recoit en paramètre le type de l'actualité : standard ou évènement, 
    */
    function listeActualites() {
		global $gJConfig;

        $rep = $this->getResponse('htmlBo');

		$rep->addJSLink($gJConfig->urlengine['basePath'] . 'design/back/js/actualiteListe.js');

		jClasses::inc('actualite~actualiteSrv');

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

		$rep->menusActifs = array(HtmlBoResponse::MENU_ACTUALITE, HtmlBoResponse::MENU_ACTUALITE_LISTE);
		$rep->bodyTpl = 'actualite~actualiteBo';

		//Param
		$tParams = array('page'=> $this->page, 'aid'=> $this->aid);

		$rep->body->assignZone("listeActualiteBo", "actualite~listeActualiteBo", $tParams);

        return $rep;
    }

	/**
    * Affichage le détail d'une actualité en mode edition 
	* Recoit l'id de l'actualité en paramètre
    */
    function editionActualite() {
		//Préparation de la réponse
		global $gJConfig;

		//Chargement des données
		jClasses::inc('categorieAct~categorieActSrv');
		jClasses::inc('actualite~actualiteSrv');
		jClasses::inc('photoAct~photoActSrv');

        $rep = $this->getResponse('htmlBo');
		$rep->addJSLink($gJConfig->urlengine['basePath'] . 'design/back/js/actualites.js');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/back/css/nosyEdit.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceDetail.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceDiv.css');	

		$rep->addJSCode("j_actualite_medias = '".ACTUALITE_PATH_MEDIAS."';");
		$rep->addJSCode("j_actualite_resize = '".ACTUALITE_PATH_RESIZE."';");

		//Chargement du menu 
		$rep->menusActifs = array(HtmlBoResponse::MENU_ACTUALITE, HtmlBoResponse::MENU_ACTUALITE_LISTE);
		
		//Template à utiliser
		$rep->bodyTpl = 'actualite~actualiteBo';

		//Récupération des paramètres
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}		
		if ($this->intParam('actualite_id')) {
			$this->actualite_id = $this->intParam('actualite_id');
		}else{
			$this->actualite_id = 0;
		}
		if ($this->param('errorMessage')) {
			$this->errorMessage = $this->param('errorMessage');
		}else{
			$this->errorMessage = '';
		}

		//$tParams = array('zone'=> $this->getParam('zone','actualite~listeActualiteBo.zone'));

		//Chargement des données
		jClasses::inc('actualite~actualiteSrv');
		$visuel = '';		
		if ($this->actualite_id != 0) {
			try {
				$actualite = actualiteSrv::chargeActualite($this->actualite_id);

				if(file_exists(ACTUALITE_PATH_RESIZE."photos/".$actualite->actualite_photo) && is_file(ACTUALITE_PATH_RESIZE."photos/".$actualite->actualite_photo)){
					$extension=explode(".",$actualite->actualite_photo);
					switch(strtolower($extension[count($extension)-1])){
						case 'swf':
							$visuel = sprintf('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" width="%d" height="%d" id="index" align="middle"><param name="allowScriptAccess" value="sameDomain" /><param name="movie" value="%s" />	<param name="menu" value="false" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><embed src="%s" menu="false" quality="high" bgcolor="#ffffff" width="%d" height="%d" name="index" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>', ACTUALITE_WIDTH, ACTUALITE_HEIGHT, $gJConfig->urlengine['basePath'].ACTUALITE_PATH_RESIZE."photos/".$actualite->actualite_photo, $gJConfig->urlengine['basePath'].ACTUALITE_PATH_RESIZE."photos/".$actualite->actualite_photo, ACTUALITE_WIDTH, ACTUALITE_HEIGHT);
							break;
						default:
							$visuel = sprintf('<img src="%s" width="%d" height="%d" align="absmiddle">',$gJConfig->urlengine['basePath'].ACTUALITE_PATH_RESIZE."photos/".$actualite->actualite_photo,ACTUALITE_WIDTH,ACTUALITE_HEIGHT);
							break;
					}
				}
				
			} catch(Exception $oJException) {
				throw new JException ($oJException->getLocaleKey()) ;
			}				
		}else{
			$actualite = actualiteSrv::getDaoActualite();
			
			$actualite->actualite_id 			= 0;			
			$actualite->actualite_statut = USER_STATUT_ON;			
		}

		//Photos en cours
		$toPhotos 		= photoActSrv::getAllPhoto($this->actualite_id);		
		
		$toCategorieActs	= categorieActSrv::chargeAllCategorieAct();		

		//En mode modification
		if ($this->actualite_id != 0){
			//la première photo
			if(sizeof($toPhotos)){
				$actualite->actualite_photo = $toPhotos[0]->photo_photo;
			}else{
				$actualite->actualite_photo = "noPhoto.jpg";
			}
			
			//Calcule le nombre de photo possible pour l'actualite selon le forfait choisi
			$nbPhotos 		= ACTUALITE_NBPHOTOMAX; //20 
			$nbPhotoToAdd 	= $nbPhotos - sizeof($toPhotos);
			if($nbPhotoToAdd > 0){
				for($i=0; $i<$nbPhotoToAdd; $i++){				
					$photo = photoActSrv::getDaoPhoto();				
					$photo->id		= 0;
					$photo->actualiteId	= $this->actualite_id;
					$photo->photo 	= "noPhoto.jpg";
					$idPhoto = photoActSrv::sauvegardePhoto($photo);
				}					
				//Photos en cours
				$toPhotos 		= photoActSrv::getAllPhoto($this->actualite_id);					
			}						
		}	

		$tParams = array('actualite_id'=> $this->actualite_id,'errorMessage'=>$this->errorMessage, 'page'=> $this->page);

		$rep->body->assign('tParams', $tParams);
		$rep->body->assign('actualite', $actualite);													
		$rep->body->assign("actualite_id", $this->actualite_id);		
		$rep->body->assign("page", $this->page);		

		$rep->body->assign('toPhotos', $toPhotos);													
		$rep->body->assign("visuel", $visuel);		

		$rep->body->assign('toCategorieActs', $toCategorieActs);													
        return $rep;
    }
	
	
	/**
    * Enregistrement des données d'une actualité
	* 
	* Utilisé en création et modification seulement 
	* Recoit en paramètre l'ensemble des données du formulaire d'édition d'une actualité
	* Une fois ls actualite sauvegardée, redirige vers la page de liste des actualités
    */
    function sauvegardeActualite() {
		//Préparation de la réponse
		global $gJConfig;

		//Enregistrement
		jClasses::inc('commun~tools');	
		jClasses::inc('actualiteSrv');

		//Récupération des paramètres
		$actualite = jMagicLoader::arrayToObject($this->request->params, 'actualite');

		//Récupération des paramètres
		if ($this->request->params['page']) {
			$this->page = $this->request->params['page'];			
		}else{
			$this->page = 1;
		}	

		//Save				
		$actualite->photo			= soubstr($actualite->photo,strlen($gJConfig->urlengine['basePath'].ACTUALITE_PATH_RESIZE."photos/"),strlen($actualite->photo));
		$actualite->publier 		= $this->param('actualite_publier', 0, true);
		$actualite->publierHome		= $this->param('actualite_publierHome', 0, true);
		$actualite->laUne			= $this->param('actualite_laUne', 0, true);

		if($actualite->id){				
			$actualite->dateModification 	= date("Y-m-d");
		}else{
			$toActs = actualiteSrv::chargeListActualiteAllFo();
			$incAct							= sizeof($toActs) + 1;
			$actualite->reference 			= "ac".str_pad($incAct, 12, "0", STR_PAD_LEFT);					
			
			$actualite->dateCreation 	 	= date("Y-m-d");		
			$actualite->dateModification	= NULL;
			$actualite->vue					= 0;
			$actualite->visite				= 0;
		}	
		//Date de publication
		$actualite->datePublication 	= tools::toDateTimeSQL($actualite->datePublication);

//-----------------------------------------------------------------------
//Nom du fichier
$zNomFichier = $actualite->photo;

//Répertoire d'upload sur le serveur
$zPathMedia = ACTUALITE_PATH_MEDIAS."images/";		
//Répertoire de resize sur le serveur
$zPathResize = ACTUALITE_PATH_RESIZE."images/";				

//Supprime les fichiers
if(($zNomFichier != "nophoto.jpg")&&($zNomFichier != "noPhoto.jpg")){

	//upload du fichier	
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

}	
//-----------------------------------------------------------------------

		//Fichier : doit etre copié vers le répertoire de destination		
		$zPathMedia  = ACTUALITE_PATH_MEDIAS."fichiers/";		
		$zPathResize = ACTUALITE_PATH_RESIZE."fichiers/";				

		$actualite_fichier 		= $this->request->params['actualite_fichier']; 
		$zFileName 				= basename ($actualite_fichier);
		$zExtPathAndFile 		= $actualite_fichier;
		
		$actualite->fichier = $zFileName;				

		$id = actualiteSrv::sauvegardeActualite($actualite);

		//Renomer le fichier
		$champs_fichier 			= $this->request->params['champs_fichier']; 				
		if(strlen($champs_fichier)){

			$zNewNameFile = tools::copyFile($zFileName, $zExtPathAndFile, ACTUALITE_PATH_MEDIAS, $zPathMedia, $zPathResize);
	
			// Mettre à jour le nom de fichier dans la base
			$factory = jDao::get("actualite~actualite");
			$actualiteDao = $factory->get($id);
			
			if ($actualiteDao->actualite_id) {
				$actualiteDao->actualite_fichier = $zNewNameFile;
				$factory->update($actualiteDao);
			}
		}	


		//Paramètres
		$tParams = array('page'=> $this->page);

		//Redirection		
		$rep = $this->getResponse('redirect');
		$rep->action  = 'actualite~actualiteBo_listeActualites';
		$rep->params = $tParams;
        
        return $rep;        
    }

	/**
    * Suppression d'une actualité donnée
	* 
	* Recoit l'id de la actualité en paramètre
	* Une fois ls actualite supprimée, redirige vers la page de liste des actualités
    */
    function supprimeActualite() {

		//Récupération des paramètres
		$actualiteId = $this->intParam('actualite_id',0, FALSE);
		if ($actualiteId == 0) {
			throw new Exception('Invalid parameter actualite_id');
		}

		//Suppression
		jClasses::inc('actualiteSrv');
		actualiteSrv::supprimeActualite($actualiteId);
		
		//Redirection
		$rep = $this->getResponse('redirect');
		$rep->action  = 'actualite~actualiteBo_listeActualites';
        
        return $rep;
    }
	/**
    * traitement des visuels téléchargés
	* 
	*	re-dimensionnement,suppression
    */

    function traitementVisuels() {
		global $gJConfig;
		$rep=$this->getResponse('json');
		$action=$this->Param("process","",true);
		$fichier=explode(";",$this->Param("fichier","",true));
		jClasses::inc('commun~image') ;
		switch($action){
			case 'suppr'://suppression des images re-dimensionnées au cas où annulation
				$result=array();
				if(count($fichier)>0)
				{
					$fileImage=$this->Param("fl","",true);
					$marqueWidth = "";
					$marqueHeight = "";
					if($fileImage == "p")
					{
						$pathResize = ACTUALITE_PATH_RESIZE."photos/";
					}
					if($fileImage == "b")
					{
						$pathResize = PATH_BANNIERES_RESIZE;
					}
					if($fileImage == "l")
					{
						$pathResize = PATH_LOGO_RESIZE;
					}
					for($i=0;$i<count($fichier);$i++){
						if($fichier[$i]!=''){
							if(file_exists($pathResize.basename($fichier[$i])) && is_file($pathResize.basename($fichier[$i])))
							@unlink($pathResize.basename($fichier[$i]));
						}
					}
				}
				break;
			case 'resize'://dimensionner au format exact l'image téléchargée
				$result = array("visuel"=>"","image"=>"");
				$fichier=substr($fichier[0],strlen($gJConfig->urlengine['basePath']),strlen($fichier[0]));
				list($nomfichier,$extension)=explode(".",basename($fichier));
				switch(strtolower($extension)){
					case 'gif':
						$format='GIF';
						break;
					case 'jpeg':
					case 'jpg':
						$format='JPEG';
						break;
					case 'png':
						$format='PNG';
						break;
					case 'swf':
						$format='SWF';
						break;
					default:
						$format='';
						break;
				}
				$fileImage=$this->Param("fl","",true);
				$marqueWidth = "";
				$marqueHeight = "";
				if($fileImage == "p")
				{
					$marqueWidth = ACTUALITE_WIDTH;
					$marqueHeight = ACTUALITE_HEIGHT;
					$pathResize = ACTUALITE_PATH_RESIZE."photos/";
				}
				if($fileImage == "b")
				{
					$marqueWidth = BANNIERES_WIDTH;
					$marqueHeight = BANNIERES_HEIGHT;
					$pathResize = PATH_BANNIERES_RESIZE;
				}
				if($fileImage == "l")
				{
					$marqueWidth = LOGO_WIDTH;
					$marqueHeight = LOGO_HEIGHT;
					$pathResize = PATH_LOGO_RESIZE;
				}

				$visuel=$nomfichier."_".$marqueWidth."_".$marqueHeight.".".strtolower($extension);
				$i=1;
				while(file_exists($pathResize.$visuel) && is_file($pathResize.$visuel)){
					$tNom = explode(".", $visuel);
					$nom = "";
					for($j=0; $j<sizeof($tNom)-1; $j++)
					{
						if($j<sizeof($tNom)-2)
							$nom .= $tNom[$j].".";
						else
							$nom .= $tNom[$j];
					}
					$ext = $tNom[sizeof($tNom)-1];
					$nom=explode('_',$nom);
					$visuel=$nom[0]."_".$nom[1]."_".$nom[2]."_".$i.".".strtolower($ext);
					$i++;
				}
				$result['image']=$visuel;
				switch($format){
					case 'GIF':
					case 'JPEG':
					case 'PNG':
						$imgF = new ImageFilter;
						$imgF->loadImage($fichier);
						$imgF->resize($marqueWidth,$marqueHeight,'force',true);
						$imgF->output($format,$pathResize.$visuel,true);	
						$result['visuel']=sprintf('<img src="%s" align="absmiddle">',$gJConfig->urlengine['basePath'].$pathResize.$visuel);
						break;
					case 'SWF':
						@copy($fichier,$pathResize.$visuel);
						$result['visuel']=sprintf('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" id="index" align="middle"><param name="allowScriptAccess" value="sameDomain" /><param name="movie" value="%s" />	<param name="menu" value="false" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><embed src="%s" menu="false" quality="high" bgcolor="#ffffff" name="index" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>',$gJConfig->urlengine['basePath'].$pathResize.$nomfichier."_".$marqueWidth."_".$marqueHeight.".".strtolower($extension),$gJConfig->urlengine['basePath'].pathResize.$visuel);
						break;
				}
				break;
			default:
				
					$result = array("visuel"=>"","image"=>"");
					$fichier=substr($fichier[0],strlen($gJConfig->urlengine['basePath']),strlen($fichier[0]));
					if($fichier)
					{
						$imgF = new ImageFilter;
						$imgF->loadImage($fichier);
						$sizeImage = $imgF->getImageSize($fichier);
						$result['w'] = $sizeImage['w'];
						$result['h'] = $sizeImage['h'];
						$bFile = substr($fichier, strlen(PATH_VERRE_MEDIAS), strlen($fichier));
						$tNomFichier = explode(".", $bFile);
						$nomfichier = "";
						for($i=0; $i<sizeof($tNomFichier)-1; $i++)
						{
							$nomfichier .= $tNomFichier[$i].".";
						}
						$extension = $tNomFichier[sizeof($tNomFichier)-1];

						$visuel = $nomfichier.strtolower($extension);
						$result['visuel']=sprintf('<img src="%s" align="absmiddle">',$gJConfig->urlengine['basePath'].PATH_VERRE_MEDIAS.$visuel);
						$result['image']=$visuel;
					}
					break;
		}

		$rep->datas=$result;
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
		jClasses::inc('photoAct~photoActSrv');

		$response = array('imgSrc'=>'');
		$iReturn 	= true;

		//Récupération des paramètres
		$photo = jMagicLoader::arrayToObject($this->request->params, 'photo');
		
		//Nom du fichier
		$zNomFichier = $photo->photo;
		
		//Répertoire d'upload sur le serveur
		$zPathMedia = ACTUALITE_PATH_MEDIAS."images/";		
		//Répertoire de resize sur le serveur
		$zPathResize = ACTUALITE_PATH_RESIZE."images/";				

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
		jClasses::inc('photoAct~photoActSrv');

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
		$zPathMedia = ACTUALITE_PATH_MEDIAS."images/";		
		//Répertoire de resize sur le serveur
		$zPathResize = ACTUALITE_PATH_RESIZE."images/";				

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
		$iReturn = photoActSrv::sauvegardePhoto($photo);

		//Paramètres
		$response['imgSrc'] = $zNomFichier;
		
		$rep->datas = $response;
		return $rep;
    }
}
?>
