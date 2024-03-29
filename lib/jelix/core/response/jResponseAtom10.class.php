<?php
/**
* @package     jelix
* @subpackage  core_response
* @author      Yannick Le Guédart
* @contributor Laurent Jouanneau
* @copyright   2006 Yannick Le Guédart
* @copyright   2006-2007 Laurent Jouanneau
* @link        http://www.jelix.org
* @licence     GNU Lesser General Public Licence see LICENCE file or http://www.gnu.org/licenses/lgpl.html
*/

/**
*
*/
require_once(JELIX_LIB_TPL_PATH.'jTpl.class.php');
require_once(JELIX_LIB_RESPONSE_PATH.'jResponseXmlFeed.class.php');

/**
* Atom 1.0 response
*
* Known limitations : only text in the title, and only name in categories
* @package  jelix
* @subpackage core_response
* @link http://tools.ietf.org/html/rfc4287
* @since 1.0b1
*/
class jResponseAtom10 extends jResponseXMLFeed {

    protected $_type = 'atom1.0';

    /**
     * Class constructor
     *
     * @param  array
     * @return void
     */
    function __construct (){
        $this->_template 	= new jTpl();
        $this->_mainTpl 	= 'jelix~atom10';

        $this->infos = new jAtom10Info ();

        parent::__construct ();
    }

    /**
     * Generate the content and send it
     * Errors are managed
     * @return boolean true if generation is ok, else false
     */
    final public function output (){
        $this->_headSent = false;

        $this->_httpHeaders['Content-Type'] =
                'application/atom+xml;charset=' . $this->charset;

        $this->sendHttpHeaders ();

        echo '<?xml version="1.0" encoding="'. $this->charset .'"?>', "\n";
        $this->_outputXmlHeader ();

        $this->_headSent = true;

        if(!$this->infos->updated){
            $this->infos->updated = date("Y-m-d H:i:s");
        }

        // $this->_outputOptionals();

        $this->_template->assign ('atom', $this->infos);
        $this->_template->assign ('items', $this->itemList);
        $this->_template->assign ('lang',$this->lang);
        $this->_template->display ($this->_mainTpl);

        if ($this->hasErrors ()) {
            echo $this->getFormatedErrorMsg ();
        }
        echo '</feed>';
        return true;
    }

    final public function outputErrors() {
        if (!$this->_headSent) {
            if (!$this->_httpHeadersSent) {
                header("HTTP/1.0 500 Internal Server Error");
                header('Content-Type: text/xml;charset='.$this->charset);
            }
            echo '<?xml version="1.0" encoding="'. $this->charset .'"?>';
        }

        echo '<errors xmlns="http://jelix.org/ns/xmlerror/1.0">';
        if ($this->hasErrors()) {
            echo $this->getFormatedErrorMsg();
        } else {
            echo '<error>Unknow Error</error>';
        }
        echo '</errors>';
    }

    /**
     * Format error messages
     * @return string formated errors
     */
    protected function getFormatedErrorMsg(){
        $errors = '';
        foreach ($GLOBALS['gJCoord']->errorMessages  as $e) {
            // FIXME : Pourquoi utiliser htmlentities() ?
           $errors .=  '<error xmlns="http://jelix.org/ns/xmlerror/1.0" type="'. $e[0] .'" code="'. $e[1] .'" file="'. $e[3] .'" line="'. $e[4] .'">'.htmlentities($e[2], ENT_NOQUOTES, $this->charset). '</error>'. "\n";
        }
        return $errors;
    }

    /**
     * create a new item
     * @param string $title the item title
     * @param string $link  the link
     * @param string $date  the date of the item
     * @return jXMLFeedItem
     */
    public function createItem($title,$link, $date){
        $item = new jAtom10Item();
        $item->title = $title;
        $item->id = $item->link = $link;
        $item->published = $date;
        return $item;
    }

}

/**
 * meta data of the channel
 * @package    jelix
 * @subpackage core_response
 * @since 1.0b1
 */
class jAtom10Info extends jXMLFeedInfo{
    /**
     * unique id of the channel
     * @var string
     */
    public $id;
    /**
     * channel url
     * @var string
     */
    public $selfLink;
    /**
     * author's list
     * each author is an array('name'=>'','email'=>'','uri'=>'')
     * @var array
     */
    public $authors = array();
    /**
     * related links to the channel
     * each link is an array with this keys : href rel type hreflang title length
     * @var array
     */
    public $otherLinks = array();
    /**
     * list of contributors
     * each contributor is an array('name'=>'','email'=>'','uri'=>'')
     * @var array
     */
    public $contributors= array();
    /**
     * icon url
     * @var string
     */
    public $icon;

    /**
     * version of the generator
     * @var string
     * @see $generator
     */
    public $generatorVersion;
    /**
     * url of the generator
     * @var string
     * @see $generator
     */
    public $generatorUrl;

    function __construct ()
    {
        $this->_mandatory = array ('title', 'id', 'updated');
    }
}

/**
 * content of an item in a syndication channel
 * @package    jelix
 * @subpackage core_response
 * @since 1.0b1
 */
class jAtom10Item extends jXMLFeedItem {
    /**
     * the url of the main author
     * @var string
     */
    public $authorUri;
    /**
     * list of other authors
     * each author is an array('name'=>'','email'=>'','uri'=>'')
     * @var array
     */
    public $otherAuthors = array();
    /**
     * list of contributors
     * each contributor is an array('name'=>'','email'=>'','uri'=>'')
     * @var string
     */
    public $contributors= array();
    /**
     * related links to the item
     * each link is an array with this keys : href rel type hreflang title length
     * @var array
     */
    public $otherLinks= array();
    /**
     * summary of the content
     * @var string
     */
    public $summary;
    /**
     * type of the summary
     * possible values are 'text', 'html', 'xhtml'
     * @var string
     */
    public $summaryType;
    /**
     * atom content of the source of the item
     * @var xml
     */
    public $source;
    /**
     * Copyright
     * @var string
     */
    public $copyright;
    /**
     * date of the last update of the item
     * date format is yyyy-mm-dd hh:mm:ss
     * @var string
     */
    public $updated;

}

?>
