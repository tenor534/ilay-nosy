<div class="sortableListWithPagination">
<table class="expanded" cellspacing="0"  id="tableListeAnnonce" currentSortField="{$sortField}" currentSortDirection="{$sortDirection}" currentPage="{$page}" nbPage="{$nbPage}" src="{jurl 'commun~communBo_getZone', $tParams}">
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
		{if sizeof($toAnnonce)==0}
			<tr class="row1">
				<td colspan="9" class="color2 _center b_orange">Aucun annonce enregistré</td>
			</tr>
		{else}
			{assign $i=0}
			{assign $j=0}
			{foreach $toAnnonce as $oAnnonce}
                {assign $tPost= array('annonce_id'=> $oAnnonce->annonce_id, 'page'=>$page)}
                {assign $nbAffectAnnonce = $oAnnonce->annonce_nbPhoto}
                <tr class="row{$i++%2+1}"> 
                    <td width="20%" class="color2">{$oAnnonce->categorieAn_libelle}</td>							  
                    <td width="10%" class="color2 _center">
                        <a href="{jurl 'annonce~annonceBo_editionAnnonce', $tPost}" class="blueHead">
                        <img width="98" height="74" border="0" alt="{$oAnnonce->annonce_titre}" src="{$j_basepath}resize/annonce/images/abrege/{$oAnnonce->annonce_photo}" name="imgPrinc">
                        </a>
                    </td>							  
                    <td width="30%" class="color2 _center">
                        <a href="{jurl 'annonce~annonceBo_editionAnnonce', $tPost}">{$oAnnonce->annonce_titre}</a>
                            <br>ref. {$oAnnonce->annonce_reference}
                            <br>{$oAnnonce->annonce_offre}
                    </td>							  
                    <td width="20%" class="color2 _right" nowrap>{if $oAnnonce->annonce_prix}{$oAnnonce->annonce_prix|format_number: 0, ",", ' ','Ar'}{else}N/D{/if}</td>							  
                    <td width="20%" class="color2 _center">
                        {$oAnnonce->annonce_annee}<br>{$oAnnonce->annonce_etat} 
                    </td>							  
                    <td width="20%" class="color2 _center">
                        <input type="checkbox" name="annoncePublier_{$oAnnonce->annonce_id}" value="{$oAnnonce->annonce_publier}" {if $oAnnonce->annonce_publier == 1}checked{/if} onclick="return checkAnnonce(this);">                
					</td>							  
                    <td width="20%" class="color2 _center">
                        <input type="checkbox" name="annoncePublierHome_{$oAnnonce->annonce_id}" value="{$oAnnonce->annonce_publierHome}" {if $oAnnonce->annonce_publierHome == 1}checked{/if} onclick="return checkAnnonceHome(this);">                
					</td>							  
                    <td width="20%" class="color2 _center">
                        <input type="checkbox" name="annonceLaUne_{$oAnnonce->annonce_id}" value="{$oAnnonce->annonce_laUne}" {if $oAnnonce->annonce_laUne == 1}checked{/if} onclick="return checkAnnonceUne(this);">                
					</td>							  
                    <td width="20%" class="color2 _center">{if $oAnnonce->annonce_parution == 0}d'hui{else}{$oAnnonce->annonce_parution} j{/if}</td>							  
    
                    {*if $canAdmin*}
                    <td width="10%" style="text-align:center" class="color1"><a href="{jurl 'annonce~annonceBo_editionAnnonce', $tPost}"><img src="{$j_basepath}design/back/images/edit.gif" /></a></td>
                    <td width="10%" class="color2" style="text-align:center">
                        {if $nbAffectAnnonce}
                            <img src="{$j_basepath}design/back/images/delete_off.gif"/>	
                        {else}
                            <a id="btn_supprimer" alt="supprimer" href="{jurl 'annonce~annonceBo_supprimeAnnonce', $tPost}"><img src="{$j_basepath}design/back/images/delete.gif"/></a>
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