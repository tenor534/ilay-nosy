<div class="sortableListWithPagination">
<table class="expanded" cellspacing="0"  id="tableListePetiteAnnonce" currentSortField="{$sortField}" currentSortDirection="{$sortDirection}" currentPage="{$page}" nbPage="{$nbPage}" src="{jurl 'commun~communBo_getZone', $tParams}">
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
		{if sizeof($toPetiteAnnonce)==0}
			<tr class="row1">
				<td colspan="9" class="color2 _center b_orange">Aucune petiteAnnonce enregistr&eacute;e</td>
			</tr>
		{else}
			{assign $i=0}
			{assign $j=0}
			{foreach $toPetiteAnnonce as $oPetiteAnnonce}
            
                {assign $tPost= array('petiteAnnonce_id'=> $oPetiteAnnonce->petiteAnnonce_id, 'page'=>$page)}
                {*assign $nbAffectPetiteAnnonce = $oPetiteAnnonce->petiteAnnonce_nbPhoto*}
                <tr class="row{$i++%2+1}"> 
                    <td width="10%" class="color2">{$oPetiteAnnonce->categorieAn_libelle}</td>

                    <td width="15%" class="color2 _left">
                        <a href="{jurl 'petiteAnnonce~petiteAnnonceBo_editionPetiteAnnonce', $tPost}">{$oPetiteAnnonce->petiteAnnonce_reference}</a>
                    </td>							  
                    <td width="15%" class="color2 _right" nowrap>
                    	{if $oPetiteAnnonce->petiteAnnonce_prix}{$oPetiteAnnonce->petiteAnnonce_prix|format_number: 0, ",", ' ','Ar'}{else}N/D{/if}
                        <br />
                        ({$oPetiteAnnonce->petiteAnnonce_prixInfo})
                    </td>							  

                    <td width="40%" class="color2 _right" nowrap>
	                    {$oPetiteAnnonce->petiteAnnonce_titre}
                        <p>{$oPetiteAnnonce->petiteAnnonce_description}</p>
                    </td>							  
                    <td width="5%" class="color2 _right" nowrap>{$oPetiteAnnonce->petiteAnnonce_contact}</td>							  

                    <td width="2%" class="color2 _center">
                        <input type="checkbox" name="petiteAnnoncePublier_{$oPetiteAnnonce->petiteAnnonce_id}" value="{$oPetiteAnnonce->petiteAnnonce_publier}" {if $oPetiteAnnonce->petiteAnnonce_publier == 1}checked{/if} onclick="return checkPetiteAnnonce(this);">                
					</td>							  
                    <td width="2%" class="color2 _center">{$oPetiteAnnonce->petiteAnnonce_affichage}</td>							  
                    <td width="10%" class="color2 _center">{$oPetiteAnnonce->petiteAnnonce_dateCreation|date_format:"%d/%m/%Y (%H:%M:%S)"}</td>							  
    
                    {*if $canAdmin*}
                    <td width="10%" style="text-align:center" class="color1"><a href="{jurl 'petiteAnnonce~petiteAnnonceBo_editionPetiteAnnonce', $tPost}"><img src="{$j_basepath}design/back/images/edit.gif" /></a></td>
                    <td width="10%" class="color2" style="text-align:center">
	                    <a id="btn_supprimer" alt="supprimer" href="{jurl 'petiteAnnonce~petiteAnnonceBo_supprimePetiteAnnonce', $tPost}"><img src="{$j_basepath}design/back/images/delete.gif"/></a>
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