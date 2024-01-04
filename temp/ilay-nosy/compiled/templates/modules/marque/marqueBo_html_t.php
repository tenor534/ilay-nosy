<?php 
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/html/function.jurl.php');
function template_meta_cb97a36f458e07079970f2505308addc($t){

return $t->_meta;
}
function template_cb97a36f458e07079970f2505308addc($t){
?><?php echo $t->_vars['header']; ?>
<h1>Gestion des marques</h1>

<?php if(isset($t->_vars['listeMarqueBo'])):?>	
	<h2>Liste des marques</h2>

	<p>&nbsp;</p>
	<p style="width:725px; text-align:right">
	    <p class="frmBouton" style="text-align:right; margin-right:7px;">
		<a class="bouton" href="<?php jtpl_function_html_jurl( $t,'marque~marqueBo_editionMarque');?>">Nouvelle marque </a>
	</p>
	</p>
	<p style="height:6px">&nbsp;</p>

	<div class="ajaxZone">
		<?php echo $t->_vars['listeMarqueBo']; ?>		
	</div>
<?php else:?>	  
	<h2>Edition d'une marque</h2>
	<div class="ajaxZone">
		<form enctype="multipart/form-data" id='marqueForm' name='marqueForm' action="<?php jtpl_function_html_jurl( $t,'marque~marqueBo_sauvegardeMarque', array('page'=>$t->_vars['page']));?>" method="POST" tmt:validate="true" tmt:callback="displayError">
		  <input type="hidden" id="marque_id" name="marque_id" value="<?php echo $t->_vars['marque']->marque_id; ?>">

		  <p class="clearfix">
			<label>Libellé* :</label>
			<span class="champ">
				<input class="user_input1" type="text" style="width:400px;" id='marque_libelle' name='marque_libelle' tmt:required="true" tmt:minlength="3" tmt:maxlength="100" value="<?php echo htmlspecialchars($t->_vars['marque']->marque_libelle); ?>">
				ex : Peugeot
			</span>
		  </p>
		  <p class="clearfix">
			<label>Code* :</label>
			<span class="champ">
				<input class="user_input5" type="text" style="width:50px;" id='marque_code' name='marque_code' tmt:required="true" tmt:minlength="2" tmt:maxlength="5" value="<?php echo htmlspecialchars($t->_vars['marque']->marque_code); ?>">
				ex : PEU
			</span>
		  </p>
		  
		  <p class="line_bottom clear">&nbsp;</p>
		  <p class="frmBouton">
			<a class="bouton submit" href="#">Valider</a>
			<a class="bouton" href="<?php jtpl_function_html_jurl( $t,'marque~marqueBo_listeMarques', array('page'=>$t->_vars['page']));?>">Annuler</a>
		  </p>
		  <p class="errorMessage" id="errorMessage"></p>  
		</form>
	</div>
<?php endif;?>	  
<?php echo $t->_vars['footer']; ?><?php 
}
?>