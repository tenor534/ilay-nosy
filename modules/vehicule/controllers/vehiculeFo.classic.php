<?php
/**
* @package ilay-nosy
* @subpackage utilisateur
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Contrôleur FO pour les membres
* @package ilay-nosy
* @subpackage utilisateur
* @todo : définir les différentes actions du contrôleur
*/
require_once (LIB_PATH.'fpdf/fpdf.php');

class utilisateurFoCtrl extends jController {

	//Toutes les actions de ce contrôleur nécessite une authentification via le plugin jAuth
	public $pluginParams = array('*'=>array('auth.required'=>false));
	
	/**
    * Supprime la vehicule de profil d'un membre utilisateur
	* 
	* Utilisé via mode edition popup 
	* Recoit en paramètre l'ensemble des données du formulaire d'édition d'un membre
	* Une fois ls utilisateur sauvegardée, redirige vers la page de liste des membres
    */
    function removeVehicule() {
		//Préparation de la réponse
		global $gJConfig;

		//JSON		
		$rep = $this->getResponse('json');

		//Classes
		jClasses::inc('commun~tools');	
		jClasses::inc('utilisateur~utilisateurSrv');

		$response = array('imgSrc'=>'');
		$iReturn 	= true;

		//Récupération des paramètres
		$utilisateur = jMagicLoader::arrayToObject($this->request->params, 'user');
		
		//Nom du fichier
		$zNomFichier = $utilisateur->profilVehicule;
		
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

		$utilisateur->vehicule = "";
		
		//Update
		$iReturn = utilisateurSrv::sauvegardeMembre($utilisateur);

		//Paramètres
		$response['imgSrc'] = "novehicule.jpg";
		
		$rep->datas = $response;
		return $rep;
    }


	/**
    * Changement de la vehicule de profil d'un membre utilisateur
	* 
	* Utilisé via mode edition popup 
	* Recoit en paramètre l'ensemble des données du formulaire d'édition d'un membre
	* Une fois ls utilisateur sauvegardée, redirige vers la page de liste des membres
    */
    function changeVehicule() {
		//Préparation de la réponse
		global $gJConfig;

		//JSON		
		$rep = $this->getResponse('json');

		//Classes
		jClasses::inc('commun~tools');	
		jClasses::inc('utilisateur~utilisateurSrv');

		$response = array('imgSrc'=>'');
		$iReturn 	= true;

		//Récupération des paramètres
		$utilisateur = jMagicLoader::arrayToObject($this->request->params, 'user');

		//$utilisateur->id 				= 0;
		
		//Traitement de la vehicule
		//creation rep upload image sur le serveur
		//$zPath = JELIX_APP_WWW_PATH.'medias/utilisateur/' ;		
		//tools::createDirectory($zPath) ;  	

		//Répertoire d'upload sur le serveur
		$zPathMedia = UTILISATEUR_PATH_MEDIAS."images/";		
		//Répertoire de resize sur le serveur
		$zPathResize = UTILISATEUR_PATH_RESIZE."images/";				

		//upload du fichier
		$zNomFichier 		= tools::uploadFile ("user_vehicule", $zPathMedia) ;
		$utilisateur->vehicule = $zNomFichier;
		
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
			//resize fichier au format vehicule : 180 x 135
			//tools::resizeImage($zPathMedia.''.$zNomFichier, $zPathResize.'vehicule/'.$zNomFichier, ANNONCE_PHOTO_WIDTH, ANNONCE_PHOTO_HEIGHT, 'ratio');
			tools::resizeImage2($zPathMedia.''.$zNomFichier, $zPathResize.'vehicule/'.$zNomFichier, $zPathResize.'vehicule/blank.jpg', ANNONCE_PHOTO_WIDTH, ANNONCE_PHOTO_HEIGHT, $im_color, $im_cropratio, $im_quality);
			//resize fichier au format popup : 360 x 270
			//tools::resizeImage($zPathMedia.''.$zNomFichier, $zPathResize.'popup/'.$zNomFichier, ANNONCE_POPUP_WIDTH, ANNONCE_POPUP_HEIGHT, 'ratio');
			tools::resizeImage2($zPathMedia.''.$zNomFichier, $zPathResize.'popup/'.$zNomFichier, $zPathResize.'popup/blank.jpg', ANNONCE_POPUP_WIDTH, ANNONCE_POPUP_HEIGHT, $im_color, $im_cropratio, $im_quality);
		}	

