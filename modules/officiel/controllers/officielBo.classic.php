<?php
/**
* @package ilay-nosy
* @subpackage officiel
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Contrôleur BO pour les officiels
* @package ilay-nosy
* @subpackage officiel
* @todo : définir les différentes actions du contrôleur
*/
require_once (LIB_PATH.'fpdf/fpdf.php');

class officielBoCtrl extends jController {

	//Toutes les actions de ce contrôleur nécessite une authentification via le plugin jAuth
	public $pluginParams = array('*'=>array('auth.required'=>true));
	

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
	function updateOfficielHome()
	{
		global $gJConfig;
        $rep = $this->getResponse('json');
		jClasses::inc('officiel~officielSrv');

		$idOfficiel = $this->intParam('idOfficiel', 0, true);
		$publier = $this->intParam('publier', -1, true);
		officielSrv::updateOfficielHome($idOfficiel, $publier);

		return $rep;	
	}
	function updateOfficielUne()
	{
		global $gJConfig;
        $rep = $this->getResponse('json');
		jClasses::inc('officiel~officielSrv');

		$idOfficiel = $this->intParam('idOfficiel', 0, true);
		$publier = $this->intParam('publier', -1, true);
		officielSrv::updateOfficielUne($idOfficiel, $publier);

		return $rep;	
	}

	/**
    * Affiche la liste des officiels
	* Recoit en paramètre le type de l'actualité : standard ou évènement, 
    */
    function listeOfficiels() {
		global $gJConfig;

        $rep = $this->getResponse('htmlBo');

		$rep->addJSLink($gJConfig->urlengine['basePath'] . 'design/back/js/officielListe.js');

		jClasses::inc('officiel~officielSrv');

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

		$rep->menusActifs = array(HtmlBoResponse::MENU_OFFICIEL, HtmlBoResponse::MENU_OFFICIEL_LISTE);
		$rep->bodyTpl = 'officiel~officielBo';

		//Param
		$tParams = array('page'=> $this->page, 'aid'=> $this->aid);

		$rep->body->assignZone("listeOfficielBo", "officiel~listeOfficielBo", $tParams);

        return $rep;
    }

	/**
    * Affichage le détail d'une actualité en mode edition 
	* Recoit l'id de l'actualité en paramètre
    */
    function editionOfficiel() {
		//Préparation de la réponse
		global $gJConfig;

		//Chargement des données
		jClasses::inc('categorieOff~categorieOffSrv');
		jClasses::inc('officiel~officielSrv');
		jClasses::inc('photoOff~photoOffSrv');

        $rep = $this->getResponse('htmlBo');
		$rep->addJSLink($gJConfig->urlengine['basePath'] . 'design/back/js/officiels.js');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/back/css/nosyEdit.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceDetail.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceDiv.css');	

		$rep->addJSCode("j_officiel_medias = '".OFFICIEL_PATH_MEDIAS."';");
		$rep->addJSCode("j_officiel_resize = '".OFFICIEL_PATH_RESIZE."';");

		//Chargement du menu 
		$rep->menusActifs = array(HtmlBoResponse::MENU_OFFICIEL, HtmlBoResponse::MENU_OFFICIEL_LISTE);
		
		//Template à utiliser
		$rep->bodyTpl = 'officiel~officielBo';

		//Récupération des paramètres
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}		
		if ($this->intParam('officiel_id')) {
			$this->officiel_id = $this->intParam('officiel_id');
		}else{
			$this->officiel_id = 0;
		}
		if ($this->param('errorMessage')) {
			$this->errorMessage = $this->param('errorMessage');
		}else{
			$this->errorMessage = '';
		}

		//$tParams = array('zone'=> $this->getParam('zone','officiel~listeOfficielBo.zone'));

