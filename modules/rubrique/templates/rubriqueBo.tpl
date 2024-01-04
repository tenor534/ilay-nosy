{$header}
<h1>Gestion des rubriques</h1>

{if isset($listeRubriqueBo)}	
	<h2>Liste des rubriques</h2>

	<p>&nbsp;</p>
	<p style="width:725px; text-align:right">
	    <p class="frmBouton" style="text-align:right; margin-right:7px;">
		<a class="bouton" href="{jurl 'rubrique~rubriqueBo_editionRubrique'}">Nouvelle rubrique </a>
	</p>
	</p>
	<p style="height:6px">&nbsp;</p>

	<div class="ajaxZone">
		{$listeRubriqueBo}		
	</div>
{else}	  
	<h2>Edition d'une rubrique</h2>
	<div class="ajaxZone">
		<form enctype="multipart/form-data" id='rubriqueForm' name='rubriqueForm' action="{jurl 'rubrique~rubriqueBo_sauvegardeRubrique', array('page'=>$page)}" method="POST" tmt:validate="true" tmt:callback="displayError">
		  <input type="hidden" id="rubrique_id" name="rubrique_id" value="{$rubrique->rubrique_id}">

		  <p class="clearfix">
			<label>Cat&eacute;gorie : *</label>
			<span class="champ">
			<select class="user_input1 user_input_select input_middle" name="rubrique_categorieAnId" id="rubrique_categorieAnId"  tmt:invalidvalue="0" tmt:required="true">			
				<option value="0">Select&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
				{foreach $listeCategorieAn as $olisteCategorieAn}
					{if $olisteCategorieAn->categorieAn_id==$rubrique->rubrique_categorieAnId}
						{assign $selected="selected"}
					{else}
						{assign $selected=""}
					{/if}
					<option value="{$olisteCategorieAn->categorieAn_id}" {$selected}>{$olisteCategorieAn->categorieAn_libelle}</option>
				{/foreach}
			</select>
			</span>
		  </p>

		  <div id="divRubrique">
          <p class="clearfix">
			<label>Parent : *</label>
			<span class="champ">
			<select class="user_input1 user_input_select input_middle" name="rubrique_parentId" id="rubrique_parentId">			
				<option value="0">Racine</option>
				{foreach $listeRubrique as $olisteRubrique}
					{if $olisteRubrique->rubrique_id==$rubrique->rubrique_parentId}
						{assign $selected="selected"}
					{else}
						{assign $selected=""}
					{/if}
					{assign $indent=""}
                    {for $i=0; $i<$olisteRubrique->rubrique_level;$i++}
						{assign $indent=$indent . " - "}
                    {/for}
					<option value="{$olisteRubrique->rubrique_id}" {$selected}>{$indent}{$olisteRubrique->rubrique_libelle}</option>
				{/foreach}
			</select>
			</span>
		  </p>
          </div>

		  <p class="clearfix">
			<label>Path: *</label>
			<span class="champ"><input readonly="readonly" class="user_input1" type="text" id='rubrique_path' name='rubrique_path' tmt:filters="nohtml" value="{$rubrique->rubrique_path|escxml}" maxlength="100"></span>
		  </p>

		  <p class="clearfix">
			<label>Libellé* :</label>
			<span class="champ">
				<input class="user_input1" type="text" style="width:400px;" name='rubrique_libelle' tmt:required="true" tmt:minlength="3" tmt:maxlength="100" value="{$rubrique->rubrique_libelle|escxml}">
				ex : Appartements
			</span>
		  </p>
		  <p class="clearfix">
			<label>Code* :</label>
			<span class="champ">
				<input class="user_input5" type="text" style="width:50px;" name='rubrique_code' tmt:required="true" tmt:minlength="2" tmt:maxlength="5" value="{$rubrique->rubrique_code|escxml}">
				ex : APPART
			</span>
		  </p>

		  
		  <p class="line_bottom clear">&nbsp;</p>
		  <p class="frmBouton">
			<a class="bouton submit" href="#">Valider</a>
			<a class="bouton" href="{jurl 'rubrique~rubriqueBo_listeRubriques', array('page'=>$page)}">Annuler</a>
		  </p>
		  <p class="errorMessage" id="errorMessage"></p>  
		</form>
	</div>
{/if}	  
{$footer}