<div class="sortableListWithPagination">
<table class="expanded" cellspacing="0"  id="tableListeService" currentSortField="{$sortField}" currentSortDirection="{$sortDirection}" currentPage="{$page}" nbPage="{$nbPage}" src="{jurl 'commun~communBo_getZone', $tParams}">
	<thead>
		<tr>
			{assign $i=0}
			{foreach $tHead as $headFields}
				{if $headFields['sortField']!=''}
					<th rowspan="2" class="color{$i++%2+1} {$headFields['align']}" sortField="{$headFields['sortField']}">{$headFields['libelle']}</th>
				{/if}
			{/foreach}
			<th width="10%" colspan="3" class="color3">Actions</th>
		</tr>
		<tr>
			<th width="5%" class="color2">Modif</th>
			<th width="5%" class="color1">Suppr</th>
		</tr>
	</thead>

	<tbody>
		{if sizeof($toService)==0}
			<tr class="row1">
				<td colspan="9" class="color2 _center b_orange">Aucun service enregistr&eacute;</td>
			</tr>
		{else}
			{assign $i=0}
			{assign $j=0}
			{foreach $toService as $oService}
			{assign $tPost= array('service_id'=> $oService->service_id, 'page'=>$page)}
			{assign $nbAffectService = $oService->service_nbAssociation + $oService->service_nbUtilisateur}			
			<tr class="row{$i++%2+1}"> 
			  	<td width="30%" class="color2">{$oService->service_libelle} {*: ct ({$oService->service_nbAssociation}) : exp ({$oService->service_nbUtilisateur})*}</td>							  
			  	<td width="10%" class="color2 _center">{$oService->service_code}</td>							  
				<td width="5%" style="text-align:center" class="color1"><a href="{jurl 'service~serviceBo_editionService', $tPost}"><img src="{$j_basepath}design/back/images/edit.gif" /></a></td>
				<td width="5%" class="color2" style="text-align:center">
					{if $nbAffectService}
						<img src="{$j_basepath}design/back/images/delete_off.gif"/>	
					{else}
						<a alt="supprimer" href="{jurl 'service~serviceBo_supprimeService', $tPost}"><img src="{$j_basepath}design/back/images/delete.gif"/></a>
					{/if}				
				</td>						

			 </tr>
			{assign $j++}
			{/foreach}
		{/if}
	 </tbody>
</table>
<p class="pagination">&nbsp;</p>
</div>