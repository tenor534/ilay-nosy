{$header}
<h1>Gestion des cat&eacute;gories d'actualit&eacute;</h1>

{if isset($listeCategorieActBo)}	
	<h2>Liste des cat&eacute;gories d'actualit&eacute;</h2>

	<p>&nbsp;</p>
	<p style="width:725px; text-align:right">
	    <p class="frmBouton" style="text-align:right; margin-right:7px;">
		<a class="bouton" href="{jurl 'categorieAct~categorieActBo_editionCategorieAct'}">Nouvelle cat&eacute;gorie</a>
	</p>
	</p>
	<p style="height:6px">&nbsp;</p>

	<div class="ajaxZone">
		{$listeCategorieActBo}		
	</div>
{else}	  
	<h2>Edition d'une cat&eacute;gorie d'actualit&eacute;</h2>
	<div class="ajaxZone">
		<form enctype="multipart/form-data" id='categorieActForm' name='categorieActForm' action="{jurl 'categorieAct~categorieActBo_sauvegardeCategorieAct', array('page'=>$page)}" method="POST" tmt:validate="true" tmt:callback="displayError">
		  <input type="hidden" name="categorieAct_id" value="{$categorieAct->categorieAct_id}">

		  <p class="clearfix">
			<label>Libellé* :</label>
			<span class="champ">
				<input class="user_input1" type="text" style="width:400px;" name='categorieAct_libelle' tmt:required="true" tmt:minlength="3" tmt:maxlength="100" value="{$categorieAct->categorieAct_libelle|escxml}">
				ex : International
			</span>
		  </p>
		  <p class="clearfix">
			<label>Code* :</label>
			<span class="champ">
				<input class="user_input5" type="text" style="width:50px;" name='categorieAct_code' tmt:required="true" tmt:minlength="2" tmt:maxlength="5" value="{$categorieAct->categorieAct_code|escxml}">
				ex : INTER
			</span>
		  </p>
		  
		  <p class="line_bottom clear">&nbsp;</p>
		  <p class="frmBouton">
			<a class="bouton submit" href="#">Valider</a>
			<a class="bouton" href="{jurl 'categorieAct~categorieActBo_listeCategorieActs', array('page'=>$page)}">Annuler</a>
		  </p>
		  <p class="errorMessage" id="errorMessage"></p>  
		</form>
	</div>
{/if}	  
{$footer}