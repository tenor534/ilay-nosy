<?php
/**
* @package     jelix
* @subpackage  core_response
* @author      Laurent Jouanneau
* @contributor Yann (description and keywords)
* @copyright   2005-2007 Laurent Jouanneau, 2006 Yann
*   few lines of code are copyrighted CopixTeam http://www.copix.org
* @link        http://www.jelix.org
* @licence     GNU Lesser General Public Licence see LICENCE file or http://www.gnu.org/licenses/lgpl.html
*/

/**
*
*/
require_once(JELIX_LIB_TPL_PATH.'jTpl.class.php');

/**
* HTML response
* @package  jelix
* @subpackage core_response
*/
class jResponseHtml extends jResponse {
    /**
    * jresponse id
    * @var string
    */
    protected $_type = 'html';

    /**
     * Title of the document
     * @var string
     */
    public $title = '';

    /**
     * favicon url linked to the document
     * @var string
     * @since 1.0b2
     */
    public $favicon = '';

    /**
     * The template engine used to generate the body content
     * @var jTpl
     */
    public $body = null;

    /**
     * selector of the main template file
     * This template should contains the body content, and is used by the $body template engine
     * @var string
     */
    public $bodyTpl = '';

    /**
     * Selector of the template used when there are some errors, instead of $bodyTpl
     * @var string
     */
    public $bodyErrorTpl = '';

    /**
     * body attributes
     * This attributes are written on the body tags
     * @var array
     */
    public $bodyTagAttributes= array();

    /**
     * says what part of the html head has been send
     * @var integer
     */
    protected $_headSent = 0;

    /**
     * the charset of the document
     * @var string
     */
    protected $_charset;

    /**
     * the lang of the document
     * @var string
     */
    protected $_lang;

    /**
     * properties of the head content
     */

    /**#@+
     * content for the head
     * @var array
     */
    protected $_CSSLink = array ();
    protected $_CSSIELink = array ();
    protected $_Styles  = array ();
    protected $_JSLink  = array ();
    protected $_JSIELink  = array ();
    protected $_JSCode  = array ();
    protected $_Others  = array ();
    protected $_MetaKeywords = array();
    protected $_MetaDescription = array();
    /**#@-*/

    /**#@+
     * content for the body
     * @var array
     */
    protected $_bodyTop = array();
    protected $_bodyBottom = array();
    /**#@-*/

    /**
     * says if the document is in xhtml or html
     */
    protected $_isXhtml = true;
    protected $_endTag="/>\n";

    /**
     * says if xhtml content type should be send or not.
     * it true, a verification of HTTP_ACCEPT is done.
     * @var boolean
     */
    public $xhtmlContentType = false;


    /**
    * constructor;
    * setup the charset, the lang, the template engine
    */
    function __construct (){
        global $gJConfig;
        $this->_charset = $gJConfig->charset;
        $this->_lang = $gJConfig->locale;
        $this->body = new jTpl();
        parent::__construct();
    }

    /**
     * output the html content
     *
     * @return boolean    true if the generated content is ok
     */
    final public function output(){
        $this->_headSent = 0;
        if($this->_isXhtml && $this->xhtmlContentType && strstr($_SERVER['HTTP_ACCEPT'],'application/xhtml+xml')){
            $this->_httpHeaders['Content-Type']='application/xhtml+xml;charset='.$this->_charset;
        }else{
            $this->_httpHeaders['Content-Type']='text/html;charset='.$this->_charset;
        }

        $this->sendHttpHeaders();
        if($this->_isXhtml){
            echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="',$this->_lang,'" lang="',$this->_lang,'">
';
        }else{
            //echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">', "\n";
            echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">', "\n";

            //echo '<html lang="',$this->_lang,'">';
			echo '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="',$this->_lang,'" lang="',$this->_lang,'">', "\n";

        }
        $this->_headSent = 1;
        $this->_commonProcess();
        if($this->bodyTpl != '')
           $this->body->meta($this->bodyTpl);
        $this->outputHtmlHeader();
        echo '<body ';
        foreach($this->bodyTagAttributes as $attr=>$value){
           echo $attr,'="', htmlspecialchars($value),'" ';
        }
        echo ">\n";
        $this->_headSent = 2;
        echo implode("\n",$this->_bodyTop);
        if($this->bodyTpl != '')
           $this->body->display($this->bodyTpl);

        if($this->hasErrors()){
            echo '<div id="jelixerror" style="position:absolute;left:0px;top:0px;border:3px solid red; background-color:#f39999;color:black;">';
            echo $this->getFormatedErrorMsg();
            echo '<p><a href="#" onclick="document.getElementById(\'jelixerror\').style.display=\'none\';return false;">fermer</a></p></div>';
        }
        echo implode("\n",$this->_bodyBottom);
        echo '</body>'."\n".'</html>';
        return true;
    }

