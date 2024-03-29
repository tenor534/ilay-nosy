<?php
/**
* @package     jelix
* @subpackage  core_url
* @author      Laurent Jouanneau
* @contributor
* @copyright   2005-2006 Laurent Jouanneau
* Some parts of this file are took from an experimental branch of the Copix project (CopixUrl.class.php, Copix 2.3dev20050901, http://www.copix.org),
* Some lines of code are still copyrighted 2001-2005 CopixTeam (LGPL licence).
* Initial authors of this parts are Gerald Croes and Laurent Jouanneau,
* and this parts were adapted/improved for Jelix by Laurent Jouanneau
* @link        http://www.jelix.org
* @licence     GNU Lesser General Public Licence see LICENCE file or http://www.gnu.org/licenses/lgpl.html
*/

/**
 * interface for url engines
 * @package  jelix
 * @subpackage core_url
 * @author      Laurent Jouanneau
 * @copyright   2005 CopixTeam, 2005-2006 Laurent Jouanneau
 */
interface jIUrlEngine {
  /**
    * Parse some url components
    * @param string $scriptNamePath    /path/index.php
    * @param string $pathinfo          the path info part of the url (part between script name and query)
    * @param array  $params            url parameters (query part e.g. $_REQUEST)
    * @return jUrlAction
    */
  public function parse($scriptNamePath, $pathinfo, $params );

  /**
   * Create a jurl object with the given action datas
   * @param jUrlAction $url  information about the action
   * @return jUrl the url correspondant to the action
   */
  public function create($urlact);

}
/**
 * base class for jUrl and jUrlAction
 * @package  jelix
 * @subpackage core_url
 * @author      Laurent Jouanneau
 * @copyright   2005-2006 Laurent Jouanneau
 */
abstract class jUrlBase {

    /**
     * parameters
     */
    public $params=array();

    /**
    * add or change the value of a parameter
    * @param    string    $name    parameter name
    * @param    string    $value   parameter value
    */
    public function setParam ($name, $value){
        $this->params[$name] = $value;
    }

    /**
    * delete a parameter
    * @param    string    $name    parameter name
    */
    public function delParam ($name){
        if (array_key_exists($name, $this->params))
            unset ($this->params[$name]);
    }

    /**
    * get a parameter value
    * @param string  $name    parameter name
    * @param string  $defaultValue   the default value returned if the parameter doesn't exists
    * @return string the value
    */
    public function getParam ($name, $defaultValue=null){
        return array_key_exists($name, $this->params)? $this->params[$name] :$defaultValue;
    }

    /**
    * Clear parameters
    */
    public function clearParam (){
        $this->params = array ();
    }


    /**
     * get the url string corresponding to the url/action
     * @param boolean $forxml  true: some characters will be escaped
     * @return string
     */
    abstract public function toString($forxml = false);


    /**
     * magic method for echo and others...
     */
    public function __toString(){
        return $this->toString();
    }


}

/**
 * A container to store url datas for an action
 * @package  jelix
 * @subpackage core_url
 * @author      Laurent Jouanneau
 * @copyright   2005-2006 Laurent Jouanneau
 */
class jUrlAction extends jUrlBase {

    /**
     * the request type
     * @var string
     */
    public $requestType='';

    /**
     * constructor...
     */
    function __construct ($params=array(),$request=''){
        $this->params=$params;
        $this->requestType=$request;
        if($this->requestType == ''){
            $this->requestType = $GLOBALS['gJCoord']->request->type;
        }
    }

    /**
     * get the url string corresponding to the action
     * @param boolean $forxml  true: some characters will be escaped
     * @return string
     */
    public function toString($forxml = false){
        return $this->toUrl()->toString($forxml);
    }

    /**
     * get the jUrl object corresponding to the action
     * @return jUrl
     */
    public function toUrl() {
        return jUrl::getEngine()->create($this);
    }
}


/**
 * Object that contains url datas, and which provides static method helpers
 * @package  jelix
 * @subpackage core_url
 * @author      Laurent Jouanneau (for the original code from Copix and enhancement for jelix)
 * @author      Gerald Croes (for the original code from Copix)
 * @copyright   2005 CopixTeam, 2005-2006 Laurent Jouanneau
 */
class jUrl extends jUrlBase {

     /**#@+
     * constant for get() method
     * @var integer
     */
    const STRING=0;
    const XMLSTRING=1;
    const JURL=2;
    const JURLACTION=3;
    /**#@-*/
    
    /**
    * script name including its path
    * @var string
    */
    public $scriptName;

    /**
    * path info part of the url
    * @var string
    */
    public $pathInfo = '';

    /**
    * constructor
    * @param    string    $scriptname    script name
    * @param    array    $params    parameters
    * @param    string    $pathInfo    path info contents
    */
    function __construct ($scriptname='', $params=array (), $pathInfo=''){
        $this->params      = $params;
        $this->scriptName  = $scriptname;
        $this->pathInfo    = $pathInfo;
    }


    /**
    * converts the url to a string
    * @param boolean $forxml  true: some characters will be escaped
    * @return string
    */
    public function toString ($forxml = false){
        $url = $this->scriptName.$this->pathInfo;
        if (count ($this->params)>0){
            $url .='?'.http_build_query($this->params, '', ($forxml?'&amp;':'&'));
        }
        return $url;
    }

