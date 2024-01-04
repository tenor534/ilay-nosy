<?php 
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/html/function.jurl.php');
function template_meta_993c26eb0d1f66b97304c3d211d1c265($t){

return $t->_meta;
}
function template_993c26eb0d1f66b97304c3d211d1c265($t){
?><?php echo $t->_vars['header']; ?>
<h1>Gestion des forfaits</h1>

<?php if(isset($t->_vars['listeForfaitBo'])):?>	
	<h2>Liste des forfaits</h2>

	<p>&nbsp;</p>
	<p style="width:725px; text-align:right">
	    <p class="frmBouton" style="text-align:right; margin-right:7px;">
		<a class="bouton" href="<?php jtpl_function_html_jurl( $t,'forfait~forfaitBo_editionForfait');?>">Nouveau forfait </a>
	</p>
	</p>
	<p style="height:6px">&nbsp;</p>

	<div class="ajaxZone">
		<?php echo $t->_vars['listeForfaitBo']; ?>		
	</div>
<?php else:?>	  
	<h2>Edition d'un forfait</h2>
	<div class="ajaxZone">
		<form enctype="multipart/form-data" id='forfaitForm' name='forfaitForm' action="<?php jtpl_function_html_jurl( $t,'forfait~forfaitBo_sauvegardeForfait', array('page'=>$t->_vars['page']));?>" method="POST" tmt:validate="true" tmt:callback="displayError">
		  <input type="hidden" id="forfait_id" name="forfait_id" value="<?php echo $t->_vars['forfait']->forfait_id; ?>">

		  <p class="clearfix">
			<label>Pack :*</label>
			<span class="champ">
			<select class="user_input1 user_input_select input_middle" name="forfait_packId" id="forfait_packId"  tmt:invalidvalue="0" tmt:required="true">			
				<option value="0">Select&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
				<?php foreach($t->_vars['listePack'] as $t->_vars['olistePack']):?>
					<?php if($t->_vars['olistePack']->pack_id==$t->_vars['forfait']->forfait_packId):?>
						<?php $t->_vars['selected']="selected";?>
					<?php else:?>
						<?php $t->_vars['selected']="";?>
					<?php endif;?>
					<option value="<?php echo $t->_vars['olistePack']->pack_id; ?>" <?php echo $t->_vars['selected']; ?>><?php echo $t->_vars['olistePack']->pack_libelle; ?></option>
				<?php endforeach;?>
			</select>
			</span>
		  </p>

		  <p class="clearfix">
			<label>Libelle :*</label>
			<span class="champ">
				<input class="user_input1" type="text" style="width:400px;" id='forfait_libelle' name='forfait_libelle' tmt:required="true" tmt:minlength="3" tmt:maxlength="100" value="<?php echo htmlspecialchars($t->_vars['forfait']->forfait_libelle); ?>">
			</span>
		  </p>

		  <p class="clearfix">
			<label>Nombre d'annonces :*</label>
			<span class="champ">
				<input class="user_input1" type="text" style="width:20px;" id='forfait_nbAnnonce' name='forfait_nbAnnonce' tmt:required="true"  tmt:pattern="number" tmt:maxlength="4" value="<?php echo htmlspecialchars($t->_vars['forfait']->forfait_nbAnnonce); ?>">
			</span>
		  </p>
		  <p class="clearfix">
			<label>Nombre de photos :*</label>
			<span class="champ">
				<input class="user_input1" type="text" style="width:20px;" id='forfait_nbPhoto' name='forfait_nbPhoto' tmt:required="true"  tmt:pattern="number" tmt:maxlength="4" value="<?php echo htmlspecialchars($t->_vars['forfait']->forfait_nbPhoto); ?>">
                &nbsp;par annonce
			</span>
		  </p>
		  <p class="clearfix">
			<label>Nombre de caract&egrave;res :*</label>
			<span class="champ">
				<input class="user_input1" type="text" style="width:40px;" id='forfait_nbCaractere' name='forfait_nbCaractere' tmt:required="true"  tmt:pattern="number" tmt:maxlength="4" value="<?php echo htmlspecialchars($t->_vars['forfait']->forfait_nbCaractere); ?>">
                &nbsp;par annonce
			</span>
		  </p>

		  <p class="clearfix">
			<label>Dur&eacute;e de la parution (unit = jour) :*</label>
			<span class="champ">
				<input class="user_input1" type="text" style="width:40px;" id='forfait_dureeParution' name='forfait_dureeParution' tmt:required="true"  tmt:pattern="number" tmt:maxlength="4" value="<?php echo htmlspecialchars($t->_vars['forfait']->forfait_dureeParution); ?>">
                &nbsp;ex: 60 : pour 60j
			</span>
		  </p>

		  <p class="clearfix">
			<label>Peut voir les photos :*</label>
			<span class="champ">
				<input type="checkbox" id="forfait_voirPhoto" name="forfait_voirPhoto" style="width:5%" value="1" <?php if($t->_vars['forfait']->forfait_voirPhoto == 1):?>checked<?php endif;?>>
			</span>
		  </p>

		  <p class="clearfix">
			<label>Peut voir les contacts annonceurs :*</label>
			<span class="champ">
				<input type="checkbox" id="forfait_voirCoordonnee" name="forfait_voirCoordonnee" style="width:5%" value="1" <?php if($t->_vars['forfait']->forfait_voirCoordonnee == 1):?>checked<?php endif;?>>
			</span>
		  </p>

		  <p class="clearfix">
			<label>Affiche les photos :*</label>
			<span class="champ">
				<input type="checkbox" id="forfait_affichePhoto" name="forfait_affichePhoto" style="width:5%" value="1" <?php if($t->_vars['forfait']->forfait_affichePhoto == 1):?>checked<?php endif;?>>
			</span>
		  </p>

		  <p class="clearfix">
			<label>Affiche les coordonn&eacute;es :*</label>
			<span class="champ">
				<input type="checkbox" id="forfait_afficheCoordonnee" name="forfait_afficheCoordonnee" style="width:5%" value="1" <?php if($t->_vars['forfait']->forfait_afficheCoordonnee == 1):?>checked<?php endif;?>>
			</span>
		  </p>

		  <p class="clearfix">
			<label>Ajout d'un lien externe :*</label>
			<span class="champ">
				<input type="checkbox" id="forfait_ajoutLien" name="forfait_ajoutLien" style="width:5%" value="1" <?php if($t->_vars['forfait']->forfait_ajoutLien == 1):?>checked<?php endif;?>>
			</span>
		  </p>

		  <p class="clearfix">
			<label>Droit aux options suppl. :*</label>
			<span class="champ">
				<input type="checkbox" id="forfait_hasPlus" name="forfait_hasPlus" style="width:5%" value="1" <?php if($t->_vars['forfait']->forfait_hasPlus == 1):?>checked<?php endif;?>>
			</span>
		  </p>

		  <p class="clearfix">
			<label>Statistiques des visites :*</label>
			<span class="champ">
				<input type="checkbox" id="forfait_statistique" name="forfait_statistique" style="width:5%" value="1" <?php if($t->_vars['forfait']->forfait_statistique == 1):?>checked<?php endif;?>>
			</span>
		  </p>

		  <p class="clearfix">
			<label>Texte mis en valeur :*</label>
			<span class="champ">
				<input type="checkbox" id="forfait_texteMEV" name="forfait_texteMEV" style="width:5%" value="1" <?php if($t->_vars['forfait']->forfait_texteMEV == 1):?>checked<?php endif;?>>
			</span>
		  </p>
          
		  <p class="clearfix">
			<label>Nombre de photos suppl. :*</label>
			<span class="champ">
				<input class="user_input1" type="text" style="width:20px;" id='forfait_nbPhotoAdd' name='forfait_nbPhotoAdd' tmt:required="true"  tmt:pattern="number" tmt:maxlength="4" value="<?php echo htmlspecialchars($t->_vars['forfait']->forfait_nbPhotoAdd); ?>">
			</span>
		  </p>

		  <p class="clearfix">
			<label>Prix du pack :*</label>
			<span class="champ">
				<input class="user_input1" type="text" style="width:100px;" id='forfait_prix' name='forfait_prix' tmt:required="true"  tmt:pattern="number" tmt:maxlength="10" value="<?php echo htmlspecialchars($t->_vars['forfait']->forfait_prix); ?>">
                &nbsp;Ariary
			</span>
		  </p>
          
		  <p class="clearfix">
			<label>Prix du pack + :*</label>
			<span class="champ">
				<input class="user_input1" type="text" style="width:100px;" id='forfait_prixPlus' name='forfait_prixPlus' tmt:required="true"  tmt:pattern="number" tmt:maxlength="10" value="<?php echo htmlspecialchars($t->_vars['forfait']->forfait_prixPlus); ?>">
                &nbsp;Ariary
			</span>
		  </p>
    
		  
		  <p class="line_bottom clear">&nbsp;</p>
		  <p class="frmBouton">
			<a class="bouton submit" href="#">Valider</a>
			<a class="bouton" href="<?php jtpl_function_html_jurl( $t,'forfait~forfaitBo_listeForfaits', array('page'=>$t->_vars['page']));?>">Annuler</a>
		  </p>
		  <p class="errorMessage" id="errorMessage"></p>  
		</form>
	</div>
<?php endif;?>	  
<?php echo $t->_vars['footer']; ?><?php 
}
?>