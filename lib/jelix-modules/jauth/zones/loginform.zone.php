<?php

/**
* @package    jelix-modules
* @subpackage jauth
* @author     Laurent Jouanneau
* @contributor Antoine Detante
* @copyright  2005-2006 Laurent Jouanneau, 2007 Antoine Detante
* @link       http://www.jelix.org
* @licence  http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public Licence, see LICENCE file
*/

class LoginFormZone extends jZone {
   protected $_tplname='login.form';

    protected function _prepareTpl(){

        $this->_tpl->assign ('login', $this->getParam('login'));
        $this->_tpl->assign ('failed',  $this->getParam('failed'));
		
		//Le service sélectionné
		/*
		$service = 0;
		if($this->getParam('service')){
			$service = $this->getParam('service');
		}
		if(isset($_GET['service'])){
			$service = $_GET['service'];
		}
		
		//Liste des services
		if($this->getParam('listeService')){
			
			$services 	= $this->getParam('listeService');
			$rs 		= $services['listeService'];
			
			$i = 0;
			$listeService = array();
			while ($i < sizeof($rs)){
				$rs_temp = array();
				$rs_temp['service_id'] 		= $rs[$i]->service_id;
				$rs_temp['service_libelle'] = $rs[$i]->service_libelle;
				$rs_temp['service_code'] 	= $rs[$i]->service_code;
				array_push($listeService, $rs_temp);
				$i++;
			}
			//print_r($listeService);
			//die();			
		}
		if(isset($_GET['listeService'])){
			$services = $_GET['listeService'];
			$listeService = $services['listeService'];
		}*/		
		
		/*
		*	auteur : Ramaroson Tahina
		*/
		$this->_tpl->assign ('auth_url_return',  $this->getParam('auth_url_return'));
        //$this->_tpl->assign ('service', $service);		
        //$this->_tpl->assign ('listeService', $listeService);
        $this->_tpl->assign ('user', jAuth::getUserSession());
        $this->_tpl->assign ('isLogged', jAuth::isConnected());
        $this->_tpl->assign ('showRememberMe', $this->getParam('showRememberMe'));
    }
}
?>
