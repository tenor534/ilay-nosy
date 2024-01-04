<?php
/**
* @package     jelix
* @subpackage  core_response
* @author      Laurent Jouanneau
* @contributor
* @copyright   2005-2006 Laurent Jouanneau
* @link        http://www.jelix.org
* @licence     GNU Lesser General Public Licence see LICENCE file or http://www.gnu.org/licenses/lgpl.html
*/


/**
* Response use to send a binary file to the browser
* @package  jelix
* @subpackage core_response
*/

final class jResponseExcel extends jResponse {
    /**
    * @var string
    */
    protected $_type = 'excel';

    /**
     * name of the file under which the content will be send to the user
     * @var string
     */
    public $outputFileName ='';

    /**
     * the content you want to send. Keep empty if you indicate a filename
     * @var string
     */
    public $content = null;


    /**
     * send the content or the file to the browser.
     * @return boolean    true it it's ok
     */
    public function output(){
        if($this->hasErrors()) return false;

		header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=".$this->outputFileName);
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Pragma: public");
		header("Content-Length: ".strlen ($this->content));
		echo $this->content;
		flush();

		return true;
    }

    /**
     * @todo do this method
     */
    public function outputErrors(){

    }
}
?>