		//Supprime le fichier source
		tools::removeFile ($zPathMedia.''.$zNomFichier);
			
		//Enregistrement
		$iReturn = utilisateurSrv::sauvegardeMembre($utilisateur);

		//Paramètres
		$response['imgSrc'] = $zNomFichier;
		
		$rep->datas = $response;
		return $rep;
    }

	/**
    * Enregistrement des données d'un membre utilisateur
	* 
	* Utilisé en création et modification seulement 
	* Recoit en paramètre l'ensemble des données du formulaire d'édition d'un membre
	* Une fois ls utilisateur sauvegardée, redirige vers la page de liste des membres
    */
    function sauvegardeMembre() {
		//Préparation de la réponse
		global $gJConfig;

		//JSON		
		$rep = $this->getResponse('json');

		//Classes
		jClasses::inc('commun~tools');	
		jClasses::inc('utilisateur~utilisateurSrv');

		$result 	= array();
		$iReturn 	= true;

		//Récupération des paramètres
		$this->request_utf8_decode();
		$utilisateur = jMagicLoader::arrayToObject($this->request->params, 'user');


		//Paramètres calculés ou supplémentaires
		$utilisateur->paysId 			= $utilisateur->pays;
		$utilisateur->profilId 			= $utilisateur->profil;
		$utilisateur->dateNaissance 	= tools::toDateSQL($utilisateur->dateNaissance);

		//$utilisateur->id 				= 0;
		//$utilisateur->login 			= "";
		
		if($utilisateur->id != 0){
			$utilisateur->dateModification 	= date("y-m-d"); 
		}else{
			$utilisateur->dateModification 	= ""; 
			$utilisateur->dateCreation 		= date("y-m-d");		
		}
		$utilisateur->statut 			= 1; //3 = en attente de confirmation
		
		//Traitement de la vehicule
		//creation rep upload image sur le serveur
		//$zPath = JELIX_APP_WWW_PATH.'medias/utilisateur/' ;		
		//tools::createDirectory($zPath) ;  	

		//Répertoire d'upload sur le serveur
		$zPathMedia = UTILISATEUR_PATH_MEDIAS."images/";		
		//Répertoire de resize sur le serveur
		$zPathResize = UTILISATEUR_PATH_RESIZE."images/";				

		//upload du fichier
		$zNomFichier 		= tools::uploadFile ("user_vehicule", $zPathMedia) ;
		$utilisateur->vehicule = $zNomFichier;
		
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
			//resize fichier au format vehicule : 180 x 135
			//tools::resizeImage($zPathMedia.''.$zNomFichier, $zPathResize.'vehicule/'.$zNomFichier, ANNONCE_PHOTO_WIDTH, ANNONCE_PHOTO_HEIGHT, 'ratio');
			tools::resizeImage2($zPathMedia.''.$zNomFichier, $zPathResize.'vehicule/'.$zNomFichier, $zPathResize.'vehicule/blank.jpg', ANNONCE_PHOTO_WIDTH, ANNONCE_PHOTO_HEIGHT, $im_color, $im_cropratio, $im_quality);
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
			//resize fichier au format vehicule : 180 x 135
			tools::resizeImage($zPathMedia.''.$zNomFichier, $zPathResize.'vehicule/'.$zNomFichier, ANNONCE_PHOTO_WIDTH, ANNONCE_PHOTO_HEIGHT, 'ratio');
			//resize fichier au format popup : 360 x 270
			tools::resizeImage($zPathMedia.''.$zNomFichier, $zPathResize.'popup/'.$zNomFichier, ANNONCE_POPUP_WIDTH, ANNONCE_POPUP_HEIGHT, 'ratio');
		}*/	
			
		//Supprime le fichier source
		tools::removeFile ($zPathMedia.''.$zNomFichier);

		//print_r($utilisateur);
		//die();

		//Enregistrement
		$iReturn = utilisateurSrv::sauvegardeMembre($utilisateur);

		//Paramètres
		$result = array("statut"=>$iReturn);
		
		$rep->datas = $result;
		return $rep;
    }

}
?>
