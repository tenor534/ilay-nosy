<?php 
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/html/function.jurl.php');
function template_meta_3e5988ff8edac1a697301061f6276920($t){

return $t->_meta;
}
function template_3e5988ff8edac1a697301061f6276920($t){
?><div id="mainPage">
	<div id="navLeft">
		<div id="navContent">
			<img src="<?php echo $t->_vars['j_basepath']; ?>design/back/images/admin.jpg" alt="Gamma" id="logo_menu">
			
			<script type="text/javascript">
				var menuactive =<?php  echo $t->_vars['menusActifs'];  ?>;
				document.write(createMenu (<?php  echo $t->_vars['menus'];  ?>));
			</script>
			
		</div>
	</div>
	<div id="mainContent">
		<div id="contentHeader">
			<a style="padding-left:5px;padding-top:12px; float:left;">&nbsp;Bonjour <b><?php echo $t->_vars['prenom']; ?>&nbsp;<?php echo $t->_vars['nom']; ?></b></a>
			<a href="<?php jtpl_function_html_jurl( $t,'jauth~login_out');?>" id="deconnexion"><img src="<?php echo $t->_vars['j_basepath']; ?>design/back/images/btn_deconnexion.jpg" alt="d&eacute;connexion" /></a>
		</div>
	    <div id="contentOuter">
	    	<div id="contentInner">        
<?php 
}
?>