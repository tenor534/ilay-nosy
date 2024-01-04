<?php 
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/html/function.jurl.php');
function template_meta_0d4059ef1410f5327577cf512438e423($t){

return $t->_meta;
}
function template_0d4059ef1410f5327577cf512438e423($t){
?><?php echo $t->_vars['header']; ?>
<h1>Gestion des cat&eacute;gories d'annonce</h1>

<?php if(isset($t->_vars['listeCategorieAnBo'])):?>	
	<h2>Liste des cat&eacute;gories d'annonce</h2>

	<p>&nbsp;</p>
	<p style="width:725px; text-align:right">
	    <p class="frmBouton" style="text-align:right; margin-right:7px;">
		<a class="bouton" href="<?php jtpl_function_html_jurl( $t,'categorieAn~categorieAnBo_editionCategorieAn');?>">Nouvelle cat&eacute;gorie</a>
	</p>
	</p>
	<p style="height:6px">&nbsp;</p>

	<div class="ajaxZone">
		<?php echo $t->_vars['listeCategorieAnBo']; ?>		
	</div>
<?php else:?>	  
	<h2>Edition d'une cat&eacute;gorie</h2>
	<div class="ajaxZone">
		<form enctype="multipart/form-data" id='categorieAnForm' name='categorieAnForm' action="<?php jtpl_function_html_jurl( $t,'categorieAn~categorieAnBo_sauvegardeCategorieAn', array('page'=>$t->_vars['page']));?>" method="POST" tmt:validate="true" tmt:callback="displayError">
		  <input type="hidden" name="categorieAn_id" value="<?php echo $t->_vars['categorieAn']->categorieAn_id; ?>">

		  <p class="clearfix">
			<label>Libellé* :</label>
			<span class="champ">
				<input class="user_input1" type="text" style="width:400px;" name='categorieAn_libelle' tmt:required="true" tmt:minlength="3" tmt:maxlength="100" value="<?php echo htmlspecialchars($t->_vars['categorieAn']->categorieAn_libelle); ?>">
				ex : Immobilier location
			</span>
		  </p>
		  <p class="clearfix">
			<label>Code* :</label>
			<span class="champ">
				<input class="user_input5" type="text" style="width:50px;" name='categorieAn_code' tmt:required="true" tmt:minlength="2" tmt:maxlength="5" value="<?php echo htmlspecialchars($t->_vars['categorieAn']->categorieAn_code); ?>">
				ex : IMLOC
			</span>
		  </p>
		  
		  <p class="line_bottom clear">&nbsp;</p>
		  <p class="frmBouton">
			<a class="bouton submit" href="#">Valider</a>
			<a class="bouton" href="<?php jtpl_function_html_jurl( $t,'categorieAn~categorieAnBo_listeCategorieAns', array('page'=>$t->_vars['page']));?>">Annuler</a>
		  </p>
		  <p class="errorMessage" id="errorMessage"></p>  
		</form>
	</div>
<?php endif;?>	  
<?php echo $t->_vars['footer']; ?><?php 
}
?>