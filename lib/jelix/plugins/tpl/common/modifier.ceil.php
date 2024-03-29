<?php
/**
 * Plugin from smarty project and adapted for jtpl
 * @package    jelix
 * @subpackage jtpl_plugin
 * @version    $Id$
 * @author      Monte Ohrt <monte at ohrt dot com>
 * @copyright  2001-2003 ispi of Lincoln, Inc.
 * @link http://smarty.php.net/
 * @link http://jelix.org/
 * @licence    GNU Lesser General Public Licence see LICENCE file or http://www.gnu.org/licenses/lgpl.html
 */

/**
 * modifier plugin : convert \r\n, \r or \n to <<br/>>
 * Example:  {$text|nl2br}
 * @param string
 * @return string
 */
function jtpl_modifier_common_count($_fNum)
{
	return ceil($_fNum);
}

?>
