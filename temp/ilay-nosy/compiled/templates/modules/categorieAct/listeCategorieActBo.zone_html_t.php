<?php 
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/html/function.jurl.php');
function template_meta_644e7fd4b37b5987671f09be0ca12c29($t){

return $t->_meta;
}
function template_644e7fd4b37b5987671f09be0ca12c29($t){
?><div class="sortableListWithPagination">
<table class="expanded" cellspacing="0"  id="tableListeCategorieAct" currentSortField="<?php echo $t->_vars['sortField']; ?>" currentSortDirection="<?php echo $t->_vars['sortDirection']; ?>" currentPage="<?php echo $t->_vars['page']; ?>" nbPage="<?php echo $t->_vars['nbPage']; ?>" src="<?php jtpl_function_html_jurl( $t,'commun~communBo_getZone', $t->_vars['tParams']);?>">
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
		<?php if(sizeof($t->_vars['toCategorieAct'])==0):?>
			<tr class="row1">
				<td colspan="9" class="color2 _center b_orange">Aucun categorieAct enregistré</td>
			</tr>
		<?php else:?>
			<?php $t->_vars['i']=0;?>
			<?php $t->_vars['j']=0;?>
			<?php foreach($t->_vars['toCategorieAct'] as $t->_vars['oCategorieAct']):?>
			<?php $t->_vars['tPost']= array('categorieAct_id'=> $t->_vars['oCategorieAct']->categorieAct_id, 'page'=>$t->_vars['page']);?>
			<?php $t->_vars['nbAffectCategorieAct'] = $t->_vars['oCategorieAct']->categorieAct_nbActualite;?>			
			<tr class="row<?php echo $t->_vars['i']++%2+1; ?>"> 
			  	<td width="30%" class="color2"><a href="<?php jtpl_function_html_jurl( $t,'categorieAct~categorieActBo_editionCategorieAct', $t->_vars['tPost']);?>"><?php echo $t->_vars['oCategorieAct']->categorieAct_libelle; ?> </a></td>							  
			  	<td width="10%" class="color2 _center"><?php echo $t->_vars['oCategorieAct']->categorieAct_code; ?></td>							  
				<td width="5%" style="text-align:center" class="color1"><a href="<?php jtpl_function_html_jurl( $t,'categorieAct~categorieActBo_editionCategorieAct', $t->_vars['tPost']);?>"><img src="<?php echo $t->_vars['j_basepath']; ?>design/back/images/edit.gif" /></a></td>
				<td width="5%" class="color2" style="text-align:center">
					<?php if($t->_vars['nbAffectCategorieAct']):?>
						<img src="<?php echo $t->_vars['j_basepath']; ?>design/back/images/delete_off.gif"/>	
					<?php else:?>
						<a alt="supprimer" href="<?php jtpl_function_html_jurl( $t,'categorieAct~categorieActBo_supprimeCategorieAct', $t->_vars['tPost']);?>"><img src="<?php echo $t->_vars['j_basepath']; ?>design/back/images/delete.gif"/></a>
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