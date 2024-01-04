 <?php
/**
* @package prospecteo
* @subpackage html_plugins
* @author DWORD Consulting SARL
*/

/**
 * function plugin :  FCKeditor
 *
 * example : {fckeditor 'zDesc', 'Basic', '100%', 200, 'contenu'}
 * @param string $tpl nom du template
 * @param string $instanceName nom de l'instance de l'editeur
 * @param string $toolbar nom de la barre d'outils à utiliser
 * @param int $Width longueur de l'editeur
 * @param int $Height largeur de l'editeur
 * @param string $contenu contenu de l'editeur
 */

  require_once (JELIX_APP_WWW_PATH.'FCKeditor/fckeditor.php');
 
  function jtpl_function_html_fckeditor($tpl, $instanceName, $toolbar, $Width, $Height, $contenu=NULL) {
	GLOBAL $gJConfig;
	$oFCKeditor = new FCKeditor($instanceName);
	$oFCKeditor->BasePath = $gJConfig->urlengine['basePath'].'FCKeditor/';//
	$oFCKeditor->ToolbarSet	= $toolbar;
	$oFCKeditor->Config = array('LinkBrowserURL'=>$oFCKeditor->BasePath . "editor/filemanager/browser/default/browser.html?externe=no&champs=&ServerPath=" .  $gJConfig->urlengine['basePath'] . 'medias/' . "&CurrentFolder=/&Type=&Connector=connectors/php/connector.php",
		'ImageBrowserURL'=>$oFCKeditor->BasePath . "editor/filemanager/browser/default/browser.html?externe=no&champs=&ServerPath=" . $gJConfig->urlengine['basePath'] . 'medias/' . "&CurrentFolder=/&Type=&Connector=connectors/php/connector.php");
	$oFCKeditor->Value = $contenu;
	
	echo $oFCKeditor->CreateHtml($instanceName, $Width, $Height);
  }
  ?>
