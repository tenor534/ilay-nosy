<?php
/**
* @package     jelix
* @subpackage  jintrospection
* @author      Sylvain261
*/

class jIntrospection  {


	static function getAllActions(){

		//error_reporting(0);

		require_once (LIB_PATH.'phpDoctor/phpDoctor.php');

		$options = array(
			//Names of files to parse. This can be a single filename, or a comma separated list of filenames. Wildcards are allowed.
			"files" => "*.php" 
			
			//Names of files or directories to ignore. This can be a single filename, or a comma separated list of filenames. Wildcards are NOT allowed.
			,"ignore" => "CVS, _compiled"

			//The directory to look for files in, if not used the PHPDoctor will look in the current directory (the directory it is run from).
			,"source_path" => JELIX_APP_PATH

			//If the code you are parsing does not use package tags or not all elements have package tags, use this setting to place unbound elements into a particular package.
			, "default_package" => "bmw"

			//Parse out global variables and/or global constants?
			//,"globals" => "off"
			//,"constants" => "off"

			//Generate documentation for all class members
			//,"private" => "on"

			//Generate documentation for public and protected class members
			//,"protected" => "on"

			//Generate documentation for only public class members
			//,"public" => "on"

		);

		$phpdoc = new phpDoctor($options);
		$rootDoc = $phpdoc->parse();
//		print_r($rootDoc);
//		die();

		$actions = array();

		foreach($rootDoc->_packages as $package){
			foreach($package->_classes as $classeName => $classe){
				if($classe->_superclass == 'jController'){
					foreach($classe->_methods as $methodName => $method){
						$module = $classe->_fileName;
						$module=substr($module, strpos($module, "modules")+8, strpos($module, "controllers")-(strpos($module, "modules")+9));

						$parameters = array();
						$desc = "";
						if(isset($method->_tags["@text"])){
							$desc = $method->_tags["@text"]->_text;
						}
						if(isset($method->_tags["@param"])){
							if(is_array($method->_tags["@param"])){
								foreach($method->_tags["@param"] as $parameter){
									$parameterName=NULL;
									$parameterType=NULL;
									$parameterText =str_word_count($parameter->_text, 1, "0123456789_");
									if(isset($parameterText[0])){
										$parameterType = $parameterText[0];
									}
									if(isset($parameterText[1])){
										$parameterName = $parameterText[1];
									}
									
									array_push($parameters, new Parametre($parameterName, $parameterType, $parameter->_text));
								}
							}else{
								$parameterName=NULL;
								$parameterType=NULL;
								$parameterText =str_word_count($method->_tags["@param"]->_text, 1, "0123456789_");
								if(isset($parameterText[0])){
									$parameterType = $parameterText[0];
								}
								if(isset($parameterText[1])){
									$parameterName = $parameterText[1];
								}

								array_push($parameters, new Parametre($parameterName, $parameterType,$method->_tags["@param"]->_text));
							}
						}					
						array_push($actions, new Action($classe->_package, $module, $classeName, $methodName, $desc, $parameters));
					}
				}
			}
		}

		return $actions;
	}
}



class Action{
	var $_packageName;
	var $_moduleName;
	var $_controllerName;
	var $_name;
	var $_parameters;
	var $_url;
	var $_desc;

	function Action($packageName, $moduleName, $controllerName, $actionName, $desc, $parameters){
		$this->_packageName = $packageName;
		$this->_moduleName = $moduleName;
		$this->_controllerName = substr(strtolower($controllerName),0,1) . substr($controllerName, 1, strlen($this->_controllerName)-4);
		$this->_name = $actionName;
		$this->_desc = $desc;
		$this->_parameters = $parameters;
		$this->_url = "index.php?module=".$this->_moduleName."&action=".$this->_controllerName."_".$this->_name;

	}
}

class Parametre{
	var $_name;
	var $_type;
	var $_desc;

	function Parametre($name, $type, $desc){
		if(substr($name, 0, 1)=='$'){
			$this->_name = substr($name, 1);
		}else{
			$this->_name = $name;
		}
		$this->_type = $type;
		$this->_desc = $desc;
	}

}


?>