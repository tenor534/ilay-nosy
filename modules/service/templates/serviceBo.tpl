{$header}
<h1>Gestion des services</h1>

{if isset($listeServiceBo)}	
	<h2>Liste des services</h2>

	<p>&nbsp;</p>
	<p style="width:725px; text-align:right">
	    <p class="frmBouton" style="text-align:right; margin-right:7px;">
		<a class="bouton" href="{jurl 'service~serviceBo_editionService'}">Nouveau service </a>
	</p>
	</p>
	<p style="height:6px">&nbsp;</p>

	<div class="ajaxZone">
		{$listeServiceBo}		
	</div>
{else}	  
	<h2>Edition d'un service</h2>
	<div class="ajaxZone">
		<form enctype="multipart/form-data" id='serviceForm' name='serviceForm' action="{jurl 'service~serviceBo_sauvegardeService', array('page'=>$page)}" method="POST" tmt:validate="true" tmt:callback="displayError">
		  <input type="hidden" name="service_id" value="{$service->service_id}">

		  <p class="clearfix">
			<label>Libell&eacute;* :</label>
			<span class="champ">
				<input type="text" style="width:400px;" name='service_libelle' tmt:required="true" tmt:minlength="3" tmt:maxlength="100" value="{$service->service_libelle|escxml}">
				ex : Monsieur
			</span>
		  </p>
		  <p class="clearfix">
			<label>Code* :</label>
			<span class="champ">
				<input type="text" style="width:50px;" name='service_code' tmt:required="true" tmt:minlength="2" tmt:maxlength="5" value="{$service->service_code|escxml}">
				ex : M.
			</span>
		  </p>
		  
		  <p class="line_bottom clear">&nbsp;</p>
		  <p class="frmBouton">
			<a class="bouton submit" href="#">Valider</a>
			<a class="bouton" href="{jurl 'service~serviceBo_listeServices', array('page'=>$page)}">Annuler</a>
		  </p>
		  <p class="errorMessage" id="errorMessage"></p>  
		</form>
	</div>
{/if}	  
{$footer}