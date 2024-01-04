<?php 
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/html/function.jurl.php');
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/common/modifier.date_format.php');
function template_meta_b9a62cdda29d6b7adac9f47603c1f1d2($t){

return $t->_meta;
}
function template_b9a62cdda29d6b7adac9f47603c1f1d2($t){
?><?php echo $t->_vars['header']; ?>
<h1>Gestion des utilisateurs</h1>

<?php if(isset($t->_vars['listeUtilisateurBo'])):?>	
	<h2>Liste des utilisateurs</h2>

	<p>&nbsp;</p>
	<p style="width:725px; text-align:right">
	    <p class="frmBouton" style="text-align:right; margin-right:7px;">
		<a class="bouton" href="<?php jtpl_function_html_jurl( $t,'utilisateur~utilisateurBo_editionUtilisateur');?>">Nouvel utilisateur </a>
	</p>
	</p>
	<p style="height:6px">&nbsp;</p>

	<div class="ajaxZone">
		<?php echo $t->_vars['listeUtilisateurBo']; ?>		
	</div>
<?php else:?>	  
	<h2>Edition d'un utilisateur</h2>
	<div class="ajaxZone">
		<form enctype="multipart/form-data" id='utilisateurForm' name='utilisateurForm' action="<?php jtpl_function_html_jurl( $t,'utilisateur~utilisateurBo_sauvegardeUtilisateur', array('page'=>$t->_vars['page']));?>" method="POST" tmt:validate="true" tmt:callback="displayError">
		  <input type="hidden" id="utilisateur_id" name="utilisateur_id" value="<?php echo $t->_vars['utilisateur']->utilisateur_id; ?>">

		  <p class="clearfix">
			<label>Photo : </label>
			<span class="champ">
				<img id="profile_pic" name="profile_pic" src="<?php echo $t->_vars['j_basepath']; ?>resize/utilisateur/images/detail/<?php if($t->_vars['utilisateur']->utilisateur_photo != ""): echo $t->_vars['utilisateur']->utilisateur_photo;  else:?>nophoto.jpg<?php endif;?>" alt="<?php echo $t->_vars['utilisateur']->utilisateur_prenom; ?> <?php echo $t->_vars['utilisateur']->utilisateur_nom; ?>">	    
			</span>
		  </p>
		  <p class="clearfix">
			<label>Profile : *</label>
			<span class="champ">
			<select class="user_input1 user_input_select input_middle" name="utilisateur_profilId" id="utilisateur_profilId"  tmt:invalidvalue="0" tmt:required="true">			
				<option value="0">Select&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
				<?php foreach($t->_vars['listeProfil'] as $t->_vars['olisteProfil']):?>
					<?php if($t->_vars['olisteProfil']->profil_id==$t->_vars['utilisateur']->utilisateur_profilId):?>
						<?php $t->_vars['selected']="selected";?>
					<?php else:?>
						<?php $t->_vars['selected']="";?>
					<?php endif;?>
					<option value="<?php echo $t->_vars['olisteProfil']->profil_id; ?>" <?php echo $t->_vars['selected']; ?>><?php echo $t->_vars['olisteProfil']->profil_libelle; ?></option>
				<?php endforeach;?>
			</select>
			</span>
		  </p>

		  <p class="clearfix">
			<label>Civilit&eacute; : *</label>
			<span class="champ">
            <select class="user_input3 user_input_select input_middle" id="utilisateur_civilite" name="utilisateur_civilite">
                <option value="0" <?php if($t->_vars['utilisateur']->utilisateur_civilite == 0):?>selected<?php endif;?>>Monsieur</option>
                <option value="1" <?php if($t->_vars['utilisateur']->utilisateur_civilite == 1):?>selected<?php endif;?>>Madame</option>
                <option value="2" <?php if($t->_vars['utilisateur']->utilisateur_civilite == 2):?>selected<?php endif;?>>Mademoiselle</option>
            </select>
			</span>
		  </p>


		  <p class="clearfix">
			<label>Prénom: *</label>
			<span class="champ"><input class="user_input1" type="text" name='utilisateur_prenom' tmt:required="true" tmt:filters="nocommas,nodots,nohtml,ltrim" value="<?php echo htmlspecialchars($t->_vars['utilisateur']->utilisateur_prenom); ?>" maxlength="100"></span>
		  </p>

		  <p class="clearfix">
			<label>Nom: *</label>
			<span class="champ"><input class="user_input1" type="text" name='utilisateur_nom' tmt:required="true" tmt:filters="nocommas,nodots,nohtml,ltrim" value="<?php echo htmlspecialchars($t->_vars['utilisateur']->utilisateur_nom); ?>" maxlength="100"></span>
		  </p>

		  <p class="clearfix">
			<label>Date de naissance: *</label>
			<span class="champ"><input class="user_input3" type="text" id="utilisateur_dateNaissance" name="utilisateur_dateNaissance" value="<?php echo jtpl_modifier_common_date_format($t->_vars['utilisateur']->utilisateur_dateNaissance,'%d/%m/%Y'); ?>" tmt:required="true" tmt:datepattern="DD/MM/YYYY" maxlength="10"></span>
		  </p>

		  <p class="clearfix">
			<label>Adresse: *</label>
			<span class="champ"><input class="user_input1" type="text" id="utilisateur_adresse" name="utilisateur_adresse" value="<?php echo $t->_vars['utilisateur']->utilisateur_adresse; ?>" tmt:required="true" tmt:filters="nodots,nohtml" maxlength="100"></span>
		  </p>
		  <p class="clearfix">
			<label>CP: *</label>
			<span class="champ"><input class="user_input5" type="text" id="utilisateur_cp" name="utilisateur_cp" value="<?php echo $t->_vars['utilisateur']->utilisateur_cp; ?>" tmt:required="true"  tmt:pattern="number" tmt:filters="nodots,nohtml" maxlength="5" ></span>
		  </p>
		  <p class="clearfix">
			<label>Ville: *</label>
			<span class="champ"><input class="user_input2" type="text" id="utilisateur_ville" name="utilisateur_ville" value="<?php echo $t->_vars['utilisateur']->utilisateur_ville; ?>" tmt:required="true" tmt:filters="nodots,nohtml" maxlength="100"></span>
		  </p>

		  <p class="clearfix">
			<label>Pays : *</label>
			<span class="champ">
			<select class="user_input1 user_input_select input_middle" name="utilisateur_paysId" id="utilisateur_paysId"  tmt:invalidvalue="0" tmt:required="true">			
			<option value="0">Select&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
				<?php foreach($t->_vars['listePays'] as $t->_vars['olistePays']):?>
					<?php if($t->_vars['olistePays']->pays_id==$t->_vars['utilisateur']->utilisateur_paysId):?>
						<?php $t->_vars['selected']="selected";?>
					<?php else:?>
						<?php $t->_vars['selected']="";?>
					<?php endif;?>
					<option value="<?php echo $t->_vars['olistePays']->pays_id; ?>" <?php echo $t->_vars['selected']; ?>><?php echo $t->_vars['olistePays']->pays_libelle; ?></option>
				<?php endforeach;?>
			</select>
			</span>
		  </p>
    
		  <p class="clearfix">
			<label>Fonction: *</label>
			<span class="champ"><input class="user_input1" type="text" name='utilisateur_fonction' tmt:required="true" tmt:filters="nocommas,nodots,nohtml,ltrim" value="<?php echo htmlspecialchars($t->_vars['utilisateur']->utilisateur_fonction); ?>" maxlength="100"></span>
		  </p>
		  <p class="clearfix">
			<label>Société: *</label>
			<span class="champ"><input class="user_input1" type="text" name='utilisateur_societe' tmt:required="true" tmt:filters="nocommas,nodots,nohtml,ltrim" value="<?php echo htmlspecialchars($t->_vars['utilisateur']->utilisateur_societe); ?>" maxlength="100"></span>
		  </p>	
		  <p class="clearfix">
			<label>Téléphone: *</label>
			<span class="champ"><input class="user_input3"  name='utilisateur_telephone' type="text" value="<?php echo htmlspecialchars($t->_vars['utilisateur']->utilisateur_telephone); ?>" maxlength="20" tmt:required="true" tmt:maxlength="20" tmt:pattern="phone" size="20">
			</span>
		  </p>


		  <p class="clearfix">
			<label>Email: *</label>
			<span class="champ"><input class="user_input1" type="text" name='utilisateur_email' tmt:required="true" tmt:pattern="email" tmt:filters="nohtml,ltrim" value="<?php echo htmlspecialchars($t->_vars['utilisateur']->utilisateur_email); ?>" maxlength="100"></span>
		  </p>
		  <p class="clearfix">
			<label>Identifiant: </label>
			<span class="champ"><input class="user_input4" type="text" id='utilisateur_login' name='utilisateur_login' tmt:required="false" tmt:filters="nocommas,nodots,nohtml,ltrim" value="<?php echo htmlspecialchars($t->_vars['utilisateur']->utilisateur_login); ?>" maxlength="100"></span>
		  </p>
		  <p class="clearfix">
			<label>Mot de passe: *</label>
			<span class="champ"><input class="user_input4" type="password" name='utilisateur_password' tmt:required="true" tmt:filters="nocommas,nodots,nohtml,ltrim" value="<?php echo htmlspecialchars($t->_vars['utilisateur']->utilisateur_password); ?>" maxlength="100"></span>
		  </p>


		  <p class="clearfix">
			<label>Question: *</label>
			<span class="champ">
                <select class="user_input1 user_input_select input_middle" id="utilisateur_question" name="utilisateur_question">
                    <option value="1" <?php if($t->_vars['utilisateur']->utilisateur_question == 1):?>selected<?php endif;?>>Question 1  .....</option>
                    <option value="2" <?php if($t->_vars['utilisateur']->utilisateur_question == 2):?>selected<?php endif;?>>Question 2  .....</option>
                    <option value="3" <?php if($t->_vars['utilisateur']->utilisateur_question == 3):?>selected<?php endif;?>>Question 3  .....</option>
                    <option value="4" <?php if($t->_vars['utilisateur']->utilisateur_question == 4):?>selected<?php endif;?>>Question 4  .....</option>
                </select>
            </span>
		  </p>

		  <p class="clearfix">
			<label>R&eacute;ponse: *</label>
			<span class="champ"><input class="user_input1" type="text" id="utilisateur_reponse" name="utilisateur_reponse" value="<?php echo $t->_vars['utilisateur']->utilisateur_reponse; ?>"  tmt:required="true"></span>
		  </p>
        



		  <p class="clearfix" style="display: block;">
			<label>Activation:</label>
			<span class="champ">
				<input type="checkbox" name="utilisateur_statut" id="utilisateur_statut" style="width:5%" value="1" <?php if($t->_vars['utilisateur']->utilisateur_statut == 1):?>checked<?php endif;?>>
			</span>
		  </p>	
		  
		  <p class="line_bottom clear">&nbsp;</p>
		  <p class="frmBouton">
			<a class="bouton submit" href="#">Valider</a>
			<a class="bouton" href="<?php jtpl_function_html_jurl( $t,'utilisateur~utilisateurBo_listeUtilisateurs', array('page'=>$t->_vars['page']));?>">Annuler</a>
		  </p>
		  <p class="errorMessage" id="errorMessage"></p>  
		</form>
	</div>
<?php endif;?>	  
<?php echo $t->_vars['footer']; ?><?php 
}
?>