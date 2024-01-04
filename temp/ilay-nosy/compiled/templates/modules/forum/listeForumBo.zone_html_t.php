<?php 
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/html/function.jurl.php');
function template_meta_e7297fcbae8b0f4714893d0b697b88ec($t){

return $t->_meta;
}
function template_e7297fcbae8b0f4714893d0b697b88ec($t){
?><div class="sortableListWithPagination">
<table class="expanded" cellspacing="0"  id="tableListeForum" currentSortField="<?php echo $t->_vars['sortField']; ?>" currentSortDirection="<?php echo $t->_vars['sortDirection']; ?>" currentPage="<?php echo $t->_vars['page']; ?>" nbPage="<?php echo $t->_vars['nbPage']; ?>" src="<?php jtpl_function_html_jurl( $t,'commun~communBo_getZone', $t->_vars['tParams']);?>">
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
		<?php if(sizeof($t->_vars['toForum'])==0):?>
			<tr class="row1">
				<td colspan="9" class="color2 _center b_orange">Aucun forum enregistré</td>
			</tr>
		<?php else:?>
			<?php $t->_vars['i']=0;?>
			<?php $t->_vars['j']=0;?>
			<?php foreach($t->_vars['toForum'] as $t->_vars['oForum']):?>
			<?php $t->_vars['tPost']= array('forum_id'=> $t->_vars['oForum']->forum_id, 'page'=>$t->_vars['page']);?>
            
			<?php $t->_vars['nbAffectForum'] = $t->_vars['oForum']->forum_nbSujet;?>

			<tr class="row<?php echo $t->_vars['i']++%2+1; ?>"> 
			  	<td width="5%" class="color2 _center"><?php echo $t->_vars['oForum']->categorieFor_code; ?></td>							  
			  	<td width="5%" class="color2 _center"><?php echo $t->_vars['oForum']->forum_level; ?></td>							  
			  	<td width="25%" class="color2 _center"><?php echo $t->_vars['oForum']->forum_sortCode; ?></td>							  
			  	<td width="20%" class="color2"><?php echo $t->_vars['oForum']->forum_path; ?></td>							  
			  	<td width="40%" class="color2"><?php echo $t->_vars['oForum']->forum_libelle; ?></td>							  
				
				<td width="5%" style="text-align:center" class="color1"><a href="<?php jtpl_function_html_jurl( $t,'forum~forumBo_editionForum', array('forum_id'=>$t->_vars['oForum']->forum_id, 'page'=>$t->_vars['page']));?>"><img src="<?php echo $t->_vars['j_basepath']; ?>design/back/images/edit.gif" /></a></td>
				<td width="5%" class="color2" style="text-align:center">
					<?php if($t->_vars['nbAffectForum']):?>
						<img src="<?php echo $t->_vars['j_basepath']; ?>design/back/images/delete_off.gif"/>	
					<?php else:?>
						<a id="btn_supprimer" alt="supprimer" href="<?php jtpl_function_html_jurl( $t,'forum~forumBo_supprimeForum', $t->_vars['tPost']);?>"><img src="<?php echo $t->_vars['j_basepath']; ?>design/back/images/delete.gif"/></a>
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