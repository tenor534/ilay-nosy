<?php
/**
* @package ilay-nosy
* @subpackage officiel
* @version  1
* @author DWORD Consulting SARL
*/

/**
* JSON
*/
//require_once (LIB_PATH.'json/JSON.php');

/**
* Zone affichant le bloc officiel de droite en FO, toutes actualités confondues
*
* @package ilay-nosy
* @subpackage officiel
*/
class innerPageNewFoZone extends jZone {
 
    protected $_tplname='officiel~innerPageNewFo.zone';
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
		jClasses::inc('categorieOff~categorieOffSrv');
		jClasses::inc('officiel~officielSrv');
		jClasses::inc('photoOff~photoOffSrv');
		jClasses::inc('commun~tools');

		//Liste des actualités à la une 
		$toOfficiels  		= array(); 
		
		//OFFICIELS
		$toResults  		= officielSrv::getLastAct(10);		
		foreach ($toResults as $oResults){
			//la première photo
			$toPhoto = photoOffSrv::getAllPhoto($oResults->officiel_id);					
			if(sizeof($toPhoto)){
				//$oResults->officiel_photo = $toPhoto[0]->photo_photo;
			}else{
				//$oResults->officiel_photo = "noPhoto.jpg";
			}			
			
			$oResults->officiel_reference 	= stripslashes($oResults->officiel_reference);
			$oResults->officiel_titre 		= stripslashes($oResults->officiel_titre);
			$oResults->officiel_resume 	= mb_strimwidth(stripslashes($oResults->officiel_resume), 0, 300, "...");
			$oResults->officiel_texte 		= stripslashes($oResults->officiel_texte);			
			$oResults->officiel_photo 		= stripslashes($oResults->officiel_photo);
			$oResults->officiel_source 	= stripslashes($oResults->officiel_source);
			$oResults->officiel_fichier 	= stripslashes($oResults->officiel_fichier);

			//$oResults->officiel_datePublication = tools::formatToLongDateTime($oResults->officiel_datePublication, "-", 'fr', 'abrege');

			array_push( $toOfficiels, $oResults);
		}
		
		$this->_tpl->assign('toOfficiels', $toOfficiels);
	}
}
?>