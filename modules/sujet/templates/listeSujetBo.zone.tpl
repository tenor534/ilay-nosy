<div class="sortableListWithPagination">
<table class="expanded" cellspacing="0"  id="tableListeSujet" currentSortField="{$sortField}" currentSortDirection="{$sortDirection}" currentPage="{$page}" nbPage="{$nbPage}" src="{jurl 'commun~communBo_getZone', $tParams}">
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
		{if sizeof($toSujet)==0}
			<tr class="row1">
				<td colspan="9" class="color2 _center b_orange">Aucun sujet enregistr&eacute;e</td>
			</tr>
		{else}
			{assign $i=0}
			{assign $j=0}
			{foreach $toSujet as $oSujet}
                {assign $tPost= array('sujet_id'=> $oSujet->sujet_id, 'page'=>$page)}
                {assign $nbAffectSujet = $oSujet->sujet_nbPhoto}
                <tr class="row{$i++%2+1}"> 
					{*}                                
					 array('sortField'=> "forum_libelle", 'libelle'=> "Cat&eacute;g.", 'modifier'=> '', 'align'=> "_left")					
					,array('sortField'=> "sujet_photo", 'libelle'=> "Photo", 'modifier'=> '', 'align'=> "_left")					
					,array('sortField'=> "sujet_titre", 'libelle'=> "Titre", 'modifier'=> '', 'align'=> "_left")					
					,array('sortField'=> "sujet_publier", 'libelle'=> "Pub", 'modifier'=> '', 'align'=> "_center")					
					,array('sortField'=> "sujet_publierHome", 'libelle'=> "Pub H", 'modifier'=> '', 'align'=> "_center")					
					,array('sortField'=> "sujet_laUne", 'libelle'=> "Une", 'modifier'=> '', 'align'=> "_center")					
					,array('sortField'=> "sujet_dateCreation", 'libelle'=> "Cr&eacute;ation", 'modifier'=> '', 'align'=> "_center")									
					,array('sortField'=> "sujet_dateModification", 'libelle'=> "Modification", 'modifier'=> '', 'align'=> "_center")									
					,array('sortField'=> "sujet_datePublication", 'libelle'=> "Publication", 'modifier'=> '', 'align'=> "_center")									
                    {*}
                
                    <td width="15%" class="color2"><strong>{$oSujet->forum_libelle}</strong></td>							  
                    <td width="15%" class="color2 _center">
                        <a href="{jurl 'sujet~sujetBo_editionSujet', $tPost}" class="blueHead">
                        <img width="98" height="74" border="0" alt="{$oSujet->sujet_titre}" src="{$j_basepath}resize/sujet/images/abrege/{$oSujet->sujet_photo}" name="imgPrinc">
                        </a>
                    </td>							  
                    <td width="40%" class="color2 _center">
                        <a href="{jurl 'sujet~sujetBo_editionSujet', $tPost}"><strong>{$oSujet->sujet_titre}</strong></a>
                            <br><strong>ref.</strong> {$oSujet->sujet_reference}
                            <br><strong>src.</strong> {$oSujet->sujet_source}
                    </td>							  

                    <td width="0%" class="color2 _center">
                        <input type="checkbox" name="sujetPublier_{$oSujet->sujet_id}" value="{$oSujet->sujet_publier}" {if $oSujet->sujet_publier == 1}checked{/if} onclick="return checkSujet(this);">                
					</td>							  
                    <td width="0%" class="color2 _center">
                        <input type="checkbox" name="sujetPublierHome_{$oSujet->sujet_id}" value="{$oSujet->sujet_publierHome}" {if $oSujet->sujet_publierHome == 1}checked{/if} onclick="return checkSujetHome(this);">                
					</td>							  
                    <td width="0%" class="color2 _center">
                        <input type="checkbox" name="sujetLaUne_{$oSujet->sujet_id}" value="{$oSujet->sujet_laUne}" {if $oSujet->sujet_laUne == 1}checked{/if} onclick="return checkSujetUne(this);">                
					</td>							  
                    <td width="5%" class="color2 _center">{$oSujet->sujet_dateCreation|date_format:"%d/%m/%Y"}</td>							  
                    <td width="5%" class="color2 _center">{$oSujet->sujet_dateModification|date_format:"%d/%m/%Y"}</td>							  
                    <td width="5%" class="color2 _center">{$oSujet->sujet_datePublication|date_format:"%d/%m/%Y (%H:%M:%S)"}</td>							  
    
                    {*if $canAdmin*}
                    <td width="5%" style="text-align:center" class="color1"><a href="{jurl 'sujet~sujetBo_editionSujet', $tPost}"><img src="{$j_basepath}design/back/images/edit.gif" /></a></td>
                    <td width="5%" class="color2" style="text-align:center">
                        {if $nbAffectSujet}
                            <img src="{$j_basepath}design/back/images/delete_off.gif"/>	
                        {else}
                            <a id="btn_supprimer" alt="supprimer" href="{jurl 'sujet~sujetBo_supprimeSujet', $tPost}"><img src="{$j_basepath}design/back/images/delete.gif"/></a>
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