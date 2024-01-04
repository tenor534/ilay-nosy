<?php
/**
* @package groupe3
* @subpackage commun
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Contrôleur BO pour les actions communes à l'ensemble du back office
* @package groupe3
* @subpackage commun
* @todo : définir les différentes actions du contrôleur
*/
class communBoCtrl extends jController {

	//Toutes les actions de ce contrôleur nécessite une authentification via le plugin jAuth
	public $pluginParams = array();


	/**
	* Action générique permettant d'appeller une zone sans passer par un controlleur en particulier
	*
	* Utile pour le recherchement de liste en AJAX (on a donc pas à créer une action pour chaque zone appellable en ajax)
	*/
	function getZone() {
        $rep = $this->getResponse('text');

		$zone = $this->param('zone');
		if (is_null($zone)) {
			throw new Exception('Paramètre zone requis');
		}
		$params = $GLOBALS['gJCoord']->request->params;


		$rep->content = jZone::get($zone, $params);

        return $rep;
	}



}
?>