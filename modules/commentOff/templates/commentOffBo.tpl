{$header}
<h1>Gestion des utilisateurs</h1>

{if isset($listeUtilisateurBo)}	
	<h2>Liste des utilisateurs</h2>

	<p>&nbsp;</p>
	<p style="width:725px; text-align:right">
	    <p class="frmBouton" style="text-align:right; margin-right:7px;">
		<a class="bouton" href="{jurl 'utilisateur~utilisateurBo_editionUtilisateur'}">Nouvel utilisateur </a>
	</p>
	</p>
	<p style="height:6px">&nbsp;</p>

	<div class="ajaxZone">
		{$listeUtilisateurBo}		
	</div>
{else}	  
	<h2>Edition d'un utilisateur</h2>
	<div class="ajaxZone">
		<form enctype="multipart/form-data" id='utilisateurForm' name='utilisateurForm' action="{jurl 'utilisateur~utilisateurBo_sauvegardeUtilisateur', array('page'=>$page)}" method="POST" tmt:validate="true" tmt:callback="displayError">
		  <input type="hidden" id="utilisateur_id" name="utilisateur_id" value="{$utilisateur->utilisateur_id}">

		  <p class="clearfix">
			<label>CommentOff : </label>
			<span class="champ">
				<img id="profile_pic" name="profile_pic" src="{$j_basepath}resize/utilisateur/images/detail/{if $utilisateur->utilisateur_commentOff != ""}{$utilisateur->utilisateur_commentOff}{else}nocommentOff.jpg{/if}" alt="{$utilisateur->utilisateur_prenom} {$utilisateur->utilisateur_nom}">	    
			</span>
		  </p>
		  <p class="clearfix">
			<label>Profile : *</label>
			<span class="champ">
			<select class="user_input1 user_input_select input_middle" name="utilisateur_profilId" id="utilisateur_profilId"  tmt:invalidvalue="0" tmt:required="true">			
				<option value="0">Select&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
				{foreach $listeProfil as $olisteProfil}
					{if $olisteProfil->profil_id==$utilisateur->utilisateur_profilId}
						{assign $selected="selected"}
					{else}
						{assign $selected=""}
					{/if}
					<option value="{$olisteProfil->profil_id}" {$selected}>{$olisteProfil->profil_libelle}</option>
				{/foreach}
			</select>
			</span>
		  </p>

		  <p class="clearfix">
			<label>Civilit&eacute; : *</label>
			<span class="champ">
            <select class="user_input3 user_input_select input_middle" id="utilisateur_civilite" name="utilisateur_civilite">
                <option value="0" {if $utilisateur->utilisateur_civilite == 0}selected{/if}>Monsieur</option>
                <option value="1" {if $utilisateur->utilisateur_civilite == 1}selected{/if}>Madame</option>
                <option value="2" {if $utilisateur->utilisateur_civilite == 2}selected{/if}>Mademoiselle</option>
            </select>
			</span>
		  </p>


		  <p class="clearfix">
			<label>Prénom: *</label>
			<span class="champ"><input class="user_input1" type="text" name='utilisateur_prenom' tmt:required="true" tmt:filters="nocommas,nodots,nohtml,ltrim" value="{$utilisateur->utilisateur_prenom|escxml}" maxlength="100"></span>
		  </p>

		  <p class="clearfix">
			<label>Nom: *</label>
			<span class="champ"><input class="user_input1" type="text" name='utilisateur_nom' tmt:required="true" tmt:filters="nocommas,nodots,nohtml,ltrim" value="{$utilisateur->utilisateur_nom|escxml}" maxlength="100"></span>
		  </p>

		  <p class="clearfix">
			<label>Date de naissance: *</label>
			<span class="champ"><input class="user_input3" type="text" id="utilisateur_dateNaissance" name="utilisateur_dateNaissance" value="{$utilisateur->utilisateur_dateNaissance|date_format:'%d/%m/%Y'}" tmt:required="true" tmt:datepattern="DD/MM/YYYY" maxlength="10"></span>
		  </p>

		  <p class="clearfix">
			<label>Adresse: *</label>
			<span class="champ"><input class="user_input1" type="text" id="utilisateur_adresse" name="utilisateur_adresse" value="{$utilisateur->utilisateur_adresse}" tmt:required="true" tmt:filters="nodots,nohtml" maxlength="100"></span>
		  </p>
		  <p class="clearfix">
			<label>CP: *</label>
			<span class="champ"><input class="user_input5" type="text" id="utilisateur_cp" name="utilisateur_cp" value="{$utilisateur->utilisateur_cp}" tmt:required="true"  tmt:pattern="number" tmt:filters="nodots,nohtml" maxlength="5" ></span>
		  </p>
		  <p class="clearfix">
			<label>Ville: *</label>
			<span class="champ"><input class="user_input2" type="text" id="utilisateur_ville" name="utilisateur_ville" value="{$utilisateur->utilisateur_ville}" tmt:required="true" tmt:filters="nodots,nohtml" maxlength="100"></span>
		  </p>

		  <p class="clearfix">
			<label>Pays : *</label>
			<span class="champ">
			<select class="user_input1 user_input_select input_middle" name="utilisateur_paysId" id="utilisateur_paysId"  tmt:invalidvalue="0" tmt:required="true">			
			<option value="0">Select&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
				{foreach $listePays as $olistePays}
					{if $olistePays->pays_id==$utilisateur->utilisateur_paysId}
						{assign $selected="selected"}
					{else}
						{assign $selected=""}
					{/if}
					<option value="{$olistePays->pays_id}" {$selected}>{$olistePays->pays_libelle}</option>
				{/foreach}
			</select>
			</span>
		  </p>
    
		  <p class="clearfix">
			<label>Fonction: *</label>
			<span class="champ"><input class="user_input1" type="text" name='utilisateur_fonction' tmt:required="true" tmt:filters="nocommas,nodots,nohtml,ltrim" value="{$utilisateur->utilisateur_fonction|escxml}" maxlength="100"></span>
		  </p>
		  <p class="clearfix">
			<label>Société: *</label>
			<span class="champ"><input class="user_input1" type="text" name='utilisateur_societe' tmt:required="true" tmt:filters="nocommas,nodots,nohtml,ltrim" value="{$utilisateur->utilisateur_societe|escxml}" maxlength="100"></span>
		  </p>	
		  <p class="clearfix">
			<label>Téléphone: *</label>
			<span class="champ"><input class="user_input3"  name='utilisateur_telephone' type="text" value="{$utilisateur->utilisateur_telephone|escxml}" maxlength="20" tmt:required="true" tmt:maxlength="20" tmt:pattern="phone" size="20">
			</span>
		  </p>


		  <p class="clearfix">
			<label>Email: *</label>
			<span class="champ"><input class="user_input1" type="text" name='utilisateur_email' tmt:required="true" tmt:pattern="email" tmt:filters="nohtml,ltrim" value="{$utilisateur->utilisateur_email|escxml}" maxlength="100"></span>
		  </p>
		  <p class="clearfix">
			<label>Identifiant: </label>
			<span class="champ"><input class="user_input4" type="text" id='utilisateur_login' name='utilisateur_login' tmt:required="false" tmt:filters="nocommas,nodots,nohtml,ltrim" value="{$utilisateur->utilisateur_login|escxml}" maxlength="100"></span>
		  </p>
		  <p class="clearfix">
			<label>Mot de passe: *</label>
			<span class="champ"><input class="user_input4" type="password" name='utilisateur_password' tmt:required="true" tmt:filters="nocommas,nodots,nohtml,ltrim" value="{$utilisateur->utilisateur_password|escxml}" maxlength="100"></span>
		  </p>


		  <p class="clearfix">
			<label>Question: *</label>
			<span class="champ">
                <select class="user_input1 user_input_select input_middle" id="utilisateur_question" name="utilisateur_question">
                    <option value="1" {if $utilisateur->utilisateur_question == 1}selected{/if}>Question 1  .....</option>
                    <option value="2" {if $utilisateur->utilisateur_question == 2}selected{/if}>Question 2  .....</option>
                    <option value="3" {if $utilisateur->utilisateur_question == 3}selected{/if}>Question 3  .....</option>
                    <option value="4" {if $utilisateur->utilisateur_question == 4}selected{/if}>Question 4  .....</option>
                </select>
            </span>
		  </p>

		  <p class="clearfix">
			<label>R&eacute;ponse: *</label>
			<span class="champ"><input class="user_input1" type="text" id="utilisateur_reponse" name="utilisateur_reponse" value="{$utilisateur->utilisateur_reponse}"  tmt:required="true"></span>
		  </p>
        



		  <p class="clearfix" style="display: block;">
			<label>Activation:</label>
			<span class="champ">
				<input type="checkbox" name="utilisateur_statut" id="utilisateur_statut" style="width:5%" value="1" {if $utilisateur->utilisateur_statut == 1}checked{/if}>
			</span>
		  </p>	
		  
		  <p class="line_bottom clear">&nbsp;</p>
		  <p class="frmBouton">
			<a class="bouton submit" href="#">Valider</a>
			<a class="bouton" href="{jurl 'utilisateur~utilisateurBo_listeUtilisateurs', array('page'=>$page)}">Annuler</a>
		  </p>
		  <p class="errorMessage" id="errorMessage"></p>  
		</form>
	</div>
{/if}	  
{$footer}