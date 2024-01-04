<?php
/**
* @package ilay-nosy
* @subpackage annonce
* @version  1
* @author DWORD Consulting SARL
*/

/**
* JSON
*/
//require_once (LIB_PATH.'json/JSON.php');

/**
* Zone affichant le bloc annonce de droite en FO
*
* @package ilay-nosy
* @subpackage annonce
*/
class homePageAnnonceFoZone extends jZone {
 
    protected $_tplname='annonce~homePageAnnonceFo.zone';
	protected $_useCache = false;

	/**
	* Cat a afficher
	*/
	public $rub = 0;

	/**
	* Catégorie a afficher
	*/
	public $rubriqueIds = 0;
	
	/**
	* CSS a afficher
	*/
	public $mast = "";	
	
	/**
	* Titre a afficher
	*/
	public $topTitre = "";	

	/**
	* Chargement des données pour affichage
	*/
	protected function _prepareTpl(){

		//Récupération des paramètres
		if ($this->getParam('rub')) {
			$this->rub = $this->getParam('rub');
		}
		
		//Chargement des données
		jClasses::inc('annonce~annonceSrv');
		jClasses::inc('photo~photoSrv');
		jClasses::inc('commun~tools');

		//Liste des 3 dernères annonces selon les rubriques 
		$nbFalls = 3;
		$toAnnonceFemmes  	= array(); 
		$toAnnonceHommes  	= array(); 
		$toAnnonceCouples 	= array(); 
		
		//FEMMES
		$toResults  		= annonceSrv::getLastAnByRubrique(RENCONTRE_FEMMES, 3);		
		foreach ($toResults as $oResults){
					//la première photo
			$toPhoto = photoSrv::getAllPhoto($oResults->annonce_id);					
			if(sizeof($toPhoto)){
				$oResults->annonce_photo = $toPhoto[0]->photo_photo;
			}else{
				$oResults->annonce_photo = "noPhoto.jpg";
			}			
			//Parution
			$dt = strtotime($oResults->annonce_dateDebut);			
			$oResults->annonce_parution	=  floor((time() - $dt) / 60 / 60 /24);
			$oResults->annonce_resume 	= mb_strimwidth($oResults->annonce_resume, 0, 30, "...");			

			$oResults->annonce_reference 		= stripslashes($oResults->annonce_reference);
			$oResults->annonce_titre 			= stripslashes($oResults->annonce_titre);
			$oResults->annonce_resume 			= stripslashes($oResults->annonce_resume);
			$oResults->annonce_prixInfo 		= stripslashes($oResults->annonce_prixInfo);			
			$oResults->annonce_description 	= stripslashes($oResults->annonce_description);
			$oResults->annonce_contactNom 		= stripslashes($oResults->annonce_contactNom);
			$oResults->annonce_contactPrenom 	= stripslashes($oResults->annonce_contactPrenom);
			$oResults->annonce_contactEmail 	= stripslashes($oResults->annonce_contactEmail);
			$oResults->annonce_contactAdresse 	= stripslashes($oResults->annonce_contactAdresse);
			$oResults->annonce_photo 			= stripslashes($oResults->annonce_photo);
			$oResults->annonce_origine 		= stripslashes($oResults->annonce_origine);

			array_push( $toAnnonceFemmes, $oResults);
		}
		//HOMMES
		$toResults  		= annonceSrv::getLastAnByRubrique(RENCONTRE_HOMMES, 3);		
		foreach ($toResults as $oResults){
					//la première photo
			$toPhoto = photoSrv::getAllPhoto($oResults->annonce_id);					
			if(sizeof($toPhoto)){
				$oResults->annonce_photo = $toPhoto[0]->photo_photo;
			}else{
				$oResults->annonce_photo = "noPhoto.jpg";
			}			
			//Parution
			$dt = strtotime($oResults->annonce_dateDebut);			
			$oResults->annonce_parution	=  floor((time() - $dt) / 60 / 60 /24);
			$oResults->annonce_resume 	= mb_strimwidth($oResults->annonce_resume, 0, 30, "...");			

			$oResults->annonce_reference 		= stripslashes($oResults->annonce_reference);
			$oResults->annonce_titre 			= stripslashes($oResults->annonce_titre);
			$oResults->annonce_resume 			= stripslashes($oResults->annonce_resume);
			$oResults->annonce_prixInfo 		= stripslashes($oResults->annonce_prixInfo);			
			$oResults->annonce_description 	= stripslashes($oResults->annonce_description);
			$oResults->annonce_contactNom 		= stripslashes($oResults->annonce_contactNom);
			$oResults->annonce_contactPrenom 	= stripslashes($oResults->annonce_contactPrenom);
			$oResults->annonce_contactEmail 	= stripslashes($oResults->annonce_contactEmail);
			$oResults->annonce_contactAdresse 	= stripslashes($oResults->annonce_contactAdresse);
			$oResults->annonce_photo 			= stripslashes($oResults->annonce_photo);
			$oResults->annonce_origine 		= stripslashes($oResults->annonce_origine);

			array_push( $toAnnonceHommes, $oResults);
		}
		//COUPLES
		$toResults  		= annonceSrv::getLastAnByRubrique(RENCONTRE_COUPLES, 3);		
		foreach ($toResults as $oResults){
					//la première photo
			$toPhoto = photoSrv::getAllPhoto($oResults->annonce_id);					
			if(sizeof($toPhoto)){
				$oResults->annonce_photo = $toPhoto[0]->photo_photo;
			}else{
				$oResults->annonce_photo = "noPhoto.jpg";
			}			
			//Parution
			$dt = strtotime($oResults->annonce_dateDebut);			
			$oResults->annonce_parution	=  floor((time() - $dt) / 60 / 60 /24);
			$oResults->annonce_resume 	= mb_strimwidth($oResults->annonce_resume, 0, 30, "...");			

			$oResults->annonce_reference 		= stripslashes($oResults->annonce_reference);
			$oResults->annonce_titre 			= stripslashes($oResults->annonce_titre);
			$oResults->annonce_resume 			= stripslashes($oResults->annonce_resume);
			$oResults->annonce_prixInfo 		= stripslashes($oResults->annonce_prixInfo);			
			$oResults->annonce_description 	= stripslashes($oResults->annonce_description);
			$oResults->annonce_contactNom 		= stripslashes($oResults->annonce_contactNom);
			$oResults->annonce_contactPrenom 	= stripslashes($oResults->annonce_contactPrenom);
			$oResults->annonce_contactEmail 	= stripslashes($oResults->annonce_contactEmail);
			$oResults->annonce_contactAdresse 	= stripslashes($oResults->annonce_contactAdresse);
			$oResults->annonce_photo 			= stripslashes($oResults->annonce_photo);
			$oResults->annonce_origine 		= stripslashes($oResults->annonce_origine);

			array_push( $toAnnonceCouples, $oResults);
		}
					
		$this->_tpl->assign('toAnnonceFemmes', $toAnnonceFemmes);
		$this->_tpl->assign('toAnnonceHommes', $toAnnonceHommes);
		$this->_tpl->assign('toAnnonceCouples', $toAnnonceCouples);
	}
}
?>