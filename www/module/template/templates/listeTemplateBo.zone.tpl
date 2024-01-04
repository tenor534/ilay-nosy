<div class="sortableListWithPagination">
<table class="expanded" cellspacing="0"  id="tableListeSociete" currentSortField="{$sortField}" currentSortDirection="{$sortDirection}" currentPage="{$page}" nbPage="{$nbPage}" src="{jurl 'commun~communBo_getZone', $tParams}">
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
		{if sizeof($toSociete)==0}
			<tr class="row1">
				<td colspan="9" class="color2 _center b_orange">Aucun societe enregistr&eacute;</td>
			</tr>
		{else}
			{assign $i=0}
			{assign $j=0}
			{foreach $toSociete as $oSociete}
			{assign $tPost= array('societe_id'=> $oSociete->societe_id, 'page'=>$page)}
			{assign $nbAffectSociete = $oSociete->societe_nbSociete}

			<tr class="row{$i++%2+1}"> 
			  	<td width="20%" class="color2">{$oSociete->societe_nom}</td>							  
			  	<td width="20%" class="color2">{$oSociete->societe_fonction}</td>							  
			  	<td width="20%" class="color2 _center">{$oSociete->societe_telephone}</td>							  
			  	<td width="20%" class="color2 _center">{$oSociete->societe_email}</td>							  
				{*if $canAdmin*}
				<td width="10%" style="text-align:center" class="color1"><a href="{jurl 'societe~societeBo_editionSociete', array('societe_id'=>$oSociete->societe_id, 'page'=>$page)}"><img src="{$j_basepath}design/back/images/edit.gif" /></a></td>
				<td width="10%" class="color2" style="text-align:center">
					{if $nbAffectSociete}
						<img src="{$j_basepath}design/back/images/delete_off.gif"/>	
					{else}
						<a alt="supprimer" href="{jurl 'societe~societeBo_supprimeSociete', $tPost}"><img src="{$j_basepath}design/back/images/delete.gif"/></a>
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