    /**
     * The method you can overload in your inherited html response
     * overload it if you want to add processes (stylesheet, head settings, additionnal content etc..)
     * for all actions
     */
    protected function _commonProcess(){

    }

    /**
     * output errors
     */
    final public function outputErrors(){
        if($this->_headSent < 1){
             if(!$this->_httpHeadersSent){
                header("HTTP/1.0 500 Internal Server Error");
                header('Content-Type: text/html;charset='.$this->_charset);
             }
            echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">', "\n<html>";
        }
        if($this->_headSent < 2){
            echo '<head><title>Errors</title></head><body>';
        }
        if($this->hasErrors()){
            echo $this->getFormatedErrorMsg();
        }else{
            echo '<p style="color:#FF0000">Unknow Error</p>';
        }
        echo "</body>\n";
        echo "</html>";
    }


    /**
     * create html error messages
     * @return string html content
     */
    protected function getFormatedErrorMsg(){
        $errors='';
        foreach( $GLOBALS['gJCoord']->errorMessages  as $e){
            // FIXME : Pourquoi utiliser htmlentities() ?
           $errors .=  '<p style="margin:0;"><b>['.$e[0].' '.$e[1].']</b> <span style="color:#FF0000">'.htmlentities($e[2], ENT_NOQUOTES, $this->_charset)."</span> \t".$e[3]." \t".$e[4]."</p>\n";
        }
        return $errors;
    }

    /**
     * add content to the body
     * you can add additionnal content, before or after the content generated by the main template
     * @param string $content additionnal html content
     * @param boolean $beforeTpl true if you want to add it before the template content, else false for after
     */
    function addContent($content, $beforeTpl = false){
      if($beforeTpl){
        $this->_bodyTop[]=$content;
      }else{
         $this->_bodyBottom[]=$content;
      }
    }

    /**
     * add a link to a javascript script in the document head
     *
     * $forIe parameter exists since 1.0b2
     *
     * @param string $src the link
     * @param array $params additionnals attributes for the script tag
     * @param boolean $forIE if true, the script sheet will be only for IE browser
     */
    final public function addJSLink ($src, $params=array(), $forIE=false){
        if($forIE){
            if (!isset ($this->_JSIELink[$src])){
                $this->_JSIELink[$src] = $params;
            }
        }else{
            if (!isset ($this->_JSLink[$src])){
                $this->_JSLink[$src] = $params;
            }
        }
    }

    /**
     * add a link to a css stylesheet in the document head
     *
     * $forIe parameter exists since 1.0b2
     *
     * @param string $src the link
     * @param array $params additionnals attributes for the link tag
     * @param boolean $forIE if true, the style sheet will be only for IE browser
     */
    final public function addCSSLink ($src, $params=array (), $forIE=false){
        if($forIE){
            if (!isset ($this->_CSSIELink[$src])){
                $this->_CSSIELink[$src] = $params;
            }
        }else{
            if (!isset ($this->_CSSLink[$src])){
                $this->_CSSLink[$src] = $params;
            }
        }
    }

    /**
     * add inline css style into the document (inside a <style> tag)
     * @param string $selector css selector
     * @param string $def      css properties for the given selector
     */
    final public function addStyle ($selector, $def=null){
        if (!isset ($this->_Styles[$selector])){
            $this->_Styles[$selector] = $def;
        }
    }

    /**
     * @deprecated
     * @see $addHeadContent
     */
    final public function addOthers ($content){
        $this->_Others[] = $content;
    }

    /**
     * add additional content into the document head
     * @param string $content
     * @since 1.0b1
     */
    final public function addHeadContent ($content){
        $this->_Others[] = $content;
    }

    /**
     * add inline javascript code (inside a <script> tag)
     * @param string $code  javascript source code
     */
    final public function addJSCode ($code){
        $this->_JSCode[] = $code;
    }

    /**
     * add some keywords in a keywords meta tag
     * @author Yann
     * @param string $content keywords
     * @since 1.0b1
     */
    final public function addMetaKeywords ($content){
        $this->_MetaKeywords[] = $content;
    }
    /**
     * add a description in a description meta tag
     * @author Yann
     * @param string $content a description
     * @since 1.0b1
     */
    final public function addMetaDescription ($content){
        $this->_MetaDescription[] = $content;
    }

