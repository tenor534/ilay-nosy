<?php
/**
* @package ilay-nosy
* @subpackage element
* @version  1
* @author NEOV
*/

/**
* envoi mail
* @package ilay-nosy
* @subpackage element
*/
class envoiMailFoZone extends jZone {
 
	protected $_tplname='contact~envoiMailFo';

	public function __construct($params=array()){
		parent::__construct($params);
   }


	protected function _prepareTpl(){
	}
}
?>