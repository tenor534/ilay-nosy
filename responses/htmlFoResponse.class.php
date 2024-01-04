<?php
/**
* @package ilay-nosy
* @subpackage commun
* @version  1
* @author DWORD Consulting SARL
*/

/**
 * Classe jResponseHtml
 */
require_once (JELIX_LIB_RESPONSE_PATH . 'jResponseHtml.class.php');

/**
* Reponse commune surchargeant les réponses HTML standard 
* Comprant les traitement communs à toutes les pages du BO
* @package ilay-nosy
* @subpackage responses
*/
class HtmlFoResponse extends jResponseHtml {
	
	/**
	* Menu actif
	*/
	var $menuActif;

	/**
	* Constructeur. On place ici les addJS/addCSS qui doivent être fait avant le traitement de l'action
	* @todo A implémenter
	*/
	public function __construct ($attributes = array()){ 
        parent::__construct($attributes);

		global $gJConfig;

		//Définition du basePath
		$this->addJSCode("var j_basepath = '" . $gJConfig->urlengine['basePath'] . "';");
		
		$this->title 	= "Madagascar - ilay nosy, site portail d'informations, d'annonces et de publicités de Madagascar";
		$this->favicon 	= "images/fav/ilay-nosy.ico";

		$this->addMetaKeywords("madagascar, malagasy, portail, information, annonces, publicité, photo, reportages");
		$this->addMetaDescription("Site portail pour visualiser Madagascar virtuellement à travers les différentes informations");

		$this->addHeadContent("\t");
		$this->addHeadContent('<meta name="generator" content="TYPO3 4.1 CMS">');
		$this->addHeadContent('<meta name="reply-to" content="contact@ilay-nosy.com">');
		$this->addHeadContent('<meta name="robots" content="all">');
		$this->addHeadContent('<meta name="distribution" content="global">');
		$this->addHeadContent('<meta name="revisit-after" content="10 days">');
		$this->addHeadContent('<meta name="author" lang="fr" content="ilay-nosy.com">');
		$this->addHeadContent('<meta name="copyright" content="ilay-nosy.com">');
		$this->addHeadContent("\n");
		
		//Ajoute les fichiers js
		$this->addJSLink($gJConfig->urlengine['basePath'] . 'design/commun/js/jquery.js');
		$this->addJSLink($gJConfig->urlengine['basePath'] . 'design/commun/js/jquery.form.js');
		$this->addJSLink($gJConfig->urlengine['basePath'] . 'design/commun/js/tmtValidator.js');
		$this->addJSLink($gJConfig->urlengine['basePath'] . 'design/front/js/designFo.js');

		$this->addJSLink($gJConfig->urlengine['basePath'] .'design/front/js/sortableListWithPagination.js');							
		$this->addJSLink($gJConfig->urlengine['basePath'] .'design/commun/js/jscrollable.js');							
		$this->addJSLink($gJConfig->urlengine['basePath'] .'design/front/js/jquery.tablesorter.js');							
		$this->addJSLink($gJConfig->urlengine['basePath'] .'design/front/js/jquery.multiselects.js');							
		$this->addJSLink($gJConfig->urlengine['basePath'] .'design/front/js/library.all.js');							


		//Ajoute les fichiers css
		$this->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosy.css');
		$this->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyCommon.css');
		$this->addCSSLink($gJConfig->urlengine['basePath'] . 'design/front/css/nosyEdit.css');
		$this->addCSSLink($gJConfig->urlengine['basePath'] . 'design/commun/css/tmtValidator.css');
		
		//$siteId = (isset($_SESSION['SESSION_SITE_ID']))?$_SESSION['SESSION_SITE_ID']:SITE_PORTAIL;
		$this->setXhtmlOutput(false);		
   } 

	/**
	* Traitements communs aux actions utilisant cette reponses
	* On place ici les addJS/addCSS qui doivent être fait aprés le traitement de l'action
	* @todo A implémenter
	*/
	protected function _commonProcess(){
		global $gJConfig;

		//Affiche les zones communs pour toutes les pages du site		
		
		$this->body->assignZone('logo', 'commun~logoFo');
		$this->body->assignZone('mastAdvert', 'commun~mastAdvertFo');
		$this->body->assignZone('logInWrap', 'commun~logInWrapFo');
		$this->body->assignZone('underConstWrap', 'commun~underConstFo');
		$this->body->assignZone('searchNav', 'commun~searchNavFo');
		$this->body->assignZone('mainNavWrap', 'commun~mainNavWrapFo');
		$this->body->assignZone('bootFoot', 'commun~bootFootFo');	
		$this->body->assignZone('underConstFoot', 'commun~underConstFootFo');	
		
		//Chargement des données
		jClasses::inc('visite~visiteSrv');
		
		$visite = visiteSrv::getDaoVisite();

		if (isset($_SESSION['SESSION_MEMBRE_ID'])) {
			$idUtilisateurId = $_SESSION['SESSION_MEMBRE_ID'];
		}else{
			$idUtilisateurId = 0;		
		}
		
		$visite->id 			= 0;
		$visite->serverSoftware = $_SERVER["SERVER_SOFTWARE"];
		$visite->serverName 	= $_SERVER["SERVER_NAME"];
		$visite->serverAddr 	= $_SERVER["SERVER_ADDR"];
		$visite->serverPort 	= $_SERVER["SERVER_PORT"];
		$visite->remoteAddr 	= $_SERVER["REMOTE_ADDR"];
		$visite->remotePort 	= $_SERVER["REMOTE_PORT"];
		$visite->httpRefferer 	= "";
		$visite->httpUserAgent 	= $_SERVER["HTTP_USER_AGENT"];
		$visite->requestMethod 	= $_SERVER["REQUEST_METHOD"];
		$visite->requestUri 	= $_SERVER["REQUEST_URI"];
		$visite->phpSelf 		= $_SERVER["PHP_SELF"];
		$visite->queryString 	= $_SERVER["QUERY_STRING"];
		$visite->date 			= date("Y-m-d H:i:s");
		$visite->userId			= $idUtilisateurId;
		
		
		//$visiteId = visiteSrv::sauvegardeVisite($visite);
			
	}
}
?>