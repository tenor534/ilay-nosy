<div class="sortableListWithPagination">
<table class="expanded" cellspacing="0"  id="tableListeOfficiel" currentSortField="{$sortField}" currentSortDirection="{$sortDirection}" currentPage="{$page}" nbPage="{$nbPage}" src="{jurl 'commun~communBo_getZone', $tParams}">
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
		{if sizeof($toOfficiel)==0}
			<tr class="row1">
				<td colspan="9" class="color2 _center b_orange">Aucune page de groupe ou officielle enregistr&eacute;e</td>
			</tr>
		{else}
			{assign $i=0}
			{assign $j=0}
			{foreach $toOfficiel as $oOfficiel}
                {assign $tPost= array('officiel_id'=> $oOfficiel->officiel_id, 'page'=>$page)}
                {assign $nbAffectOfficiel = $oOfficiel->officiel_nbPhoto}
                <tr class="row{$i++%2+1}"> 
					{*}                                
					 array('sortField'=> "categorieOff_libelle", 'libelle'=> "Cat&eacute;g.", 'modifier'=> '', 'align'=> "_left")					
					,array('sortField'=> "officiel_photo", 'libelle'=> "Photo", 'modifier'=> '', 'align'=> "_left")					
					,array('sortField'=> "officiel_titre", 'libelle'=> "Titre", 'modifier'=> '', 'align'=> "_left")					
					,array('sortField'=> "officiel_publier", 'libelle'=> "Pub", 'modifier'=> '', 'align'=> "_center")					
					,array('sortField'=> "officiel_publierHome", 'libelle'=> "Pub H", 'modifier'=> '', 'align'=> "_center")					
					,array('sortField'=> "officiel_laUne", 'libelle'=> "Une", 'modifier'=> '', 'align'=> "_center")					
					,array('sortField'=> "officiel_dateCreation", 'libelle'=> "Cr&eacute;ation", 'modifier'=> '', 'align'=> "_center")									
					,array('sortField'=> "officiel_dateModification", 'libelle'=> "Modification", 'modifier'=> '', 'align'=> "_center")									
					,array('sortField'=> "officiel_datePublication", 'libelle'=> "Publication", 'modifier'=> '', 'align'=> "_center")									
                    {*}
                
                    <td width="15%" class="color2"><strong>{$oOfficiel->categorieOff_libelle}</strong></td>							  
                    <td width="15%" class="color2 _center">
                        <a href="{jurl 'officiel~officielBo_editionOfficiel', $tPost}" class="blueHead">
                        <img width="98" height="74" border="0" alt="{$oOfficiel->officiel_titre}" src="{$j_basepath}resize/officiel/images/abrege/{$oOfficiel->officiel_photo}" name="imgPrinc">
                        </a>
                    </td>							  
                    <td width="40%" class="color2 _center">
                        <a href="{jurl 'officiel~officielBo_editionOfficiel', $tPost}"><strong>{$oOfficiel->officiel_titre}</strong></a>
                            <br><strong>ref.</strong> {$oOfficiel->officiel_reference}
                            <br><strong>src.</strong> {$oOfficiel->officiel_source}
                    </td>							  

                    <td width="0%" class="color2 _center">
                        <input type="checkbox" name="officielPublier_{$oOfficiel->officiel_id}" value="{$oOfficiel->officiel_publier}" {if $oOfficiel->officiel_publier == 1}checked{/if} onclick="return checkOfficiel(this);">                
					</td>							  
                    <td width="0%" class="color2 _center">
                        <input type="checkbox" name="officielPublierHome_{$oOfficiel->officiel_id}" value="{$oOfficiel->officiel_publierHome}" {if $oOfficiel->officiel_publierHome == 1}checked{/if} onclick="return checkOfficielHome(this);">                
					</td>							  
                    <td width="0%" class="color2 _center">
                        <input type="checkbox" name="officielLaUne_{$oOfficiel->officiel_id}" value="{$oOfficiel->officiel_laUne}" {if $oOfficiel->officiel_laUne == 1}checked{/if} onclick="return checkOfficielUne(this);">                
					</td>							  
                    <td width="5%" class="color2 _center">{$oOfficiel->officiel_dateCreation|date_format:"%d/%m/%Y"}</td>							  
                    <td width="5%" class="color2 _center">{$oOfficiel->officiel_dateModification|date_format:"%d/%m/%Y"}</td>							  
                    <td width="5%" class="color2 _center">{$oOfficiel->officiel_datePublication|date_format:"%d/%m/%Y (%H:%M:%S)"}</td>							  
    
                    {*if $canAdmin*}
                    <td width="5%" style="text-align:center" class="color1"><a href="{jurl 'officiel~officielBo_editionOfficiel', $tPost}"><img src="{$j_basepath}design/back/images/edit.gif" /></a></td>
                    <td width="5%" class="color2" style="text-align:center">
                        {if $nbAffectOfficiel}
                            <img src="{$j_basepath}design/back/images/delete_off.gif"/>	
                        {else}
                            <a id="btn_supprimer" alt="supprimer" href="{jurl 'officiel~officielBo_supprimeOfficiel', $tPost}"><img src="{$j_basepath}design/back/images/delete.gif"/></a>
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