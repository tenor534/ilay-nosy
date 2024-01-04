<?php
/**
* @package ilay-nosy
* @subpackage actualite
* @version  1
* @author DWORD Consulting SARL
*/

/**
* JSON
*/
//require_once (LIB_PATH.'json/JSON.php');

/**
* Zone affichant le bloc actualite "A la Une" de gauche en FO, triées par date de publication anti-chronologique 
*
* @package ilay-nosy
* @subpackage actualite
*/
class homePageNewFoZone extends jZone {
 
    protected $_tplname='actualite~homePageNewFo.zone';
	protected $_useCache = false;

	/**
	* Titre a afficher
	*/
	public $topTitre = "";	

	/**
	* Chargement des données pour affichage
	*/
	protected function _prepareTpl(){

		//Chargement des données
		jClasses::inc('categorieAct~categorieActSrv');
		jClasses::inc('actualite~actualiteSrv');
		jClasses::inc('photoAct~photoActSrv');
		jClasses::inc('commun~tools');

		//Liste des actualités à la une 
		$toActualites  		= array(); 
		$toCategorieActs  	= array(); 
		$tCategs  			= array(); 
		
		//CATEGORIES
		$toCategResults = categorieActSrv::chargeAllCategorieAct();
		foreach ($toCategResults as $oResults){
			$tCategs[$oResults->categorieAct_id] = 0;
		}
		
		//ACTUALITES
		$toResults  		= actualiteSrv::getTopActLaUNE(10);		
		foreach ($toResults as $oResults){
			//la première photo
			$toPhoto = photoActSrv::getAllPhoto($oResults->actualite_id);					
			if(sizeof($toPhoto)){
				//$oResults->actualite_photo = $toPhoto[0]->photo_photo;
			}else{
				//$oResults->actualite_photo = "noPhoto.jpg";
			}			
			
			$oResults->actualite_reference 	= stripslashes($oResults->actualite_reference);
			$oResults->actualite_titre 		= stripslashes($oResults->actualite_titre);
			$oResults->actualite_resume 	= mb_strimwidth(stripslashes($oResults->actualite_resume), 0, 300, "...");
			$oResults->actualite_texte 		= stripslashes($oResults->actualite_texte);			
			$oResults->actualite_photo 		= stripslashes($oResults->actualite_photo);
			$oResults->actualite_source 	= stripslashes($oResults->actualite_source);
			$oResults->actualite_fichier 	= stripslashes($oResults->actualite_fichier);

			$oResults->actualite_datePublication = tools::formatToLongDateTime($oResults->actualite_datePublication, "-", 'fr', 'abrege');

			//Inc nbAct per Categ
			$tCategs[$oResults->actualite_categorieActId]++;
			array_push( $toActualites, $oResults);
		}

		//CATEGORIES
		foreach ($toCategResults as $oResults){
			if($tCategs[$oResults->categorieAct_id] > 0){			
				array_push( $toCategorieActs, $oResults);
			}	
		}

		$this->_tpl->assign('toCategorieActs', $toCategorieActs);
		$this->_tpl->assign('toActualites', $toActualites);
	}
}
?>