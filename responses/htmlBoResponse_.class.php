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
class HtmlBoResponse extends jResponseHtml {

//	public $canAdmin = ($_SESSION['JELIX_USER']->profilId != 1)? 0 : 1;

	const MENU_ACTUALITE = 0;
	const MENU_ACTUALITE_LISTE = 0;
	
	const MENU_ABONNEMENT = 1;
	const MENU_ABONNEMENT_LISTE = 0;
	const MENU_ABONNEMENT_MEMBRE = 1;
	const MENU_ABONNEMENT_PACK = 2;
	const MENU_ABONNEMENT_FORFAIT = 3;

	const MENU_ANNONCE = 2;
	const MENU_ANNONCE_LISTE = 0;
	const MENU_ANNONCE_MEMBRE = 1;
	const MENU_ANNONCE_RUBRIQUE = 2;

	const MENU_PETITE_ANNONCE = 3;
	const MENU_PETITE_ANNONCE_LISTE = 0;

	const MENU_CULTURE = 4;
	const MENU_CULTURE_LISTE = 0;

	const MENU_FORUM = 5;
	const MENU_FORUM_LISTE = 0;

	const MENU_NEWSLETTER = 6;
	const MENU_NEWSLETTER_LISTE = 0;
	const MENU_NEWSLETTER_ENVOI = 1;

	const MENU_PRATIQUE = 7;
	const MENU_PRATIQUE_LISTE = 0;

	const MENU_PUBLICATION = 8;
	const MENU_PUBLICATION_LISTE = 0;

	const MENU_COMPTE = 9;
	const MENU_COMPTE_PROFIL = 0;
	const MENU_COMPTE_UTILISATEUR = 1;

	const MENU_CREDIT = 10;
	const MENU_CREDIT_LISTE = 0;
	const MENU_CREDIT_GENERATION = 1;

	const MENU_PARAMETRE = 11;
	const MENU_PARAMETRE_PAYS = 0;
	const MENU_PARAMETRE_CAT_ANNONCE = 1;
	const MENU_PARAMETRE_CAT_ACTUALITE = 2;
	const MENU_PARAMETRE_CAT_FORUM = 3;
	const MENU_PARAMETRE_MARQUE = 4;
	const MENU_PARAMETRE_MODELE = 5;


	/**
	* Menu actif
	*/
	public $menuActif;

	/**
	* Constructeur. On place ici les addJS/addCSS qui doivent être fait avant le traitement de l'action
	* @todo A implémenter
	*/
	public function __construct ($attributes = array()){ 
        parent::__construct($attributes);

		global $gJConfig;  

		$this->addJSCode("var j_basepath = '" . $gJConfig->urlengine['basePath'] . "';");

    	$this->addJSLink($gJConfig->urlengine['basePath'] . 'design/commun/js/jquery.js');
		$this->addJSLink($gJConfig->urlengine['basePath'] . 'design/commun/js/jquery.form.js');
		$this->addJSLink($gJConfig->urlengine['basePath'] . 'design/back/js/sortableListWithPagination.js');

		$this->addJSLink($gJConfig->urlengine['basePath'] . 'design/back/js/design_bo.js');
		$this->addCSSLink($gJConfig->urlengine['basePath'] . 'design/back/css/common.css');
		
		$this->addJSLink($gJConfig->urlengine['basePath'] . 'design/commun/js/tmtValidator.js');
		$this->addJSLink($gJConfig->urlengine['basePath'] . 'design/commun/js/jscrollable.js');
		
		$this->addCSSLink($gJConfig->urlengine['basePath'] . 'design/back/css/tmtValidator.css');
		$this->addCSSLink($gJConfig->urlengine['basePath'] . 'design/back/css/calendar-aiw.css');
		$this->addCSSLink($gJConfig->urlengine['basePath'] . 'design/back/css/calendar-win2k-cold-1.css');			
		
		$this->addJSLink($gJConfig->urlengine['basePath'] . 'design/back/js/calendar.js');
		$this->addJSLink($gJConfig->urlengine['basePath'] . 'design/back/js/jquery.tablesorter.js');
		$this->addJSLink($gJConfig->urlengine['basePath'] . 'design/back/js/jquery.multiselects.js');
		//$this->addJSLink($gJConfig->urlengine['basePath'] . 'design/back/js/calendar-fr.js');
		$this->addJSLink($gJConfig->urlengine['basePath'] . 'design/back/js/calendar-en.js');
		$this->addJSLink($gJConfig->urlengine['basePath'] . 'design/back/js/calendar-setup.js');
		$this->addJSLink($gJConfig->urlengine['basePath'] . 'design/back/js/library.all.js');
		$this->addJSLink($gJConfig->urlengine['basePath'] . 'design/back/js/201a.js');

		//Tris des listes
		$this->currentSortField = $GLOBALS['gJCoord']->request->getParam('sortField');
		$this->currentSortDirection = $GLOBALS['gJCoord']->request->getParam('sortDirection');

   } 

	/**
	* Traitements communs aux actions utilisant cette reponses
	* On place ici les addJS/addCSS qui doivent être fait aprés le traitement de l'action
	* @todo A implémenter
	*/
	protected function _commonProcess(){
		global $gJConfig;

		if (!isset($this->menusActifs)) {
			throw new Exception("Les menus actifs de la réponse HTML htmlBo doivent être définit");
		}
		if (!is_array($this->menusActifs)) {
			throw new Exception("Les menus actifs de la réponse HTML htmlBo doivent être un tableau");
		}

		//Header et footer
		$this->body->assignZone('header', 'commun~headerBo', array('menusActifs'=>$this->menusActifs));
		$this->body->assignZone('footer', 'commun~footerBo');
	}
}
?>