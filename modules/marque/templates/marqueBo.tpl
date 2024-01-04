{$header}
<h1>Gestion des marques</h1>

{if isset($listeMarqueBo)}	
	<h2>Liste des marques</h2>

	<p>&nbsp;</p>
	<p style="width:725px; text-align:right">
	    <p class="frmBouton" style="text-align:right; margin-right:7px;">
		<a class="bouton" href="{jurl 'marque~marqueBo_editionMarque'}">Nouvelle marque </a>
	</p>
	</p>
	<p style="height:6px">&nbsp;</p>

	<div class="ajaxZone">
		{$listeMarqueBo}		
	</div>
{else}	  
	<h2>Edition d'une marque</h2>
	<div class="ajaxZone">
		<form enctype="multipart/form-data" id='marqueForm' name='marqueForm' action="{jurl 'marque~marqueBo_sauvegardeMarque', array('page'=>$page)}" method="POST" tmt:validate="true" tmt:callback="displayError">
		  <input type="hidden" id="marque_id" name="marque_id" value="{$marque->marque_id}">

		  <p class="clearfix">
			<label>Libellé* :</label>
			<span class="champ">
				<input class="user_input1" type="text" style="width:400px;" id='marque_libelle' name='marque_libelle' tmt:required="true" tmt:minlength="3" tmt:maxlength="100" value="{$marque->marque_libelle|escxml}">
				ex : Peugeot
			</span>
		  </p>
		  <p class="clearfix">
			<label>Code* :</label>
			<span class="champ">
				<input class="user_input5" type="text" style="width:50px;" id='marque_code' name='marque_code' tmt:required="true" tmt:minlength="2" tmt:maxlength="5" value="{$marque->marque_code|escxml}">
				ex : PEU
			</span>
		  </p>
		  
		  <p class="line_bottom clear">&nbsp;</p>
		  <p class="frmBouton">
			<a class="bouton submit" href="#">Valider</a>
			<a class="bouton" href="{jurl 'marque~marqueBo_listeMarques', array('page'=>$page)}">Annuler</a>
		  </p>
		  <p class="errorMessage" id="errorMessage"></p>  
		</form>
	</div>
{/if}	  
{$footer}