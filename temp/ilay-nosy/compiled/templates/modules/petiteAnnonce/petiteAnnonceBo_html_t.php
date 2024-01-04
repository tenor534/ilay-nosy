<?php 
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/html/function.jurl.php');
function template_meta_4201635a8f5e7bbe7d08bb63e0e8c4a9($t){

return $t->_meta;
}
function template_4201635a8f5e7bbe7d08bb63e0e8c4a9($t){
?><?php echo $t->_vars['header']; ?>
<h1>Gestion des petites annonces</h1>

<?php if(isset($t->_vars['listePetiteAnnonceBo'])):?>	
	<h2>Liste des petites annonces</h2>

	<p>&nbsp;</p>
	<p style="width:725px; text-align:right">
	    <p class="frmBouton" style="text-align:right; margin-right:7px;">
		<a class="bouton" href="<?php jtpl_function_html_jurl( $t,'petiteAnnonce~petiteAnnonceBo_editionPetiteAnnonce');?>">Nouvelle petite annonce </a>
	</p>
	</p>
	<p style="height:6px">&nbsp;</p>

	<div class="ajaxZone">
		<?php echo $t->_vars['listePetiteAnnonceBo']; ?>		
	</div>
<?php else:?>	  

	<h2>Edition d'une petite annonce</h2>
	<div class="ajaxZone">
		<form enctype="multipart/form-data" id='petiteAnnonceForm' name='petiteAnnonceForm' action="<?php jtpl_function_html_jurl( $t,'petiteAnnonce~petiteAnnonceBo_sauvegardePetiteAnnonce', array('page'=>$t->_vars['page']));?>" method="POST" tmt:validate="true" tmt:callback="displayError">
		  <input type="hidden" id="petiteAnnonce_id" name="petiteAnnonce_id" value="<?php echo $t->_vars['petiteAnnonce']->petiteAnnonce_id; ?>">
		  <input type="hidden" id="petiteAnnonce_categorieAnId" name="petiteAnnonce_categorieAnId" value="<?php echo $t->_vars['petiteAnnonce']->petiteAnnonce_categorieAnId; ?>">
		  <p class="clearfix">
			<label>S&eacute;lectionner une cat&eacute;gorie : *</label>
			<span class="champ">
            <select class="user_input1 user_input_select input_middle" name="petiteAnnonce_categorieAnId" id="petiteAnnonce_categorieAnId"  tmt:invalidvalue="0" tmt:required="true">			
                <option value="0">Cat&eacute;gorie:</option>
                <?php foreach($t->_vars['toCategorieAns'] as $t->_vars['oCategorieAn']):?>
                    <?php if($t->_vars['oCategorieAn']->categorieAn_id==$t->_vars['caid']):?>
                        <?php $t->_vars['selected']="selected";?>
                    <?php else:?>
                        <?php $t->_vars['selected']="";?>
                    <?php endif;?>
                    <option value="<?php echo $t->_vars['oCategorieAn']->categorieAn_id; ?>" <?php echo $t->_vars['selected']; ?>><?php echo $t->_vars['oCategorieAn']->categorieAn_libelle; ?></option>
                <?php endforeach;?>
            </select>
			</span>
		  </p>

		  <p class="clearfix">
			<label>R&eacute;f&eacute;rence: *</label>
			<span class="champ">
				<input readonly="readonly" class="user_input1" type="text" id="petiteAnnonce_reference" name="petiteAnnonce_reference" value="<?php echo $t->_vars['petiteAnnonce']->petiteAnnonce_reference; ?>" tmt:filters="" maxlength="50">
          	</span>
		  </p>
		  <p class="clearfix">
			<label>Titre: *</label>
			<span class="champ">
				<input class="user_input1" type="text" id="petiteAnnonce_titre" name="petiteAnnonce_titre" value="<?php echo $t->_vars['petiteAnnonce']->petiteAnnonce_titre; ?>" tmt:filters="" maxlength="150">
          	</span>
		  </p>
		  <p class="clearfix">
			<label>Description g&eacute;n&eacute;rale: *</label>
			<span class="champ">
				<textarea style="width:608px;height:150px;" class="user_input_select1" id="petiteAnnonce_description" name="petiteAnnonce_description" rows="10" tmt:required="true"><?php echo $t->_vars['petiteAnnonce']->petiteAnnonce_description; ?></textarea>
          	</span>
		  </p>
		  <p class="clearfix">
			<label>Prix: </label>
			<span class="champ">
				<input style="text-align:right;" class="user_input3" type="text" id="petiteAnnonce_prix" name="petiteAnnonce_prix" value="<?php echo $t->_vars['petiteAnnonce']->petiteAnnonce_prix; ?>" tmt:pattern="number" tmt:filters="" maxlength="50">
                &nbsp;
                <strong>Ar</strong>
          	</span>
		  </p>

		  <p class="clearfix">
			<label>Prix info: </label>
			<span class="champ">
				<input class="user_input1" type="text" id="petiteAnnonce_prixInfo" name="petiteAnnonce_prixInfo" value="<?php echo $t->_vars['petiteAnnonce']->petiteAnnonce_prixInfo; ?>" tmt:filters="" maxlength="50">
          	</span>
		  </p>
		  <p class="clearfix">
			<label>Contact: </label>
			<span class="champ">
				<input class="user_input1" type="text" id="petiteAnnonce_contact" name="petiteAnnonce_contact" value="<?php echo $t->_vars['petiteAnnonce']->petiteAnnonce_contact; ?>" tmt:filters="" maxlength="100">                                                        
          	</span>
		  </p>

		  <h2>Publication</h2>
          
		  <p class="clearfix" style="display: block;">
			<label>Publier:</label>
			<span class="champ">
				<input class="radio" type="checkbox" id="petiteAnnonce_publier" name="petiteAnnonce_publier" <?php if($t->_vars['petiteAnnonce']->petiteAnnonce_publier == 1):?>checked<?php endif;?> value="1">
			</span>
		  </p>	

		  <p class="clearfix" style="display: block;">
			<label>Affichage:</label>
			<span class="champ">
            <select class="user_input3 user_input_select input_middle" name="petiteAnnonce_affichage" id="petiteAnnonce_affichage"> 			
                <option value="0">Affichage:</option>                
                <?php $t->_vars['selected1']="";?>
                <?php $t->_vars['selected2']="";?>
                <?php $t->_vars['selected3']="";?>
                
                    <?php if($t->_vars['petiteAnnonce']->petiteAnnonce_affichage==1): $t->_vars['selected1']="selected"; endif;?>
                    <?php if($t->_vars['petiteAnnonce']->petiteAnnonce_affichage==2): $t->_vars['selected2']="selected"; endif;?>
                    <?php if($t->_vars['petiteAnnonce']->petiteAnnonce_affichage==3): $t->_vars['selected3']="selected"; endif;?>                    
                    <option value="1" <?php echo $t->_vars['selected1']; ?>>Mise en valeur</option>
                    <option value="2" <?php echo $t->_vars['selected2']; ?>>Recadr&eacute;</option>
                    <option value="3" <?php echo $t->_vars['selected3']; ?>>Couleur</option>
            </select>
			</span>
		  </p>	

		  <p class="line_bottom clear">&nbsp;</p>
		  <p class="frmBouton">
			<a class="bouton submit" href="#">Valider</a>
			<a class="bouton" href="<?php jtpl_function_html_jurl( $t,'petiteAnnonce~petiteAnnonceBo_listePetiteAnnonces', array('page'=>$t->_vars['page']));?>">Annuler</a>
		  </p>
		  <p class="errorMessage" id="errorMessage"></p>  
		</form>
	</div>
<?php endif;?>	  
<?php echo $t->_vars['footer']; ?><?php 
}
?>