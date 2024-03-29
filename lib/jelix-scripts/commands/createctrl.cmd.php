<?php

/**
* @package     jelix-scripts
* @author      Jouanneau Laurent
* @contributor Loic Mathaud
* @copyright   2005-2007 Jouanneau laurent
* @link        http://www.jelix.org
* @licence     GNU General Public Licence see LICENCE file or http://www.gnu.org/licenses/gpl.html
*/

class createctrlCommand extends JelixScriptCommand {

    public  $name = 'createctrl';
    public  $allowed_options=array('-cmdline'=>false);
    public  $allowed_parameters=array('module'=>true,'name'=>true, 'method'=>false);

    public  $syntaxhelp = "[-cmdline] MODULE CONTROLLER [METHOD]";
    public  $help=array(
        'fr'=>"
    Créer un nouveau controleur de type jController ou jControllerCmdLine.

    Si l'option -cmdline est présente, le controleur est de type 
    jControllerCmdLine (pour développer des scripts en ligne de commande).
    
    MODULE : le nom du module concerné.
    CONTROLLER :  nom du controleur que vous voulez créer.
    METHOD (facultatif) : nom de la première méthode. Par défaut, elle a
                              le nom index.",
        'en'=>"
    Create a new controller, either a jController or jControllerCmdLine.
    
    To create a jControllerCmdLine (for command line script), you should 
    provide -cmdline option
    
    MODULE : module name where to create the controller.
    CONTROLLER :  name of your new controller.
    METHOD (optional) : name of the first method ('index' by default)."
    );

    public function run(){
       $path= $this->getModulePath($this->_parameters['module']);

       $agfilename= $path.'controllers/';
       $this->createDir($agfilename);
       
       if ($this->getOption('-cmdline')) { 
            $type = 'cmdline';
       } else {
            $type = 'classic';
       }
       
       $agfilename.=strtolower($this->_parameters['name']).'.'. $type .'.php';

       $method = $this->getParam('method','index');

       $param= array('name'=>$this->_parameters['name'] , 'method'=>$method);

       if ($this->getOption('-cmdline')) {
            $tplname = 'controller.cmdline.tpl';
       } else {
            $tplname = 'controller.tpl';
       }
       $this->createFile($agfilename,$tplname,$param);

    }
}


?>