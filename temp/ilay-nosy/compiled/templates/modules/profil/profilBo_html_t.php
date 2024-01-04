<?php 
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/html/function.jurl.php');
function template_meta_66068508d0846e149232505f11a6f2a6($t){

return $t->_meta;
}
function template_66068508d0846e149232505f11a6f2a6($t){
?><?php echo $t->_vars['header']; ?>
<h1>Gestion des profils</h1>

<?php if(isset($t->_vars['listeProfilBo'])):?>	
	<h2>Liste des profils</h2>

	<p>&nbsp;</p>
	<p style="width:725px; text-align:right">
	    <p class="frmBouton" style="text-align:right; margin-right:7px;">
		<a class="bouton" href="<?php jtpl_function_html_jurl( $t,'profil~profilBo_editionProfil');?>">Nouveau profil </a>
	</p>
	</p>
	<p style="height:6px">&nbsp;</p>

	<div class="ajaxZone">
		<?php echo $t->_vars['listeProfilBo']; ?>		
	</div>
<?php else:?>	  
	<h2>Edition d'un profil</h2>
	<div class="ajaxZone">
		<form enctype="multipart/form-data" id='profilForm' name='profilForm' action="<?php jtpl_function_html_jurl( $t,'profil~profilBo_sauvegardeProfil', array('page'=>$t->_vars['page']));?>" method="POST" tmt:validate="true" tmt:callback="displayError">
		  <input type="hidden" name="profil_id" value="<?php echo $t->_vars['profil']->profil_id; ?>">

		  <p class="clearfix">
			<label>Libellé* :</label>
			<span class="champ">
				<input type="text" style="width:400px;" name='profil_libelle' tmt:required="true" tmt:minlength="3" tmt:maxlength="100" value="<?php echo htmlspecialchars($t->_vars['profil']->profil_libelle); ?>">
				ex : Monsieur
			</span>
		  </p>
		  <p class="clearfix">
			<label>Code* :</label>
			<span class="champ">
				<input type="text" style="width:50px;" name='profil_code' tmt:required="true" tmt:minlength="2" tmt:maxlength="5" value="<?php echo htmlspecialchars($t->_vars['profil']->profil_code); ?>">
				ex : M.
			</span>
		  </p>
		  
		  <p class="line_bottom clear">&nbsp;</p>
		  <p class="frmBouton">
			<a class="bouton submit" href="#">Valider</a>
			<a class="bouton" href="<?php jtpl_function_html_jurl( $t,'profil~profilBo_listeProfils', array('page'=>$t->_vars['page']));?>">Annuler</a>
		  </p>
		  <p class="errorMessage" id="errorMessage"></p>  
		</form>
	</div>
<?php endif;?>	  
<?php echo $t->_vars['footer']; ?><?php 
}
?>