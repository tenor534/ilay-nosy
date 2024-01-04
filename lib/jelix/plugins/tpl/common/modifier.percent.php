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
 * modifier plugin :  Formate un nombre à n chiffres pour affichage en pourcentage  (%)
 *
 * Formate un nombre pour un affichage en pour affichage en pourcentage
 * @param number
 * @param integer
 * @param string
 * @param string
 * @return string
 */
function jtpl_modifier_common_percent($number, $decimal=2,$sepDecimal= ",", $sepThousand= " ",$unit= '%')
{
    if ($number)
   		return number_format($number*100,$decimal,$sepDecimal,$sepThousand)." ".$unit;
	return "0".$sepDecimal."00 ".$unit;
}
?>