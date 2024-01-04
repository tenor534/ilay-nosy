<?php
/**
* @package     jelix
* @subpackage  core_response
* @author      Laurent Jouanneau
* @contributor Loic Mathaud
* @copyright   2006-2007 Laurent Jouanneau
* @copyright   2007 Loic Mathaud
* @link        http://www.jelix.org
* @licence     GNU Lesser General Public Licence see LICENCE file or http://www.gnu.org/licenses/lgpl.html
*/

/**
 *
 */
require_once (LIB_PATH.'json/JSON.php');


/**
* Json response
* @package  jelix
* @subpackage core_response
* @see jResponse
* @since 1.0b1
*/
final class jResponseJson extends jResponse {
    protected $_acceptSeveralErrors=false;

    /**
     * datas in PHP you want to send
     * @var mixed
     */
    public $datas = null;


    public function output(){
		global $gJCoord;
        if($this->hasErrors()) return false;
        $this->_httpHeaders['Content-Type'] = "text/plain";
		//JAK : Modif 2007 10 04 : changement de JSON_LOOSE_TYPE en SERVICES_JSON_LOOSE_TYPE
        $json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);
        $content = $json->encode($this->datas);
		if($this->hasErrors()) return false;

        $this->_httpHeaders['Content-length'] = strlen($content);
        $this->sendHttpHeaders();
        echo $content;
        return true;
    }

    public function outputErrors(){
        global $gJCoord;
        $message = array();
        if(count($gJCoord->errorMessages)){
           $e = $gJCoord->errorMessages[0];
           $message['errorCode'] = $e[1];
           $message['errorMessage'] = '['.$e[0].'] '.$e[2].' (file: '.$e[3].', line: '.$e[4].')';
        }else{
            $message['errorMessage'] = 'Unknow error';
            $message['errorCode'] = -1;
        }
        $this->clearHttpHeaders();
        $this->_httpStatusCode ='500';
        $this->_httpStatusMsg ='Internal Server Error';
        $this->_httpHeaders['Content-Type'] = "text/plain";
		//JAK : Modif 2007 10 04 : changement de JSON_LOOSE_TYPE en SERVICES_JSON_LOOSE_TYPE
        $json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);
        $content = $json->encode($message);
        $this->_httpHeaders['Content-length'] = strlen($content);
        $this->sendHttpHeaders();
        echo $content;
    }
}

?>
