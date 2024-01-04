<?php 
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/html/function.jurl.php');
function template_meta_ec77ea0550986968012c970de3e8a8ee($t){

return $t->_meta;
}
function template_ec77ea0550986968012c970de3e8a8ee($t){
?>                <div id="logInWrap">
                    <h3 class="signedOut">Bienvenue sur ilay NOSY!</h3>
                    <p class="regText">Connectez-vous pour placer et publier gratuitement vos annonces sur le service d'annonces classées à l'&eacute;chelle malgache en quelques minutes.</p>
                    <ul class="signInOrJoin">
                        <li><a title="S'identifier" class="signIn" href="<?php jtpl_function_html_jurl( $t,'commun~communFo_login');?>">S'identifier</a></li>
                        <li class="regTextPale homeOr">ou</li><li><a title="Cr&eacute;er un compte pour devenir membre" class="joinNow" href="<?php jtpl_function_html_jurl( $t,'commun~communFo_register');?>">Cr&eacute;er un compte</a> pour devenir membre.</li>
                    </ul>
                </div><!--  logInWrap: [end] -->
<?php 
}
?>