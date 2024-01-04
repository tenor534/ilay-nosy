<?php 
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/html/function.jurl.php');
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/common/modifier.format_number.php');
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/common/modifier.date_format.php');
function template_meta_23eeca7288d20dc52db1d66a30c4edcf($t){

return $t->_meta;
}
function template_23eeca7288d20dc52db1d66a30c4edcf($t){
?><div class="sortableListWithPagination">
<table class="expanded" cellspacing="0"  id="tableListePetiteAnnonce" currentSortField="<?php echo $t->_vars['sortField']; ?>" currentSortDirection="<?php echo $t->_vars['sortDirection']; ?>" currentPage="<?php echo $t->_vars['page']; ?>" nbPage="<?php echo $t->_vars['nbPage']; ?>" src="<?php jtpl_function_html_jurl( $t,'commun~communBo_getZone', $t->_vars['tParams']);?>">
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
		<?php if(sizeof($t->_vars['toPetiteAnnonce'])==0):?>
			<tr class="row1">
				<td colspan="9" class="color2 _center b_orange">Aucune petiteAnnonce enregistr&eacute;e</td>
			</tr>
		<?php else:?>
			<?php $t->_vars['i']=0;?>
			<?php $t->_vars['j']=0;?>
			<?php foreach($t->_vars['toPetiteAnnonce'] as $t->_vars['oPetiteAnnonce']):?>
            
                <?php $t->_vars['tPost']= array('petiteAnnonce_id'=> $t->_vars['oPetiteAnnonce']->petiteAnnonce_id, 'page'=>$t->_vars['page']);?>
                
                <tr class="row<?php echo $t->_vars['i']++%2+1; ?>"> 
                    <td width="10%" class="color2"><?php echo $t->_vars['oPetiteAnnonce']->categorieAn_libelle; ?></td>

                    <td width="15%" class="color2 _left">
                        <a href="<?php jtpl_function_html_jurl( $t,'petiteAnnonce~petiteAnnonceBo_editionPetiteAnnonce', $t->_vars['tPost']);?>"><?php echo $t->_vars['oPetiteAnnonce']->petiteAnnonce_reference; ?></a>
                    </td>							  
                    <td width="15%" class="color2 _right" nowrap>
                    	<?php if($t->_vars['oPetiteAnnonce']->petiteAnnonce_prix): echo jtpl_modifier_common_format_number($t->_vars['oPetiteAnnonce']->petiteAnnonce_prix, 0, ",", ' ','Ar');  else:?>N/D<?php endif;?>
                        <br />
                        (<?php echo $t->_vars['oPetiteAnnonce']->petiteAnnonce_prixInfo; ?>)
                    </td>							  

                    <td width="40%" class="color2 _right" nowrap>
	                    <?php echo $t->_vars['oPetiteAnnonce']->petiteAnnonce_titre; ?>
                        <p><?php echo $t->_vars['oPetiteAnnonce']->petiteAnnonce_description; ?></p>
                    </td>							  
                    <td width="5%" class="color2 _right" nowrap><?php echo $t->_vars['oPetiteAnnonce']->petiteAnnonce_contact; ?></td>							  

                    <td width="2%" class="color2 _center">
                        <input type="checkbox" name="petiteAnnoncePublier_<?php echo $t->_vars['oPetiteAnnonce']->petiteAnnonce_id; ?>" value="<?php echo $t->_vars['oPetiteAnnonce']->petiteAnnonce_publier; ?>" <?php if($t->_vars['oPetiteAnnonce']->petiteAnnonce_publier == 1):?>checked<?php endif;?> onclick="return checkPetiteAnnonce(this);">                
					</td>							  
                    <td width="2%" class="color2 _center"><?php echo $t->_vars['oPetiteAnnonce']->petiteAnnonce_affichage; ?></td>							  
                    <td width="10%" class="color2 _center"><?php echo jtpl_modifier_common_date_format($t->_vars['oPetiteAnnonce']->petiteAnnonce_dateCreation,"%d/%m/%Y (%H:%M:%S)"); ?></td>							  
    
                    
                    <td width="10%" style="text-align:center" class="color1"><a href="<?php jtpl_function_html_jurl( $t,'petiteAnnonce~petiteAnnonceBo_editionPetiteAnnonce', $t->_vars['tPost']);?>"><img src="<?php echo $t->_vars['j_basepath']; ?>design/back/images/edit.gif" /></a></td>
                    <td width="10%" class="color2" style="text-align:center">
	                    <a id="btn_supprimer" alt="supprimer" href="<?php jtpl_function_html_jurl( $t,'petiteAnnonce~petiteAnnonceBo_supprimePetiteAnnonce', $t->_vars['tPost']);?>"><img src="<?php echo $t->_vars['j_basepath']; ?>design/back/images/delete.gif"/></a>
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