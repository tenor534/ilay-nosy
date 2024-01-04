<?php 
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/html/function.jurl.php');
function template_meta_94dc8d6b0a1c1d411ce1400b1d00db06($t){

return $t->_meta;
}
function template_94dc8d6b0a1c1d411ce1400b1d00db06($t){
?><div class="sortableListWithPagination">
<table class="expanded" cellspacing="0"  id="tableListeUtilisateur" currentSortField="<?php echo $t->_vars['sortField']; ?>" currentSortDirection="<?php echo $t->_vars['sortDirection']; ?>" currentPage="<?php echo $t->_vars['page']; ?>" nbPage="<?php echo $t->_vars['nbPage']; ?>" src="<?php jtpl_function_html_jurl( $t,'commun~communBo_getZone', $t->_vars['tParams']);?>">
	<thead>
		<tr>
			<?php $t->_vars['i']=0;?>
			<?php foreach($t->_vars['tHead'] as $t->_vars['headFields']):?>
				<?php if($t->_vars['headFields']['sortField']!=''):?>
					<th rowspan="2" class="color<?php echo $t->_vars['i']++%2+1; ?> <?php echo $t->_vars['headFields']['align']; ?>" sortField="<?php echo $t->_vars['headFields']['sortField']; ?>"><?php echo $t->_vars['headFields']['libelle']; ?></th>
				<?php endif;?>
			<?php endforeach;?>
			
				<th width="20%" colspan="3" class="color3">Actions</th>
				
		</tr>
		
		<tr>
			<th width="10%" class="color2">Modify</th>
			<th width="10%" class="color1">Delete</th>
		</tr>
		
	</thead>

	<tbody>
		<?php if(sizeof($t->_vars['toUtilisateur'])==0):?>
			<tr class="row1">
				<td colspan="9" class="color2 _center b_orange">Aucun utilisateur enregistré</td>
			</tr>
		<?php else:?>
			<?php $t->_vars['i']=0;?>
			<?php $t->_vars['j']=0;?>
			<?php foreach($t->_vars['toUtilisateur'] as $t->_vars['oUtilisateur']):?>
			<?php $t->_vars['tPost']= array('utilisateur_id'=> $t->_vars['oUtilisateur']->utilisateur_id, 'page'=>$t->_vars['page']);?>
            
			<?php $t->_vars['nbAffectUtilisateur'] = $t->_vars['oUtilisateur']->utilisateur_nbCC + $t->_vars['oUtilisateur']->utilisateur_nbCA + $t->_vars['oUtilisateur']->utilisateur_nbAB;?>

			<tr class="row<?php echo $t->_vars['i']++%2+1; ?>"> 
			  	<td width="20%" class="color2"><?php echo $t->_vars['oUtilisateur']->utilisateur_titre; ?></td>							  
			  	<td width="20%" class="color2"><?php echo $t->_vars['oUtilisateur']->utilisateur_prenom; ?></td>							  
			  	<td width="20%" class="color2"><b><?php echo $t->_vars['oUtilisateur']->utilisateur_nom; ?></b></td>							  
			  	<td width="20%" class="color2"><?php echo $t->_vars['oUtilisateur']->utilisateur_email; ?></td>							  
			  	<td width="20%" class="color2 _center"><?php echo $t->_vars['oUtilisateur']->profil_code; ?></td>							  
			  	<td width="20%" class="color2 _center"><?php echo $t->_vars['oUtilisateur']->pays_code; ?></td>							  
			  	<td width="20%" class="color2 _center"><?php echo $t->_vars['oUtilisateur']->utilisateur_etat; ?></td>							  
				
				<td width="10%" style="text-align:center" class="color1"><a href="<?php jtpl_function_html_jurl( $t,'utilisateur~utilisateurBo_editionUtilisateur', array('utilisateur_id'=>$t->_vars['oUtilisateur']->utilisateur_id, 'page'=>$t->_vars['page']));?>"><img src="<?php echo $t->_vars['j_basepath']; ?>design/back/images/edit.gif" /></a></td>
				<td width="10%" class="color2" style="text-align:center">
					<?php if($t->_vars['nbAffectUtilisateur']):?>
						<img src="<?php echo $t->_vars['j_basepath']; ?>design/back/images/delete_off.gif"/>	
					<?php else:?>
						<a id="btn_supprimer" alt="supprimer" href="<?php jtpl_function_html_jurl( $t,'utilisateur~utilisateurBo_supprimeUtilisateur', $t->_vars['tPost']);?>"><img src="<?php echo $t->_vars['j_basepath']; ?>design/back/images/delete.gif"/></a>
					<?php endif;?>
				</td>			
							
			 </tr>

			<?php $t->_vars['j']++;?>
			<?php endforeach;?>
		<?php endif;?>
	 </tbody>
</table>
<p class="pagination">&nbsp;</p>
</div><?php 
}
?>