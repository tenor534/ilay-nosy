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
* Zone affichant les abonnements en cours dans l'espace membre pour un utilisateur connecté FO
*
* @package ilay-nosy
* @subpackage membre
*/
class contentPageMainAbonnementEditFoZone extends jZone {
 
    protected $_tplname='abonnement~contentPageMainAbonnementEditFo.zone';
	protected $_useCache = false;

	/**
	* Chargement des données pour affichage
	*/
	protected function _prepareTpl(){
	
		//Classes		
		jClasses::inc('pack~packSrv');
		jClasses::inc('forfait~forfaitSrv');
		jClasses::inc('abonnement~abonnementSrv');

		//Session utilisateur
		$idUtilisateurId = $_SESSION['SESSION_MEMBRE_ID'];

		//Les paramètres
		$this->pack_id 			= $this->intParam('pid', 0);
		$this->forfait_id 		= $this->intParam('fid', 0);
		$this->abonnement_id 	= $this->intParam('aid', 0);
		
		//Edite des abonnement avec le type de forfait correspondant		
		$toPack 		= packSrv::chargePack($this->pack_id);
		$toForfait 		= forfaitSrv::chargeForfait($this->forfait_id);
		$toAbonnement 	= abonnementSrv::chargeAbonnement($this->abonnement_id);

		//Forfaits pour le pack en cours
		$toForfaits 		= forfaitSrv::getAllForfait($this->pack_id);

		//Type de template forfait à utiliser
		$iType 		= 0;
		$zUseCss 	= "";
		switch ($this->pack_id){
			case PACK_VEHICULES:
				$iType = 1;
				$zUseCss 	= "bloc_forfait_vehicule_split";
				break;
			case PACK_IMMOBILIERS:
				$iType = 1;
				$zUseCss 	= "bloc_forfait_immobilier_split";
				break;
			case PACK_EMPLOIS:
				$iType = 1;
				$zUseCss 	= "bloc_forfait_emploi_split";
				break;
			case PACK_VISITEURS:
				$iType = 2;
				$zUseCss 	= "bloc_forfait_visiteur_split";
				break;
			case PACK_ANNONCES:
				$iType = 3;
				$zUseCss 	= "bloc_forfait_autres";
				break;
		}
		
		$this->_tpl->assign('toPack', $toPack);
		$this->_tpl->assign('toForfait', $toForfait);
		$this->_tpl->assign('toAbonnement', $toAbonnement);
		$this->_tpl->assign('toForfaits', $toForfaits);

		$this->_tpl->assign('iType', $iType);
		$this->_tpl->assign('zUseCss', $zUseCss);
	}
}
?>