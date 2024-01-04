<?php
/**
* @package ilay-nosy
* @subpackage accueil
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Contrôleur BO pour la page d'accueil du back office
* @package ilay-nosy
* @subpackage accueil
*/
class AccueilBoCtrl extends jController {

	//Toutes les actions de ce contrôleur nécessite une authentification via le plugin jAuth
	public $pluginParams = array('*'=>array('auth.required'=>true));

	/**
    * Affichage du tableau de bord
	* 
    */
    function tableauDeBord() {

		global $gJConfig ;
        $rep = $this->getResponse('htmlBo');
		
		//js de module utilisateur
		$rep->addJSLink($gJConfig->urlengine['basePath'] . 'design/back/js/utilisateur.js');
			
		
		//Affichage
		$rep->menusActifs = array(HtmlBoResponse::MENU_TABLEAUDEBORD);
		$rep->bodyTpl = 'accueil~accueilBo';
		$rep->body->assignZone('listeAccueilBo', 'accueil~listeAccueilBo');
        
        return $rep;
    }

	/**
    * Affiche la page d'erreur
    */
    function afficheEreur() {  

   		global $gJConfig;
        $rep = $this->getResponse('htmlBo');
		
		
		//Affichage
		//$rep->menusActifs = array(HtmlBoResponse::MENU_ACCUEIL);
		$rep->bodyTpl = 'accueil~erreurBo';

		$rep->body->assign('erreurMessage', "xxxx");
        
        return $rep;
	}		

}
?>
