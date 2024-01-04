{$header}
<h1>Gestion des packs</h1>

{if isset($listePackBo)}	
	<h2>Liste des packs</h2>

	<p>&nbsp;</p>
	<p style="width:725px; text-align:right">
	    <p class="frmBouton" style="text-align:right; margin-right:7px;">
		<a class="bouton" href="{jurl 'pack~packBo_editionPack'}">Nouveau pack </a>
	</p>
	</p>
	<p style="height:6px">&nbsp;</p>

	<div class="ajaxZone">
		{$listePackBo}		
	</div>
{else}	  
	<h2>Edition d'un pack</h2>
	<div class="ajaxZone">
		<form enctype="multipart/form-data" id='packForm' name='packForm' action="{jurl 'pack~packBo_sauvegardePack', array('page'=>$page)}" method="POST" tmt:validate="true" tmt:callback="displayError">
		  <input type="hidden" id="pack_id" name="pack_id" value="{$pack->pack_id}">

		  <input type="hidden" id="pack_photo" name="pack_photo" value="{if $pack->pack_photo}{$j_basepath}resize/pack/photos/{$pack->pack_photo}{/if}">
		  <input type="hidden" id="auxvisuel" name="auxvisuel" value="">

		  <p class="clearfix">
			<label>Libellé* :</label>
			<span class="champ">
				<input class="user_input1" type="text" style="width:400px;" id='pack_libelle' name='pack_libelle' tmt:required="true" tmt:minlength="3" tmt:maxlength="100" value="{$pack->pack_libelle|escxml}">
				ex : Immobilier
			</span>
		  </p>
		  <p class="clearfix">
			<label>Code* :</label>
			<span class="champ">
				<input class="user_input5" type="text" style="width:50px;" id='pack_code' name='pack_code' tmt:required="true" tmt:minlength="2" tmt:maxlength="5" value="{$pack->pack_code|escxml}">
				ex : IMMO
			</span>
		  </p>

		  <p class="clearfix">
			<label>Photo: *</label>
			<span class="champ">
				<input class="user_input1" type="text" id="champsvisuel" name="champsvisuel" {if !$pack->pack_photo}tmt:required="true"{/if}  style="width:300px;" value="" readonly>
				&nbsp;&nbsp;&nbsp;
				<a class="bouton" id="photo" href="javascript:;">Browse ...</a>
			</span>
		  </p>
		  <div id="appercuPhoto" style="padding-left:5px;background-color:#AEE0F5;margin:0px 5px 3px; overflow:auto; width:98%;">{$visuel}</div>

		
        {if $pack->pack_fichier != ''}
        <p class="clearfix">
            <label>Actual File linked</label>
            <span class="champ">
                <input type="text" name="pack_fichier_view" id="pack_fichier_view" value="{if $pack->pack_fichier}{$pack->pack_fichier}{/if}" style="width:240px;vertical-align:middle;top:auto;border:0px; "  readonly="readonly" />
            </span> 
        </p>
        {/if}			
        <p class="clearfix">
            {if $pack->pack_fichier != ''}
            <label>Replace by*</label>
            {else}
            <label>File to link*</label>
            {/if}
            <span class="champ">
                <input type="hidden" name="pack_fichier" id="pack_fichier" value="{if $pack->pack_fichier}{$j_basepath}resize/pack/{$pack->pack_fichier}{/if}" />
                <input class="user_input1" type="text" name="champs_fichier" id="champs_fichier" style="width:388px" value="" readonly  {if $pack->pack_id==""} tmt:required="true"{/if} /> 
                &nbsp;&nbsp;&nbsp;<a class="bouton" id="fichier"  href="#">Parcourir ...</a>
            </span> 
        </p>			

		  
		  <p class="line_bottom clear">&nbsp;</p>
		  <p class="frmBouton">
			<a class="bouton submit" href="#">Valider</a>
			<a class="bouton" href="{jurl 'pack~packBo_listePacks', array('page'=>$page)}">Annuler</a>
		  </p>
		  <p class="errorMessage" id="errorMessage"></p>  
		</form>
	</div>
{/if}	  
{$footer}