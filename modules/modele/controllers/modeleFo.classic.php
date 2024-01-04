<?php
/**
* @marqueage ilay-nosy
* @submarqueage modele
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Contrôleur FO pour les membres
* @marqueage ilay-nosy
* @submarqueage modele
* @todo : définir les différentes actions du contrôleur
*/
require_once (LIB_PATH.'fpdf/fpdf.php');

class modeleFoCtrl extends jController {

	//Toutes les actions de ce contrôleur nécessite une authentification via le plugin jAuth
	public $pluginParams = array('*'=>array('auth.required'=>false));
	
	/**
    * Supprime la photo de profil d'un membre modele
	* 
	* Utilisé via mode edition popup 
	* Recoit en paramètre l'ensemble des données du formulaire d'édition d'un membre
	* Une fois ls modele sauvegardée, redirige vers la page de liste des membres
    */
    function removePhoto() {
		//Préparation de la réponse
		global $gJConfig;

		//JSON		
		$rep = $this->getResponse('json');

		//Classes
		jClasses::inc('commun~tools');	
		jClasses::inc('modele~modeleSrv');

		$response = array('imgSrc'=>'');
		$iReturn 	= true;

		//Récupération des paramètres
		$modele = jMagicLoader::arrayToObject($this->request->params, 'user');
		
		//Nom du fichier
		$zNomFichier = $modele->profilPhoto;
		
		//Répertoire d'upload sur le serveur
		$zPathMedia = UTILISATEUR_PATH_MEDIAS."images/";		
		//Répertoire de resize sur le serveur
		$zPathResize = UTILISATEUR_PATH_RESIZE."images/";				

		//Supprime les fichiers
		tools::removeFile ($zPathMedia.''.$zNomFichier);
		tools::removeFile ($zPathResize.'detail/'.$zNomFichier);
		tools::removeFile ($zPathResize.'detail/'.$zNomFichier);
		tools::removeFile ($zPathResize.'detail/'.$zNomFichier);
		tools::removeFile ($zPathResize.'detail/'.$zNomFichier);

		$modele->photo = "";
		
		//Update
		$iReturn = modeleSrv::sauvegardeMembre($modele);

		//Paramètres
		$response['imgSrc'] = "nophoto.jpg";
		
		$rep->datas = $response;
		return $rep;
    }


	/**
    * Changement de la photo de profil d'un membre modele
	* 
	* Utilisé via mode edition popup 
	* Recoit en paramètre l'ensemble des données du formulaire d'édition d'un membre
	* Une fois ls modele sauvegardée, redirige vers la page de liste des membres
    */
    function changePhoto() {
		//Préparation de la réponse
		global $gJConfig;

		//JSON		
		$rep = $this->getResponse('json');

		//Classes
		jClasses::inc('commun~tools');	
		jClasses::inc('modele~modeleSrv');

		$response = array('imgSrc'=>'');
		$iReturn 	= true;

		//Récupération des paramètres
		$modele = jMagicLoader::arrayToObject($this->request->params, 'user');

		//$modele->id 				= 0;
		
		//Traitement de la photo
		//creation rep upload image sur le serveur
		//$zPath = JELIX_APP_WWW_PATH.'medias/modele/' ;		
		//tools::createDirectory($zPath) ;  	

		//Répertoire d'upload sur le serveur
		$zPathMedia = UTILISATEUR_PATH_MEDIAS."images/";		
		//Répertoire de resize sur le serveur
		$zPathResize = UTILISATEUR_PATH_RESIZE."images/";				

		//upload du fichier
		$zNomFichier 		= tools::uploadFile ("user_photo", $zPathMedia) ;
		$modele->photo = $zNomFichier;
		
		if($zNomFichier){

			$im_color		= "ffffff";
			$im_cropratio	= "1:1";
			$im_quality		= 90;			

			//resize fichier en GF MF PF
			//tools::resizeImage($zPath.''.$zNomFichier, $zPath.'resize_164_121/'.$zNomFichier, I_MAX_WIDTH, I_MAX_HEIGTH, 'ratio');

			//resize fichier au format detail : 180 x 135
			//tools::resizeImage($zPathMedia.''.$zNomFichier, $zPathResize.'detail/'.$zNomFichier, ANNONCE_DETAIL_WIDTH, ANNONCE_DETAIL_HEIGHT, 'fixed');
			tools::resizeImage2($zPathMedia.''.$zNomFichier, $zPathResize.'detail/'.$zNomFichier, $zPathResize.'detail/blank.jpg', ANNONCE_DETAIL_WIDTH, ANNONCE_DETAIL_HEIGHT, $im_color, $im_cropratio, $im_quality);
			//resize fichier au format abrege : 98 x 74
			//tools::resizeImage($zPathMedia.''.$zNomFichier, $zPathResize.'abrege/'.$zNomFichier, ANNONCE_ABREGE_WIDTH, ANNONCE_ABREGE_HEIGHT, 'ratio');
			tools::resizeImage2($zPathMedia.''.$zNomFichier, $zPathResize.'abrege/'.$zNomFichier, $zPathResize.'abrege/blank.jpg', ANNONCE_ABREGE_WIDTH, ANNONCE_ABREGE_HEIGHT, $im_color, $im_cropratio, $im_quality);
			//resize fichier au format photo : 180 x 135
			//tools::resizeImage($zPathMedia.''.$zNomFichier, $zPathResize.'photo/'.$zNomFichier, ANNONCE_PHOTO_WIDTH, ANNONCE_PHOTO_HEIGHT, 'ratio');
			tools::resizeImage2($zPathMedia.''.$zNomFichier, $zPathResize.'photo/'.$zNomFichier, $zPathResize.'photo/blank.jpg', ANNONCE_PHOTO_WIDTH, ANNONCE_PHOTO_HEIGHT, $im_color, $im_cropratio, $im_quality);
			//resize fichier au format popup : 360 x 270
			//tools::resizeImage($zPathMedia.''.$zNomFichier, $zPathResize.'popup/'.$zNomFichier, ANNONCE_POPUP_WIDTH, ANNONCE_POPUP_HEIGHT, 'ratio');
			tools::resizeImage2($zPathMedia.''.$zNomFichier, $zPathResize.'popup/'.$zNomFichier, $zPathResize.'popup/blank.jpg', ANNONCE_POPUP_WIDTH, ANNONCE_POPUP_HEIGHT, $im_color, $im_cropratio, $im_quality);
		}	

		//Supprime le fichier source
		tools::removeFile ($zPathMedia.''.$zNomFichier);
			
		//Enregistrement
		$iReturn = modeleSrv::sauvegardeMembre($modele);

		//Paramètres
		$response['imgSrc'] = $zNomFichier;
		
		$rep->datas = $response;
		return $rep;
    }

