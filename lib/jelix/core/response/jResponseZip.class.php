<?php
/**
* @package     jelix
* @subpackage  core_response
* @author      Laurent Jouanneau
* @contributor
* @copyright   2006-2007 Laurent Jouanneau
* @link        http://www.jelix.org
* @licence     GNU Lesser General Public Licence see LICENCE file or http://www.gnu.org/licenses/lgpl.html
*/

/**
 *
 */
include JELIX_LIB_UTILS_PATH.'jZipCreator.class.php';

/**
* generate a zip content and send it to the browser
* @package  jelix
* @subpackage core_response
*/
class jResponseZip extends jResponse {
    /**
    * @var string
    */
    protected $_type = 'zip';

    /**
     * the zip content. Manipulates it to add files into it
     * @var jZipCreator
     */
    public $content = null;

    /**
     * file name which appear in the browser
     */
    public $zipFilename='';

    /**
    * constructor
    */
    function __construct (){
        $this->content = new jZipCreator();
        parent::__construct();
    }

    /**
     * construct the zip content into zip format, and send it to the browser
     * @return boolean    true  if it's ok
     */
    public function output(){
        $zipContent = $this->content->getContent();
        if($this->hasErrors()){
            return false;
        }
        $this->_httpHeaders['Content-Type']='application/zip';
        $this->_httpHeaders['Content-Disposition']='attachment; filename="'.$this->zipfilename.'"';

        $this->addHttpHeaders('Content-Description','File Transfert',false);
        $this->addHttpHeaders('Content-Transfer-Encoding','binary',false);
        $this->addHttpHeaders('Pragma','no-cache',false);
        $this->addHttpHeaders('Cache-Control','no-store, no-cache, must-revalidate, post-check=0, pre-check=0',false);
        $this->addHttpHeaders('Expires','0',false);

        $this->_httpHeaders['Content-length']=strlen($zipContent);
        $this->sendHttpHeaders();
        echo $zipContent;
        flush();
        return true;
    }

    public function outputErrors(){
        global $gJConfig;
        header("HTTP/1.0 500 Internal Server Error");
        header('Content-Type: text/plain;charset='.$gJConfig->charset);
        if($this->hasErrors()){
            foreach( $GLOBALS['gJCoord']->errorMessages  as $e){
               echo '['.$e[0].' '.$e[1].'] '.$e[2]." \t".$e[3]." \t".$e[4]."\n";
            }
        }else{
            echo "[unknow error]\n";
        }
    }
}
?>