    /**
    * construct query part of the url
    * @param boolean $forxml if the output must be HTML/XML compliant
    * @return string
    * @deprecated
    */
    public function collapseParams ($forxml = false) {
        return http_build_query($this->params, '', ($forxml?'&amp;':'&'));
    }

    //============================== static helper methods

    /**
    * get current Url
    * @param boolean $forxml if true, escape some characters to include the url into an html/xml document
    * @return string the url
    */
    static function getCurrentUrl ($forxml = false) {
        if(isset($_SERVER["REQUEST_URI"])){
           return $_SERVER["REQUEST_URI"];
        }
        static $url = false;
        if ($url === false){
           $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'].$GLOBALS['gJCoord']->request->url_path_info.'?';
           $url.= http_build_query($_GET, '', ($forxml?'&amp;':'&'));
        }
        return $url;
    }

    /**
    * Adds parameters to the given url
    * @param string $url  an URL
    * @param array $params some parameters to append to the url
    * @param boolean $forxml if true, escape some characters to include the url into an html/xml document
    * @return string the url
    */
    static function appendToUrlString ($url, $params = array (), $forxml = false){
        if ((($pos = strpos ( $url, '?')) !== false) && ($pos !== (strlen ($url)-1))){
            return $url . ($forxml ? '&amp;' : '&').http_build_query($params, '', ($forxml?'&amp;':'&'));
        }else{
            return $url . '?'.http_build_query($params, '', ($forxml?'&amp;':'&'));
        }
    }

    /**
    * Gets the url corresponding to an action, in the given format
    * @param string $actSel  action selector. You can use # instead of the module 
    *                or the action name, to specify the current url.
    * @param array $params associative array with the parameters
    * @param integer $what the format you want : one of the jUrl const,
    *                                     STRING XMLSTRING JURL JURLACTION
    * @return mixed a value, depending of the $what parameter
    */
    static function get ($actSel, $params = array (), $what=0) {

        $sel = new jSelectorAct($actSel,true);
        $params['module'] = $sel->module;
        $params['action'] = $sel->resource;
        $ua = new jUrlAction($params, $sel->request);

        if($what == 3) return $ua;

        $url = jUrl::getEngine()->create($ua);

        if($what == 2) return $url;

        return $url->toString($what != 0);
    }

    /**
     * Parse a url
     * @param string $scriptNamePath    /path/index.php
     * @param string $pathinfo          the path info of the url.
     * @param array  $params            url parameter ($_REQUEST)
     * @return jUrlAction
     */
    static function parse($scriptNamePath, $pathinfo, $params ){
         return jUrl::getEngine()->parse($scriptNamePath,$pathinfo, $params);
    }

    /**
    * gets the module/action parameters from the destination string.
    * @param string $dest the destination to parse
    * @return assocative array where keys are module and action
    * @deprecated
    */
    static function getAction ($actionSelector){
        $sel = new jSelectorAct($actionSelector,true);
        return array('module'=>$sel->module, 'action'=>$sel->resource, 'request'=>$sel->request);
    }


    /**
     * escape and simplier a string to be a part of an url path
     * remove or replace not allowed characters etc..
     * @param string $str the string to escape
     * @param boolean $highlevel false : just to a urlencode. true, replace some characters
     * @return string escaped string
     */
    static function escape($str, $highlevel=false){
        static $url_escape_from = null;
        static $url_escape_to = null;

        if($highlevel){
            if($url_escape_from == null){
                $url_escape_from = explode(' ',jLocale::get('jelix~format.url_escape_from'));
                $url_escape_to = explode(' ',jLocale::get('jelix~format.url_escape_to'));
            }
            // we don't use strtr because it is not utf8 compliant
            $str=str_replace($url_escape_from,$url_escape_to, $str); // supprime les caractères accentués, et les quotes, doubles quotes
            $str=preg_replace("/([^\w])/"," ",$str); // remplace tout ce qui n'est pas lettre par un espace
            //$str=preg_replace("/(?<=\s)\w{1,2}(?=\s)/"," ",$str); // enleve les mots de moins de 2 lettres
            $str=preg_replace("/( +)/","-",trim($str)); // on remplace les espaces et groupes d'espaces par -
            $str=strtolower($str); // on met en minuscule
            return $str;
        }else{
            return urlencode (str_replace (array ('-', ' '), array ('--','-'), $str));
        }
    }

    /**
     * perform the opposit of escape
     * @param string $str the string to escape
     * @return string
     */
    static function unescape($str){
        return strtr ($str, array ('--'=>'-', '-'=>' '));
    }

    /**
     * return the current url engine
     * @return jIUrlEngine
     * @internal call with true parameter, to force to re-instancy the engine. usefull for test suite
     */
    static function getEngine($reset=false){
        static $engine = null;

        if($reset) $engine=null; // pour pouvoir faire les tests unitaires

        if($engine === null){
            global $gJConfig;
            $name = $gJConfig->urlengine['engine'];
            if( !isset($gJConfig->_pluginsPathList_urls[$name])
                || !file_exists($gJConfig->_pluginsPathList_urls[$name]) ){
                    throw new jException('jelix~errors.urls.engine.notfound', $name);
            }
            require_once($gJConfig->_pluginsPathList_urls[$name].$name.'.urls.php');

            $cl=$name.'UrlEngine';
            $engine = new $cl();
        }
        return $engine;
    }

}

?>