		//Chargement des données
		jClasses::inc('officiel~officielSrv');
		$visuel = '';		
		if ($this->officiel_id != 0) {
			try {
				$officiel = officielSrv::chargeOfficiel($this->officiel_id);

				if(file_exists(OFFICIEL_PATH_RESIZE."photos/".$officiel->officiel_photo) && is_file(OFFICIEL_PATH_RESIZE."photos/".$officiel->officiel_photo)){
					$extension=explode(".",$officiel->officiel_photo);
					switch(strtolower($extension[count($extension)-1])){
						case 'swf':
							$visuel = sprintf('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" width="%d" height="%d" id="index" align="middle"><param name="allowScriptAccess" value="sameDomain" /><param name="movie" value="%s" />	<param name="menu" value="false" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><embed src="%s" menu="false" quality="high" bgcolor="#ffffff" width="%d" height="%d" name="index" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>', OFFICIEL_WIDTH, OFFICIEL_HEIGHT, $gJConfig->urlengine['basePath'].OFFICIEL_PATH_RESIZE."photos/".$officiel->officiel_photo, $gJConfig->urlengine['basePath'].OFFICIEL_PATH_RESIZE."photos/".$officiel->officiel_photo, OFFICIEL_WIDTH, OFFICIEL_HEIGHT);
							break;
						default:
							$visuel = sprintf('<img src="%s" width="%d" height="%d" align="absmiddle">',$gJConfig->urlengine['basePath'].OFFICIEL_PATH_RESIZE."photos/".$officiel->officiel_photo,OFFICIEL_WIDTH,OFFICIEL_HEIGHT);
							break;
					}
				}
				
			} catch(Exception $oJException) {
				throw new JException ($oJException->getLocaleKey()) ;
			}				
		}else{
			$officiel = officielSrv::getDaoOfficiel();
			
			$officiel->officiel_id 			= 0;			
			$officiel->officiel_statut = USER_STATUT_ON;			
		}

		//Photos en cours
		$toPhotos 		= photoOffSrv::getAllPhoto($this->officiel_id);		
		
		$toCategorieOffs	= categorieOffSrv::chargeAllCategorieOff();		

		//En mode modification
		if ($this->officiel_id != 0){
			//la première photo
			if(sizeof($toPhotos)){
				//$officiel->officiel_photo = $toPhotos[0]->photo_photo;
			}else{
				//$officiel->officiel_photo = "noPhoto.jpg";
			}
			
			//Calcule le nombre de photo possible pour l'officiel selon le forfait choisi
			$nbPhotos 		= OFFICIEL_NBPHOTOMAX; //20 
			$nbPhotoToAdd 	= $nbPhotos - sizeof($toPhotos);
			if($nbPhotoToAdd > 0){
				for($i=0; $i<$nbPhotoToAdd; $i++){				
					$photo = photoOffSrv::getDaoPhoto();				
					$photo->id		= 0;
					$photo->officielId	= $this->officiel_id;
					$photo->photo 	= "noPhoto.jpg";
					$idPhoto = photoOffSrv::sauvegardePhoto($photo);
				}					
				//Photos en cours
				$toPhotos 		= photoOffSrv::getAllPhoto($this->officiel_id);					
			}						
		}	

		$tParams = array('officiel_id'=> $this->officiel_id,'errorMessage'=>$this->errorMessage, 'page'=> $this->page);

		$rep->body->assign('tParams', $tParams);
		$rep->body->assign('officiel', $officiel);													
		$rep->body->assign("officiel_id", $this->officiel_id);		
		$rep->body->assign("page", $this->page);		

		$rep->body->assign('toPhotos', $toPhotos);													
		$rep->body->assign("visuel", $visuel);		

