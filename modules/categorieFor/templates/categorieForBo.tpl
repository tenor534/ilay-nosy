{$header}
<h1>Gestion des cat&eacute;gories de forum</h1>

{if isset($listeCategorieForBo)}	
	<h2>Liste des cat&eacute;gories de forum</h2>

	<p>&nbsp;</p>
	<p style="width:725px; text-align:right">
	    <p class="frmBouton" style="text-align:right; margin-right:7px;">
		<a class="bouton" href="{jurl 'categorieFor~categorieForBo_editionCategorieFor'}">Nouvelle cat&eacute;gorie</a>
	</p>
	</p>
	<p style="height:6px">&nbsp;</p>

	<div class="ajaxZone">
		{$listeCategorieForBo}		
	</div>
{else}	  
	<h2>Edition d'une cat&eacute;gorie</h2>
	<div class="ajaxZone">
		<form enctype="multipart/form-data" id='categorieForForm' name='categorieForForm' action="{jurl 'categorieFor~categorieForBo_sauvegardeCategorieFor', array('page'=>$page)}" method="POST" tmt:validate="true" tmt:callback="displayError">
		  <input type="hidden" name="categorieFor_id" value="{$categorieFor->categorieFor_id}">

		  <p class="clearfix">
			<label>Libellé* :</label>
			<span class="champ">
				<input class="user_input1" type="text" style="width:400px;" name='categorieFor_libelle' tmt:required="true" tmt:minlength="3" tmt:maxlength="100" value="{$categorieFor->categorieFor_libelle|escxml}">
				ex : Informatique
			</span>
		  </p>
		  <p class="clearfix">
			<label>Code* :</label>
			<span class="champ">
				<input class="user_input5" type="text" style="width:50px;" name='categorieFor_code' tmt:required="true" tmt:minlength="2" tmt:maxlength="5" value="{$categorieFor->categorieFor_code|escxml}">
				ex : INFO
			</span>
		  </p>
		  
		  <p class="line_bottom clear">&nbsp;</p>
		  <p class="frmBouton">
			<a class="bouton submit" href="#">Valider</a>
			<a class="bouton" href="{jurl 'categorieFor~categorieForBo_listeCategorieFors', array('page'=>$page)}">Annuler</a>
		  </p>
		  <p class="errorMessage" id="errorMessage"></p>  
		</form>
	</div>
{/if}	  
{$footer}