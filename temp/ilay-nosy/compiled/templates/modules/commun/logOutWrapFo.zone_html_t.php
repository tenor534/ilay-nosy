<?php 
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/html/function.jurl.php');
function template_meta_1bc5a11fe2d90d402200da546ba57577($t){

return $t->_meta;
}
function template_1bc5a11fe2d90d402200da546ba57577($t){
?>                <div id="logInWrap">
                    <h3 class="signedOut">Bienvenue <?php echo $t->_vars['zPrenom']; ?> <?php echo $t->_vars['zNom']; ?>!</h3>
                    <p class="regText">Maintenant placez et publiez gratuitement vos annonces sur le service d'annonces classées à l'&eacute;chelle malgache en quelques minutes.</p>
                    <ul class="signInOrJoin">
                        <li><a title="Se d&eacute;conecter" class="signIn" href="<?php jtpl_function_html_jurl( $t,'commun~communFo_deconnexion');?>">Se d&eacute;conecter</a></li>
                        <li class="regTextPale homeOr">ou</li><li><a title="Acc&eacute;der &agrave; votre espace membre" class="joinNow" href="<?php jtpl_function_html_jurl( $t,'membre~membreFo_tableBord');?>">Acc&eacute;der &agrave; votre espace membre</a></li>
                    </ul>
                </div><!--  logInWrap: [end] -->
<?php 
}
?>