<div class="sortableListWithPagination">
<table class="expanded" cellspacing="0"  id="tableListeRubrique" currentSortField="{$sortField}" currentSortDirection="{$sortDirection}" currentPage="{$page}" nbPage="{$nbPage}" src="{jurl 'commun~communBo_getZone', $tParams}">
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
		{if sizeof($toRubrique)==0}
			<tr class="row1">
				<td colspan="9" class="color2 _center b_orange">Aucun rubrique enregistré</td>
			</tr>
		{else}
			{assign $i=0}
			{assign $j=0}
			{foreach $toRubrique as $oRubrique}
			{assign $tPost= array('rubrique_id'=> $oRubrique->rubrique_id, 'page'=>$page)}
            
			{assign $nbAffectRubrique = $oRubrique->rubrique_nbAnnonce}

			<tr class="row{$i++%2+1}"> 
			  	<td width="5%" class="color2 _center">{$oRubrique->categorieAn_code}</td>							  
			  	<td width="5%" class="color2 _center">{$oRubrique->rubrique_level}</td>							  
			  	<td width="25%" class="color2 _center">{$oRubrique->rubrique_sortCode}</td>							  
			  	<td width="20%" class="color2">{$oRubrique->rubrique_path}</td>							  
			  	<td width="40%" class="color2">{$oRubrique->rubrique_libelle}</td>							  
				{*if $canAdmin*}
				<td width="5%" style="text-align:center" class="color1"><a href="{jurl 'rubrique~rubriqueBo_editionRubrique', array('rubrique_id'=>$oRubrique->rubrique_id, 'page'=>$page)}"><img src="{$j_basepath}design/back/images/edit.gif" /></a></td>
				<td width="5%" class="color2" style="text-align:center">
					{if $nbAffectRubrique}
						<img src="{$j_basepath}design/back/images/delete_off.gif"/>	
					{else}
						<a id="btn_supprimer" alt="supprimer" href="{jurl 'rubrique~rubriqueBo_supprimeRubrique', $tPost}"><img src="{$j_basepath}design/back/images/delete.gif"/></a>
					{/if}
				</td>			
				{*/if*}			
			 </tr>

			{assign $j++}
			{/foreach}
		{/if}
	 </tbody>
</table>
<p class="pagination">&nbsp;</p>
</div>