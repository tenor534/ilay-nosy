{$header}
<h1>Gestion des societes</h1>

{if isset($listeSocieteBo)}	
	<h2>Liste des societes</h2>

	<p>&nbsp;</p>
	<p style="width:725px; text-align:right">
	    <p class="frmBouton" style="text-align:right; margin-right:7px;">
		<a class="bouton" href="{jurl 'societe~societeBo_editionSociete'}">Nouveau societe </a>
	</p>
	</p>
	<p style="height:6px">&nbsp;</p>

	<div class="ajaxZone">
		{$listeSocieteBo}		
	</div>
{else}	  
	<h2>Edition d'un societe</h2>
	<div class="ajaxZone">
		<form enctype="multipart/form-data" id='societeForm' name='societeForm' action="{jurl 'societe~societeBo_sauvegardeSociete', array('page'=>$page)}" method="POST" tmt:validate="true" tmt:callback="displayError">
		  <input type="hidden" name="societe_id" value="{$societe->societe_id}">

		  <p class="clearfix">
			<label>Civilit&eacute; : *</label>
			<span class="champ">
			<select name="societe_civiliteId" id="societe_civiliteId"  tmt:invalidvalue="0" tmt:required="true">			
			<option value="0">Select&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
				{foreach $listeCivilite as $olisteCivilite}
					{if $olisteCivilite->civilite_id==$societe->societe_civiliteId}
						{assign $selected="selected"}
					{else}
						{assign $selected=""}
					{/if}
					<option value="{$olisteCivilite->civilite_id}" {$selected}>{$olisteCivilite->civilite_libelle}</option>
				{/foreach}
			</select>
			</span>
		  </p>

		  <p class="clearfix">
			<label>Nom: *</label>
			<span class="champ"><input type="text" name='societe_nom' tmt:required="true" tmt:filters="nocommas,nodots,nohtml,ltrim" value="{$societe->societe_nom|escxml}" maxlength="100"></span>
		  </p>

	
		  <p class="clearfix">
			<label>Fonction: *</label>
			<span class="champ"><input type="text" name='societe_fonction' tmt:required="true" tmt:filters="nocommas,nodots,nohtml,ltrim" value="{$societe->societe_fonction|escxml}" maxlength="100"></span>
		  </p>
	
		  <p class="clearfix">
			<label>T&eacute;l&eacute;phone: *</label>
			<span class="champ"><input  name='societe_telephone' type="text" style="width:150px;" value="{$societe->societe_telephone|escxml}" maxlength="20" tmt:required="true" tmt:maxlength="20" tmt:pattern="phone" size="20">
			</span>
		  </p>

		  <p class="clearfix">
			<label>Fax: *</label>
			<span class="champ"><input type="text" style="width:150px;" name='societe_fax' tmt:required="true" tmt:pattern="phone" tmt:filters="nohtml,ltrim" value="{$societe->societe_fax|escxml}" maxlength="20"></span>
		  </p>
		  
		  <p class="clearfix">
			<label>Email: *</label>
			<span class="champ"><input type="text" style="width:150px;" name='societe_email' tmt:required="true" tmt:pattern="email" tmt:filters="nohtml,ltrim" value="{$societe->societe_email|escxml}" maxlength="100"></span>
		  </p>
		  <p class="clearfix">
			<label>Note: *</label>
			<span class="champ">
				<textarea cols="95" rows="10" name="societe_note" id="societe_note">{$societe->societe_note}</textarea>
			</span>
		  </p>
		  
		  <p class="line_bottom clear">&nbsp;</p>
		  <p class="frmBouton">
			<a class="bouton submit" href="#">Valider</a>
			<a class="bouton" href="{jurl 'societe~societeBo_listeSocietes', array('page'=>$page)}">Annuler</a>
		  </p>
		  <p class="errorMessage" id="errorMessage"></p>  
		</form>
	</div>
{/if}	  
{$footer}