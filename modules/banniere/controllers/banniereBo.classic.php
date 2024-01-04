<?php
/**
* @package ilay-nosy
* @subpackage banniere
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Contrôleur BO pour les bannieres
* @package ilay-nosy
* @subpackage banniere
* @todo : définir les différentes actions du contrôleur
*/
require_once (LIB_PATH.'fpdf/fpdf.php');

class banniereBoCtrl extends jController {

	//Toutes les actions de ce contrôleur nécessite une authentification via le plugin jAuth
	public $pluginParams = array('*'=>array('auth.required'=>true));
	

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
	function updateBanniereHome()
	{
		global $gJConfig;
        $rep = $this->getResponse('json');
		jClasses::inc('banniere~banniereSrv');

		$idBanniere = $this->intParam('idBanniere', 0, true);
		$publier = $this->intParam('publier', -1, true);
		banniereSrv::updateBanniereHome($idBanniere, $publier);

		return $rep;	
	}
	function updateBanniereUne()
	{
		global $gJConfig;
        $rep = $this->getResponse('json');
		jClasses::inc('banniere~banniereSrv');

		$idBanniere = $this->intParam('idBanniere', 0, true);
		$publier = $this->intParam('publier', -1, true);
		banniereSrv::updateBanniereUne($idBanniere, $publier);

		return $rep;	
	}

	/**
    * Affiche la liste des bannieres
	* Recoit en paramètre le type de l'actualité : standard ou évènement, 
    */
    function listeBannieres() {
		global $gJConfig;

        $rep = $this->getResponse('htmlBo');

		$rep->addJSLink($gJConfig->urlengine['basePath'] . 'design/back/js/banniereListe.js');

		jClasses::inc('banniere~banniereSrv');

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

		$rep->menusActifs = array(HtmlBoResponse::MENU_BANNIERE, HtmlBoResponse::MENU_BANNIERE_LISTE);
		$rep->bodyTpl = 'banniere~banniereBo';

		//Param
		$tParams = array('page'=> $this->page, 'aid'=> $this->aid);

		$rep->body->assignZone("listeBanniereBo", "banniere~listeBanniereBo", $tParams);

        return $rep;
    }

	/**
    * Affichage le détail d'une actualité en mode edition 
	* Recoit l'id de l'actualité en paramètre
    */
    function editionBanniere() {
		//Préparation de la réponse
		global $gJConfig;

		//Chargement des données
		jClasses::inc('categorieAct~categorieActSrv');
		jClasses::inc('banniere~banniereSrv');
		jClasses::inc('photoAct~photoActSrv');

        $rep = $this->getResponse('htmlBo');
		$rep->addJSLink($gJConfig->urlengine['basePath'] . 'design/back/js/bannieres.js');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/back/css/nosyEdit.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceDetail.css');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyAnnounceDiv.css');	

		$rep->addJSCode("j_banniere_medias = '".BANNIERE_PATH_MEDIAS."';");
		$rep->addJSCode("j_banniere_resize = '".BANNIERE_PATH_RESIZE."';");

		//Chargement du menu 
		$rep->menusActifs = array(HtmlBoResponse::MENU_BANNIERE, HtmlBoResponse::MENU_BANNIERE_LISTE);
		
		//Template à utiliser
		$rep->bodyTpl = 'banniere~banniereBo';

