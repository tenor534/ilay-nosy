<?php 
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/html/function.jurl.php');
function template_meta_53fa7299cb4d98ee9f97bcfcecd77c93($t){

return $t->_meta;
}
function template_53fa7299cb4d98ee9f97bcfcecd77c93($t){
?><?php echo $t->_vars['header']; ?>
<h1>Gestion des cat&eacute;gories d'actualit&eacute;</h1>

<?php if(isset($t->_vars['listeCategorieActBo'])):?>	
	<h2>Liste des cat&eacute;gories d'actualit&eacute;</h2>

	<p>&nbsp;</p>
	<p style="width:725px; text-align:right">
	    <p class="frmBouton" style="text-align:right; margin-right:7px;">
		<a class="bouton" href="<?php jtpl_function_html_jurl( $t,'categorieAct~categorieActBo_editionCategorieAct');?>">Nouvelle cat&eacute;gorie</a>
	</p>
	</p>
	<p style="height:6px">&nbsp;</p>

	<div class="ajaxZone">
		<?php echo $t->_vars['listeCategorieActBo']; ?>		
	</div>
<?php else:?>	  
	<h2>Edition d'une cat&eacute;gorie d'actualit&eacute;</h2>
	<div class="ajaxZone">
		<form enctype="multipart/form-data" id='categorieActForm' name='categorieActForm' action="<?php jtpl_function_html_jurl( $t,'categorieAct~categorieActBo_sauvegardeCategorieAct', array('page'=>$t->_vars['page']));?>" method="POST" tmt:validate="true" tmt:callback="displayError">
		  <input type="hidden" name="categorieAct_id" value="<?php echo $t->_vars['categorieAct']->categorieAct_id; ?>">

		  <p class="clearfix">
			<label>Libellé* :</label>
			<span class="champ">
				<input class="user_input1" type="text" style="width:400px;" name='categorieAct_libelle' tmt:required="true" tmt:minlength="3" tmt:maxlength="100" value="<?php echo htmlspecialchars($t->_vars['categorieAct']->categorieAct_libelle); ?>">
				ex : International
			</span>
		  </p>
		  <p class="clearfix">
			<label>Code* :</label>
			<span class="champ">
				<input class="user_input5" type="text" style="width:50px;" name='categorieAct_code' tmt:required="true" tmt:minlength="2" tmt:maxlength="5" value="<?php echo htmlspecialchars($t->_vars['categorieAct']->categorieAct_code); ?>">
				ex : INTER
			</span>
		  </p>
		  
		  <p class="line_bottom clear">&nbsp;</p>
		  <p class="frmBouton">
			<a class="bouton submit" href="#">Valider</a>
			<a class="bouton" href="<?php jtpl_function_html_jurl( $t,'categorieAct~categorieActBo_listeCategorieActs', array('page'=>$t->_vars['page']));?>">Annuler</a>
		  </p>
		  <p class="errorMessage" id="errorMessage"></p>  
		</form>
	</div>
<?php endif;?>	  
<?php echo $t->_vars['footer']; ?><?php 
}
?>