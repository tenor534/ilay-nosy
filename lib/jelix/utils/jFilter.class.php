<?php
/**
* @package     jelix
* @subpackage  utils
* @author      Laurent Jouanneau
* @contributor
* @copyright   2006-2007 Laurent Jouanneau
* @link        http://www.jelix.org
* @licence     http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public Licence, see LICENCE file
*/

/**
 * utility class to check values
 * @package     jelix
 * @subpackage  utils
 * @since 1.0b1
 */
class jFilter {

    private function _construct() {}

    static public function usePhpFilter(){
        return false;
    }

    /**
     * check if the given value is an integer
     * @param string $val the value
     * @param int $min minimum value (optional), null if no minimum
     * @param int $max maximum value (optional), null if no maximum
     * @return boolean true if it is valid
     */
    static public function isInt ($val, $min=null, $max=null){
        // @FIXME : trouver une solution plus performante ?
        if(!preg_match("/^\\-?\d+$/", $val)) return false;
        if($min !== null && intval($val) < $min) return false;
        if($max !== null && intval($val) > $max) return false;
        return true;
    }

    /**
     * check if the given value is an hexadecimal integer
     * @param string $val the value
     * @param int $min minimum value (optional), null if no minimum
     * @param int $max maximum value (optional), null if no maximum
     * @return boolean true if it is valid
     */
    static public function isHexInt ($val, $min=null, $max=null){
        // @FIXME : trouver une solution plus performante ?
        if(!preg_match("/^0x[a-f0-9A-F]+$/", $val)) return false;
        if($min !== null && intval($val,16) < $min) return false;
        if($max !== null && intval($val,16) > $max) return false;
        return true;
    }


     /**
     * check if the given value is a boolean
     * @param string $val the value
     * @return boolean true if it is valid
     */
    static public function isBool ($val){
        return in_array($val, array('true','false','1','0','TRUE', 'FALSE','on','off'));
    }


    /**
     * check if the given value is a float
     * @param string $val the value
     * @param int $min minimum value (optional), null if no minimum
     * @param int $max maximum value (optional), null if no maximum
     * @return boolean true if it is valid
     */
    static public function isFloat ($val, $min=null, $max=null){
        if(!is_numeric($val)) return false;
        if($min !== null && floatval($val) < $min) return false;
        if($max !== null && floatval($val) > $max) return false;
        return true;
    }

    /**
     * check if the given value is
     * @param string $url the url
     * @return boolean true if it is valid
     */

    static public function isUrl ($url, $schemeRequired=false,
                            $hostRequired=false, $pathRequired=false,
                            $queryRequired=false ){
        //$re = '/^(([a-z]):\/\/)?((([A-Z0-9][A-Z0-9_-]*)(\.[A-Z0-9][A-Z0-9_-]*)+)(:(\d+))?)?';
        //$re .= '((\/'
        //if (!preg_match('/^(([a-z]):\/\/)?((([A-Z0-9][A-Z0-9_-]*)(\.[A-Z0-9][A-Z0-9_-]*)+)(:(\d+))?)?\//i', $url, $m)) {

        // php filter use in fact parse_url, so we use the same function to have same result.
        // however, note that it doesn't validate all bad url...
        $res=@parse_url($url);
        if($res === false) return false;
        if($schemeRequired && $res['scheme'] == '') return false;
        if($hostRequired && $res['host'] == '') return false;
        if($pathRequired && $res['path'] == '') return false;
        if($queryRequired && $res['query'] == '') return false;
        return true;
    }

    /**
     * check if the given value is an IP version 4
     * @param string $val the value
     * @return boolean true if it is valid
     */
    static public function isIPv4 ($val){
        if(!preg_match('/^(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})$/',$val,$m)) return false;
        if(intval($m[1]) > 255) return false;
        if(intval($m[2]) > 255) return false;
        if(intval($m[3]) > 255) return false;
        if(intval($m[4]) > 255) return false;
        return true;
    }

    /**
     * check if the given value is an IP version 6
     * @param string $val the value
     * @return boolean true if it is valid
     */
    static public function isIPv6 ($val){
        return preg_match('/^([a-f0-9]{1,4})(:([a-f0-9]{1,4})){7}$/i',$val,$m);
    }

    /**
     * check if the given value is an email
     * @param string $val the value
     * @return boolean true if it is valid
     */
    static public function isEmail ($val){
        return preg_match('/^[A-Z0-9][A-Z0-9_\-]*(\.[A-Z0-9][A-Z0-9_\-]*)*@[A-Z0-9][A-Z0-9_\-]*(\.[A-Z0-9][A-Z0-9_\-]+)$/i',$val);
    }


}

?>
