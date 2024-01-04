<div class="sortableListWithPagination">
<table class="expanded" cellspacing="0"  id="tableListeUtilisateur" currentSortField="{$sortField}" currentSortDirection="{$sortDirection}" currentPage="{$page}" nbPage="{$nbPage}" src="{jurl 'commun~communBo_getZone', $tParams}">
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
		{if sizeof($toUtilisateur)==0}
			<tr class="row1">
				<td colspan="9" class="color2 _center b_orange">Aucun utilisateur enregistré</td>
			</tr>
		{else}
			{assign $i=0}
			{assign $j=0}
			{foreach $toUtilisateur as $oUtilisateur}
			{assign $tPost= array('utilisateur_id'=> $oUtilisateur->utilisateur_id, 'page'=>$page)}
            
			{assign $nbAffectUtilisateur = $oUtilisateur->utilisateur_nbCC + $oUtilisateur->utilisateur_nbCA + $oUtilisateur->utilisateur_nbAB}

			<tr class="row{$i++%2+1}"> 
			  	<td width="20%" class="color2">{$oUtilisateur->utilisateur_titre}</td>							  
			  	<td width="20%" class="color2">{$oUtilisateur->utilisateur_prenom}</td>							  
			  	<td width="20%" class="color2"><b>{$oUtilisateur->utilisateur_nom}</b></td>							  
			  	<td width="20%" class="color2">{$oUtilisateur->utilisateur_email}</td>							  
			  	<td width="20%" class="color2 _center">{$oUtilisateur->profil_code}</td>							  
			  	<td width="20%" class="color2 _center">{$oUtilisateur->pays_code}</td>							  
			  	<td width="20%" class="color2 _center">{$oUtilisateur->utilisateur_etat}</td>							  
				{*if $canAdmin*}
				<td width="10%" style="text-align:center" class="color1"><a href="{jurl 'utilisateur~utilisateurBo_editionUtilisateur', array('utilisateur_id'=>$oUtilisateur->utilisateur_id, 'page'=>$page)}"><img src="{$j_basepath}design/back/images/edit.gif" /></a></td>
				<td width="10%" class="color2" style="text-align:center">
					{if $nbAffectUtilisateur}
						<img src="{$j_basepath}design/back/images/delete_off.gif"/>	
					{else}
						<a id="btn_supprimer" alt="supprimer" href="{jurl 'utilisateur~utilisateurBo_supprimeUtilisateur', $tPost}"><img src="{$j_basepath}design/back/images/delete.gif"/></a>
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