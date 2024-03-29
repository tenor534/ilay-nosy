<?php
/**
* @package    jelix
* @subpackage coord_plugin
* @author     Croes Gérald
* @contributor  Laurent Jouanneau, Frédéric Guillot, Antoine Detante
* @copyright  2001-2005 CopixTeam, 2005-2006 Laurent Jouanneau, 2007 Frédéric Guillot, 2007 Antoine Detante
*
* This class was get originally from an experimental branch of the Copix project
* (PluginAuth, Copix 2.3dev20050901, http://www.copix.org)
* Few lines of code are still copyrighted 2001-2005 CopixTeam (LGPL licence).
* Initial authors of this Copix classes are Gerald Croes and Laurent Jouanneau,
* and this class was adapted for Jelix by Laurent Jouanneau
*
* @licence  http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public Licence, see LICENCE file
*/
require_once(JELIX_LIB_AUTH_PATH.'jAuth.class.php');
require_once(JELIX_LIB_AUTH_PATH.'jAuthUser.class.php');

/**
* @package    jelix
* @subpackage coord_plugin
*/
class AuthCoordPlugin implements jICoordPlugin {
    public $config;

    function __construct($conf){
        $this->config = $conf;

        if (!isset($this->config['session_name'])
            || $this->config['session_name'] == ''){
                
            $this->config['session_name'] = 'JELIX_USER';
        }
    }

    /**
     * @param    array  $params   plugin parameters for the current action
     * @return null or jSelectorAct  if action should change
     */
    public function beforeAction ($params){
        $notLogged = false;
        $badip = false;
        $selector = null;
        // Check if auth cookie exist and user isn't logged on
        if (isset($this->config['persistant_enable']) && $this->config['persistant_enable'] && !jAuth::isConnected()){
            if(isset($this->config['persistant_cookie_name']) && isset($this->config['persistant_crypt_key'])){
                $cookieName=$this->config['persistant_cookie_name'];
                if(isset($_COOKIE[$cookieName]['login']) && isset($_COOKIE[$cookieName]['passwd']) && strlen($_COOKIE[$cookieName]['passwd'])>0){
                    $login = $_COOKIE[$cookieName]['login'];
                    $encryptedPassword=$_COOKIE[$cookieName]['passwd'];
                    jAuth::login($login,jCrypt::decrypt($encryptedPassword,$this->config['persistant_crypt_key']));
                }
            }
            else{
                throw new jException('jelix~auth.error.persistant.incorrectconfig','persistant_cookie_name, persistant_crypt_key');
            }
        }
        //Do we check the ip ?
        if ($this->config['secure_with_ip']){
            if (! isset ($_SESSION['JELIX_AUTH_SECURE_WITH_IP'])){
                $_SESSION['JELIX_AUTH_SECURE_WITH_IP'] = $this->_getIpForSecure ();
            }else{
                if (($_SESSION['JELIX_AUTH_SECURE_WITH_IP'] != $this->_getIpForSecure ())){
                    session_destroy ();
                    $selector = new jSelectorAct($this->config['bad_ip_action']);
                    $notLogged = true;
                    $badip = true;
                }
            }
        }
        
        //Creating the user's object if needed
        if (! isset ($_SESSION[$this->config['session_name']])){
            $notLogged = true;
            $_SESSION[$this->config['session_name']] = new jDummyAuthUser();
        }else{
            $notLogged = ! jAuth::isConnected();
        }
        if(!$notLogged && $this->config['timeout']){
            if(isset($_SESSION['JELIX_AUTH_LASTTIME'])){
                if((mktime() - $_SESSION['JELIX_AUTH_LASTTIME'] )> ($this->config['timeout'] *60)){
                    $notLogged = true;
                    jAuth::logout();
                    unset($_SESSION['JELIX_AUTH_LASTTIME']);
                }else{
                    $_SESSION['JELIX_AUTH_LASTTIME'] =mktime();
                }
            }else{
                $_SESSION['JELIX_AUTH_LASTTIME'] =mktime();
            }
        }
        $needAuth = isset($params['auth.required']) ? ($params['auth.required']==true):$this->config['auth_required'];
        $authok = false;

        if($needAuth){
            if($notLogged){
                if($this->config['on_error'] == 1 
                    || !$GLOBALS['gJCoord']->request->isAllowedResponse('jResponseRedirect')){
                    throw new jException($this->config['error_message']);
                }else{
                    if(!$badip){
/*
*	auteur : Ramaroson Tahina
*	modification : gestion de l'url de retour pour l'authentification dans le module provider
*	ajout du paramètre de plugin : auth.module
*/
						if(isset($params['auth.module']) && $params['auth.module']!='default')
							$selector= new jSelectorAct('jauth~login_'.$params['auth.module']);
						else
/* fin modif */
                        $selector= new jSelectorAct($this->config['on_error_action']);
                    }
                }
            }else{
                $authok= true;
            }
        }else{
          $authok= true;
        }

        return $selector;
    }


    public function beforeOutput(){}

    public function afterProcess (){}

    /**
    * Getting IP adress of the user
    * @return string
    * @access private
    */
    private function _getIpForSecure (){
        //this method is heavily based on the article found on
        // phpbuilder.com, and from the comments on the official phpdoc.
        if (isset ($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR']){
            $IP_ADDR = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else if (isset ($_SERVER['HTTP_CLIENT_IP']) && $_SERVER['HTTP_CLIENT_IP']){
            $IP_ADDR =  $_SERVER['HTTP_CLIENT_IP'];
        }else{
            $IP_ADDR = $_SERVER['REMOTE_ADDR'];
        }

        // get server ip and resolved it
        $FIRE_IP_ADDR = $_SERVER['REMOTE_ADDR'];
        $ip_resolved = gethostbyaddr($FIRE_IP_ADDR);
        // builds server ip infos string
        $FIRE_IP_LITT = ($FIRE_IP_ADDR != $ip_resolved && $ip_resolved) ? $FIRE_IP_ADDR." - ". $ip_resolved : $FIRE_IP_ADDR;
        // builds client ip full infos string
        $toReturn = ($IP_ADDR != $FIRE_IP_ADDR) ? "$IP_ADDR | $FIRE_IP_LITT" : $FIRE_IP_LITT;
        return $toReturn;
    }
}
?>
