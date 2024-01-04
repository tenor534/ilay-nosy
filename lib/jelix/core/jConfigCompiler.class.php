<?php
/**
* @package  jelix
* @subpackage core
* @author   Jouanneau Laurent
* @contributor
* @copyright   2006-2007 Jouanneau laurent
* @link        http://www.jelix.org
* @licence  GNU Lesser General Public Licence see LICENCE file or http://www.gnu.org/licenses/lgpl.html
*/

/**
 * jConfigCompiler merge two ini file in a single array and store it in a temporary file
 * This is a static class
 * @package  jelix
 * @subpackage core
 * @static
 */
class jConfigCompiler {

    private function __construct (){ }

    /**
     * read the given ini file. Merge it with the content of defaultconfig.ini.php
     * It also calculates some options. It stores the result in a temporary file
     * @param string $configFile the config file name
     * @return object an object which contains configuration values
     */
    static public function read($configFile){

        $config = jIniFile::read(JELIX_LIB_CORE_PATH.'defaultconfig.ini.php');

        if( $commonConfig = @parse_ini_file(JELIX_APP_CONFIG_PATH.'defaultconfig.ini.php',true)){
            self::_mergeConfig($config, $commonConfig);
        }

        if($configFile !='defaultconfig.ini.php'){
            if(!file_exists(JELIX_APP_CONFIG_PATH.$configFile))
                die("Jelix config file $configFile is missing !");
            if( false === ($userConfig = @parse_ini_file(JELIX_APP_CONFIG_PATH.$configFile,true)))
                die("Syntax error in the Jelix config file $configFile !");
            self::_mergeConfig($config, $userConfig);
        }
        $config['isWindows'] = (substr(PHP_OS,0,3) == 'WIN');
        if(trim( $config['startAction']) == '')
             $config['startAction'] = '_';

        $config['_allBasePath'] = array();
        $config['_modulesPathList'] = self::_loadPathList($config['modulesPath'], $config['_allBasePath']);

        self::_loadPluginsPathList($config);

        if($config['checkTrustedModules']){
            $config['_trustedModules'] = explode(',',$config['trustedModules']);
        }else{
            $config['_trustedModules'] = array_keys($config['_modulesPathList']);
        }
        $path=$config['urlengine']['basePath'];
        if($path!='/' && $path!=''){
            if($path{0} != '/') $path='/'.$path;
            if(substr($path,-1) != '/') $path.='/';
            $config['urlengine']['basePath'] = $path;
        }

        if($path!='' && $config['urlengine']['jelixWWWPath']{0} != '/')
            $config['urlengine']['jelixWWWPath'] = $path.$config['urlengine']['jelixWWWPath'];

        /*if(preg_match("/^([a-zA-Z]{2})(?:_([a-zA-Z]{2}))?$/",$config['locale'],$m)){
            if(!isset($m[2])){
                $m[2] = $m[1];
            }
            $config['defaultLang'] = strtolower($m[1]);
            $config['defaultCountry'] = strtoupper($m[2]);
            $config['locale'] = $config['defaultLang'].'_'.$config['defaultCountry'];
        }else{
            die("Syntax error in the locale parameter in Jelix config file $configFile !");
        }*/

        if(BYTECODE_CACHE_EXISTS){
            $filename=JELIX_APP_TEMP_PATH.str_replace('/','~',$configFile).'.conf.php';
            if ($f = @fopen($filename, 'wb')) {
                fwrite($f, '<?php $config = '.var_export($config,true).";\n?>");
                fclose($f);
            } else {
                throw new Exception('(24)Error while writing config cache file '.$filename);
            }
        }else{
            jIniFile::write($config, JELIX_APP_TEMP_PATH.str_replace('/','~',$configFile).'.resultini.php');
        }
        $config = (object) $config;
        return $config;
    }

    /**
     * Analyse and check the "lib:" and "app:" path.
     * @param array $list list of "lib:*" and "app:*" path
     * @return array list of full path
     */
    static private function _loadPathList($list, &$allBasePath){
        $list = split(' *, *',$list);
        array_unshift($list, JELIX_LIB_PATH.'core-modules/');
        $result=array();
        foreach($list as $k=>$path){
            $p = str_replace(array('lib:','app:'), array(LIB_PATH, JELIX_APP_PATH), $path);
            if(!file_exists($p)){
                trigger_error('The path, '.$path.' given in the jelix config, doesn\'t exists !',E_USER_ERROR);
                exit;
            }
            if(substr($p,-1) !='/')
                $p.='/';
            if($k!=0) 
                $allBasePath[]=$p;
            if ($handle = opendir($p)) {
                while (false !== ($f = readdir($handle))) {
                    if ($f{0} != '.' && is_dir($p.$f)) {
                        $result[$f]=$p.$f.'/';
                    }
                }
                closedir($handle);
            }
        }
        return $result;
    }


    /**
     * Analyse plugin paths
     * @param array|object $config the config container
     */
    static private function _loadPluginsPathList(&$config){
        $list = split(' *, *',$config['pluginsPath']);
        array_unshift($list, JELIX_LIB_PATH.'plugins/'); 
        foreach($list as $k=>$path){
            $p = str_replace(array('lib:','app:'), array(LIB_PATH, JELIX_APP_PATH), $path);
            if(!file_exists($p)){
                trigger_error('The path, '.$path.' given in the jelix config, doesn\'t exists !',E_USER_ERROR);
                exit;
            }
            if(substr($p,-1) !='/')
                $p.='/';

            if ($handle = opendir($p)) {
                while (false !== ($f = readdir($handle))) {
                    if ($f{0} != '.' && is_dir($p.$f)) {
                        if($subdir = opendir($p.$f)){
                            if($k!=0) 
                               $config['_allBasePath'][]=$p.$f.'/';
                            while (false !== ($subf = readdir($subdir))) {
                                if ($subf{0} != '.' && is_dir($p.$f.'/'.$subf)) {
                                    if($f == 'tpl'){
                                        $config['_tplpluginsPathList_'.$subf][] = $p.$f.'/'.$subf.'/';
                                    }else{
                                        $config['_pluginsPathList_'.$f][$subf] =$p.$f.'/'.$subf.'/';
                                    }
                                }
                            }
                            closedir($subdir);
                        }
                    }
                }
                closedir($handle);
            }
        }
    }

    /**
     * merge two array which are the result of a parse_ini_file call
     * @param $array the main array
     * @param $tomerge the array to merge in the first one
     */
    static private function _mergeConfig(&$array, $tomerge){

        foreach($tomerge as $k=>$v){
            if(!isset($array[$k])){
                $array[$k] = $v;
                continue;
            }
            if($k{1} == '_')
                continue;
            if(is_array($v)){
                $array[$k] = array_merge($array[$k], $v);
            }else{
                $array[$k] = $v;
            }
        }

    }
}

?>