		//Récupération des paramètres
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}		
		if ($this->intParam('banniere_id')) {
			$this->banniere_id = $this->intParam('banniere_id');
		}else{
			$this->banniere_id = 0;
		}
		if ($this->param('errorMessage')) {
			$this->errorMessage = $this->param('errorMessage');
		}else{
			$this->errorMessage = '';
		}

		//$tParams = array('zone'=> $this->getParam('zone','banniere~listeBanniereBo.zone'));

		//Chargement des données
		jClasses::inc('banniere~banniereSrv');
		$visuel = '';		
		if ($this->banniere_id != 0) {
			try {
				$banniere = banniereSrv::chargeBanniere($this->banniere_id);

				if(file_exists(BANNIERE_PATH_RESIZE."photos/".$banniere->banniere_photo) && is_file(BANNIERE_PATH_RESIZE."photos/".$banniere->banniere_photo)){
					$extension=explode(".",$banniere->banniere_photo);
					switch(strtolower($extension[count($extension)-1])){
						case 'swf':
							$visuel = sprintf('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" width="%d" height="%d" id="index" align="middle"><param name="allowScriptAccess" value="sameDomain" /><param name="movie" value="%s" />	<param name="menu" value="false" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><embed src="%s" menu="false" quality="high" bgcolor="#ffffff" width="%d" height="%d" name="index" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>', BANNIERE_WIDTH, BANNIERE_HEIGHT, $gJConfig->urlengine['basePath'].BANNIERE_PATH_RESIZE."photos/".$banniere->banniere_photo, $gJConfig->urlengine['basePath'].BANNIERE_PATH_RESIZE."photos/".$banniere->banniere_photo, BANNIERE_WIDTH, BANNIERE_HEIGHT);
							break;
						default:
							$visuel = sprintf('<img src="%s" width="%d" height="%d" align="absmiddle">',$gJConfig->urlengine['basePath'].BANNIERE_PATH_RESIZE."photos/".$banniere->banniere_photo,BANNIERE_WIDTH,BANNIERE_HEIGHT);
							break;
					}
				}
				
			} catch(Exception $oJException) {
				throw new JException ($oJException->getLocaleKey()) ;
			}				
		}else{
			$banniere = banniereSrv::getDaoBanniere();
			
			$banniere->banniere_id 			= 0;			
			$banniere->banniere_statut = USER_STATUT_ON;			
		}

		//Photos en cours
		$toPhotos 		= photoActSrv::getAllPhoto($this->banniere_id);		
		
		$toCategorieActs	= categorieActSrv::chargeAllCategorieAct();		

		//En mode modification
		if ($this->banniere_id != 0){
			//la première photo
			if(sizeof($toPhotos)){
				//$banniere->banniere_photo = $toPhotos[0]->photo_photo;
			}else{
				//$banniere->banniere_photo = "noPhoto.jpg";
			}
			
			//Calcule le nombre de photo possible pour l'banniere selon le forfait choisi
			$nbPhotos 		= BANNIERE_NBPHOTOMAX; //20 
			$nbPhotoToAdd 	= $nbPhotos - sizeof($toPhotos);
			if($nbPhotoToAdd > 0){
				for($i=0; $i<$nbPhotoToAdd; $i++){				
					$photo = photoActSrv::getDaoPhoto();				
					$photo->id		= 0;
					$photo->banniereId	= $this->banniere_id;
					$photo->photo 	= "noPhoto.jpg";
					$idPhoto = photoActSrv::sauvegardePhoto($photo);
				}					
				//Photos en cours
				$toPhotos 		= photoActSrv::getAllPhoto($this->banniere_id);					
			}						
		}	

		$tParams = array('banniere_id'=> $this->banniere_id,'errorMessage'=>$this->errorMessage, 'page'=> $this->page);

		$rep->body->assign('tParams', $tParams);
		$rep->body->assign('banniere', $banniere);													
		$rep->body->assign("banniere_id", $this->banniere_id);		
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
	* Une fois ls banniere sauvegardée, redirige vers la page de liste des actualités
    */
    function sauvegardeBanniere() {
		//Préparation de la réponse
		global $gJConfig;

		//Enregistrement
		jClasses::inc('commun~tools');	
		jClasses::inc('banniereSrv');

		//Récupération des paramètres
		$banniere = jMagicLoader::arrayToObject($this->request->params, 'banniere');

		//Récupération des paramètres
		if ($this->request->params['page']) {
			$this->page = $this->request->params['page'];			
		}else{
			$this->page = 1;
		}	

		//Save				
		$banniere->photo			= substr($banniere->photo,strlen($gJConfig->urlengine['basePath'].BANNIERE_PATH_RESIZE."photos/"),strlen($banniere->photo));
		$banniere->photoSave		= substr($banniere->photoSave,strlen($gJConfig->urlengine['basePath'].BANNIERE_PATH_RESIZE."photos/"),strlen($banniere->photoSave));
		
		$banniere->publier 		= $this->param('banniere_publier', 0, true);
		$banniere->publierHome		= $this->param('banniere_publierHome', 0, true);
		$banniere->laUne			= $this->param('banniere_laUne', 0, true);

		if($banniere->id){				
			$banniere->dateModification 	= date("Y-m-d");
		}else{
			$toActs = banniereSrv::chargeListBanniereAllFo();
			$incAct							= sizeof($toActs) + 1;
			$banniere->reference 			= "ac".str_pad($incAct, 12, "0", STR_PAD_LEFT);					
			
			$banniere->dateCreation 	 	= date("Y-m-d");		
			$banniere->dateModification	= NULL;
			$banniere->vue					= 0;
			$banniere->visite				= 0;
		}	
		//Date de publication
		$banniere->datePublication 	= tools::toDateTimeSQL($banniere->datePublication);

//-----------------------------------------------------------------------
if($banniere->photo != $banniere->photoSave){

	//Nom du fichier
	$zNomFichier = $banniere->photo;
	
	//Répertoire d'upload sur le serveur
	$zPathMedia = BANNIERE_PATH_RESIZE."photos/";		
	//Répertoire de resize sur le serveur
	$zPathResize = BANNIERE_PATH_RESIZE."images/";				
	
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
		$zPathMedia  = BANNIERE_PATH_MEDIAS."fichiers/";		
		$zPathResize = BANNIERE_PATH_RESIZE."fichiers/";				

		$banniere_fichier 		= $this->request->params['banniere_fichier']; 
		$zFileName 				= basename ($banniere_fichier);
		$zExtPathAndFile 		= $banniere_fichier;
		
		$banniere->fichier = $zFileName;				

		$id = banniereSrv::sauvegardeBanniere($banniere);

		//Renomer le fichier
		$champs_fichier 			= $this->request->params['champs_fichier']; 				
		if(strlen($champs_fichier)){

			$zNewNameFile = tools::copyFile($zFileName, $zExtPathAndFile, BANNIERE_PATH_MEDIAS, $zPathMedia, $zPathResize);
	
			// Mettre à jour le nom de fichier dans la base
			$factory = jDao::get("banniere~banniere");
			$banniereDao = $factory->get($id);
			
			if ($banniereDao->banniere_id) {
				$banniereDao->banniere_fichier = $zNewNameFile;
				$factory->update($banniereDao);
			}
		}	


		//Paramètres
		$tParams = array('page'=> $this->page);

		//Redirection		
		$rep = $this->getResponse('redirect');
		$rep->action  = 'banniere~banniereBo_listeBannieres';
		$rep->params = $tParams;
        
        return $rep;        
    }

	/**
    * Suppression d'une actualité donnée
	* 
	* Recoit l'id de la actualité en paramètre
	* Une fois ls banniere supprimée, redirige vers la page de liste des actualités
    */
    function supprimeBanniere() {

		//Récupération des paramètres
		$banniereId = $this->intParam('banniere_id',0, FALSE);
		if ($banniereId == 0) {
			throw new Exception('Invalid parameter banniere_id');
		}

		//Suppression
		jClasses::inc('banniereSrv');
		banniereSrv::supprimeBanniere($banniereId);
		
		//Redirection
		$rep = $this->getResponse('redirect');
		$rep->action  = 'banniere~banniereBo_listeBannieres';
        
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
						$pathResize = BANNIERE_PATH_RESIZE."photos/";
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
					$marqueWidth = BANNIERE_WIDTH;
					$marqueHeight = BANNIERE_HEIGHT;
					$pathResize = BANNIERE_PATH_RESIZE."photos/";
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
		$zPathMedia = BANNIERE_PATH_MEDIAS."images/";		
		//Répertoire de resize sur le serveur
		$zPathResize = BANNIERE_PATH_RESIZE."images/";				

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
		$zPathMedia = BANNIERE_PATH_MEDIAS."images/";		
		//Répertoire de resize sur le serveur
		$zPathResize = BANNIERE_PATH_RESIZE."images/";				

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
