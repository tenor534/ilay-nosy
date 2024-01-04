<?php
/**
* @package    jelix
* @subpackage core
* @author     Laurent Jouanneau
* @contributor
* @copyright  2005-2006 Laurent Jouanneau
* @link        http://www.jelix.org
* @licence    GNU Lesser General Public Licence see LICENCE file or http://www.gnu.org/licenses/lgpl.html
*/


/**
* base class for response object
* A response object is responsible to generate a content in a specific format.
* @package  jelix
* @subpackage core
*/
abstract class jResponse {
    /**
    * ident of the response type
    * @var string
    */
    protected  $_type = null;

    protected $_errorMessages=array();

    protected $_acceptSeveralErrors=true;

    protected $_httpHeaders = array();

    protected $_httpHeadersSent = false;

    protected $_httpStatusCode ='200';

    protected $_httpStatusMsg ='OK';

    /**
    * constructor
    */
    function __construct (){
    }

    /**
     * Send the response in the correct format.
     *
     * @return boolean    true if the output is ok
     * @internal should take care about errors
     */
    abstract public function output();

    /**
     * Send a response with only error messages which appears during the action
     * (errors, warning, notice, exceptions...). Type and error details
     *  depend on the application configuration
     */
    abstract public function outputErrors();

    /**
     * return the response type name
     * @return string the name
     */
    public final function getType(){ return $this->_type;}

    /**
     * return the format type name (eg the family type name)
     * @return string the name
     */
    public function getFormatType(){ return $this->_type;}

    /**
     * says if the response can embed more than one error message
     * @return boolean true if many
     */
    public final function acceptSeveralErrors(){ return $this->_acceptSeveralErrors;}

    /**
     *
     */
    public final function hasErrors(){ return count($GLOBALS['gJCoord']->errorMessages)>0;}

    /**
     * add an http header to the response.
     * will be send during the output of the response
     * @param string $htype the header type ("Content-Type", "Date-modified"...)
     * @param string $hcontent value of the header type
     * @param boolean $overwrite false if the value should be set only if it doesn't still exist
     */
    public function addHttpHeader($htype, $hcontent, $overwrite=true){ 
        if(!$overwrite && isset($this->_httpHeaders[$htype]))
            return;
        $this->_httpHeaders[$htype]=$hcontent;
    }

    /**
     * delete all http headers
     */
    public function clearHttpHeaders(){
        $this->_httpHeaders = array();
        $this->_httpStatusCode ='200';
        $this->_httpStatusMsg ='OK';
    }

    /**
     * set the http status code for the http header
     * @param string $code  the status code (200, 404...)
     * @param string $msg the message following the status code ("OK", "Not Found"..)
     */
    public function setHttpStatus($code, $msg){ $this->_httpStatusCode=$code; $this->_httpStatusMsg=$msg;}

    /**
     * send http headers
     */
    protected function sendHttpHeaders(){
        if ($this->_httpHeadersSent==false){
			header("HTTP/1.0 ".$this->_httpStatusCode.' '.$this->_httpStatusMsg);
			//print_r($this->_httpHeaders);
			foreach($this->_httpHeaders as $ht=>$hc){
				header($ht.': '.$hc);
			}
			$this->_httpHeadersSent=true;
		}
        /*
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        */
    }

	/**
	 * $param object Objet JDate correspondante à la date de la dernière modification 
	 * des contenus correspondant à cette requêute
	 * return boolean true si le client a une version à jour en cache, false sinon
	 * Dans les 2 cas renvoie au client les entêtes lui indiquant de revalider son cache 
	 * @author	sylvain261
	 * @todo A mettre à jour lorsque JDateTime  implémentera le format RFC822 et permettra de renvoyer du GMT
	*/
	public function activateHttpCache($lastModified){
		
		global $gJConfig;

		if(!isset($gJConfig->cache) || !isset($gJConfig->cache['httpCache']) || ($gJConfig->cache['httpCache']!=1)){
			return FALSE;
		}
		
		if(isset($_SERVER["HTTP_IF_MODIFIED_SINCE"])){
			$userVersionLastModified = new jDateTime();
			$userVersionLastModified->setFromString(strtotime($_SERVER["HTTP_IF_MODIFIED_SINCE"]), jDateTime::TIMESTAMP_FORMAT);

			if($lastModified->compareTo($userVersionLastModified) == 0){
				$this->setHttpStatus(304, "Not Modified");
				$this->addHttpHeader("Cache-Control", "must-revalidate");
				$this->addHttpHeader("Last-modified", self::JDateToString_GM_RFC822($lastModified));
				return TRUE;
			}
		}
		$this->addHttpHeader("Cache-Control", "must-revalidate");
		$this->addHttpHeader("Last-modified", self::JDateToString_GM_RFC822($lastModified));
		return FALSE;
	}

	/**
	* Permet de renvoyer une heure GMT au format RFC822
	* Ca n'a rien à faire là...faudra l'implémenter dans jDateTime mais je ne veut pas avoir à modifier trop de fichiers de Jelix
	* @author	sylvain261
	*/
	static function JDateToString_GM_RFC822($jdate){
		return gmdate('r', mktime ( $jdate->hour, $jdate->minute, $jdate->second , $jdate->month, $jdate->day, $jdate->year ));
	}

}
?>