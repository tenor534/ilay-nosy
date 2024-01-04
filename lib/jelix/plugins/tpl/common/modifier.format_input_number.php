<?php
/**
 * Plugin from smarty project and adapted for jtpl
 * @package    jelix
 * @subpackage jtpl_plugin
 * @author
 * @contributor Njaka MISAHARISON
 * @copyright  2007 Njaka MISAHARISON
 * @link http://gasyleiss.free.fr
 * @link http://gasyleiss.free.fr
 * @licence   GNU Lesser General Public Licence see LICENCE file or http://www.gnu.org/licenses/lgpl.html
 */

/**
 * modifier plugin :  Formate un nombre à n chiffres après virgule 
 *
 * Formate un nombre pour avoir n chiffres après virgule, avec un séparateur décimal et millier
 * @param number
 * @param integer
 * @param string
 * @param string
 * @return string
 */
function jtpl_modifier_common_format_input_number($price, $decimal=2,$sepDecimal= ".", $sepThousand= "")
{
    if ($price>0)
   		return number_format($price,$decimal,$sepDecimal,$sepThousand);
	return 0;
}
?>