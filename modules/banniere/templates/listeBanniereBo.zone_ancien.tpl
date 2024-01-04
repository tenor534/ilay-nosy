<div class="sortableListWithPagination">
<table class="expanded" cellspacing="0"  id="tableListeBanniere" currentSortField="{$sortField}" currentSortDirection="{$sortDirection}" currentPage="{$page}" nbPage="{$nbPage}" src="{jurl 'commun~communBo_getZone', $tParams}">
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
		{if sizeof($toBanniere)==0}
			<tr class="row1">
				<td colspan="9" class="color2 _center b_orange">Aucun banni&egrave;re enregistr&eacute;e</td>
			</tr>
		{else}
			{assign $i=0}
			{assign $j=0}
			{foreach $toBanniere as $oBanniere}
                {assign $tPost= array('banniere_id'=> $oBanniere->banniere_id, 'page'=>$page)}
                {*assign $nbAffectBanniere = $oBanniere->banniere_nbPhoto*}
                <tr class="row{$i++%2+1}"> 
					{*}                                
                        banniere_nom
                        banniere_typeZone
                        banniere_dateCreation
                        banniere_dateDebutPub
                        banniere_publierInternal
                        banniere_publierHome
                        banniere_click
                        banniere_vue
                    {*}
                
                    <td width="30%" class="color2"><strong>{$oBanniere->banniere_nom}</strong></td>							  
                    <td width="5%" class="color2 _center"><strong>{$oBanniere->banniere_typeZone}</strong></td>							  
                    <td width="5%" class="color2 _center">{$oBanniere->banniere_dateCreation|date_format:"%d/%m/%Y"}</td>							  
                    <td width="5%" class="color2 _center">{$oBanniere->banniere_dateDebutPub|date_format:"%d/%m/%Y (%H:%M:%S)"}</td>							  
                    <td width="5%" class="color2 _center">{$oBanniere->banniere_dateFinPub|date_format:"%d/%m/%Y (%H:%M:%S)"}</td>							  

                    <td width="0%" class="color2 _center">
                        <input type="checkbox" name="bannierePublierHome_{$oBanniere->banniere_id}" value="{$oBanniere->banniere_publierHome}" {if $oBanniere->banniere_publierHome == 1}checked{/if} onclick="return checkBanniereHome(this);">                
					</td>							  
                    <td width="0%" class="color2 _center">
                        <input type="checkbox" name="bannierePublierInternal_{$oBanniere->banniere_id}" value="{$oBanniere->banniere_publierInternal}" {if $oBanniere->banniere_publierInternal == 1}checked{/if} onclick="return checkBanniereInternal(this);">                
					</td>							  
                    <td width="5%" class="color2 _center"><strong>{$oBanniere->banniere_click}</strong></td>							  
                    <td width="5%" class="color2 _center"><strong>{$oBanniere->banniere_vue}</strong></td>							  
    
                    {*if $canAdmin*}
                    <td width="5%" style="text-align:center" class="color1"><a href="{jurl 'banniere~banniereBo_editionBanniere', $tPost}"><img src="{$j_basepath}design/back/images/edit.gif" /></a></td>
                    <td width="5%" class="color2" style="text-align:center">
                       <a id="btn_supprimer" alt="supprimer" href="{jurl 'banniere~banniereBo_supprimeBanniere', $tPost}"><img src="{$j_basepath}design/back/images/delete.gif"/></a>
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