<?php
/**
* @package    jelix
* @subpackage core
* @author     Laurent Jouanneau
* @contributor
* @copyright  2005-2006 laurent Jouanneau
* @link        http://www.jelix.org
* @licence    GNU Lesser General Public Licence see LICENCE file or http://www.gnu.org/licenses/lgpl.html
*/

/**
 * Jelix Exception
 *
 * It handles locale messages. Message property contains the locale key,
 * and a new property contains the localized message.
 * @package  jelix
 * @subpackage core
 */
class jException extends Exception {

	/**
     * the locale key
     * @var string
     */
    protected $localeKey = "";

    /**
     * parameters for the locale key
     */
    public $localeParams = array();

    /**
     * @param string $localekey a locale key
     * @param array $localeParams parameters for the message (for sprintf)
     * @param integer $code error code (can be provided by the localized message)
     */
    public function __construct($localekey, $localeParams=array(), $code = 1) {

        $this->localeKey = $localekey;
        $this->localeParams = $localeParams;

        try{
            $message = jLocale::get($localekey, $localeParams);
        }catch(Exception $e){
            $message = $e->getMessage();
        }
        if(preg_match('/^\s*\((\d+)\)(.+)$/',$message,$m)){
            $code = $m[1];
            $message = $m[2];
        }
        parent::__construct($message, $code);
    }

    /**
     * magic function for echo
     * @return string localized message
     */
    /*public function __toString() {
        return $this->localizedMessage;
    }*/

    /**
     * getter for the locale parameters
     * @return string
     */
    public function getLocaleParameters(){
        return $this->localeParams;
    }

    /**
     * getter for the locale key
     * @return string
     */
    public function getLocaleKey(){
        return $this->localeKey;
    }

}

/**
* Exception handler for the framework.
* Replace the default PHP Exception handler
* @param   Exception   $exception  the exception object
*/
function jExceptionHandler($exception){
    global $gJConfig, $gJCoord;

    $msg = $exception->getMessage();

    $conf = $gJConfig->error_handling;
    $action = $conf['exception'];

    $doecho=true;

    if($gJCoord->request == null){

        $msg = 'JELIX PANIC ! Error during initialization !! '.$msg;
        $doecho = false;

    }elseif($gJCoord->response == null){

        $ret = $gJCoord->initDefaultResponseOfRequest();
        if(is_string($ret)){
            $msg = 'Double error ! 1)'. $ret.'; 2)'.$msg;
        }

    }

      if(!isset($_SERVER['REMOTE_ADDR'])){ // for CLI mode (bug #111)
          $_SERVER['REMOTE_ADDR'] = '127.0.0.1';
      }

    // formatage du message de log
    $messageLog = strtr($conf['messageLogFormat'], array(
        '%date%' => date("Y-m-d H:i:s"),
        '%ip%'   => $_SERVER['REMOTE_ADDR'],
        '%code%' => $exception->getCode(),
        '%msg%'  => $msg,
        '%file%' => $exception->getFile(),
        '%line%' => $exception->getLine(),
        '%typeerror%'=>'exception',
        '\t' =>"\t",
        '\n' => "\n"
    ));

    if(strpos($action , 'TRACE') !== false){

		//Sylvain261 - 01/12/2007 - Bug de jelix...
		//$arr = debug_backtrace();
        //array_shift($arr);
		$arr = $exception->getTrace();
        
		$messageLog.="\ttrace:";

        foreach($arr as $k=>$t){
            $messageLog.="\n\t$k\t".(isset($t['class'])?$t['class'].$t['type']:'').$t['function']."()\t";
            $messageLog.=(isset($t['file'])?$t['file']:'[php]').' : '.(isset($t['line'])?$t['line']:'');
        }
        $messageLog.="\n";
    }

    // traitement du message
    if(strpos($action , 'ECHOQUIET') !== false){
        if(!$doecho){
            header("HTTP/1.1 500 Internal jelix error");
            header('Content-type: text/plain');
            echo 'JELIX PANIC ! Error during initialization !! ';
        }else
            $gJCoord->addErrorMsg('error', $exception->getCode(), $conf['quietMessage'], '', '');
    }elseif(strpos($action , 'ECHO') !== false){
        if($doecho)
            $gJCoord->addErrorMsg('error', $exception->getCode(), $msg, $exception->getFile(), $exception->getLine());
        else{
            header("HTTP/1.1 500 Internal jelix error");
            header('Content-type: text/plain');
            echo $messageLog;
        }
    }
    if(strpos($action , 'LOGFILE') !== false){
        error_log($messageLog,3, JELIX_APP_LOG_PATH.$conf['logFile']);
	}
    if(strpos($action , 'MAIL') !== false){
        error_log(wordwrap($messageLog,70),1, $conf['email'], $conf['emailHeaders']);
    }
    if(strpos($action , 'SYSLOG') !== false){
        error_log($messageLog,0);
    }

    if($doecho)
        $gJCoord->response->outputErrors();
    exit;
}

?>