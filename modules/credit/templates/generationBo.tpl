{$header}
<h1>Gestion des credits</h1>

{if isset($listeCreditBo)}	
	<h2>Liste des credits</h2>

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
	<h2>G&eacute;n&eacute;ration de cr&eacute;dits</h2>
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
			<label>Nombre de codes :*</label>
			<span class="champ">
				<input class="user_input1" type="text" style="width:50px;" id='credit_nbCode' name='credit_nbCode' tmt:required="true"  tmt:pattern="number" tmt:maxlength="5" value="10">
                &nbsp;par g&eacute;n&eacute;ration
			</span>
		  </p>

		  <p class="line_bottom clear">&nbsp;</p>
		  <p class="frmBouton">
			<a id="generation" class="bouton" href="#">G&eacute;n&eacute;rer</a>
		  </p>
		  <p class="line_bottom clear">&nbsp;</p>

		  <div id="automateCode">

            <table class="expanded" cellspacing="0"  id="tableListeCredit">
                <thead>
                    <tr>
                        {assign $i=0}
                        <th class="color{$i++%2+1} _center">N&deg; s&eacute;rie</th>
                        <th class="color{$i++%2+1} _center">Code PIN</th>
                        <th class="color{$i++%2+1} _center">Password</th>
                        <th class="color{$i++%2+1} _center">Montant Ariary</th>
                    </tr>
                </thead>
            
                <tbody id="createdCode">
                 </tbody>
            </table>
          
          </div>			  
		  <p class="errorMessage" id="errorMessage"></p>  
		</form>
	</div>
{/if}	  
{$footer}