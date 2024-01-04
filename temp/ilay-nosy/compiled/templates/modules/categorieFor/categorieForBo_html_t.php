<?php 
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/html/function.jurl.php');
function template_meta_6fa02d657e94cb825e3c5a637cae8664($t){

return $t->_meta;
}
function template_6fa02d657e94cb825e3c5a637cae8664($t){
?><?php echo $t->_vars['header']; ?>
<h1>Gestion des cat&eacute;gories de forum</h1>

<?php if(isset($t->_vars['listeCategorieForBo'])):?>	
	<h2>Liste des cat&eacute;gories de forum</h2>

	<p>&nbsp;</p>
	<p style="width:725px; text-align:right">
	    <p class="frmBouton" style="text-align:right; margin-right:7px;">
		<a class="bouton" href="<?php jtpl_function_html_jurl( $t,'categorieFor~categorieForBo_editionCategorieFor');?>">Nouvelle cat&eacute;gorie</a>
	</p>
	</p>
	<p style="height:6px">&nbsp;</p>

	<div class="ajaxZone">
		<?php echo $t->_vars['listeCategorieForBo']; ?>		
	</div>
<?php else:?>	  
	<h2>Edition d'une cat&eacute;gorie</h2>
	<div class="ajaxZone">
		<form enctype="multipart/form-data" id='categorieForForm' name='categorieForForm' action="<?php jtpl_function_html_jurl( $t,'categorieFor~categorieForBo_sauvegardeCategorieFor', array('page'=>$t->_vars['page']));?>" method="POST" tmt:validate="true" tmt:callback="displayError">
		  <input type="hidden" name="categorieFor_id" value="<?php echo $t->_vars['categorieFor']->categorieFor_id; ?>">

		  <p class="clearfix">
			<label>Libellé* :</label>
			<span class="champ">
				<input class="user_input1" type="text" style="width:400px;" name='categorieFor_libelle' tmt:required="true" tmt:minlength="3" tmt:maxlength="100" value="<?php echo htmlspecialchars($t->_vars['categorieFor']->categorieFor_libelle); ?>">
				ex : Informatique
			</span>
		  </p>
		  <p class="clearfix">
			<label>Code* :</label>
			<span class="champ">
				<input class="user_input5" type="text" style="width:50px;" name='categorieFor_code' tmt:required="true" tmt:minlength="2" tmt:maxlength="5" value="<?php echo htmlspecialchars($t->_vars['categorieFor']->categorieFor_code); ?>">
				ex : INFO
			</span>
		  </p>
		  
		  <p class="line_bottom clear">&nbsp;</p>
		  <p class="frmBouton">
			<a class="bouton submit" href="#">Valider</a>
			<a class="bouton" href="<?php jtpl_function_html_jurl( $t,'categorieFor~categorieForBo_listeCategorieFors', array('page'=>$t->_vars['page']));?>">Annuler</a>
		  </p>
		  <p class="errorMessage" id="errorMessage"></p>  
		</form>
	</div>
<?php endif;?>	  
<?php echo $t->_vars['footer']; ?><?php 
}
?>