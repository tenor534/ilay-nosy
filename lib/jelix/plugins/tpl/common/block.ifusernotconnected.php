<?php
/**
* @package    jelix
* @subpackage jtpl_plugin
* @author     Jouanneau Laurent
* @copyright   2006 Jouanneau laurent
* @link        http://www.jelix.org
* @licence    GNU Lesser General Public Licence see LICENCE file or http://www.gnu.org/licenses/lgpl.html
*/

/**
 * a special if block to test easily if the current user is not connected
 *
 * <pre>{ifusernotconnected} ..here generated content if the user is NOTconnected  {/ifusernotconnected}</pre>
 * @param jTplCompiler $compiler the template compiler
 * @param boolean true if it is the begin of block, else false
 * @param array $params no parameters. array should be empty
 * @return string the php code corresponding to the begin or end of the block
 */
function jtpl_block_common_ifusernotconnected($compiler, $begin, $params=array())
{
    if($begin){
        if(count($params)){
            $content='';
            $compiler->doError1('errors.tplplugin.block.too.many.arguments','ifuserconnected');
        }else{
            $content = ' if(!jAuth::isConnected()){';
        }
    }else{
        $content = ' } ';
    }
    return $content;
}

?>