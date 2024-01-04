{$header}
<h1>Gestion des groupes, pages officielles, ou communaut&eacute;s</h1>

{if isset($listeCategorieOffBo)}	
	<h2>Liste des groupes</h2>

	<p>&nbsp;</p>
	<p style="width:725px; text-align:right">
	    <p class="frmBouton" style="text-align:right; margin-right:7px;">
		<a class="bouton" href="{jurl 'categorieOff~categorieOffBo_editionCategorieOff'}">Nouveau groupe </a>
	</p>
	</p>
	<p style="height:6px">&nbsp;</p>

	<div class="ajaxZone">
		{$listeCategorieOffBo}		
	</div>
{else}	  
	<h2>Edition d'un groupe</h2>
	<div class="ajaxZone">
		<form enctype="multipart/form-data" id='categorieOffForm' name='categorieOffForm' action="{jurl 'categorieOff~categorieOffBo_sauvegardeCategorieOff', array('page'=>$page)}" method="POST" tmt:validate="true" tmt:callback="displayError">
		  <input type="hidden" name="categorieOff_id" value="{$categorieOff->categorieOff_id}">

		  <p class="clearfix">
			<label>Libellé* :</label>
			<span class="champ">
				<input class="user_input1" type="text" style="width:400px;" name='categorieOff_libelle' tmt:required="true" tmt:minlength="3" tmt:maxlength="100" value="{$categorieOff->categorieOff_libelle|escxml}">
				ex : Ilay NOSY, Telma, Orange
			</span>
		  </p>
		  <p class="clearfix">
			<label>Code* :</label>
			<span class="champ">
				<input class="user_input5" type="text" style="width:50px;" name='categorieOff_code' tmt:required="true" tmt:minlength="2" tmt:maxlength="5" value="{$categorieOff->categorieOff_code|escxml}">
				ex : NOSY
			</span>
		  </p>
		  
		  <p class="line_bottom clear">&nbsp;</p>
		  <p class="frmBouton">
			<a class="bouton submit" href="#">Valider</a>
			<a class="bouton" href="{jurl 'categorieOff~categorieOffBo_listeCategorieOffs', array('page'=>$page)}">Annuler</a>
		  </p>
		  <p class="errorMessage" id="errorMessage"></p>  
		</form>
	</div>
{/if}	  
{$footer}