    /**
     * generate the content of the <head> content
     */
    final protected function outputHtmlHeader (){
        echo '<head>'."\n";
        echo "\t".'<title>'.htmlspecialchars($this->title)."</title>\n";
        //echo '<meta content="text/html; charset='.$this->_charset.'" http-equiv="Content-type"'.$this->_endTag;
        echo "\t".'<meta http-equiv="Content-Type" content="text/html; charset='.$this->_charset.'"'.$this->_endTag;
        echo "\t".'<meta http-equiv="Content-Language" content="'.$this->_lang.'"'.$this->_endTag;



        if(!empty($this->_MetaDescription)){
            // meta description
            $description = implode(' ',$this->_MetaDescription);
            echo "\t".'<meta name="description" content="'.htmlspecialchars($description).'" '.$this->_endTag;
        }

        if(!empty($this->_MetaKeywords)){
            // meta description
            $keywords = implode(',',$this->_MetaKeywords);
            echo "\t".'<meta name="keywords" content="'.htmlspecialchars($keywords).'" '.$this->_endTag;
        }

        echo implode ("\n\t", $this->_Others);

        // css link
        foreach ($this->_CSSLink as $src=>$params){
            //the extra params we may found in there.
            $more = '';
            foreach ($params as $param_name=>$param_value){
                $more .= $param_name.'="'. htmlspecialchars($param_value).'" ';
            }
            if(!isset($params['rel']))
                $more .='rel="stylesheet" ';
            echo  "\t".'<link ',$more,' type="text/css" href="',$src,'" ',$this->_endTag;
        }

        if(count($this->_CSSIELink)){
            echo '<!--[if IE]>';
            foreach ($this->_CSSIELink as $src=>$params){
                //the extra params we may found in there.
                $more = '';
                foreach ($params as $param_name=>$param_value){
                    $more .= $param_name.'="'. htmlspecialchars($param_value).'" ';
                }
                if(!isset($params['rel']))
                    $more .='rel="stylesheet" ';
                echo  "\t".'<link type="text/css" href="',$src,'" ',$more,$this->_endTag;
            }
            echo '<![endif]-->';
        }

        // js link
        foreach ($this->_JSLink as $src=>$params){
            //the extra params we may found in there.
            $more = '';
            foreach ($params as $param_name=>$param_value){
                $more .= $param_name.'="'. htmlspecialchars($param_value).'" ';
            }
            echo "\n"."\t".'<script type="text/javascript" src="',$src,'" ',$more,'></script>';
        }
        if(count($this->_JSIELink)){
            echo '<!--[if IE]>';
            foreach ($this->_JSIELink as $src=>$params){
                //the extra params we may found in there.
                $more = '';
                foreach ($params as $param_name=>$param_value){
                    $more .= $param_name.'="'. htmlspecialchars($param_value).'" ';
                }
                echo "\t".'<script type="text/javascript" src="',$src,'" ',$more,'></script>';
            }
            echo '<![endif]-->';
        }

        // styles
        if(count($this->_Styles)){
            echo "\t".'<style type="text/css">
            ';
            foreach ($this->_Styles as $selector=>$value){
                if (strlen ($value)){
                    //il y a une paire clef valeur.
                    echo $selector.' {'.$value."}\n";
                }else{
                    //il n'y a pas de valeur, c'est peut être simplement une commande.
                    //par exemple @import qqchose, ...
                    echo $selector, "\n";
                }
            }
            echo "\n </style>\n";
        }

        // js code
        if(count($this->_JSCode)){
            echo "\n\t" . '<script type="text/javascript">'."\n";
			echo "\t" . '// <![CDATA['."\n";
			echo "\t" . '	'.implode ("\n", $this->_JSCode).''."\n";
			echo "\t" . '// ]]>'."\n";
			echo "\t" . '</script>';
        }

        if($this->favicon != ''){
            $fav = htmlspecialchars($this->favicon);
            //echo '<link rel="icon" type="image/x-icon" href="',$fav,'" ',$this->_endTag;
            echo "\n". "\t".'<link rel="shortcut icon" type="image/x-icon" href="',$fav,'" ',$this->_endTag;
        }

        echo "\n</head>\n";

    }

    /**
     * used to erase some head properties
     * @param array $what list of one or many of this strings : 'CSSLink', 'CSSIELink', 'Styles', 'JSLink', 'JSIELink', 'JSCode', 'Others','MetaKeywords','MetaDescription'. If null, it cleans all values.
     */
    final public function clearHtmlHeader ($what=null){
        $cleanable = array ('CSSLink', 'CSSIELink', 'Styles', 'JSLink','JSIELink', 'JSCode', 'Others','MetaKeywords','MetaDescription');
        if($what==null)
            $what= $cleanable;
        foreach ($what as $elem){
            if (in_array ($elem, $cleanable)){
                $name = '_'.$elem;
                $this->$name = array ();
            }
        }
    }

    /**
     * change the type of html for the output
     * @param boolean $xhtml true if you want xhtml, false if you want html
     */
    final public function setXhtmlOutput($xhtml = true){
       $this->_isXhtml = $xhtml;
       if($xhtml)
          $this->_endTag = "/>\n";
       else
          $this->_endTag = ">\n";
    }

    /**
     * says if the response will be xhtml or html
     * @return boolean true if it is xhtml
     */
    final public function isXhtml(){ return $this->_isXhtml; }
    /**
     * return the end of a html tag : "/>" or ">", depending if it will generate xhtml or html
     * @return string
     */
    final public function endTag(){ return $this->_endTag;}

}
?>