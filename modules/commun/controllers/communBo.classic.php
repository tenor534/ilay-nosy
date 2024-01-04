<?php
/**
* @package groupe3
* @subpackage commun
* @version  1
* @author DWORD Consulting SARL
*/

/**
* Contr�leur BO pour les actions communes � l'ensemble du back office
* @package groupe3
* @subpackage commun
* @todo : d�finir les diff�rentes actions du contr�leur
*/
class communBoCtrl extends jController {

	//Toutes les actions de ce contr�leur n�cessite une authentification via le plugin jAuth
	public $pluginParams = array();


	/**
	* Action g�n�rique permettant d'appeller une zone sans passer par un controlleur en particulier
	*
	* Utile pour le recherchement de liste en AJAX (on a donc pas � cr�er une action pour chaque zone appellable en ajax)
	*/
	function getZone() {
        $rep = $this->getResponse('text');

		$zone = $this->param('zone');
		if (is_null($zone)) {
			throw new Exception('Param�tre zone requis');
		}
		$params = $GLOBALS['gJCoord']->request->params;


		$rep->content = jZone::get($zone, $params);

        return $rep;
	}



}
?>