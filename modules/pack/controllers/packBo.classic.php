<?php
/**
* @package ilay-nosy
* @subpackage pack
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Contrôleur BO pour les packs
* @package ilay-nosy
* @subpackage pack
* @todo : définir les différentes actions du contrôleur
*/
require_once (LIB_PATH.'fpdf/fpdf.php');

class packBoCtrl extends jController {

	//Toutes les actions de ce contrôleur nécessite une authentification via le plugin jAuth
	public $pluginParams = array('*'=>array('auth.required'=>true));
	
	/**
    * Affiche la liste des packs
	* Recoit en paramètre le type de l'actualité : standard ou évènement, 
    */
    function listePacks() {
		jClasses::inc('pack~packSrv');

        $rep = $this->getResponse('htmlBo');

		//Param
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}

		$rep->menusActifs = array(HtmlBoResponse::MENU_ABONNEMENT, HtmlBoResponse::MENU_ABONNEMENT_PACK);
		$rep->bodyTpl = 'pack~packBo';

		//Param
		$tParams = array('page'=> $this->page);

		$rep->body->assignZone("listePackBo", "pack~listePackBo", $tParams);

        return $rep;
    }

	/**
    * Affichage le détail d'une actualité en mode edition 
	* Recoit l'id de l'actualité en paramètre
    */
    function editionPack() {
		//Préparation de la réponse
		global $gJConfig;

        $rep = $this->getResponse('htmlBo');
		$rep->addJSLink($gJConfig->urlengine['basePath'].'design/back/js/packs.js');
		$rep->addCSSLink($gJConfig->urlengine['basePath'] . 'design/back/css/nosyEdit.css');

		$rep->addJSCode("j_pack_medias = '".PACK_PATH_MEDIAS."';");
		$rep->addJSCode("j_pack_resize = '".PACK_PATH_RESIZE."';");
		
		//Chargement du menu 
		$rep->menusActifs = array(HtmlBoResponse::MENU_ABONNEMENT, HtmlBoResponse::MENU_ABONNEMENT_PACK);
		
		//Template à utiliser
		$rep->bodyTpl = 'pack~packBo';

		//Récupération des paramètres
		if ($this->intParam('page')) {
			$this->page = $this->intParam('page');
		}else{
			$this->page = 1;
		}		
		if ($this->intParam('pack_id')) {
			$this->pack_id = $this->intParam('pack_id');
		}else{
			$this->pack_id = 0;
		}
		if ($this->param('errorMessage')) {
			$this->errorMessage = $this->param('errorMessage');
		}else{
			$this->errorMessage = '';
		}

		//$tParams = array('zone'=> $this->getParam('zone','pack~listePackBo.zone'));

		//Chargement des données
		jClasses::inc('pack~packSrv');
		$visuel = '';
		
		if ($this->pack_id != 0) {
			try {
				$pack = packSrv::chargePack($this->pack_id);

				if(file_exists(PACK_PATH_RESIZE."photos/".$pack->pack_photo) && is_file(PACK_PATH_RESIZE."photos/".$pack->pack_photo)){
					$extension=explode(".",$pack->pack_photo);
					switch(strtolower($extension[count($extension)-1])){
						case 'swf':
							$visuel = sprintf('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" width="%d" height="%d" id="index" align="middle"><param name="allowScriptAccess" value="sameDomain" /><param name="movie" value="%s" />	<param name="menu" value="false" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><embed src="%s" menu="false" quality="high" bgcolor="#ffffff" width="%d" height="%d" name="index" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>', PACK_WIDTH, PACK_HEIGHT, $gJConfig->urlengine['basePath'].PACK_PATH_RESIZE."photos/".$pack->pack_photo, $gJConfig->urlengine['basePath'].PACK_PATH_RESIZE."photos/".$pack->pack_photo, PACK_WIDTH, PACK_HEIGHT);
							break;
						default:
							$visuel = sprintf('<img src="%s" width="%d" height="%d" align="absmiddle">',$gJConfig->urlengine['basePath'].PACK_PATH_RESIZE."photos/".$pack->pack_photo,PACK_WIDTH,PACK_HEIGHT);
							break;
					}
				}
				
				
			} catch(Exception $oJException) {
				throw new JException ($oJException->getLocaleKey()) ;
			}				
		}else{
			$pack = packSrv::getDaoPack();
		}

		$tParams = array('pack_id'=> $this->pack_id, 'errorMessage'=>$this->errorMessage);
							
		$rep->body->assign('tParams', $tParams);
		$rep->body->assign('pack', $pack);													
		$rep->body->assign("visuel", $visuel);		
		$rep->body->assign("pack_id", $this->pack_id);		
		$rep->body->assign("page", $this->page);		

        return $rep;
    }
	
	
	/**
    * Enregistrement des données d'une actualité
	* 
	* Utilisé en création et modification seulement 
	* Recoit en paramètre l'ensemble des données du formulaire d'édition d'une actualité
	* Une fois ls pack sauvegardée, redirige vers la page de liste des actualités
    */
    function sauvegardePack() {
		//Préparation de la réponse
		global $gJConfig;

		//Récupération des paramètres
		$pack = jMagicLoader::arrayToObject($this->request->params, 'pack');

		//Récupération des paramètres
		if ($this->request->params['page']) {
			$this->page = $this->request->params['page'];			
		}else{
			$this->page = 1;
		}	

		//Enregistrement
		jClasses::inc('commun~tools');	
		jClasses::inc('packSrv');

		//Répertoire d'upload sur le serveur
		$zPathMedia = PACK_PATH_MEDIAS."images/";		
		//Répertoire de resize sur le serveur
		$zPathResize = PACK_PATH_RESIZE."images/";				

		//Photo, qui est resizé automatique au moment de la sélection
		
		$pack->photo=substr($pack->photo,strlen($gJConfig->urlengine['basePath'].PACK_PATH_RESIZE."photos/"),strlen($pack->photo));
		//$pack->photo=substr($pack->photo,strlen($gJConfig->urlengine['basePath'].PACK_PATH_RESIZE),strlen($pack->photo));

		//echo "<br>".$pack->photo;
		//die();
		
		//Fichier : doit etre copié vers le répertoire de destination		
		$zPathMedia = PACK_PATH_MEDIAS."fichiers/";		
		$zPathResize = PACK_PATH_RESIZE."fichiers/";				

		$pack_fichier 			= $this->request->params['pack_fichier']; 
		$zFileName 				= basename ($pack_fichier);
		$zExtPathAndFile 		= $pack_fichier;
		
		$pack->fichier = $zFileName;				
		
		//Transaction
		$id = packSrv::sauvegardePack($pack);
		
		$champs_fichier 			= $this->request->params['champs_fichier']; 	
			
		if(strlen($champs_fichier)){

			$zNewNameFile = tools::copyFile($zFileName, $zExtPathAndFile, PACK_PATH_MEDIAS, $zPathMedia, $zPathResize);
	
			// Mettre à jour le nom de fichier dans la base
			$factory = jDao::get("pack~pack");
			$packDao = $factory->get($id);
			
			if ($packDao->pack_id) {
				$packDao->pack_fichier = $zNewNameFile;
				$factory->update($packDao);
			}
		}	
			

		//Paramètres
		$tParams = array('page'=> $this->page);

		//Redirection		
		$rep = $this->getResponse('redirect');
		$rep->action  = 'pack~packBo_listePacks';
		$rep->params = $tParams;
        
        return $rep;        
    }

	/**
    * Suppression d'une actualité donnée
	* 
	* Recoit l'id de la actualité en paramètre
	* Une fois ls pack supprimée, redirige vers la page de liste des actualités
    */
    function supprimePack() {

		//Récupération des paramètres
		$packId = $this->intParam('pack_id',0, FALSE);
		if ($packId == 0) {
			throw new Exception('Invalid parameter pack_id');
		}

		//Suppression
		jClasses::inc('packSrv');
		packSrv::supprimePack($packId);
		
		//Redirection
		$rep = $this->getResponse('redirect');
		$rep->action  = 'pack~packBo_listePacks';
        
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
						$pathResize = PACK_PATH_RESIZE."photos/";
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
					$marqueWidth = PACK_WIDTH;
					$marqueHeight = PACK_HEIGHT;
					$pathResize = PACK_PATH_RESIZE."photos/";
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
}
?>
