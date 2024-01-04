<?php 
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/html/function.jurl.php');
function template_meta_4788a7c2ce5a2661934c0232f6746bd6($t){

return $t->_meta;
}
function template_4788a7c2ce5a2661934c0232f6746bd6($t){
?><?php echo $t->_vars['header']; ?>
<h1>Gestion des modeles</h1>

<?php if(isset($t->_vars['listeModeleBo'])):?>	
	<h2>Liste des mod&egrave;les</h2>

	<p>&nbsp;</p>
	<p style="width:725px; text-align:right">
	    <p class="frmBouton" style="text-align:right; margin-right:7px;">
		<a class="bouton" href="<?php jtpl_function_html_jurl( $t,'modele~modeleBo_editionModele');?>">Nouveau mod&egrave;le </a>
	</p>
	</p>
	<p style="height:6px">&nbsp;</p>

	<div class="ajaxZone">
		<?php echo $t->_vars['listeModeleBo']; ?>		
	</div>
<?php else:?>	  
	<h2>Edition d'un mod&egrave;le</h2>
	<div class="ajaxZone">
		<form enctype="multipart/form-data" id='modeleForm' name='modeleForm' action="<?php jtpl_function_html_jurl( $t,'modele~modeleBo_sauvegardeModele', array('page'=>$t->_vars['page']));?>" method="POST" tmt:validate="true" tmt:callback="displayError">
		  <input type="hidden" id="modele_id" name="modele_id" value="<?php echo $t->_vars['modele']->modele_id; ?>">

		  <p class="clearfix">
			<label>Marque :*</label>
			<span class="champ">
			<select class="user_input1 user_input_select input_middle" name="modele_marqueId" id="modele_marqueId"  tmt:invalidvalue="0" tmt:required="true">			
				<option value="0">Select&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
				<?php foreach($t->_vars['listeMarque'] as $t->_vars['olisteMarque']):?>
					<?php if($t->_vars['olisteMarque']->marque_id==$t->_vars['modele']->modele_marqueId):?>
						<?php $t->_vars['selected']="selected";?>
					<?php else:?>
						<?php $t->_vars['selected']="";?>
					<?php endif;?>
					<option value="<?php echo $t->_vars['olisteMarque']->marque_id; ?>" <?php echo $t->_vars['selected']; ?>><?php echo $t->_vars['olisteMarque']->marque_libelle; ?></option>
				<?php endforeach;?>
			</select>
			</span>
		  </p>

		  <p class="clearfix">
			<label>Libelle :*</label>
			<span class="champ">
				<input class="user_input1" type="text" style="width:400px;" id='modele_libelle' name='modele_libelle' tmt:required="true" tmt:minlength="3" tmt:maxlength="100" value="<?php echo htmlspecialchars($t->_vars['modele']->modele_libelle); ?>">
			</span>
		  </p>
		  <p class="clearfix">
			<label>Code* :</label>
			<span class="champ">
				<input class="user_input5" type="text" style="width:50px;" id='modele_code' name='modele_code' tmt:required="true" tmt:minlength="2" tmt:maxlength="5" value="<?php echo htmlspecialchars($t->_vars['modele']->modele_code); ?>">
				ex : PEU
			</span>
		  </p>
		  
		  <p class="line_bottom clear">&nbsp;</p>
		  <p class="frmBouton">
			<a class="bouton submit" href="#">Valider</a>
			<a class="bouton" href="<?php jtpl_function_html_jurl( $t,'modele~modeleBo_listeModeles', array('page'=>$t->_vars['page']));?>">Annuler</a>
		  </p>
		  <p class="errorMessage" id="errorMessage"></p>  
		</form>
	</div>
<?php endif;?>	  
<?php echo $t->_vars['footer']; ?><?php 
}
?>