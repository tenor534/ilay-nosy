<?php
/**
* @package AS
* @version  1
* @author DWORD Consulting SARL
* @subpackage commun
*/

/**
* Contr�leur pour les actions utilitaires non specifiques au projet
* @package expo
* @subpackage commun
*/
class UtilsCtrl extends jController {

	
	/**
    * supprime les compil�s dans temp
	*
	*/
    function cleartemp() {
   		$rep = $this->getResponse('text');
		jFile::removeDir(JELIX_APP_TEMP_PATH, false);
		return $rep;
     }

}
?>