		$rep->body->assign('toCategorieOffs', $toCategorieOffs);													
        return $rep;
    }
	
	
	/**
    * Enregistrement des données d'une actualité
	* 
	* Utilisé en création et modification seulement 
	* Recoit en paramètre l'ensemble des données du formulaire d'édition d'une actualité
	* Une fois ls officiel sauvegardée, redirige vers la page de liste des actualités
    */
    function sauvegardeOfficiel() {
		//Préparation de la réponse
		global $gJConfig;

		//Enregistrement
		jClasses::inc('commun~tools');	
		jClasses::inc('officielSrv');

		//Récupération des paramètres
		$officiel = jMagicLoader::arrayToObject($this->request->params, 'officiel');

		//Récupération des paramètres
		if ($this->request->params['page']) {
			$this->page = $this->request->params['page'];			
		}else{
			$this->page = 1;
		}	

		//Save				
		$officiel->photo			= substr($officiel->photo,strlen($gJConfig->urlengine['basePath'].OFFICIEL_PATH_RESIZE."photos/"),strlen($officiel->photo));
		$officiel->photoSave		= substr($officiel->photoSave,strlen($gJConfig->urlengine['basePath'].OFFICIEL_PATH_RESIZE."photos/"),strlen($officiel->photoSave));
		
		$officiel->publier 		= $this->param('officiel_publier', 0, true);
		$officiel->publierHome		= $this->param('officiel_publierHome', 0, true);
		$officiel->laUne			= $this->param('officiel_laUne', 0, true);

		if($officiel->id){				
			$officiel->dateModification 	= date("Y-m-d");
		}else{
			$toActs = officielSrv::chargeListOfficielAllFo();
			$incAct							= sizeof($toActs) + 1;
			$officiel->reference 			= "ac".str_pad($incAct, 12, "0", STR_PAD_LEFT);					
			
			$officiel->dateCreation 	 	= date("Y-m-d");		
			$officiel->dateModification	= NULL;
			$officiel->vue					= 0;
			$officiel->visite				= 0;
		}	
		//Date de publication
		$officiel->datePublication 	= tools::toDateTimeSQL($officiel->datePublication);

//-----------------------------------------------------------------------
if($officiel->photo != $officiel->photoSave){

	//Nom du fichier
	$zNomFichier = $officiel->photo;
	
	//Répertoire d'upload sur le serveur
	$zPathMedia = OFFICIEL_PATH_RESIZE."photos/";		
	//Répertoire de resize sur le serveur
	$zPathResize = OFFICIEL_PATH_RESIZE."images/";				
	
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
	
	}	
}	
//-----------------------------------------------------------------------

		//Fichier : doit etre copié vers le répertoire de destination		
		$zPathMedia  = OFFICIEL_PATH_MEDIAS."fichiers/";		
		$zPathResize = OFFICIEL_PATH_RESIZE."fichiers/";				

		$officiel_fichier 		= $this->request->params['officiel_fichier']; 
		$zFileName 				= basename ($officiel_fichier);
		$zExtPathAndFile 		= $officiel_fichier;
		
		$officiel->fichier = $zFileName;				

		$id = officielSrv::sauvegardeOfficiel($officiel);

		//Renomer le fichier
		$champs_fichier 			= $this->request->params['champs_fichier']; 				
		if(strlen($champs_fichier)){

			$zNewNameFile = tools::copyFile($zFileName, $zExtPathAndFile, OFFICIEL_PATH_MEDIAS, $zPathMedia, $zPathResize);
	
			// Mettre à jour le nom de fichier dans la base
			$factory = jDao::get("officiel~officiel");
			$officielDao = $factory->get($id);
			
			if ($officielDao->officiel_id) {
				$officielDao->officiel_fichier = $zNewNameFile;
				$factory->update($officielDao);
			}
		}	


		//Paramètres
		$tParams = array('page'=> $this->page);

		//Redirection		
		$rep = $this->getResponse('redirect');
		$rep->action  = 'officiel~officielBo_listeOfficiels';
		$rep->params = $tParams;
        
        return $rep;        
    }

	/**
    * Suppression d'une actualité donnée
	* 
	* Recoit l'id de la actualité en paramètre
	* Une fois ls officiel supprimée, redirige vers la page de liste des actualités
    */
    function supprimeOfficiel() {

		//Récupération des paramètres
		$officielId = $this->intParam('officiel_id',0, FALSE);
		if ($officielId == 0) {
			throw new Exception('Invalid parameter officiel_id');
		}

		//Suppression
		jClasses::inc('officielSrv');
		officielSrv::supprimeOfficiel($officielId);
		
		//Redirection
		$rep = $this->getResponse('redirect');
		$rep->action  = 'officiel~officielBo_listeOfficiels';
        
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
						$pathResize = OFFICIEL_PATH_RESIZE."photos/";
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
					$marqueWidth = OFFICIEL_WIDTH;
					$marqueHeight = OFFICIEL_HEIGHT;
					$pathResize = OFFICIEL_PATH_RESIZE."photos/";
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
		jClasses::inc('photoOff~photoOffSrv');

		$response = array('imgSrc'=>'');
		$iReturn 	= true;

		//Récupération des paramètres
		$photo = jMagicLoader::arrayToObject($this->request->params, 'photo');
		
		//Nom du fichier
		$zNomFichier = $photo->photo;
		
		//Répertoire d'upload sur le serveur
		$zPathMedia = OFFICIEL_PATH_MEDIAS."images/";		
		//Répertoire de resize sur le serveur
		$zPathResize = OFFICIEL_PATH_RESIZE."images/";				

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
		$iReturn = photoOffSrv::sauvegardePhoto($photo);

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
		jClasses::inc('photoOff~photoOffSrv');

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
		$zPathMedia = OFFICIEL_PATH_MEDIAS."images/";		
		//Répertoire de resize sur le serveur
		$zPathResize = OFFICIEL_PATH_RESIZE."images/";				

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
		$iReturn = photoOffSrv::sauvegardePhoto($photo);

		//Paramètres
		$response['imgSrc'] = $zNomFichier;
		
		$rep->datas = $response;
		return $rep;
    }
}
?>
