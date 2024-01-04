<?php
/**
* @package     jelix
* @subpackage  jintrospection
* @author      Sylvain261
*/

class defaultCtrl extends jController {

    /**
    * Renvoie la liste des actions des contrôlleurs du projet au format JSON
    */
    function getAllActions() {

		$rep = $this->getResponse ('json') ;

		jClasses::inc('jintrospection~jintrospection');
		$rep->datas = jintrospection::getAllActions();

		return $rep;

	}

    /**
    * Génère une page contenant un formulaire par action
    */
    function index() {

		global $gJConfig;
		$rep = $this->getResponse('html', TRUE) ;

		$rep->title =  "Test unitaires des actions";
        $rep->bodyTpl = 'jintrospection~testActions';

		$rep->addJSCode("var j_basepath = '".$gJConfig->urlengine['basePath']."';");
		$rep->addJSLink($gJConfig->urlengine['basePath'].'design/commun/js/jquery.js');
		$rep->addJSLink($gJConfig->urlengine['basePath'].'design/commun/js/jquery.form.js');

		return $rep;

	}

}
?>
