{$header}
<h1>Gestion des profils</h1>

{if isset($listeProfilBo)}	
	<h2>Liste des profils</h2>

	<p>&nbsp;</p>
	<p style="width:725px; text-align:right">
	    <p class="frmBouton" style="text-align:right; margin-right:7px;">
		<a class="bouton" href="{jurl 'profil~profilBo_editionProfil'}">Nouveau profil </a>
	</p>
	</p>
	<p style="height:6px">&nbsp;</p>

	<div class="ajaxZone">
		{$listeProfilBo}		
	</div>
{else}	  
	<h2>Edition d'un profil</h2>
	<div class="ajaxZone">
		<form enctype="multipart/form-data" id='profilForm' name='profilForm' action="{jurl 'profil~profilBo_sauvegardeProfil', array('page'=>$page)}" method="POST" tmt:validate="true" tmt:callback="displayError">
		  <input type="hidden" name="profil_id" value="{$profil->profil_id}">

		  <p class="clearfix">
			<label>Libellé* :</label>
			<span class="champ">
				<input type="text" style="width:400px;" name='profil_libelle' tmt:required="true" tmt:minlength="3" tmt:maxlength="100" value="{$profil->profil_libelle|escxml}">
				ex : Monsieur
			</span>
		  </p>
		  <p class="clearfix">
			<label>Code* :</label>
			<span class="champ">
				<input type="text" style="width:50px;" name='profil_code' tmt:required="true" tmt:minlength="2" tmt:maxlength="5" value="{$profil->profil_code|escxml}">
				ex : M.
			</span>
		  </p>
		  
		  <p class="line_bottom clear">&nbsp;</p>
		  <p class="frmBouton">
			<a class="bouton submit" href="#">Valider</a>
			<a class="bouton" href="{jurl 'profil~profilBo_listeProfils', array('page'=>$page)}">Annuler</a>
		  </p>
		  <p class="errorMessage" id="errorMessage"></p>  
		</form>
	</div>
{/if}	  
{$footer}