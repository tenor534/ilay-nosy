<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty plugin
 *
 * Type:     modifier<br>
 * Name:     nl2brpuce<br>
 * Date:      2007
 * Purpose:  convert \r\n, \r or \n to <<br>> and a bullet
 * Input:<br>
 *         - contents = contents to replace
 *         - preceed_test = if true, includes preceeding break tags
 *           in replacement
 * Example:  {$text|nl2brpuce}
 *
 * @version  1.0
 * @author   Jak
 * @param string
 * @return string
 */
function  jtpl_modifier_common_nl2brpuce($string)
{
	$chaine = "";
	if($string!=""){
		$tab = explode("\r\n", $string);
		for($i=0 ; $i<sizeof($tab) ; $i++){
			$chaine .= "<li>".$tab[$i]."</li>";
		}
	}
    return ($chaine);
}

/* vim: set expandtab: */

?>
