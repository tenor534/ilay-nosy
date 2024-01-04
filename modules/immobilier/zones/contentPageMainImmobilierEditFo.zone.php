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
* Zone affichant les annonces en cours dans l'espace membre pour un utilisateur connecté FO
*
* @package ilay-nosy
* @subpackage membre
*/
class contentPageMainImmobilierEditFoZone extends jZone {
 
	/**
	* Nom du template HTML
	*/
    protected $_tplname='immobilier~contentPageMainImmobilierEditFo.zone';

	protected $_useCache = false;

	/**
	* Annonce a afficher
	*/
	public $anid = 0;

	/**
	* Chargement des données pour affichage
	*/
	protected function _prepareTpl(){

		//Session utilisateur
		$idUtilisateurId = $_SESSION['SESSION_MEMBRE_ID'];

		//Récupération des paramètres
		if ($this->getParam('anid')) {
			$this->anid = $this->getParam('anid');
		}	

		//Chargement des données
		jClasses::inc('immobilier~immobilierSrv');
		
		if ($this->anid != 0) {
			try {
				$immobilier = immobilierSrv::chargeImmobilier($this->anid);
				
			} catch(Exception $oJException) {
				//throw new JException ($oJException->getLocaleKey()) ;
				$immobilier = immobilierSrv::getDaoImmobilier();
			}				
		}else{
			$immobilier = immobilierSrv::getDaoImmobilier();

			$immobilier->immobilier_id 			= 0;			
			$immobilier->immobilier_annonceId 	= 0;
		}

		//$immobilier->immobilier_tailleMoteur = ($immobilier->immobilier_tailleMoteur)?floatval($immobilier->immobilier_tailleMoteur) : "";

		$tParams = array('anid'=> $this->anid);

		$this->_tpl->assign('tParams', $tParams);													
		$this->_tpl->assign('immobilier', $immobilier);													
	}
}
?>