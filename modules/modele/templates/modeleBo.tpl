{$header}
<h1>Gestion des modeles</h1>

{if isset($listeModeleBo)}	
	<h2>Liste des mod&egrave;les</h2>

	<p>&nbsp;</p>
	<p style="width:725px; text-align:right">
	    <p class="frmBouton" style="text-align:right; margin-right:7px;">
		<a class="bouton" href="{jurl 'modele~modeleBo_editionModele'}">Nouveau mod&egrave;le </a>
	</p>
	</p>
	<p style="height:6px">&nbsp;</p>

	<div class="ajaxZone">
		{$listeModeleBo}		
	</div>
{else}	  
	<h2>Edition d'un mod&egrave;le</h2>
	<div class="ajaxZone">
		<form enctype="multipart/form-data" id='modeleForm' name='modeleForm' action="{jurl 'modele~modeleBo_sauvegardeModele', array('page'=>$page)}" method="POST" tmt:validate="true" tmt:callback="displayError">
		  <input type="hidden" id="modele_id" name="modele_id" value="{$modele->modele_id}">

		  <p class="clearfix">
			<label>Marque :*</label>
			<span class="champ">
			<select class="user_input1 user_input_select input_middle" name="modele_marqueId" id="modele_marqueId"  tmt:invalidvalue="0" tmt:required="true">			
				<option value="0">Select&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
				{foreach $listeMarque as $olisteMarque}
					{if $olisteMarque->marque_id==$modele->modele_marqueId}
						{assign $selected="selected"}
					{else}
						{assign $selected=""}
					{/if}
					<option value="{$olisteMarque->marque_id}" {$selected}>{$olisteMarque->marque_libelle}</option>
				{/foreach}
			</select>
			</span>
		  </p>

		  <p class="clearfix">
			<label>Libelle :*</label>
			<span class="champ">
				<input class="user_input1" type="text" style="width:400px;" id='modele_libelle' name='modele_libelle' tmt:required="true" tmt:minlength="3" tmt:maxlength="100" value="{$modele->modele_libelle|escxml}">
			</span>
		  </p>
		  <p class="clearfix">
			<label>Code* :</label>
			<span class="champ">
				<input class="user_input5" type="text" style="width:50px;" id='modele_code' name='modele_code' tmt:required="true" tmt:minlength="2" tmt:maxlength="5" value="{$modele->modele_code|escxml}">
				ex : PEU
			</span>
		  </p>
		  
		  <p class="line_bottom clear">&nbsp;</p>
		  <p class="frmBouton">
			<a class="bouton submit" href="#">Valider</a>
			<a class="bouton" href="{jurl 'modele~modeleBo_listeModeles', array('page'=>$page)}">Annuler</a>
		  </p>
		  <p class="errorMessage" id="errorMessage"></p>  
		</form>
	</div>
{/if}	  
{$footer}