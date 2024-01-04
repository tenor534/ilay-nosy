<?php 
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/html/function.jurl.php');
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/common/modifier.format_number.php');
function template_meta_266a538c16559c54ba5980402003099f($t){

return $t->_meta;
}
function template_266a538c16559c54ba5980402003099f($t){
?><div class="sortableListWithPagination">
<table class="expanded" cellspacing="0"  id="tableListeAnnonce" currentSortField="<?php echo $t->_vars['sortField']; ?>" currentSortDirection="<?php echo $t->_vars['sortDirection']; ?>" currentPage="<?php echo $t->_vars['page']; ?>" nbPage="<?php echo $t->_vars['nbPage']; ?>" src="<?php jtpl_function_html_jurl( $t,'commun~communBo_getZone', $t->_vars['tParams']);?>">
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
		<?php if(sizeof($t->_vars['toAnnonce'])==0):?>
			<tr class="row1">
				<td colspan="9" class="color2 _center b_orange">Aucun annonce enregistré</td>
			</tr>
		<?php else:?>
			<?php $t->_vars['i']=0;?>
			<?php $t->_vars['j']=0;?>
			<?php foreach($t->_vars['toAnnonce'] as $t->_vars['oAnnonce']):?>
                <?php $t->_vars['tPost']= array('annonce_id'=> $t->_vars['oAnnonce']->annonce_id, 'page'=>$t->_vars['page']);?>
                <?php $t->_vars['nbAffectAnnonce'] = $t->_vars['oAnnonce']->annonce_nbPhoto;?>
                <tr class="row<?php echo $t->_vars['i']++%2+1; ?>"> 
                    <td width="20%" class="color2"><?php echo $t->_vars['oAnnonce']->categorieAn_libelle; ?></td>							  
                    <td width="10%" class="color2 _center">
                        <a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceBo_editionAnnonce', $t->_vars['tPost']);?>" class="blueHead">
                        <img width="98" height="74" border="0" alt="<?php echo $t->_vars['oAnnonce']->annonce_titre; ?>" src="<?php echo $t->_vars['j_basepath']; ?>resize/annonce/images/abrege/<?php echo $t->_vars['oAnnonce']->annonce_photo; ?>" name="imgPrinc">
                        </a>
                    </td>							  
                    <td width="30%" class="color2 _center">
                        <a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceBo_editionAnnonce', $t->_vars['tPost']);?>"><?php echo $t->_vars['oAnnonce']->annonce_titre; ?></a>
                            <br>ref. <?php echo $t->_vars['oAnnonce']->annonce_reference; ?>
                            <br><?php echo $t->_vars['oAnnonce']->annonce_offre; ?>
                    </td>							  
                    <td width="20%" class="color2 _right" nowrap><?php if($t->_vars['oAnnonce']->annonce_prix): echo jtpl_modifier_common_format_number($t->_vars['oAnnonce']->annonce_prix, 0, ",", ' ','Ar');  else:?>N/D<?php endif;?></td>							  
                    <td width="20%" class="color2 _center">
                        <?php echo $t->_vars['oAnnonce']->annonce_annee; ?><br><?php echo $t->_vars['oAnnonce']->annonce_etat; ?> 
                    </td>							  
                    <td width="20%" class="color2 _center">
                        <input type="checkbox" name="annoncePublier_<?php echo $t->_vars['oAnnonce']->annonce_id; ?>" value="<?php echo $t->_vars['oAnnonce']->annonce_publier; ?>" <?php if($t->_vars['oAnnonce']->annonce_publier == 1):?>checked<?php endif;?> onclick="return checkAnnonce(this);">                
					</td>							  
                    <td width="20%" class="color2 _center">
                        <input type="checkbox" name="annoncePublierHome_<?php echo $t->_vars['oAnnonce']->annonce_id; ?>" value="<?php echo $t->_vars['oAnnonce']->annonce_publierHome; ?>" <?php if($t->_vars['oAnnonce']->annonce_publierHome == 1):?>checked<?php endif;?> onclick="return checkAnnonceHome(this);">                
					</td>							  
                    <td width="20%" class="color2 _center">
                        <input type="checkbox" name="annonceLaUne_<?php echo $t->_vars['oAnnonce']->annonce_id; ?>" value="<?php echo $t->_vars['oAnnonce']->annonce_laUne; ?>" <?php if($t->_vars['oAnnonce']->annonce_laUne == 1):?>checked<?php endif;?> onclick="return checkAnnonceUne(this);">                
					</td>							  
                    <td width="20%" class="color2 _center"><?php if($t->_vars['oAnnonce']->annonce_parution == 0):?>d'hui<?php else: echo $t->_vars['oAnnonce']->annonce_parution; ?> j<?php endif;?></td>							  
    
                    
                    <td width="10%" style="text-align:center" class="color1"><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceBo_editionAnnonce', $t->_vars['tPost']);?>"><img src="<?php echo $t->_vars['j_basepath']; ?>design/back/images/edit.gif" /></a></td>
                    <td width="10%" class="color2" style="text-align:center">
                        <?php if($t->_vars['nbAffectAnnonce']):?>
                            <img src="<?php echo $t->_vars['j_basepath']; ?>design/back/images/delete_off.gif"/>	
                        <?php else:?>
                            <a id="btn_supprimer" alt="supprimer" href="<?php jtpl_function_html_jurl( $t,'annonce~annonceBo_supprimeAnnonce', $t->_vars['tPost']);?>"><img src="<?php echo $t->_vars['j_basepath']; ?>design/back/images/delete.gif"/></a>
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