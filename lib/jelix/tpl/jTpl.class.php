<?php
/**
* @package     jelix
* @subpackage  jtpl
* @author      Laurent Jouanneau
* @contributor
* @copyright   2005-2006 Laurent Jouanneau
* @link        http://www.jelix.org
* @licence     GNU Lesser General Public Licence see LICENCE file or http://www.gnu.org/licenses/lgpl.html
*/

/**
 * template engine
 * @package     jelix
 * @subpackage  jtpl
 */
class jTpl {

    /**
     * all assigned template variables. Public because Internal use. Don't touch it :-)
     * See methods of jTpl to manage template variables
     * @var array
     */
    public $_vars = array ();

    /**
     * temporary template variables for plugins. Public because Internal use. Don't touch it :-)
     * @var array
     */
    public $_privateVars = array ();


    /**
     * internal use
     * @var array
     */
    public $_meta = array();

    public function __construct(){
        global $gJConfig;
        $this->_vars['j_basepath'] = $gJConfig->urlengine['basePath'];
        $this->_vars['j_jelixwww'] = $gJConfig->urlengine['jelixWWWPath'];
        $this->_vars['j_datenow'] = date('Y-m-d');
        $this->_vars['j_timenow'] = date('H:i:s');
		//NJ - 2007 10 04 : pour gestion de la langue (locale)
        $this->_vars['j_localCode'] = $gJConfig->locale;
    }

    /**
     * assign a value in a template variable
     * @param string|array $name the variable name, or an associative array 'name'=>'value'
     * @param mixed  $value the value (or null if $name is an array)
     */
    public function assign ($name, $value = null){
        if(is_array($name)){
           foreach ($name as $key => $val) {
               $this->_vars[$key] = $val;
           }
        }else{
            $this->_vars[$name] = $value;
        }
    }

    /**
     * concat a value in with a value of an existing template variable
     * @param string|array $name the variable name, or an associative array 'name'=>'value'
     * @param mixed  $value the value (or null if $name is an array)
     */
    public function append ($name, $value = null){
        if(is_array($name)){
           foreach ($name as $key => $val) {
               if(isset($this->_vars[$key]))
                  $this->_vars[$key] .= $val;
               else
                  $this->_vars[$key] = $val;
           }
        }else{
            if(isset($this->_vars[$name]))
               $this->_vars[$name] .= $value;
            else
               $this->_vars[$name] = $value;
        }
    }

    /**
     * assign a value in a template variable, only if the template variable doesn't exist
     * @param string|array $name the variable name, or an associative array 'name'=>'value'
     * @param mixed  $value the value (or null if $name is an array)
     */
    public function assignIfNone ($name, $value = null){
        if(is_array($name)){
           foreach ($name as $key => $val) {
               if(!isset($this->_vars[$key]))
                  $this->_vars[$key] = $val;
           }
        }else{
            if(!isset($this->_vars[$name]))
               $this->_vars[$name] = $value;
        }
    }


    /**
     * assign a zone content to a template variable
     * @param string $name the variable name
     * @param string $zoneName  a zone selector
     * @param array  $params  parameters for the zone
     * @see jZone
     */
    function assignZone($name, $zoneName, $params=array()){
        $this->_vars[$name] = jZone::get ($zoneName, $params);
    }
    /**
     * assign a zone content to a template variable only if this variable doesn't exist
     * @param string $name the variable name
     * @param string $zoneName  a zone selector
     * @param array  $params  parameters for the zone
     * @see jZone
     */
    function assignZoneIfNone($name, $zoneName, $params=array()){
        if(!isset($this->_vars[$name]))
            $this->_vars[$name] = jZone::get ($zoneName, $params);
    }

    /**
     * says if a template variable exists
     * @param string $name the variable template name
     * @return boolean true if the variable exists
     */
    public function isAssigned ($name){
        return isset ($this->_vars[$name]);
    }

    /**
     * return the value of a template variable
     * @param string $name the variable template name
     * @return mixed the value (or null if it isn't exist)
     */
    public function get ($name){
        if (isset ($this->_vars[$name])){
            return $this->_vars[$name];
        }else{
            $return = null;
            return $return;
        }
    }

    /**
     * Return all template variables
     * @return array
     */
    public function getTemplateVars (){
        return $this->_vars;
    }

    /**
     * process all meta instruction of a template
     * @param string $tpl template selector
     * @param string $outputtype the type of output (html, text etc..)
     * @param boolean $trusted  says if the template file is trusted or not
     */
    public function meta($tpl, $outputtype='', $trusted = true){
        $this->getTemplate($tpl,'template_meta_', $outputtype, $trusted);
    }

    /**
     * display the generated content from the given template
     * @param string $tpl template selector
     * @param string $outputtype the type of output (html, text etc..)
     * @param boolean $trusted  says if the template file is trusted or not
     */
    public function display ($tpl, $outputtype='', $trusted = true){
        $this->getTemplate($tpl,'template_', $outputtype, $trusted);
    }

    /**
     * include the compiled template file and call one of the generated function
     * @param string $tpl template selector
     * @param string $fctname the internal function name (meta or content)
     * @param string $outputtype the type of output (html, text etc..)
     * @param boolean $trusted  says if the template file is trusted or not
     */
    protected function  getTemplate($tpl,$fctname, $outputtype='', $trusted = true){
        $sel = new jSelectorTpl($tpl,$outputtype,$trusted);
        jIncluder::inc($sel);
        $fct = $fctname.md5($sel->module.'_'.$sel->resource.'_'.$sel->outputType.($trusted?'_t':''));
        $fct($this);
    }

    /**
     * return the generated content from the given template
     * @param string $tpl template selector
     * @param string $outputtype the type of output (html, text etc..)
     * @param boolean $trusted  says if the template file is trusted or not
     * @return string the generated content
     */
    public function fetch ($tpl, $outputtype='', $trusted = true){
        ob_start ();
        try{
           $this->getTemplate($tpl,'template_', $outputtype, $trusted);
           $content = ob_get_clean();
        }catch(Exception $e){
           ob_end_clean();
           throw $e;
        }
        return $content;
    }

    /**
     * optimized version of meta() + fetch()
     * @param string $tpl template selector
     * @param string $outputtype the type of output (html, text etc..)
     * @param boolean $trusted  says if the template file is trusted or not
     * @return string the generated content
     * @since 1.0b1
     */
    public function metaFetch ($tpl, $outputtype='', $trusted = true){
        ob_start ();
        try{
            $sel = new jSelectorTpl($tpl, $outputtype, $trusted);
            jIncluder::inc($sel);
            $md = md5($sel->module.'_'.$sel->resource.'_'.$sel->outputType.($trusted?'_t':''));
            $fct = 'template_meta_'.$md;
            $fct($this);
            $fct = 'template_'.$md;
            $fct($this);
            $content = ob_get_clean();
        }catch(Exception $e){
            ob_end_clean();
            throw $e;
        }
        return $content;
    }


    /**
     * return the current encoding
     * @return string the charset string
     * @since 1.0b2
     */
    public static function getEncoding (){
        return $GLOBALS['gJConfig']->charset;
    }
}
?>
