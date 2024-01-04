<?php
/**
* @package    jelix
* @subpackage utils
* @author     Laurent Jouanneau
* @contributor
* @copyright  2006 Laurent Jouanneau
* @link       http://www.jelix.org
* @licence    GNU Lesser General Public Licence see LICENCE file or http://www.gnu.org/licenses/lgpl.html
*/

/**
 * utility class to log some message into a file into yourapp/var/log
 * @package    jelix
 * @subpackage utils
 * @static
 */
class jLog {

    private function __construct(){}

   /**
    * log a dump of a php value (object or else)
    * @param mixed $obj the value to dump
    * @param string $label a label
    * @param string $type the log type
    */
   public static function dump($obj, $label='', $type='default'){
      if($label!=''){
         $message = $label.': '.var_export($obj,true);
      }else{
         $message = var_export($obj,true);
      }
      self::log($message, $type);
   }

   /**
    * log a message
    * @param mixed $message
    * @param string $type the log type
    */
   public static function log($message, $type='default'){
      global $gJConfig;
      $f = $gJConfig->logfiles[$type];
      if(!isset($_SERVER['REMOTE_ADDR'])){ // for CLI mode (bug #111)
          $_SERVER['REMOTE_ADDR'] = '127.0.0.1';
      }
      $f = str_replace('%ip%', $_SERVER['REMOTE_ADDR'], $f);
      $sel = new jSelectorLog($f);

      $str = date ("Y-m-d H:i:s")."\t".$_SERVER['REMOTE_ADDR']."\t$type\t$message\n";
      error_log($str,3, $sel->getPath());
   }
}
?>