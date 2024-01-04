<?php 
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/html/function.jurl.php');
function template_meta_e24af713e8a5be941e1989c029a0e2a6($t){

return $t->_meta;
}
function template_e24af713e8a5be941e1989c029a0e2a6($t){
?><div class="sortableListWithPagination">
<table class="expanded" cellspacing="0"  id="tableListeCategorieAn" currentSortField="<?php echo $t->_vars['sortField']; ?>" currentSortDirection="<?php echo $t->_vars['sortDirection']; ?>" currentPage="<?php echo $t->_vars['page']; ?>" nbPage="<?php echo $t->_vars['nbPage']; ?>" src="<?php jtpl_function_html_jurl( $t,'commun~communBo_getZone', $t->_vars['tParams']);?>">
	<thead>
		<tr>
			<?php $t->_vars['i']=0;?>
			<?php foreach($t->_vars['tHead'] as $t->_vars['headFields']):?>
				<?php if($t->_vars['headFields']['sortField']!=''):?>
					<th rowspan="2" class="color<?php echo $t->_vars['i']++%2+1; ?> <?php echo $t->_vars['headFields']['align']; ?>" sortField="<?php echo $t->_vars['headFields']['sortField']; ?>"><?php echo $t->_vars['headFields']['libelle']; ?></th>
				<?php endif;?>
			<?php endforeach;?>
			<th width="10%" colspan="3" class="color3">Actions</th>
		</tr>
		<tr>
			<th width="5%" class="color2">Modif</th>
			<th width="5%" class="color1">Suppr</th>
		</tr>
	</thead>

	<tbody>
		<?php if(sizeof($t->_vars['toCategorieAn'])==0):?>
			<tr class="row1">
				<td colspan="9" class="color2 _center b_orange">Aucun categorieAn enregistré</td>
			</tr>
		<?php else:?>
			<?php $t->_vars['i']=0;?>
			<?php $t->_vars['j']=0;?>
			<?php foreach($t->_vars['toCategorieAn'] as $t->_vars['oCategorieAn']):?>
			<?php $t->_vars['tPost']= array('categorieAn_id'=> $t->_vars['oCategorieAn']->categorieAn_id, 'page'=>$t->_vars['page']);?>
			<?php $t->_vars['nbAffectCategorieAn'] = $t->_vars['oCategorieAn']->categorieAn_nbRubrique;?>			
			<tr class="row<?php echo $t->_vars['i']++%2+1; ?>"> 
			  	<td width="30%" class="color2"><?php echo $t->_vars['oCategorieAn']->categorieAn_libelle; ?> </td>							  
			  	<td width="10%" class="color2 _center"><?php echo $t->_vars['oCategorieAn']->categorieAn_code; ?></td>							  
				<td width="5%" style="text-align:center" class="color1"><a href="<?php jtpl_function_html_jurl( $t,'categorieAn~categorieAnBo_editionCategorieAn', $t->_vars['tPost']);?>"><img src="<?php echo $t->_vars['j_basepath']; ?>design/back/images/edit.gif" /></a></td>
				<td width="5%" class="color2" style="text-align:center">
					<?php if($t->_vars['nbAffectCategorieAn']):?>
						<img src="<?php echo $t->_vars['j_basepath']; ?>design/back/images/delete_off.gif"/>	
					<?php else:?>
						<a alt="supprimer" href="<?php jtpl_function_html_jurl( $t,'categorieAn~categorieAnBo_supprimeCategorieAn', $t->_vars['tPost']);?>"><img src="<?php echo $t->_vars['j_basepath']; ?>design/back/images/delete.gif"/></a>
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