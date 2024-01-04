<?php
/**
* @package ilay-nosy
* @subpackage commun
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Plugin de coordinateur assurant la connexion automatique de l'internaute lorsqu'il arrive sur le site
*
* @package agidis
* @subpackage commun
*/
class ConnexionAutoCoordPlugin implements jICoordPlugin {

	public $config;
	
	function __construct($conf){
        $this->config = $conf;
    }

    /**
	* Traitement ? effectuer avant l'ex?cution de l'action
	*
	* Si l'action n?cessite une session valide (authRequired = true)
	*
	*
	* @param    array  $params   Param?tres de plugin envoy?s par l'action en cours
	* @return null si OK ou jSelectorAct sinon
	*/
    public function beforeAction ($params) {
		if(isset($params['connexion.membre']) && $params['connexion.membre']){
		ddd
		echo "connexion";
			$sessionId = isset($_SESSION['SESSION_SITE_ID']) ? $_SESSION['SESSION_SITE_ID'] : SITE_PORTAIL;
			switch($sessionId){
				case SITE_PORTAIL:
					if(isset($_SESSION['SESSION_MEMBRE_ID']) && $_SESSION['SESSION_MEMBRE_ID']>0){
						$_SESSION['SESSION_SITE_ID']=SITE_MEMBRE;
					}else{
						return new JSelectorAct ("marque~default_accueil");
					}
				case SITE_CLUB:
					break;
				default:
					break;
			}
		}else{
			if(isset($_SESSION['SESSION_SITE_ID'])) {
				unset($_SESSION['SESSION_SITE_ID']);
			}
			
		}
	}

    public function beforeOutput(){
	}

    public function afterProcess (){
	}

}
?>