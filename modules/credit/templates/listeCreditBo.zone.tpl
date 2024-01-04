<div class="sortableListWithPagination">
<table class="expanded" cellspacing="0"  id="tableListeCredit" currentSortField="{$sortField}" currentSortDirection="{$sortDirection}" currentPage="{$page}" nbPage="{$nbPage}" src="{jurl 'commun~communBo_getZone', $tParams}">
	<thead>
		<tr>
			{assign $i=0}
			{foreach $tHead as $headFields}
				{if $headFields['sortField']!=''}
					<th rowspan="2" class="color{$i++%2+1} {$headFields['align']}" sortField="{$headFields['sortField']}">{$headFields['libelle']}</th>
				{/if}
			{/foreach}
			{*if $canAdmin*}
				<th width="20%" colspan="3" class="color3">Actions</th>
			{*/if*}	
		</tr>
		{*if $canAdmin*}
		<tr>
			<th width="10%" class="color2">Modify</th>
			<th width="10%" class="color1">Delete</th>
		</tr>
		{*/if*}
	</thead>

	<tbody>
		{if sizeof($toCredit)==0}
			<tr class="row1">
				<td colspan="9" class="color2 _center b_orange">Aucun credit enregistré</td>
			</tr>
		{else}
			{assign $i=0}
			{assign $j=0}
			{foreach $toCredit as $oCredit}
			{assign $tPost= array('credit_id'=> $oCredit->credit_id, 'page'=>$page)}
            
			{assign $nbAffectCredit = $oCredit->credit_nbAnnonce + $oCredit->credit_nbAbonnement}

			<tr class="row{$i++%2+1}"> 
			  	<td width="20%" class="color2 _center">{$oCredit->forfait_libelle}</td>							  
			  	<td width="20%" class="color2">{$oCredit->credit_codePIN}</td>							  
			  	<td width="20%" class="color2">{$oCredit->credit_password}</td>							  
			  	<td width="20%" class="color2">{$oCredit->credit_dateUse|date_format:'%d/%m/%Y'}</td>							  
			  	<td width="10%" class="color2">{if $oCredit->credit_isPlus == 1}OUI{else}NON{/if}</td>							  
				{*if $canAdmin*}
				<td width="10%" style="text-align:center" class="color1"><a href="{jurl 'credit~creditBo_editionCredit', array('credit_id'=>$oCredit->credit_id, 'page'=>$page)}"><img src="{$j_basepath}design/back/images/edit.gif" /></a></td>
				{*}
                <td width="5%" class="color2" style="text-align:center">
					{if $nbAffectCredit}
						<img src="{$j_basepath}design/back/images/delete_off.gif"/>	
					{else}
						<a id="btn_supprimer" alt="supprimer" href="{jurl 'credit~creditBo_supprimeCredit', $tPost}"><img src="{$j_basepath}design/back/images/delete.gif"/></a>
					{/if}
				</td>			
				{*/if*}			
                {*}
			 </tr>

			{assign $j++}
			{/foreach}
		{/if}
	 </tbody>
</table>
<p class="pagination">&nbsp;</p>
</div>