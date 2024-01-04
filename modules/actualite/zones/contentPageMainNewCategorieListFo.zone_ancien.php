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
* Zone affichant les actualites en cours dans l'espace membre pour un utilisateur connecté FO
*
* @package ilay-nosy
* @subpackage membre
*/
class contentPageMainNewCategorieListFoZone extends jZone {
 
	/**
	* Nom du template HTML
	*/
    protected $_tplname='actualite~contentPageMainNewCategorieListFo.zone';

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
		$tParams = array('zone'=> $this->getParam('zone','actualite~contentPageMainActualiteListFo'));
	
		//Chargement des données
		jClasses::inc('categorieAct~categorieActSrv');
		jClasses::inc('actualite~actualiteSrv');
		jClasses::inc('photoAct~photoActSrv');
		jClasses::inc('commun~tools');
		
		//Catégories
		$toCategorieActs = categorieActSrv::chargeAllCategorieAct();
		//Actualites
		$toActualite = actualiteSrv::chargeAllActualite();

		$toActualites = array();		
		foreach($toActualite as $oActualite){

			$oActualite->actualite_reference 	= stripslashes($oActualite->actualite_reference);
			$oActualite->actualite_titre 		= stripslashes($oActualite->actualite_titre);
			$oActualite->actualite_resume 		= stripslashes($oActualite->actualite_resume);
			$oActualite->actualite_texte 		= stripslashes($oActualite->actualite_texte);			
			$oActualite->actualite_photo 		= stripslashes($oActualite->actualite_photo);
			$oActualite->actualite_source 		= stripslashes($oActualite->actualite_source);
			$oActualite->actualite_fichier 		= stripslashes($oActualite->actualite_fichier);

			$oActualite->categorieAct_libelle 	= stripslashes($oActualite->categorieAct_libelle);
			$oActualite->categorieAct_code 		= stripslashes($oActualite->categorieAct_code);

			array_push($toActualites, $oActualite);		
		}		
		
		//Catégorie rondomize
		$toCategorieActRandoms 	= array();
		
		$i = 0;
		$j = 0;
		
		foreach ($toCategorieActs as $oCategorieActs){
			
			//Toutes les actualites
			$toActualite	= actualiteSrv::getRandActByCategorie($oCategorieActs->categorieAct_id);
			
			$toCategorieActRandoms[$oCategorieActs->categorieAct_id] = array();
			$toCategorieActRandoms[$oCategorieActs->categorieAct_id]["id"] 	= isset($toActualite[0]->actualite_id)?$toActualite[0]->actualite_id:0;
			$toCategorieActRandoms[$oCategorieActs->categorieAct_id]["titre"]	= isset($toActualite[0]->actualite_titre)?stripslashes($toActualite[0]->actualite_titre):"";			

			//Première photo
			if(isset($toActualite[0]->actualite_id) && $toActualite[0]->actualite_id){
				$toPhotos 		= photoActSrv::getAllPhoto($toActualite[0]->actualite_id);	
				//$toCategorieActRandoms[$oCategorieActs->categorieAct_id]["photo"]	= $toPhotos[0]->photo_photo;		
				$toCategorieActRandoms[$oCategorieActs->categorieAct_id]["photo"]	= $toActualite[0]->actualite_photo;		
			
			}else{
				$toCategorieActRandoms[$oCategorieActs->categorieAct_id]["photo"]	= "";			
			}
			
		}
		
		//Disposition des colonnes
		$nbColonnes = 3;
		
		$floor 		= floor(sizeof($toCategorieActs) / $nbColonnes);
		$mod 		= sizeof($toCategorieActs) % $nbColonnes;
		
		//
		$nbActCol1  = $floor + ($mod? 1 : 0);
		$nbActCol2  = $floor + ($mod? (($mod==2)? 1 : 0) : 0);
		$nbActCol3  = $floor;
		
		$posCat1 = 0;
		$posCat2 = $nbActCol1;
		$posCat3 = $nbActCol1 + $nbActCol2;
		$ind 	 = 0;
		
		$toCategorieActs1 = array();
		$toCategorieActs2 = array();
		$toCategorieActs3 = array();
		foreach ($toCategorieActs as $oCategorieActs){
			if($ind < $posCat2){
				array_push($toCategorieActs1, $oCategorieActs);
			}
			if(($ind >= $posCat2)&&($ind < $posCat3)){
				array_push($toCategorieActs2, $oCategorieActs);
			}
			if($ind >= $posCat3){
				array_push($toCategorieActs3, $oCategorieActs);
			}
		
			$ind ++;
		}
		
		/*
			echo "<br> nbActCol1 = $nbActCol1";
			echo "<br> nbActCol2 = $nbActCol2";
			echo "<br> nbActCol3 = $nbActCol3";		
			die();
		*/

		//NB d'actualite par catégorie
		$toCategorieActNBs	= categorieActSrv::chargeAllCategorieActNB();
		foreach ($toCategorieActNBs as $oCategorieActNBs){
			$toCategorieActNBs[$oCategorieActNBs->categorieAct_id] = $oCategorieActNBs->categorieAct_nbActualite;		
		}			
		
		$this->_tpl->assign('toCategorieActs', $toCategorieActs);
		$this->_tpl->assign('toCategorieActs1', $toCategorieActs1);
		$this->_tpl->assign('toCategorieActs2', $toCategorieActs2);
		$this->_tpl->assign('toCategorieActs3', $toCategorieActs3);
		$this->_tpl->assign('toCategorieActNBs', $toCategorieActNBs);
		$this->_tpl->assign('toCategorieActRandoms', $toCategorieActRandoms);		
		$this->_tpl->assign('toActualites', $toActualites);		
	}
}
?>