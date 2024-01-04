{$header}
<h1>Gestion des pays</h1>

{if isset($listePaysBo)}	
	<h2>Liste des pays</h2>

	<p>&nbsp;</p>
	<p style="width:725px; text-align:right">
	    <p class="frmBouton" style="text-align:right; margin-right:7px;">
		<a class="bouton" href="{jurl 'pays~paysBo_editionPays'}">Nouveau pays </a>
	</p>
	</p>
	<p style="height:6px">&nbsp;</p>

	<div class="ajaxZone">
		{$listePaysBo}		
	</div>
{else}	  
	<h2>Edition d'un pays</h2>
	<div class="ajaxZone">
		<form enctype="multipart/form-data" id='paysForm' name='paysForm' action="{jurl 'pays~paysBo_sauvegardePays', array('page'=>$page)}" method="POST" tmt:validate="true" tmt:callback="displayError">
		  <input type="hidden" name="pays_id" value="{$pays->pays_id}">

		  <p class="clearfix">
			<label>Libellé* :</label>
			<span class="champ">
				<input type="text" style="width:400px;" name='pays_libelle' tmt:required="true" tmt:minlength="3" tmt:maxlength="100" value="{$pays->pays_libelle|escxml}">
				ex : France
			</span>
		  </p>
		  <p class="clearfix">
			<label>Code* :</label>
			<span class="champ">
				<input type="text" style="width:50px;" name='pays_code' tmt:required="true" tmt:minlength="2" tmt:maxlength="5" value="{$pays->pays_code|escxml}">
				ex : FR
			</span>
		  </p>
		  
		  <p class="line_bottom clear">&nbsp;</p>
		  <p class="frmBouton">
			<a class="bouton submit" href="#">Valider</a>
			<a class="bouton" href="{jurl 'pays~paysBo_listePayss', array('page'=>$page)}">Annuler</a>
		  </p>
		  <p class="errorMessage" id="errorMessage"></p>  
		</form>
	</div>
{/if}	  
{$footer}