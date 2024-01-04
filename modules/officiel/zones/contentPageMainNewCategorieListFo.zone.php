<?php
/**
* @package ilay-nosy
* @subpackage membre
* @version  1
* @author DWORD Consulting SARL
*/

/**
* JSON
*/
//require_once (LIB_PATH.'json/JSON.php');


/**
* Zone affichant les officiels en cours dans l'espace membre pour un utilisateur connecté FO
*
* @package ilay-nosy
* @subpackage membre
*/
class contentPageMainNewCategorieListFoZone extends jZone {
 
	/**
	* Nom du template HTML
	*/
    protected $_tplname='officiel~contentPageMainNewCategorieListFo.zone';

	protected $_useCache = false;

	/**
	* Chargement des données pour affichage
	*/
	protected function _prepareTpl(){

		//Session utilisateur
		//$idUtilisateurId = $_SESSION['SESSION_MEMBRE_ID'];
		if (isset($_SESSION['SESSION_MEMBRE_ID'])) {
			$idUtilisateurId = $_SESSION['SESSION_MEMBRE_ID'];
		}else{
			$idUtilisateurId = 0;		
		}

		//Récupération des paramètres
		$tParams = array('zone'=> $this->getParam('zone','officiel~contentPageMainOfficielListFo'));
	
		//Chargement des données
		jClasses::inc('categorieOff~categorieOffSrv');
		jClasses::inc('officiel~officielSrv');
		jClasses::inc('photoOff~photoOffSrv');
		jClasses::inc('commun~tools');
		
		//Catégories
		$toCategorieOffs = categorieOffSrv::chargeAllCategorieOff();
		//Officiels
		$toOfficiel = officielSrv::chargeAllOfficiel();

		$toOfficiels = array();		
		foreach($toOfficiel as $oOfficiel){

			$oOfficiel->officiel_reference 	= stripslashes($oOfficiel->officiel_reference);
			$oOfficiel->officiel_titre 		= stripslashes($oOfficiel->officiel_titre);
			$oOfficiel->officiel_resume 		= stripslashes($oOfficiel->officiel_resume);
			$oOfficiel->officiel_texte 		= stripslashes($oOfficiel->officiel_texte);			
			$oOfficiel->officiel_photo 		= stripslashes($oOfficiel->officiel_photo);
			$oOfficiel->officiel_source 		= stripslashes($oOfficiel->officiel_source);
			$oOfficiel->officiel_fichier 		= stripslashes($oOfficiel->officiel_fichier);

			array_push($toOfficiels, $oOfficiel);		
		}		
		
		//Catégorie rondomize
		$toCategorieOffRandoms 	= array();
		
		$i = 0;
		$j = 0;
		
		foreach ($toCategorieOffs as $oCategorieOffs){
			
			//Toutes les officiels
			$toOfficiel	= officielSrv::getRandActByCategorie($oCategorieOffs->categorieOff_id);
			
			$toCategorieOffRandoms[$oCategorieOffs->categorieOff_id] = array();
			$toCategorieOffRandoms[$oCategorieOffs->categorieOff_id]["id"] 	= isset($toOfficiel[0]->officiel_id)?$toOfficiel[0]->officiel_id:0;
			$toCategorieOffRandoms[$oCategorieOffs->categorieOff_id]["titre"]	= isset($toOfficiel[0]->officiel_titre)?stripslashes($toOfficiel[0]->officiel_titre):"";			

			//Première photo
			if(isset($toOfficiel[0]->officiel_id) && $toOfficiel[0]->officiel_id){
				$toPhotos 		= photoOffSrv::getAllPhoto($toOfficiel[0]->officiel_id);	
				//$toCategorieOffRandoms[$oCategorieOffs->categorieOff_id]["photo"]	= $toPhotos[0]->photo_photo;		
				$toCategorieOffRandoms[$oCategorieOffs->categorieOff_id]["photo"]	= $toOfficiel[0]->officiel_photo;		
			
			}else{
				$toCategorieOffRandoms[$oCategorieOffs->categorieOff_id]["photo"]	= "";			
			}
			
		}
		
		//Disposition des colonnes
		$nbColonnes = 3;
		
		$floor 		= floor(sizeof($toCategorieOffs) / $nbColonnes);
		$mod 		= sizeof($toCategorieOffs) % $nbColonnes;
		
		//
		$nbActCol1  = $floor + ($mod? 1 : 0);
		$nbActCol2  = $floor + ($mod? (($mod==2)? 1 : 0) : 0);
		$nbActCol3  = $floor;
		
		$posCat1 = 0;
		$posCat2 = $nbActCol1;
		$posCat3 = $nbActCol1 + $nbActCol2;
		$ind 	 = 0;
		
		$toCategorieOffs1 = array();
		$toCategorieOffs2 = array();
		$toCategorieOffs3 = array();
		foreach ($toCategorieOffs as $oCategorieOffs){
			if($ind < $posCat2){
				array_push($toCategorieOffs1, $oCategorieOffs);
			}
			if(($ind >= $posCat2)&&($ind < $posCat3)){
				array_push($toCategorieOffs2, $oCategorieOffs);
			}
			if($ind >= $posCat3){
				array_push($toCategorieOffs3, $oCategorieOffs);
			}
		
			$ind ++;
		}
		
		/*
			echo "<br> nbActCol1 = $nbActCol1";
			echo "<br> nbActCol2 = $nbActCol2";
			echo "<br> nbActCol3 = $nbActCol3";		
			die();
		*/

		//NB d'officiel par catégorie
		$toCategorieOffNBs	= categorieOffSrv::chargeAllCategorieOffNB();
		foreach ($toCategorieOffNBs as $oCategorieOffNBs){
			$toCategorieOffNBs[$oCategorieOffNBs->categorieOff_id] = $oCategorieOffNBs->categorieOff_nbOfficiel;		
		}			
		
		$this->_tpl->assign('toCategorieOffs', $toCategorieOffs);
		$this->_tpl->assign('toCategorieOffs1', $toCategorieOffs1);
		$this->_tpl->assign('toCategorieOffs2', $toCategorieOffs2);
		$this->_tpl->assign('toCategorieOffs3', $toCategorieOffs3);
		$this->_tpl->assign('toCategorieOffNBs', $toCategorieOffNBs);
		$this->_tpl->assign('toCategorieOffRandoms', $toCategorieOffRandoms);		
		$this->_tpl->assign('toOfficiels', $toOfficiels);		
	}
}
?>