	/**
    * Enregistrement des données d'un membre modele
	* 
	* Utilisé en création et modification seulement 
	* Recoit en paramètre l'ensemble des données du formulaire d'édition d'un membre
	* Une fois ls modele sauvegardée, redirige vers la page de liste des membres
    */
    function sauvegardeMembre() {
		//Préparation de la réponse
		global $gJConfig;

		//JSON		
		$rep = $this->getResponse('json');

		//Classes
		jClasses::inc('commun~tools');	
		jClasses::inc('modele~modeleSrv');

		$result 	= array();
		$iReturn 	= true;

		//Récupération des paramètres
		$this->request_utf8_decode();
		$modele = jMagicLoader::arrayToObject($this->request->params, 'user');


		//Paramètres calculés ou supplémentaires
		$modele->paysId 			= $modele->pays;
		$modele->profilId 			= $modele->profil;
		$modele->dateNaissance 	= tools::toDateSQL($modele->dateNaissance);

		//$modele->id 				= 0;
		//$modele->login 			= "";
		
		if($modele->id != 0){
			$modele->dateModification 	= date("y-m-d"); 
		}else{
			$modele->dateModification 	= ""; 
			$modele->dateCreation 		= date("y-m-d");		
		}
		$modele->statut 			= 1; //3 = en attente de confirmation
		
		//Traitement de la photo
		//creation rep upload image sur le serveur
		//$zPath = JELIX_APP_WWW_PATH.'medias/modele/' ;		
		//tools::createDirectory($zPath) ;  	

		//Répertoire d'upload sur le serveur
		$zPathMedia = UTILISATEUR_PATH_MEDIAS."images/";		
		//Répertoire de resize sur le serveur
		$zPathResize = UTILISATEUR_PATH_RESIZE."images/";				

		//upload du fichier
		$zNomFichier 		= tools::uploadFile ("user_photo", $zPathMedia) ;
		$modele->photo = $zNomFichier;
		
		if($zNomFichier){

			$im_color		= "ffffff";
			$im_cropratio	= "1:1";
			$im_quality		= 90;			

			//resize fichier en GF MF PF
			//tools::resizeImage($zPath.''.$zNomFichier, $zPath.'resize_164_121/'.$zNomFichier, I_MAX_WIDTH, I_MAX_HEIGTH, 'ratio');

			//resize fichier au format detail : 180 x 135
			//tools::resizeImage($zPathMedia.''.$zNomFichier, $zPathResize.'detail/'.$zNomFichier, ANNONCE_DETAIL_WIDTH, ANNONCE_DETAIL_HEIGHT, 'fixed');
			tools::resizeImage2($zPathMedia.''.$zNomFichier, $zPathResize.'detail/'.$zNomFichier, $zPathResize.'detail/blank.jpg', ANNONCE_DETAIL_WIDTH, ANNONCE_DETAIL_HEIGHT, $im_color, $im_cropratio, $im_quality);
			//resize fichier au format abrege : 98 x 74
			//tools::resizeImage($zPathMedia.''.$zNomFichier, $zPathResize.'abrege/'.$zNomFichier, ANNONCE_ABREGE_WIDTH, ANNONCE_ABREGE_HEIGHT, 'ratio');
			tools::resizeImage2($zPathMedia.''.$zNomFichier, $zPathResize.'abrege/'.$zNomFichier, $zPathResize.'abrege/blank.jpg', ANNONCE_ABREGE_WIDTH, ANNONCE_ABREGE_HEIGHT, $im_color, $im_cropratio, $im_quality);
			//resize fichier au format photo : 180 x 135
			//tools::resizeImage($zPathMedia.''.$zNomFichier, $zPathResize.'photo/'.$zNomFichier, ANNONCE_PHOTO_WIDTH, ANNONCE_PHOTO_HEIGHT, 'ratio');
			tools::resizeImage2($zPathMedia.''.$zNomFichier, $zPathResize.'photo/'.$zNomFichier, $zPathResize.'photo/blank.jpg', ANNONCE_PHOTO_WIDTH, ANNONCE_PHOTO_HEIGHT, $im_color, $im_cropratio, $im_quality);
			//resize fichier au format popup : 360 x 270
			//tools::resizeImage($zPathMedia.''.$zNomFichier, $zPathResize.'popup/'.$zNomFichier, ANNONCE_POPUP_WIDTH, ANNONCE_POPUP_HEIGHT, 'ratio');
			tools::resizeImage2($zPathMedia.''.$zNomFichier, $zPathResize.'popup/'.$zNomFichier, $zPathResize.'popup/blank.jpg', ANNONCE_POPUP_WIDTH, ANNONCE_POPUP_HEIGHT, $im_color, $im_cropratio, $im_quality);
		}	
		/*if($zNomFichier){
			//resize fichier en GF MF PF
			//tools::resizeImage($zPath.''.$zNomFichier, $zPath.'resize_164_121/'.$zNomFichier, I_MAX_WIDTH, I_MAX_HEIGTH, 'ratio');

			//resize fichier au format detail : 180 x 135
			tools::resizeImage($zPathMedia.''.$zNomFichier, $zPathResize.'detail/'.$zNomFichier, ANNONCE_DETAIL_WIDTH, ANNONCE_DETAIL_HEIGHT, 'ratio');
			//resize fichier au format abrege : 98 x 74
			tools::resizeImage($zPathMedia.''.$zNomFichier, $zPathResize.'abrege/'.$zNomFichier, ANNONCE_ABREGE_WIDTH, ANNONCE_ABREGE_HEIGHT, 'ratio');
			//resize fichier au format photo : 180 x 135
			tools::resizeImage($zPathMedia.''.$zNomFichier, $zPathResize.'photo/'.$zNomFichier, ANNONCE_PHOTO_WIDTH, ANNONCE_PHOTO_HEIGHT, 'ratio');
			//resize fichier au format popup : 360 x 270
			tools::resizeImage($zPathMedia.''.$zNomFichier, $zPathResize.'popup/'.$zNomFichier, ANNONCE_POPUP_WIDTH, ANNONCE_POPUP_HEIGHT, 'ratio');
		}*/	
			
		//Supprime le fichier source
		tools::removeFile ($zPathMedia.''.$zNomFichier);

		//print_r($modele);
		//die();

		//Enregistrement
		$iReturn = modeleSrv::sauvegardeMembre($modele);

		//Paramètres
		$result = array("statut"=>$iReturn);
		
		$rep->datas = $result;
		return $rep;
    }

	function chargeSelectModele(){
		global $gJConfig;
        $rep = $this->getResponse('json');
		jClasses::inc('modele~modeleSrv');
		$idMarque = $this->intParam('idMarque', 0, true);
		
		$toModele = modeleSrv::getAllModele($idMarque);
		if(sizeof($toModele)>0)
		{
			$tModele = array();
			foreach($toModele as $oModele)
			{
				$oModele->modele_libelle = htmlentities($oModele->modele_libelle);
				array_push($tModele, $oModele);
			}
			$result = array('toModele' => $tModele);
		}
		else
			$result = array('toModele' => 0);

		$rep->datas = $result;
		return $rep;	
	}

}
?>
