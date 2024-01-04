<div class="sortableListWithPagination">
<table class="expanded" cellspacing="0"  id="tableListeActualite" currentSortField="{$sortField}" currentSortDirection="{$sortDirection}" currentPage="{$page}" nbPage="{$nbPage}" src="{jurl 'commun~communBo_getZone', $tParams}">
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
		{if sizeof($toActualite)==0}
			<tr class="row1">
				<td colspan="9" class="color2 _center b_orange">Aucun actualite enregistr&eacute;e</td>
			</tr>
		{else}
			{assign $i=0}
			{assign $j=0}
			{foreach $toActualite as $oActualite}
                {assign $tPost= array('actualite_id'=> $oActualite->actualite_id, 'page'=>$page)}
                {assign $nbAffectActualite = $oActualite->actualite_nbPhoto}
                <tr class="row{$i++%2+1}"> 
					{*}                                
					 array('sortField'=> "categorieAct_libelle", 'libelle'=> "Cat&eacute;g.", 'modifier'=> '', 'align'=> "_left")					
					,array('sortField'=> "actualite_photo", 'libelle'=> "Photo", 'modifier'=> '', 'align'=> "_left")					
					,array('sortField'=> "actualite_titre", 'libelle'=> "Titre", 'modifier'=> '', 'align'=> "_left")					
					,array('sortField'=> "actualite_publier", 'libelle'=> "Pub", 'modifier'=> '', 'align'=> "_center")					
					,array('sortField'=> "actualite_publierHome", 'libelle'=> "Pub H", 'modifier'=> '', 'align'=> "_center")					
					,array('sortField'=> "actualite_laUne", 'libelle'=> "Une", 'modifier'=> '', 'align'=> "_center")					
					,array('sortField'=> "actualite_dateCreation", 'libelle'=> "Cr&eacute;ation", 'modifier'=> '', 'align'=> "_center")									
					,array('sortField'=> "actualite_dateModification", 'libelle'=> "Modification", 'modifier'=> '', 'align'=> "_center")									
					,array('sortField'=> "actualite_datePublication", 'libelle'=> "Publication", 'modifier'=> '', 'align'=> "_center")									
                    {*}
                
                    <td width="15%" class="color2"><strong>{$oActualite->categorieAct_libelle}</strong></td>							  
                    <td width="15%" class="color2 _center">
                        <a href="{jurl 'actualite~actualiteBo_editionActualite', $tPost}" class="blueHead">
                        <img width="98" height="74" border="0" alt="{$oActualite->actualite_titre}" src="{$j_basepath}resize/actualite/images/abrege/{$oActualite->actualite_photo}" name="imgPrinc">
                        </a>
                    </td>							  
                    <td width="40%" class="color2 _center">
                        <a href="{jurl 'actualite~actualiteBo_editionActualite', $tPost}"><strong>{$oActualite->actualite_titre}</strong></a>
                            <br><strong>ref.</strong> {$oActualite->actualite_reference}
                            <br><strong>src.</strong> {$oActualite->actualite_source}
                    </td>							  

                    <td width="0%" class="color2 _center">
                        <input type="checkbox" name="actualitePublier_{$oActualite->actualite_id}" value="{$oActualite->actualite_publier}" {if $oActualite->actualite_publier == 1}checked{/if} onclick="return checkActualite(this);">                
					</td>							  
                    <td width="0%" class="color2 _center">
                        <input type="checkbox" name="actualitePublierHome_{$oActualite->actualite_id}" value="{$oActualite->actualite_publierHome}" {if $oActualite->actualite_publierHome == 1}checked{/if} onclick="return checkActualiteHome(this);">                
					</td>							  
                    <td width="0%" class="color2 _center">
                        <input type="checkbox" name="actualiteLaUne_{$oActualite->actualite_id}" value="{$oActualite->actualite_laUne}" {if $oActualite->actualite_laUne == 1}checked{/if} onclick="return checkActualiteUne(this);">                
					</td>							  
                    <td width="5%" class="color2 _center">{$oActualite->actualite_dateCreation|date_format:"%d/%m/%Y"}</td>							  
                    <td width="5%" class="color2 _center">{$oActualite->actualite_dateModification|date_format:"%d/%m/%Y"}</td>							  
                    <td width="5%" class="color2 _center">{$oActualite->actualite_datePublication|date_format:"%d/%m/%Y (%H:%M:%S)"}</td>							  
    
                    {*if $canAdmin*}
                    <td width="5%" style="text-align:center" class="color1"><a href="{jurl 'actualite~actualiteBo_editionActualite', $tPost}"><img src="{$j_basepath}design/back/images/edit.gif" /></a></td>
                    <td width="5%" class="color2" style="text-align:center">
                        {if $nbAffectActualite}
                            <img src="{$j_basepath}design/back/images/delete_off.gif"/>	
                        {else}
                            <a id="btn_supprimer" alt="supprimer" href="{jurl 'actualite~actualiteBo_supprimeActualite', $tPost}"><img src="{$j_basepath}design/back/images/delete.gif"/></a>
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