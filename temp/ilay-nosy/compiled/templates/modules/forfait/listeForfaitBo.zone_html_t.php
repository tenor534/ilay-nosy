<?php 
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/html/function.jurl.php');
function template_meta_81fee323d588b3fe5fce8ca2cd93f06b($t){

return $t->_meta;
}
function template_81fee323d588b3fe5fce8ca2cd93f06b($t){
?><div class="sortableListWithPagination">
<table class="expanded" cellspacing="0"  id="tableListeForfait" currentSortField="<?php echo $t->_vars['sortField']; ?>" currentSortDirection="<?php echo $t->_vars['sortDirection']; ?>" currentPage="<?php echo $t->_vars['page']; ?>" nbPage="<?php echo $t->_vars['nbPage']; ?>" src="<?php jtpl_function_html_jurl( $t,'commun~communBo_getZone', $t->_vars['tParams']);?>">
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
		<?php if(sizeof($t->_vars['toForfait'])==0):?>
			<tr class="row1">
				<td colspan="9" class="color2 _center b_orange">Aucun forfait enregistré</td>
			</tr>
		<?php else:?>
			<?php $t->_vars['i']=0;?>
			<?php $t->_vars['j']=0;?>
			<?php foreach($t->_vars['toForfait'] as $t->_vars['oForfait']):?>
			<?php $t->_vars['tPost']= array('forfait_id'=> $t->_vars['oForfait']->forfait_id, 'page'=>$t->_vars['page']);?>
            
			<?php $t->_vars['nbAffectForfait'] = $t->_vars['oForfait']->forfait_nbAbonnement;?>

			<tr class="row<?php echo $t->_vars['i']++%2+1; ?>"> 
			  	<td width="20%" class="color2 _center"><?php echo $t->_vars['oForfait']->pack_code; ?></td>							  
			  	<td width="70%" class="color2"><?php echo $t->_vars['oForfait']->forfait_libelle; ?></td>							  
				
				<td width="5%" style="text-align:center" class="color1"><a href="<?php jtpl_function_html_jurl( $t,'forfait~forfaitBo_editionForfait', array('forfait_id'=>$t->_vars['oForfait']->forfait_id, 'page'=>$t->_vars['page']));?>"><img src="<?php echo $t->_vars['j_basepath']; ?>design/back/images/edit.gif" /></a></td>
				<td width="5%" class="color2" style="text-align:center">
					<?php if($t->_vars['nbAffectForfait']):?>
						<img src="<?php echo $t->_vars['j_basepath']; ?>design/back/images/delete_off.gif"/>	
					<?php else:?>
						<a id="btn_supprimer" alt="supprimer" href="<?php jtpl_function_html_jurl( $t,'forfait~forfaitBo_supprimeForfait', $t->_vars['tPost']);?>"><img src="<?php echo $t->_vars['j_basepath']; ?>design/back/images/delete.gif"/></a>
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