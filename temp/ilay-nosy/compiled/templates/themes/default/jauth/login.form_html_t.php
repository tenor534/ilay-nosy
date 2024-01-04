<?php 
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/html/meta.html.php');
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/html/function.jurl.php');
function template_meta_e867509d90cdadf5aa77293af075f3f6($t){
jtpl_meta_html_html( $t,'css',$t->_vars['j_basepath'].'design/back/css/common.css');

return $t->_meta;
}
function template_e867509d90cdadf5aa77293af075f3f6($t){
?>
<div id="login">
	<img src="<?php echo $t->_vars['j_basepath']; ?>design/back/images/login.jpg" class="logo" alt="logo"/>
	<form action="<?php jtpl_function_html_jurl( $t,'jauth~login_in');?>" method="post">
       	<input type="hidden" name="auth_url_return" value="<?php echo $t->_vars['auth_url_return']; ?>">
	  	<p><label>Identifiant</label><input type="text" value="<?php echo $t->_vars['login']; ?>" name="login" /></p>
	    <p><label>Mot de passe</label><input type="password" value="" name="password" /></p>
	    
		<p class="align_right"><input type="image" src="<?php echo $t->_vars['j_basepath']; ?>design/back/images/btn_se_connecter.gif" class="btn_image" /> </p>
	</form>
	<?php if($t->_vars['failed']):?>
		<p class="message">Login ou mot de passe incorrect</p>
	<?php endif;?>
</div><?php 
}
?>