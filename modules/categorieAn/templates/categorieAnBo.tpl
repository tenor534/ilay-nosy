{$header}
<h1>Gestion des cat&eacute;gories d'annonce</h1>

{if isset($listeCategorieAnBo)}	
	<h2>Liste des cat&eacute;gories d'annonce</h2>

	<p>&nbsp;</p>
	<p style="width:725px; text-align:right">
	    <p class="frmBouton" style="text-align:right; margin-right:7px;">
		<a class="bouton" href="{jurl 'categorieAn~categorieAnBo_editionCategorieAn'}">Nouvelle cat&eacute;gorie</a>
	</p>
	</p>
	<p style="height:6px">&nbsp;</p>

	<div class="ajaxZone">
		{$listeCategorieAnBo}		
	</div>
{else}	  
	<h2>Edition d'une cat&eacute;gorie</h2>
	<div class="ajaxZone">
		<form enctype="multipart/form-data" id='categorieAnForm' name='categorieAnForm' action="{jurl 'categorieAn~categorieAnBo_sauvegardeCategorieAn', array('page'=>$page)}" method="POST" tmt:validate="true" tmt:callback="displayError">
		  <input type="hidden" name="categorieAn_id" value="{$categorieAn->categorieAn_id}">

		  <p class="clearfix">
			<label>Libellé* :</label>
			<span class="champ">
				<input class="user_input1" type="text" style="width:400px;" name='categorieAn_libelle' tmt:required="true" tmt:minlength="3" tmt:maxlength="100" value="{$categorieAn->categorieAn_libelle|escxml}">
				ex : Immobilier location
			</span>
		  </p>
		  <p class="clearfix">
			<label>Code* :</label>
			<span class="champ">
				<input class="user_input5" type="text" style="width:50px;" name='categorieAn_code' tmt:required="true" tmt:minlength="2" tmt:maxlength="5" value="{$categorieAn->categorieAn_code|escxml}">
				ex : IMLOC
			</span>
		  </p>
		  
		  <p class="line_bottom clear">&nbsp;</p>
		  <p class="frmBouton">
			<a class="bouton submit" href="#">Valider</a>
			<a class="bouton" href="{jurl 'categorieAn~categorieAnBo_listeCategorieAns', array('page'=>$page)}">Annuler</a>
		  </p>
		  <p class="errorMessage" id="errorMessage"></p>  
		</form>
	</div>
{/if}	  
{$footer}