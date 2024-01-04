{$header}
<h1>Gestion des petites annonces</h1>

{if isset($listePetiteAnnonceBo)}	
	<h2>Liste des petites annonces</h2>

	<p>&nbsp;</p>
	<p style="width:725px; text-align:right">
	    <p class="frmBouton" style="text-align:right; margin-right:7px;">
		<a class="bouton" href="{jurl 'petiteAnnonce~petiteAnnonceBo_editionPetiteAnnonce'}">Nouvelle petite annonce </a>
	</p>
	</p>
	<p style="height:6px">&nbsp;</p>

	<div class="ajaxZone">
		{$listePetiteAnnonceBo}		
	</div>
{else}	  

	<h2>Edition d'une petite annonce</h2>
	<div class="ajaxZone">
		<form enctype="multipart/form-data" id='petiteAnnonceForm' name='petiteAnnonceForm' action="{jurl 'petiteAnnonce~petiteAnnonceBo_sauvegardePetiteAnnonce', array('page'=>$page)}" method="POST" tmt:validate="true" tmt:callback="displayError">
		  <input type="hidden" id="petiteAnnonce_id" name="petiteAnnonce_id" value="{$petiteAnnonce->petiteAnnonce_id}">
		  <input type="hidden" id="petiteAnnonce_categorieAnId" name="petiteAnnonce_categorieAnId" value="{$petiteAnnonce->petiteAnnonce_categorieAnId}">
		  <p class="clearfix">
			<label>S&eacute;lectionner une cat&eacute;gorie : *</label>
			<span class="champ">
            <select class="user_input1 user_input_select input_middle" name="petiteAnnonce_categorieAnId" id="petiteAnnonce_categorieAnId"  tmt:invalidvalue="0" tmt:required="true">			
                <option value="0">Cat&eacute;gorie:</option>
                {foreach $toCategorieAns as $oCategorieAn}
                    {if $oCategorieAn->categorieAn_id==$caid}
                        {assign $selected="selected"}
                    {else}
                        {assign $selected=""}
                    {/if}
                    <option value="{$oCategorieAn->categorieAn_id}" {$selected}>{$oCategorieAn->categorieAn_libelle}</option>
                {/foreach}
            </select>
			</span>
		  </p>

		  <p class="clearfix">
			<label>R&eacute;f&eacute;rence: *</label>
			<span class="champ">
				<input readonly="readonly" class="user_input1" type="text" id="petiteAnnonce_reference" name="petiteAnnonce_reference" value="{$petiteAnnonce->petiteAnnonce_reference}" tmt:filters="" maxlength="50">
          	</span>
		  </p>
		  <p class="clearfix">
			<label>Titre: *</label>
			<span class="champ">
				<input class="user_input1" type="text" id="petiteAnnonce_titre" name="petiteAnnonce_titre" value="{$petiteAnnonce->petiteAnnonce_titre}" tmt:filters="" maxlength="150">
          	</span>
		  </p>
		  <p class="clearfix">
			<label>Description g&eacute;n&eacute;rale: *</label>
			<span class="champ">
				<textarea style="width:608px;height:150px;" class="user_input_select1" id="petiteAnnonce_description" name="petiteAnnonce_description" rows="10" tmt:required="true">{$petiteAnnonce->petiteAnnonce_description}</textarea>
          	</span>
		  </p>
		  <p class="clearfix">
			<label>Prix: </label>
			<span class="champ">
				<input style="text-align:right;" class="user_input3" type="text" id="petiteAnnonce_prix" name="petiteAnnonce_prix" value="{$petiteAnnonce->petiteAnnonce_prix}" tmt:pattern="number" tmt:filters="" maxlength="50">
                &nbsp;
                <strong>Ar</strong>
          	</span>
		  </p>

		  <p class="clearfix">
			<label>Prix info: </label>
			<span class="champ">
				<input class="user_input1" type="text" id="petiteAnnonce_prixInfo" name="petiteAnnonce_prixInfo" value="{$petiteAnnonce->petiteAnnonce_prixInfo}" tmt:filters="" maxlength="50">
          	</span>
		  </p>
		  <p class="clearfix">
			<label>Contact: </label>
			<span class="champ">
				<input class="user_input1" type="text" id="petiteAnnonce_contact" name="petiteAnnonce_contact" value="{$petiteAnnonce->petiteAnnonce_contact}" tmt:filters="" maxlength="100">                                                        
          	</span>
		  </p>

		  <h2>Publication</h2>
          
		  <p class="clearfix" style="display: block;">
			<label>Publier:</label>
			<span class="champ">
				<input class="radio" type="checkbox" id="petiteAnnonce_publier" name="petiteAnnonce_publier" {if $petiteAnnonce->petiteAnnonce_publier == 1}checked{/if} value="1">
			</span>
		  </p>	

		  <p class="clearfix" style="display: block;">
			<label>Affichage:</label>
			<span class="champ">
            <select class="user_input3 user_input_select input_middle" name="petiteAnnonce_affichage" id="petiteAnnonce_affichage"> 			
                <option value="0">Affichage:</option>                
                {assign $selected1=""}
                {assign $selected2=""}
                {assign $selected3=""}
                
                    {if $petiteAnnonce->petiteAnnonce_affichage==1}{assign $selected1="selected"}{/if}
                    {if $petiteAnnonce->petiteAnnonce_affichage==2}{assign $selected2="selected"}{/if}
                    {if $petiteAnnonce->petiteAnnonce_affichage==3}{assign $selected3="selected"}{/if}                    
                    <option value="1" {$selected1}>Mise en valeur</option>
                    <option value="2" {$selected2}>Recadr&eacute;</option>
                    <option value="3" {$selected3}>Couleur</option>
            </select>
			</span>
		  </p>	

		  <p class="line_bottom clear">&nbsp;</p>
		  <p class="frmBouton">
			<a class="bouton submit" href="#">Valider</a>
			<a class="bouton" href="{jurl 'petiteAnnonce~petiteAnnonceBo_listePetiteAnnonces', array('page'=>$page)}">Annuler</a>
		  </p>
		  <p class="errorMessage" id="errorMessage"></p>  
		</form>
	</div>
{/if}	  
{$footer}