<?php
/**
* @package     jelix
* @subpackage  acl
* @author      Laurent Jouanneau
* @copyright   2006-2007 Laurent Jouanneau
* @link        http://www.jelix.org
* @licence     http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public Licence, see LICENCE file
* @since 1.0a3
*/

/**
 * interface for jAcl drivers
 * @package jelix
 * @subpackage acl
 */
interface jIAclDriver {

    /**
     * return the possible values of the right on the given subject (and on the optional resource)
     * @param string $subject the key of the subject
     * @param string $resource the id of a resource
     * @return array list of values corresponding to the right
     */
    public function getRight($subject, $resource=null);

    /**
     * clear some cached datas, it a cache exists in the driver..
     */
    public function clearCache();

}

/**
 * Main class to query the acl system, and to know value of a right
 *
 * you should call this class (all method are static) when you want to know if
 * the current user have a right
 * @package jelix
 * @subpackage acl
 * @static
 */
class jAcl {

    /**
     * @internal The constructor is private, because all methods are static
     */
    private function __construct (){ }

    /**
     * load the acl driver
     * @return jIAclDriver
     */
    protected static function _getDriver(){
        static $driver = null;
        if($driver == null){
            global $gJConfig;
            $db = strtolower($gJConfig->acl['driver']);
            if(!isset($gJConfig->_pluginsPathList_acl) 
                || !isset($gJConfig->_pluginsPathList_acl[$db])
                || !file_exists($gJConfig->_pluginsPathList_acl[$db]) ){
                 throw new jException('jelix~errors.acl.driver.notfound',$db);
            }
            require_once($gJConfig->_pluginsPathList_acl[$db].$db.'.acl.php');
            $dname = $gJConfig->acl['driver'].'AclDriver';
            $driver = new $dname($gJConfig->acl);
        }
        return $driver;
    }


    /**
     * call this method to know if the current user has the right with the given value
     * @param string $subject the key of the subject to check
     * @param string $value the value to test against
     * @param string $resource the id of a resource
     * @return boolean true if yes
     */
    public static function check($subject, $value=true, $resource=null){
        $val = self::getRight($subject, $resource);
        return in_array($value,$val);
    }
        


    /**
     * return the value of the right on the given subject (and on the optional resource)
     * @param string $subject the key of the subject
     * @param string $resource the id of a resource
     * @return array list of values corresponding to the right
     */
    public static function getRight($subject, $resource=null){
        $dr = self::_getDriver();
        return $dr->getRight($subject, $resource);
    }

    /**
     * clear right cache
     * @since 1.0b2
     */
    public static function clearCache(){
        $dr = self::_getDriver();
        $dr->clearCache();
    }
}

?>