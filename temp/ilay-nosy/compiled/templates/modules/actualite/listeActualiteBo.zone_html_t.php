<?php 
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/html/function.jurl.php');
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/common/modifier.date_format.php');
function template_meta_b6173ec8ba151bf28554e0908e892616($t){

return $t->_meta;
}
function template_b6173ec8ba151bf28554e0908e892616($t){
?><div class="sortableListWithPagination">
<table class="expanded" cellspacing="0"  id="tableListeActualite" currentSortField="<?php echo $t->_vars['sortField']; ?>" currentSortDirection="<?php echo $t->_vars['sortDirection']; ?>" currentPage="<?php echo $t->_vars['page']; ?>" nbPage="<?php echo $t->_vars['nbPage']; ?>" src="<?php jtpl_function_html_jurl( $t,'commun~communBo_getZone', $t->_vars['tParams']);?>">
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
		<?php if(sizeof($t->_vars['toActualite'])==0):?>
			<tr class="row1">
				<td colspan="9" class="color2 _center b_orange">Aucun actualite enregistr&eacute;e</td>
			</tr>
		<?php else:?>
			<?php $t->_vars['i']=0;?>
			<?php $t->_vars['j']=0;?>
			<?php foreach($t->_vars['toActualite'] as $t->_vars['oActualite']):?>
                <?php $t->_vars['tPost']= array('actualite_id'=> $t->_vars['oActualite']->actualite_id, 'page'=>$t->_vars['page']);?>
                <?php $t->_vars['nbAffectActualite'] = $t->_vars['oActualite']->actualite_nbPhoto;?>
                <tr class="row<?php echo $t->_vars['i']++%2+1; ?>"> 
					
                
                    <td width="15%" class="color2"><strong><?php echo $t->_vars['oActualite']->categorieAct_libelle; ?></strong></td>							  
                    <td width="15%" class="color2 _center">
                        <a href="<?php jtpl_function_html_jurl( $t,'actualite~actualiteBo_editionActualite', $t->_vars['tPost']);?>" class="blueHead">
                        <img width="98" height="74" border="0" alt="<?php echo $t->_vars['oActualite']->actualite_titre; ?>" src="<?php echo $t->_vars['j_basepath']; ?>resize/actualite/images/abrege/<?php echo $t->_vars['oActualite']->actualite_photo; ?>" name="imgPrinc">
                        </a>
                    </td>							  
                    <td width="40%" class="color2 _center">
                        <a href="<?php jtpl_function_html_jurl( $t,'actualite~actualiteBo_editionActualite', $t->_vars['tPost']);?>"><strong><?php echo $t->_vars['oActualite']->actualite_titre; ?></strong></a>
                            <br><strong>ref.</strong> <?php echo $t->_vars['oActualite']->actualite_reference; ?>
                            <br><strong>src.</strong> <?php echo $t->_vars['oActualite']->actualite_source; ?>
                    </td>							  

                    <td width="0%" class="color2 _center">
                        <input type="checkbox" name="actualitePublier_<?php echo $t->_vars['oActualite']->actualite_id; ?>" value="<?php echo $t->_vars['oActualite']->actualite_publier; ?>" <?php if($t->_vars['oActualite']->actualite_publier == 1):?>checked<?php endif;?> onclick="return checkActualite(this);">                
					</td>							  
                    <td width="0%" class="color2 _center">
                        <input type="checkbox" name="actualitePublierHome_<?php echo $t->_vars['oActualite']->actualite_id; ?>" value="<?php echo $t->_vars['oActualite']->actualite_publierHome; ?>" <?php if($t->_vars['oActualite']->actualite_publierHome == 1):?>checked<?php endif;?> onclick="return checkActualiteHome(this);">                
					</td>							  
                    <td width="0%" class="color2 _center">
                        <input type="checkbox" name="actualiteLaUne_<?php echo $t->_vars['oActualite']->actualite_id; ?>" value="<?php echo $t->_vars['oActualite']->actualite_laUne; ?>" <?php if($t->_vars['oActualite']->actualite_laUne == 1):?>checked<?php endif;?> onclick="return checkActualiteUne(this);">                
					</td>							  
                    <td width="5%" class="color2 _center"><?php echo jtpl_modifier_common_date_format($t->_vars['oActualite']->actualite_dateCreation,"%d/%m/%Y"); ?></td>							  
                    <td width="5%" class="color2 _center"><?php echo jtpl_modifier_common_date_format($t->_vars['oActualite']->actualite_dateModification,"%d/%m/%Y"); ?></td>							  
                    <td width="5%" class="color2 _center"><?php echo jtpl_modifier_common_date_format($t->_vars['oActualite']->actualite_datePublication,"%d/%m/%Y (%H:%M:%S)"); ?></td>							  
    
                    
                    <td width="5%" style="text-align:center" class="color1"><a href="<?php jtpl_function_html_jurl( $t,'actualite~actualiteBo_editionActualite', $t->_vars['tPost']);?>"><img src="<?php echo $t->_vars['j_basepath']; ?>design/back/images/edit.gif" /></a></td>
                    <td width="5%" class="color2" style="text-align:center">
                        <?php if($t->_vars['nbAffectActualite']):?>
                            <img src="<?php echo $t->_vars['j_basepath']; ?>design/back/images/delete_off.gif"/>	
                        <?php else:?>
                            <a id="btn_supprimer" alt="supprimer" href="<?php jtpl_function_html_jurl( $t,'actualite~actualiteBo_supprimeActualite', $t->_vars['tPost']);?>"><img src="<?php echo $t->_vars['j_basepath']; ?>design/back/images/delete.gif"/></a>
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