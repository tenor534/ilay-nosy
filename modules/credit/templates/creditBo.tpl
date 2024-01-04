{$header}
<h1>Gestion des cr&eacute;dits</h1>

{if isset($listeCreditBo)}	
	<h2>Liste des cr&eacute;dits</h2>

	<p>&nbsp;</p>
	<p style="width:725px; text-align:right">
	    <p class="frmBouton" style="text-align:right; margin-right:7px;">		
        {*}<a class="bouton" href="{jurl 'credit~creditBo_editionCredit'}">Nouveau credit </a>{*}
	</p>
	</p>
	<p style="height:6px">&nbsp;</p>

	<div class="ajaxZone">
		{$listeCreditBo}		
	</div>
{else}	  
	<h2>Edition d'un cr&eacute;dit</h2>
	<div class="ajaxZone">
		<form enctype="multipart/form-data" id='creditForm' name='creditForm' action="{jurl 'credit~creditBo_sauvegardeCredit', array('page'=>$page)}" method="POST" tmt:validate="true" tmt:callback="displayError">
		  <input type="hidden" id="credit_id" name="credit_id" value="{$credit->credit_id}">
		  <input type="hidden" id="credit_abonnementId" name="credit_abonnementId" value="{$credit->credit_abonnementId}">

		  <p class="clearfix">
			<label>Forfait :*</label>
			<span class="champ">
			<select class="user_input1 user_input_select input_middle" name="credit_forfaitId" id="credit_forfaitId"  tmt:invalidvalue="0" tmt:required="true">			
				<option value="0">Select&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
				{foreach $listeForfait as $olisteForfait}
					{if $olisteForfait->forfait_id==$credit->credit_forfaitId}
						{assign $selected="selected"}
					{else}
						{assign $selected=""}
					{/if}
					<option value="{$olisteForfait->forfait_id}" {$selected}>{$olisteForfait->forfait_libelle}</option>
				{/foreach}
			</select>
			</span>
		  </p>

		  <p class="clearfix">
			<label>Option PLUS :*</label>
			<span class="champ">
				<input type="checkbox" id="credit_isPlus" name="credit_isPlus" style="width:5%" value="1" {if $credit->credit_isPlus == 1}checked{/if}>
			</span>
		  </p>


		  <p class="clearfix">
			<label>CodePIN :*</label>
			<span class="champ">
				<input class="user_input1" type="text" style="width:400px;" id='credit_codePIN' name='credit_codePIN' tmt:required="true" tmt:minlength="3" tmt:maxlength="100" value="{$credit->credit_codePIN|escxml}">
			</span>
		  </p>

		  <p class="clearfix">
			<label>Password :*</label>
			<span class="champ">
				<input class="user_input1" type="text" style="width:400px;" id='credit_password' name='credit_password' tmt:required="true" tmt:minlength="3" tmt:maxlength="100" value="{$credit->credit_password|escxml}">
			</span>
		  </p>

		  <p class="clearfix">
			<label>Date d'utilisation :*</label>
			<span class="champ">
				<input class="user_input3" type="text" id="credit_dateUse" name="credit_dateUse" value="{$credit->credit_dateUse|date_format:'%d/%m/%Y'}" tmt:required="true" tmt:datepattern="DD/MM/YYYY" maxlength="10">
			</span>
		  </p>

		  
		  <p class="line_bottom clear">&nbsp;</p>
		  <p class="frmBouton">
			<a class="bouton submit" href="#">Valider</a>
			<a class="bouton" href="{jurl 'credit~creditBo_listeCredits', array('page'=>$page)}">Annuler</a>
		  </p>
		  <p class="errorMessage" id="errorMessage"></p>  
		</form>
	</div>
{/if}	  
{$footer}