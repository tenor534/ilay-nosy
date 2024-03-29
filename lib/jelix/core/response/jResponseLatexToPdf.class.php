<?php
/**
* @package     jelix
* @subpackage  core_response
* @author      Aubanel MONNIER
* @contributor Laurent Jouanneau (better integration into jelix)
* @copyright   2007 Aubanel MONNIER
* @link        http://aubanel.info
* @licence     GNU Lesser General Public Licence see LICENCE file or http://www.gnu.org/licenses/lgpl.html
*/

define ('PDF_LATEX_RESPONSE_CACHE', JELIX_APP_TEMP_PATH.'responseLatexToPdf/');

/**
* pdf response, generated from a latex content
* @package  jelix
* @subpackage core_response
* @since 1.0b2
*/
class jResponseLatexToPdf extends jResponse {
    /**
    * @var string
    */
    protected $_type = 'ltx2pdf';
    /**
     * selector of the main template file
     * This template should contains the body content, and is used by the $body template engine
     * @var string
     */
    public $bodyTpl = '';
    /**
     * The template engine used to generate the content
     * @var jTpl
     */
    public $body = null;
    /**
     * Authors of the document
     * @var array
     */
    public $authors = array();
    /**
     * Document title
     * @var string
     */
    public $title = '';

    /**
     * Contains the list of commands to write in the preamble. 
     * @var array
     */
    protected $_commands=array();

    /**
     * complete path to the pdflatex executable
     * @var string
     */
    public $pdflatexPath='pdflatex';

    /**
     * constructor;
     * setup the template engine
     */
    function __construct (){
        $this->body = new jTpl();
        parent::__construct();
    }

    /**
     * Add a command to the preamble, e.g. \documentclass[a4,11pt]{article}
     * @param string $command name of the command to add
     * @param string $argument argument of the command to add
     * @param array $options options of the command to add
     */
    public function addCommand($command, $argument, $options=array()){
        $cmd = '\\'.$command;
        if (count($options)) 
            $cmd.='['.join(',',$options).']';
        $this->_commands []= $cmd.'{'.$argument.'}';
    }

    /**
     * A list of commands that can be safely used as default, or as a template for the _commonProcess function
     * Tis function is called if the command stack is empty (useful to get quicly started)
     */
    public function addDefaultCommands(){
        $this->addCommand('documentclass', 'article', array('a4', '11pt'));
        $this->addCommand('usepackage', 'fontenc', array('T1'));
        $this->addCommand('usepackage', 'graphicx');
        $this->addCommand('usepackage', 'geometry', array('pdftex'));
        $this->addCommand('geometry', 'hmargin=1cm, vmargin=1cm');
    }

    /**
     * output the pdf content
     *
     * @return boolean    true if the generated content is ok
     */
    function output(){
        $this->_commonProcess();
        if (count($this->_commands) <= 0) //No commands, likewise we need some...
            $this->addDefaultCommands();

        $data =  join("\n", $this->_commands).'
\begin{document}
\title{'.$this->title.'}
\author{';
        foreach ($this->authors as $a) 
            $data.= $a.'\\\\'."\n";
        $data.= '}
\date{\today}
\maketitle
';
        $data.=$this->body->fetch($this->bodyTpl);
        $data.= '
    
\end{document}';

        $fbase='cache-'.md5($data);
        
        $texFile=PDF_LATEX_RESPONSE_CACHE.$fbase.'.tex';
        $pdfFile=PDF_LATEX_RESPONSE_CACHE.$fbase.'.pdf';

        if (! file_exists($pdfFile)){
            // Naïve cache: we have an md5 on the content of the tex file. If the pdf 
            // corresponding to this content already exists, just serve it. 
            // No managment of cache deletion :o/
            jFile::write($texFile, $data);
            $output=array();
            $retVal=1;	
                exec('
            TEXMFOUTPUT='.PDF_LATEX_RESPONSE_CACHE.' && export TEXMFOUTPUT && TEXINPUTS=:'.PDF_LATEX_RESPONSE_CACHE.' && export TEXINPUTS &&
            '.$this->pdflatexPath.' --interaction=batchmode '.$texFile, $output, $retVal);
            if ($retVal==0){
                $outputStr=implode('<br />',$output);
                throw new jException('jelix~errors.ltx2pdf.exec',array($this->pdflatexPath, $outputStr));
            }
        }

        $this->_httpHeaders['Content-Type']='application/pdf';
        $this->_httpHeaders['Content-length']=@filesize($pdfFile);
        $this->_httpHeaders['Content-Disposition']='attachment; filename='.$this->title.'.pdf';
        $this->sendHttpHeaders();

        readfile($pdfFile);
        return true;
    }

    /**
     * The method you can overload in your inherited response
     * overload it if you want to add processes (additionnal commands, content etc..)
     * for all actions
     */
    protected function _commonProcess(){

    }

    /**
     * Clears the cache directory
     */
    public function clearCache(){
        jFile::removeDir(PDF_LATEX_RESPONSE_CACHE, false);
    }

    /**
     * output errors
     */
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